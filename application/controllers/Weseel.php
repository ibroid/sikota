<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'models/Wesel.php';
require_once APPPATH . 'models/Saldo_awal.php';
class Weseel extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->library('notifikasi');
    $this->load->library('files');
  }
  public function index()
  {
    redirect('TabayunMasuk/wesel');
  }
  public function save()
  {
    if ($_FILES['file']['name'] != null) $filename =  $this->upload($_FILES);
    Wesel::insert(array_merge([
      'bukti' => isset($filename) ? $filename : 'Tidak ada Bukti',
      'input_by' => auth()::$nama_lengkap
    ], requestAll()));
    Saldo_awal::increase(post()->nominal);
    Notifikasi::flash('success', 'Wesel Masuk telah ditambahkan', 'notif');
    redirect('TabayunMasuk/wesel', 'refresh');
  }

  public function upload($files)
  {
    $config['upload_path'] = './uploads/wesel/';
    $config['max_width']  = '2048';
    $config['allowed_types'] = '*';
    $config['file_name'] = Ramsey\Uuid\Uuid::uuid4();
    $this->load->library('upload', $config);

    if (!$this->upload->do_upload('file')) {
      Notifikasi::flash('danger', $this->upload->display_errors(), 'file');
      redirect($_SERVER['HTTP_REFERER']);
    } else {
      return $this->upload->data('file_name');
    }
  }

  public function delete()
  {
    Wesel::delete(['id' => request('id')]);
    Files::delete('uploads/wesel/', request('bukti'));
    Saldo_awal::decrease(post()->nominal);
    Notifikasi::flash('success', 'Wesel Telah di Hapus');

    echo Notifikasi::swal('success', 'Wesel Telah di Hapus');
  }
}

/* End of file Wesel.php */
