<?php

class Model {

    private $attributes;

    public abstract function delete();

    public abstract function save();

    public abstract function update();

    public abstract function validate();

}