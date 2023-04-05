<?php

abstract class Model
{
    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min';

   abstract function rules();

   public function validate()
   {
        foreach ($this->rules() as $attribute => $rules){

        }
   }
}