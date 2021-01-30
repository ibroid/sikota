<?php
function auth()
{
  return new class
  {
    static function user()
    {
      $CI = get_instance();
      if (!$CI->session->userdata('guard')) {
        redirect('/login');
      }
    }

    static function jurusita()
    {
      require_once APPPATH . 'libraries/Notifikasi.php';
      $these = get_instance();
      if ($these->session->userdata('userdata')['level'] != 1) {
        if (!$these->session->userdata('jurusita')) {
          Notifikasi::flash('danger', 'Silahkan Login Sebagai Jurusita', 'notif');
          return redirect($_SERVER['HTTP_REFERER']);
        }
      }
    }
  };
}
