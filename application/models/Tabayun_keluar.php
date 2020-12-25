<?php
require_once APPPATH . 'models/Model.php';

class Tabayun_keluar extends Model
{
	protected $table = 'tabayun_keluar';
	var $column_order = [
		null, 'pn_tujuan_text', 'nomor_perkara', 'jenis_delegasi_text', 'tgl_sidang', 'nomor_surat', 'tgl_surat', 'pihak', 'alamat_pihak'
	];
	var $column_search = [
		'pn_tujuan_text', 'nomor_perkara', 'jenis_delegasi_text', 'tgl_sidang', 'nomor_surat', 'tgl_surat', 'pihak', 'alamat_pihak'
	];
	var $order = ['id' => 'desc'];

	private function _get_datatables_query()
	{
		if (request('pn_tujuan_text')) {
			self::where('pn_tujuan_text', request('pn_tujuan_text'));
		}
		if (request('nomor_perkara')) {
			self::like('nomor_perkara', request('nomor_perkara'));
		}
		if (request('jenis_delegasi_text')) {
			self::like('jenis_delegasi_text', request('jenis_delegasi_text'));
		}
		if (request('tgl_sidang')) {
			self::like('tgl_sidang', request('tgl_sidang'));
		}
		self::get();
		$i = 0;
		foreach ($this->column_search as $item) {
			if (request('search')['value']) {
				if ($i === 0) {
					parent::instance()->db->group_start();
					self::like($item, request('search')['value']);
				} else {
					self::orLike($item, request('search')['value']);
				}
				if (count($this->column_search) - 1 == $i)
					parent::instance()->db->group_end();
			}
			$i++;
		}
		if (isset($_POST['order'])) {
			parent::instance()->db->order_by($this->column_order[request('order')['0']['column']], request('order')['0']['dir']);
		} else if (isset($this->order)) {
			$order = $this->order;
			parent::instance()->db->order_by(key($order), $order[key($order)]);
		}
	}
	public static function get_datatables()
	{
		$self = new self;
		$self->_get_datatables_query();
		if (request('length') != -1)
			parent::instance()->db->limit(request('length'), request('start'));
		$query = self::get();
		return $query->result();
	}

	public static function count_filtered()
	{
		$self = new self;
		$self->_get_datatables_query();
		$query = self::get();
		return $query->num_rows();
	}

	public static function count_all()
	{
		$self = new self;
		parent::instance()->db->from($self->table);
		return parent::instance()->db->count_all_results();
	}
}
