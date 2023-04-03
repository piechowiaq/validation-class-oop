<?php

class Validator
{
    public static function string($value, $min = 1, $max = INF): bool
    {
        $value = htmlspecialchars(stripcslashes(trim($value)));

        return strlen($value) >= $min && strlen($value) <= $max;
    }

    public static function email($value)
    {
        $value = htmlspecialchars(stripcslashes(trim($value)));

        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

}