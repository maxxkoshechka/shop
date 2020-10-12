<?php


namespace app\widgets\filter;


use ishop\Cache;

class Filter
{

    public $groups;
    public $attributes;
    public $tpl;
    public $filter;


    public function __construct($filter = null, $tpl = '')
    {
        $this->filter = $filter;
        $this->tpl = $tpl ?: __DIR__ . '/filter_tpl.php';
        $this->run();
    }

    protected function run() {
        $cache = Cache::instance();
        $this->groups = $cache->get('filter_group');
        if (!$this->groups){
            $this->groups = $this->getGroups();
            $cache->set('filter_group', $this->groups, 1);
        }
        $this->attributes = $cache->get('filter_attributes');
        if (!$this->attributes){
            $this->attributes = self::getAttributes();
            $cache->set('filter_attributes', $this->attributes);
        }
        $filters = $this->getHtml();
        echo $filters;
    }

    protected function getGroups() {
        return \R::getAssoc('SELECT id, title FROM attribute_group');
    }

    protected static function getAttributes() {
       $data = \R::getAssoc('SELECT * FROM attribute_value');
       $attributes = [];
       foreach ($data as $key => $value){
           $attributes[$value['attr_group_id']][$key] = $value['value'];
       }
       return $attributes;
    }

    protected function getHtml() {
        ob_start();
        $filter = self::getFilter();
        if (!empty($filter)){
            $filter = explode(',', $filter);
        }
        require $this->tpl;
        return ob_get_clean();
    }

    public static function getFilter() {
        $filter = null;
        if (!empty($_GET['filter'])){
            $filter = preg_replace("#[^\d,]+#", '', $_GET['filter']);
            $filter = rtrim($filter, ',');
            return $filter;
        }
    }

    public static function getCountGroups($filter){
        $filters = explode(',', $filter);
        $cache = Cache::instance();
        $attrs = $cache->get("filter_attributes");
        if (!$attrs){
            $attrs = self::getAttributes();
        }
        $data = [];
        foreach ($attrs as $key => $value){
            foreach ($value as $k => $v ){
                if (in_array($k, $filters)){
                    $data[] = $key;
                    break;
                }
            }
        }
        return count($data);
    }
}