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

    public function validate(): array
    {
        foreach($this->rules as $name => $rules){
            foreach ($rules as $rule){
                $rule_value = explode(':', $rule);
                $rule_name =  $rule_value[0];
                $value = (array_key_exists(1, $rule_value)) ? $rule_value[1] : null;
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