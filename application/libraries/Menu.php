<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu
{
  protected $ci;

  public function __construct()
  {
    $this->ci = &get_instance();
  }
  public function menu()
  {
    return $this->ci->db->get('menu')->result();
  }
}

/* End of file Menu.php */
