<?php


namespace app\models;


use ishop\App;

class Category extends AppModel
{

    public $attributes = [
        'title' => '',
        'parent_id' => '',
        'keywords' => '',
        'description' => '',
        'alias' => '',
    ];

    public $rules = [
        'required' => [
            ['title'],
        ]
    ];

    public function getIds($id) {
        $cats = App::$app->getProperty('cats');
        $ids = null;
        foreach ($cats as $key => $value){
            if ($value['parent_id'] == $id){
                $ids .= $key . ',';
                $ids .= $this->getIds($key);
            }
        }
        return $ids;
    }
}