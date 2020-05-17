<?php

class Input
{
    public static function get($method)
    {
        if (isset($_POST[$method])) {
            return $_POST[$method];
        } elseif (isset($_GET[$method])) {
            return $_GET[$method];
        } else {
            return false;
        }
    }
}
