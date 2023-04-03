<?php

class Validator
{
    public mixed $data;
    public mixed $rules;
    public array $errors = array();

    public function __construct($data, $rules)
    {
        $this->data = $data;
        $this->rules = $rules;
    }

    public function validate()
    {

    }


}