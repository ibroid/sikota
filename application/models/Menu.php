<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'models/Model.php';
class Menu extends Model
{
  public static function access($user = null)
  {
    self::select('*');
    self::join('access', 'access.menu_id = menu.id', 'LEFT');
    self::where('access.role_id', $user);
    return new static;
  }
  public function show()
  {
    return self::get()->result();
  }
}

/* End of file Menu.php */
