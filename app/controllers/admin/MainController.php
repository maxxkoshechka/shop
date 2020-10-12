<?php


namespace app\controllers\admin;


class MainController extends AppController
{

    public function indexAction() {
        $this->setMeta('Панель администратора');
        $countNewOrders = \R::count('order', "status = '0'");
        $countUsers = \R::count('user');
        $countProduct = \R::count('product');
        $countCategory = \R::count('category');
        $this->set(compact('countNewOrders', 'countCategory', 'countProduct', 'countUsers'));
    }

}