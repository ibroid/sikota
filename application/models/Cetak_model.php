<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'models/Model.php';

class Cetak_model extends Model {

	protected $table = 'tabayun_keluar';
	var $column_order = [
		null, 'pn_tujuan_text', 'nomor_perkara', 'jenis_delegasi_text', 'tgl_sidang', 'nomor_surat', 'tgl_surat', 'pihak', 'alamat_pihak'
	];
	var $column_search = [
		'pn_tujuan_text', 'nomor_perkara', 'jenis_delegasi_text', 'tgl_sidang', 'nomor_surat', 'tgl_surat', 'pihak', 'alamat_pihak'
	];
	var $order = ['id' => 'desc'];

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public static function count_all()
	{
		$self = new self;
		parent::instance()->db->from($self->table);
		return parent::instance()->db->count_all_results();
	}

	public function cetak_amplop_pengantar($id)
    {

		$self = new self;
		parent::instance()->db->from($self->table);
		self::where('pn_tujuan_text', request('pn_tujuan_text'));
		$bio = parent::instance()->db->row_array();
        // $bio = $this->tabayun_keluar->getRegByID($id)->row_array();
        $this->data['bio'] = array(
            'pn_asal_text' => ucwords($bio['pn_asal_text']),
            'pengadilan' => ucwords($bio['pengadilan']),
            'nomor_perkara' => $bio['nomor_perkara'],
            'nomor_surat' => $bio['nomor_surat'],
            'jenis_perkara' => $bio['jenis_perkara'],
            'tgl_kirim' => $this->tanggal->get_only_date($bio['tgl_kirim']).' '.ucwords($this->tanggal->get_bulan($this->tanggal->get_only_month($bio['tgl_kirim']))).' '.$this->tanggal->get_only_year($bio['tgl_kirim']),
            'nama_pihak' => $bio['nama_pihak'],
            'tgl_lahir_pihak' => $this->hitung_usia($bio['tgl_lahir_pihak']),
            'agama_pihak' => $bio['agama_pihak'],
            'pekerjaan_pihak' => $bio['pekerjaan_pihak'],
            'alamat_pihak' => $bio['alamat_pihak'],
            'jenis_pihak' => $bio['jenis_pihak'],
            'nama_pe' => $bio['nama_pe'],
            'jenis_pihak_pe' => $bio['jenis_pihak_pe'],
            'nama_te' => $bio['nama_te'],
            'jenis_pihak_te' => $bio['jenis_pihak_te'],
            'biaya_keluar' => buatrp($bio['biaya_keluar']),
            'terbilang_biaya' => ucwords(to_word($bio['biaya_keluar'])),
            'hari_sidang' => $this->tanggal->get_hari($bio['tgl_sidang']),
            'tgl_sidang' => $this->tanggal->get_only_date($bio['tgl_sidang']).' '.$this->tanggal->get_bulan($this->tanggal->get_only_month($bio['tgl_sidang'])).' '.$this->tanggal->get_only_year($bio['tgl_sidang']),
            'nomor_surat_auto' => $bio['nomor_surat'],
            'tgl_phs' => $this->tanggal->get_only_date($bio['tgl_phs']).' '.ucwords($this->tanggal->get_bulan($this->tanggal->get_only_month($bio['tgl_phs']))).' '.$this->tanggal->get_only_year($bio['tgl_phs']),
            'jns_bantuan' => $bio['jenis_bantuan'],
            'jns_bantuan_id' => $bio['jenis_bantuan_id'],
            'tgl_pbt' => $bio['tgl_pbt'],
            'tgl_putus' =>$this->tanggal->get_only_date($bio['tgl_putus']).' '.ucwords($this->tanggal->get_bulan($this->tanggal->get_only_month($bio['tgl_putus']))).' '.$this->tanggal->get_only_year($bio['tgl_putus']),
            'amar_putusan' => $bio['amar_putusan'],
            'jenis_pihak_pe' => $bio['jenis_pihak_pe'],
            'alamat_pengadilan' => $bio['alamat_pengadilan']
        );
            // print_r('<pre>');
            // print_r($this->data['bio']);
            // exit; 
            $this->render('admin/tabayun_keluar/cetak_amplop_pengantar');

    }
	

}

/* End of file Cetak_model.php */
/* Location: ./application/models/Cetak_model.php */