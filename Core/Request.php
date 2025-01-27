<?php

namespace Core;

class Request
{
    public function get($key = null)
    {
        if ($key) {
            return isset($_GET[$key]) ? $_GET[$key] : null;
        }
        return $_GET;
    }

    public function post($key = null)
    {
        if ($key) {
            return isset($_POST[$key]) ? $_POST[$key] : null;
        }
        return $_POST;
    }

    public function all()
    {
        return array_merge($_GET, $_POST);
    }
}
