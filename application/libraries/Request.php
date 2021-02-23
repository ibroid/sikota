<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Request
{
    protected $ci;

    public function __construct()
    {
        return (object) $_POST;
    }
}

/* End of file Request.php */
