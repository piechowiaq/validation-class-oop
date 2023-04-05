<?php

class User extends Model
{
    public string $firstname;
    public string $email;


    function rules()
    {
        return [
            'firstname' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL]
        ];
    }
}