<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Validation
{
  static protected $ci;
  public static function make($val = [], $rules = 'required')
  {
    self::$ci = &get_instance();
    self::$ci->load->library('form_validation');
    foreach (array_keys($val) as $fieldname) {
      if ($fieldname !== 'catatan') {
        self::$ci->form_validation->set_rules($fieldname, str_replace('_', ' ', $fieldname), $rules);
      }
    }
    return self::$ci->form_validation->run();
  }
}

/* End of file LibraryName.php */
