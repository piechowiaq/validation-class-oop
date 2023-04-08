<?php

class Validator {
    protected $data;
    protected $errors = [];

    public function __construct($data) {
        $this->data = $data;
    }

    public function validate($rules) {
        foreach ($rules as $field => $rule) {
            $rules = explode('|', $rule);
            foreach ($rules as $r) {
                $this->applyRule($field, $r);
            }
        }
        return $this->errors;
    }

    protected function applyRule($field, $rule) {
        $params = explode(':', $rule);

        $method = 'validate' . ucfirst($params[0]);

        if (method_exists($this, $method)) {
            $value = $this->data[$field];

            $rule = $params[0];

            array_shift($params);
            array_unshift($params, $value);

            $result = call_user_func_array([$this, $method], $params);


            if (!$result) {

                $this->addError($field,  $rule, $params[1] ?? "");
            }
        }
    }

    protected function addError($field, $rule, $params)
    {
        $errorMessage = $this->errorMessage($field, $rule, $params);
        return $this->errors[$field] = $errorMessage;
    }

    public function errorMessage($field, $rule, $params)
    {
        return $this->errorMessages($field, $params)[$rule];
    }


    protected function errorMessages($field, $params){
        $field = ucfirst($field);
        return [
            'required' => "{$field} is required",
            'min' => "{$field} has to be min {$params} characters.",
            'max' => "{$field} has to be max {$params} characters.",
            'email' => "{$field} has to be valid email address.",
        ];
    }

    protected function validateRequired($value) {

        return !empty($value);
    }

    protected function validateEmail($value) {
        return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
    }

    protected function validateMin($value, $min) {

        return strlen($value) >= $min;
    }

    protected function validateMax($value, $max) {
        return strlen($value) <= $max;
    }
}
