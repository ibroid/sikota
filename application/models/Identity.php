<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'models/Model.php';
require_once APPPATH . 'models/SIPP.php';
class Identity extends Model
{

  public static function take($par = [])
  {
    foreach ($par as $p) {
      self::orWhere('name', $p);
    }
    $result = self::get()->result();
    $case = [];
    foreach ($result as $r) {
      $case[$r->name] = $r->value;
    }
    return $case;
  }
  public static function sync()
  {
    foreach (self::all()->result() as $sys) {
      foreach (self::takeFromSIPP() as $srs) {
        if ($sys->name == $srs->name) {
          self::update(['value' => $srs->value], ['name' => $sys->name]);
        }
      }
    }
  }
  private static function takeFromSIPP()
  {
    $sipp = new SIPP;
    return $sipp->customAll('sys_config');
  }
}

/* End of file Identity.php */
