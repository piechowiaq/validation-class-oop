<?php

class Validator
{
    /*Validator*/

    public mixed $data;
    public mixed $rules;
    public array $errors = array();

    public function __construct($data, $rules)
    {
        $this->data = $data;
        $this->rules = $rules;
    }

    public function validate(): array
    {
        /*foreach array with rules as name firstname, email, password => rules required, min:3*/
        foreach($this->rules as $name => $rules){
            /*foreach array with rules required, min:3*/
            foreach ($rules as $rule){
                /*if : found explode for min & 3*/
                $rule_value = explode(':', $rule);
                /*rule_name = min as $rule_value[0] - first element of explode*/
                $rule_name =  $rule_value[0];
                /*if key 1 exist in array value = key[1] which is 3*/
                $value = (array_key_exists(1, $rule_value)) ? $rule_value[1] : null;

                /*name => first name , $value is null if required if min it is 3*/
                echo "<pre>";
                var_dump($this->$rule_name($name, $value));
                echo "</pre>";
                exit;
                if (!$this->$rule_name($name, $value)) break 2;
            }
        }
        return $this->errors;
    }

    public function required($name, $value): bool
    {
        if (trim($this->data[$name]) == '' || $this->data[$name] == null){
            $this->errors[$name] =  "$name is required";
            return false;
        }

        return true;
    }

    public function min($name, $value): bool
    {
        if (is_string($this->data[$name])){
            if (strlen($this->data[$name]) < $value){
                $this->errors[$name] =  "$name must have min $value characters";
                return false;
            }
        }
        else {
            if ($this->data[$name] < $value){
                $this->errors[$name] =  "$name can't have more then $value characters";
                return false;
            }
        }

        return true;
    }


}