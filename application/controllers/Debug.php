<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Debug extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('SIPP');
    }


    public function index()
    {
        echo json_encode($this->SIPP->pengadilan());
    }
}

/* End of file Debug.php */
