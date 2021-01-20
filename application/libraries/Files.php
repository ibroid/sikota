<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Files
{
  protected $ci;

  public function __construct()
  {
    $this->ci = &get_instance();
  }

  public static function delete($path = '', $filename = '')
  {
    if (file_exists(FCPATH . $path . $filename)) {
      unlink(FCPATH . $path . $filename);
      return true;
    } else {
      return 'File Tidak Ada';
    }
  }
}

/* End of file Files.php */
