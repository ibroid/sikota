<?php
function auth()
{



  return new class
  {
    static $level;
    static $id_pengguna;
    static $username;
    static $slug;
    static $nama_lengkap;
    static $email;
    static $nomor_telepon;
    static $password;
    static $foto;
    public function __construct()
    {
      $these = get_instance();
      if ($these->session->userdata('userdata')) {
        self::$level = $these->session->userdata('userdata')['level'];
        self::$id_pengguna = $these->session->userdata('userdata')['id_pengguna'];
        self::$username = $these->session->userdata('userdata')['username'];
        self::$slug = $these->session->userdata('userdata')['slug'];
        self::$nama_lengkap = $these->session->userdata('userdata')['nama_lengkap'];
        self::$email = $these->session->userdata('userdata')['email'];
        self::$nomor_telepon = $these->session->userdata('userdata')['nomor_telepon'];
        self::$password = $these->session->userdata('userdata')['password'];
        self::$foto = $these->session->userdata('userdata')['foto'];
      }
    }
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
