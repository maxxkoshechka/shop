<?php


namespace app\controllers\admin;


use app\models\admin\FilterAttr;
use app\models\admin\FilterGroup;

class filterController extends AppController
{
    public function attributeGroupAction() {
        $attrsGroup = \R::findAll('attribute_group');
        $this->setMeta('Группы фильтров');
        $this->set(compact('attrsGroup'));
    }

    public function attributeAction() {
        $attrs = \R::getAssoc("SELECT attribute_value.*, attribute_group.title FROM attribute_value JOIN attribute_group ON attribute_group.id = attribute_value.attr_group_id");
        $this->setMeta('Фильтры');
        $this->set(compact('attrs'));
    }

    public function groupDeleteAction() {
        $id = $this->getRequestId();
        $count = \R::count('attribute_value', 'attr_group_id = ?', [$id]);
        if ($count){
            $_SESSION['errors'] = 'удаление невозможно, в группе есть атрибуты';
            redirect();
        }
        $group = \R::exec('DELETE FROM attribute_group WHERE id = ?', [$id]);
        if ($group){
            $_SESSION['success'] = 'Удалено';
            redirect();
        }else{
            $_SESSION['errors'] = 'удаление невозможно, удаление группы не удалось';
            redirect();
        }

    }

    public function attributeDeleteAction() {
        $id = $this->getRequestId();
        $product = \R::exec('DELETE FROM attribute_product WHERE attr_id = ?', [$id]); // удаление связанных продуктов
        if ($product){
            $attr = \R::exec('DELETE FROM attribute_value WHERE id = ?', [$id]);
            if ($attr){
                $_SESSION['success'] = 'Удалено';
                redirect();
            }else{
                $_SESSION['errors'] = 'удаление невозможно, удаление атрибута не удалось';
                redirect();
            }
        }else{
            $_SESSION['errors'] = 'удаление невозможно, удаление связанных продуктов не удалось';
            redirect();
        }
    }

    public function groupAddAction() {
        if (!empty($_POST)){
            $group = new FilterGroup();
            $data = $_POST;
            $group->load($data);
            if (!$group->validate($data)){
                $group->getErrors();
                redirect();
            }
            if ($group->save('attribute_group', false)){
                $_SESSION['success'] = 'группа добавлена';
                redirect();
            }
        }
        $this->setMeta('Новая группа фильтров');
    }

    public function attributeAddAction() {
        if (!empty($_POST)){
            $attr = new FilterAttr();
            $data = $_POST;
            $attr->load($data);
            if (!$attr->validate($data)){
                $attr->getErrors();
                redirect();
            }
            if ($attr->save('attribute_value', false)){
                $_SESSION['success'] = 'фильтр добавлен';
                redirect();
            }
        }
        $group = \R::findAll('attribute_group');
        $this->set(compact('group'));
        $this->setMeta('Новаый фильтр');
    }

    public function groupEditAction(){
        if(!empty($_POST)){
            $id = $this->getRequestID(false);
            $group = new FilterGroup();
            $data = $_POST;
            $group->load($data);
            if(!$group->validate($data)){
                $group->getErrors();
                redirect();
            }
            if($group->update('attribute_group', $id)){
                $_SESSION['success'] = 'Изменения сохранены';
                redirect();
            }
        }
        $id = $this->getRequestID();
        $group = \R::load('attribute_group', $id);
        $this->setMeta("Редактирование группы {$group->title}");
        $this->set(compact('group'));
    }

    public function attributeEditAction(){
        if (!empty($_POST)){
            $id = $this->getRequestID(false);
            $attr = new FilterAttr();
            $data = $_POST;
            $attr->load($data);
            if (!$attr->validate($data)){
                $attr->getErrors();
                redirect();
            }
            if ($attr->update('attribute_value', $id)){
                $_SESSION['success'] = 'Изменения сохранены';
                redirect();
            }
        }
        $id = $this->getRequestID();
        $attr = \R::load('attribute_value', $id);
        $group = \R::findAll('attribute_group');
        $this->set(compact('attr', 'group'));
        $this->setMeta('Редактирование фильтра');
    }
}