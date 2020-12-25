<?php
defined('BASEPATH') or exit('No direct script access allowed');


class SupportModel
{

  public static function test()
  {
    $these = &get_instance();
    return $these->db->get('pengguna');
  }
}

/* End of file SupportModel.php */
