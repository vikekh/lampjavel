<?php namespace Vikekh\Lampjavel\Api\Models\Traits;

trait ValidatingTrait {
    public function save(array $options = array()) {
        if ($this->validate()) {
            return parent::save($options);
        }

        return null;
    }

    public abstract function validate();
}