<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'models/Model.php';
class Surat_keluar extends Model
{

	static $column_order = array(null, 'tujuan', 'no_surat', 'jenis_surat', 'perihal', 'isi', 'tgl_surat', 'tgl_catat', 'keterangan'); //set column field database for datatable orderable
	static $column_search = array('tujuan', 'no_surat', 'jenis_surat', 'perihal', 'isi', 'tgl_surat', 'tgl_catat', 'keterangan'); //set column field database for datatable searchable 
	static $order = array('id' => 'asc'); // default order 
	private static function _get_datatables_query()
	{

		//add custom filter here
		if (request('tujuan')) {
			self::where('tujuan', request('tujuan'));
		}
		if (request('jenis_surat')) {
			self::like('jenis_surat', request('jenis_surat'));
		}
		if (request('perihal')) {
			self::like('perihal', request('perihal'));
		}
		if (request('isi')) {
			self::like('isi', request('isi'));
		}

		self::get();
		$i = 0;

		foreach (self::$column_search as $item) // loop column 
		{
			if ($_POST['search']['value']) // if datatable send POST for search
			{

				if ($i === 0) // first loop
				{
					self::groupStart(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					self::like($item, $_POST['search']['value']);
				} else {
					self::orLike($item, $_POST['search']['value']);
				}

				if (count(self::$column_search) - 1 == $i) //last loop
					self::groupStart(); //close bracket
			}
			$i++;
		}

		if (isset($_POST['order'])) // here order processing
		{
			self::orderBy(self::$column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if (isset(self::$order)) {
			$order = self::$order;
			self::orderBy(key($order), $order[key($order)]);
		}
	}

	public static function get_datatables()
	{
		self::_get_datatables_query();
		if ($_POST['length'] != -1)
			self::limit($_POST['length'], $_POST['start']);
		$query = self::get();
		return $query->result();
	}

	public static function count_filtered()
	{
		self::_get_datatables_query();
		$query = self::get();
		return $query->num_rows();
	}

	public static function count_all()
	{
		$qwer = self::get();
		return $qwer->num_rows();
	}
}
