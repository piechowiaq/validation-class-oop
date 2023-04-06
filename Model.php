<?php

abstract class Model
{
    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min';

    public array $errors = [];

   abstract function rules();

   public function validate()
   {
        foreach ($this->rules() as $attribute => $rules){
            $value = $this->{$attribute};


            foreach ($rules as $rule){

                if(!is_string($rule)){


                    if($rule[0] === self::RULE_REQUIRED && !$value){
                        $this->addError($attribute, self::RULE_REQUIRED);
                    }
                }
            }
        }

        return empty($this->errors);
   }

   public function addError(string $attribute, string $rule)
   {
       $message = $this->errorMessages()[$rule] ?? '';
       $this->errors[$attribute][] = $message;
   }

    private function errorMessages()
    {
        return [
            self::RULE_REQUIRED => 'This field is required',
            self::RULE_EMAIL => 'This field has to be a valid email address',
            self::RULE_MIN => 'Min length of this field must be {min}',
        ];
    }

    public function errorMessage($rule)
    {
        return $this->errorMessages()[$rule];
    }
}