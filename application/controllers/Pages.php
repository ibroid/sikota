<?php
defined('BASEPATH') or exit('No direct script access allowed');
require 'vendor/autoload.php';
require_once APPPATH . 'models/SupportModel.php';


class Pages extends CI_Controller
{
  public function debug()
  {
    var_dump(SupportModel::test());
  }
}

/* End of file Pages.php */
