<?php


namespace app\controllers\admin;


use ishop\libs\Pagination;
use PDO;

class OrderController extends AppController
{
    public function indexAction() {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = 2;
        $count = \R::count('order');
        $pagination = new Pagination($page, $perpage, $count);
        $start = $pagination->getStart();

        $orders = \R::getAll("SELECT `order`.`id`, `order`.`user_id`, `order`.`status`, `order`.`date`, `order`.`update_at`, `order`.`currency`, `user`.`name`, ROUND(SUM(`order_product`.`price`), 2) AS `sum` FROM `order` JOIN `user` ON `order`.`user_id` = `user`.`id` JOIN `order_product` ON `order`.`id` = `order_product`.`order_id` GROUP BY `order`.`id` ORDER BY `order`.`status`, `order`.`id` LIMIT $start, $perpage");


        $this->setMeta('Список заказов');
        $this->set(compact('orders', 'pagination', 'count'));
    }

    public function viewAction() {
        $orderId = $this->getRequestId();
        $order = \R::getRow("SELECT `order`.*, `user`.`name`, ROUND(SUM(`order_product`.`price`), 2) AS `sum` FROM `order`
  JOIN `user` ON `order`.`user_id` = `user`.`id`
  JOIN `order_product` ON `order`.`id` = `order_product`.`order_id`
  WHERE `order`.`id` = ?
  GROUP BY `order`.`id` ORDER BY `order`.`status`, `order`.`id` LIMIT 1", [$orderId]);
        if (!$order){
            throw new \Exception('страница не найдена', 404);
        }
        $orderProducts = \R::findAll('order_product', 'order_id = ?', [$orderId]);
        $this->setMeta("Заказ № {$orderId}");
        $this->set(compact('order', 'orderProducts'));
    }
    public function changeAction(){
        $orderId = $this->getRequestId();
        $status = !empty($_GET['status']) ? '1' : '0';
        $order = \R::load('order', $orderId);
        if(!$order){
            throw new \Exception('Страница не найдена', 404);
        }
        $order->status = $status;
        $order->update_at = date("Y-m-d H:i:s");
        \R::store($order);

        $_SESSION['success'] = 'Изменения сохранены';
        redirect();
    }

    public function deleteAction() {
        $orderId = $this->getRequestId();
        $order = \R::load('order', $orderId);
        \R::trash($order);
        $_SESSION['success'] = 'Заказ удален!';
        redirect(ADMIN.'/order');
    }
}