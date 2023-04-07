<?php

require 'Model.php';

class User extends Model
{
    public string $firstname;
    public string $email;


    function rules()
    {
        return [
            'firstname' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8]],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED]
        ];
    }
}