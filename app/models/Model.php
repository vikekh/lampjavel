<?php

use Eloquence\Database\Traits\CamelCaseModel;

abstract class Model extends \Illuminate\Database\Eloquent\Model {
    use CamelCaseModel;

    public function save(array $options = array()) {
        if ($this->validate()) {
            return parent::save($options);
        }

        return null;
    }

    public abstract function validate();
}