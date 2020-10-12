<?php


namespace app\controllers;


class SearchController extends AppController
{
    public function typeaheadAction() {
        if ($this->isAjax()){
            $query = !empty(trim($_GET['query'])) ? trim($_GET['query']) : null;
            if ($query){
                $product = \R::getAll("SELECT id, title FROM product WHERE title LIKE ? AND status = '1' LIMIT 11", ["%{$query}%"]);
                echo json_encode($product);
            }
        }
        die();
    }

    public function indexAction() {
        $query = !empty(trim($_GET['s'])) ? trim($_GET['s']) : null;
        if ($query){
            $products = \R::find('product', "title LIKE ? AND status = '1' ", ["%{$query}%"]);
        }
        $query = getNoHtmlString($query);
        $this->setMeta('Поиск по: ' . $query);
        $this->set(compact('products', 'query'));
    }
}