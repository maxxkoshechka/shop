<?php


namespace app\controllers\admin;


use app\models\User;
use ishop\libs\Pagination;

class UserController extends AppController
{
    public function loginAdminAction() {
        $this->layout = 'loginAdmin';
        if (!empty($_POST)){
            $user = new User();
            if (!$user->login(true)){
                $_SESSION['error'] = 'Логин/пароль введены не верно!';
            }
            if (User::isAdmin()){
                redirect(ADMIN);
            }
            else redirect();
        }
    }

    public function indexAction() {
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $perpage = 20;
        $count = \R::count('user');
        $pagination = new Pagination($page, $perpage, $count);
        $start = $pagination->getStart();
        $users = \R::findAll('user', "LIMIT $start, $perpage");
        $this->setMeta('Список пользователей');
        $this->set(compact('users', 'count', 'pagination'));
    }

    public function editAction() {
        if (!empty($_POST)){
            $id = $this->getRequestId(false);
            $user = new \app\models\admin\User();
            $data = $_POST;
            $user->load($data);
            if (!$user->attributes['password']){
                unset($user->attributes['password']);
            }
            else{
                $user->attributes['password'] = password_hash($user->attributes['password'], PASSWORD_DEFAULT);
            }
            if (!$user->validate($data) || !$user->checkUnique()){
                $user->getErrors();
                redirect();
            }
            if ($user->update('user', $id)){
                $_SESSION['success'] = 'Изменения сохранены';
            }
            redirect();
        }
        $user_id = $this->getRequestId();
        $user = \R::load('user', $user_id);
        $this->setMeta('Редактирование пользователя');

        $orders = \R::getAll("SELECT `order`.`id`, `order`.`user_id`, `order`.`status`, `order`.`date`, `order`.`update_at`, `order`.`currency`, ROUND(SUM(`order_product`.`price`), 2) AS `sum` FROM `order` JOIN `order_product` ON `order`.`id` = `order_product`.`order_id` WHERE user_id = {$user_id} GROUP BY `order`.`id` ORDER BY `order`.`status`, `order`.`id`");

        $this->set(compact('user', 'orders'));
    }
    public function addAction() {
        $this->setMeta('Новый пользователь');

    }
    public function deleteAction() {
        $id = $this->getRequestId();
        $userDel = \R::load('user', $id);
        \R::trash($userDel);
        $_SESSION['success'] = 'Пользователь удален!';
        redirect(ADMIN.'/user');
    }
}