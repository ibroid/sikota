<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Components
{
  protected $ci;
  public static function load($filename, $data = [])
  {
    $instance = &get_instance();
    $instance->load->view('components/' . $filename, ['data' => $data])->output->final_output;
  }
}

/* End of file Components.php */
