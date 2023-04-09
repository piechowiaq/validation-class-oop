<?php

class Validator
{
    protected $data;
    protected $rules;
    protected $errors = [];

    public function __construct($data, $rules)
    {
        $this->data = $data;
        $this->rules = $rules;
    }

    public function validate()
    {
        foreach ($this->rules as $field => $rules) {
            $value = htmlspecialchars(stripcslashes(trim($this->data[$field])));
            foreach ($rules as $rule) {
                $params = explode(':', $rule);
                $method = 'validate' . ucfirst($params[0]);
                if (method_exists($this, $method)) {
                    if (!call_user_func_array([$this, $method], [$field, $value, $params])) {
                        break;
                    }
                }
            }
        }
        return empty($this->errors);
    }

    protected function addError($field, $message)
    {
        $this->errors[$field] = $message;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    protected function validateRequired($field, $value, $params)
    {
        if (empty($value)) {
            $this->addError($field, "The {$field} field is required.");
            return false;
        }
        return true;
    }

    protected function validateMin($field, $value, $params)
    {
        $min = $params[1];
        if (strlen($value) < $min) {
            $this->addError($field, "The {$field} field must be at least {$min} characters.");
            return false;
        }
        return true;
    }

    protected function validateEmail($field, $value, $params)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->addError($field, "The {$field} field must be a valid email address.");
            return false;
        }
        return true;
    }

    protected function validateMatch($field, $value, $params)
    {
        if($value !== $this->data[$params[1]]){
            $this->addError($field, "The {$field} field must match field {$params[1]}.");
            return false;
        }
        return true;

    }
}


