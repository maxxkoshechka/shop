<?php

namespace ishop\base;

use ishop\Db;
use Valitron\Validator;

abstract class Model{

    public $attributes = [];
    public $errors = [];
    public $rules = [];

    public function __construct(){
        Db::instance();
    }

    public function load($data) {
        foreach ($this->attributes as $name => $value){
            if (isset($data[$name])){
                $this->attributes[$name] = $data[$name];
            }
        }
    }

    public function validate($data) {
        Validator::langDir(WWW . '/validator/lang');
        Validator::lang('ru');
        $v = new Validator($data);
        $v->rules($this->rules);
        if ($v->validate()){
            return true;
        }
        else {
            $this->errors = $v->errors();
            return false;
        }
    }

    public function getErrors() {
        $errors = '<ul>';
        foreach ($this->errors as $error){
            foreach ($error as $item){
                $errors .= "<li>$item</li>";
            }
        }
        $errors .= '</ul>';
        $_SESSION['errors'] = $errors;
    }

    public function save($table, $valid = true) {
        if ($valid){
            $tbl = \R::dispense($table);
        }
        else{
            $tbl = \R::xdispense($table);
        }
        foreach ($this->attributes as $name => $value){
            $tbl->$name = $value;
        }
        return \R::store($tbl);
    }

    public function update($table, $id) {
        $been = \R::load($table, $id);
        foreach ($this->attributes as $name => $value){
            $been->$name = $value;
        }
        return \R::store($been);

    }

}