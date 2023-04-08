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
//            echo "<pre>";
//            var_dump($params);
//            echo "</pre>";
//            exit;
//            array_shift($params);
//            echo "<pre>";
//            var_dump($params);
//            echo "</pre>";
//            exit;
            array_unshift($params, $this->data[$field]);
            echo "<pre>";
            var_dump($params);
            echo "</pre>";
            exit;

            $result = call_user_func_array([$this, $method], $params);
            if (!$result) {
                echo "<pre>";
                var_dump($params);
                echo "</pre>";
                exit;
                $this->addError($field, $params[0]);
            }
        }
    }

    protected function addError($field, $rule) {
        $this->errors[$field][] = $rule;
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
