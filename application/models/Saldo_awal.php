<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'models/Model.php';
require_once APPPATH . 'models/Wesel.php';
class Saldo_awal extends Model
{
    public static function increase($nominal)
    {
        self::update([
            'saldo_ahir' => floatval(self::saldoTerakhir()[1]) + floatval($nominal)
        ], ['id' => self::saldoTerakhir()[0]]);
    }
    public static function decrease($nominal)
    {
        self::update([
            'saldo_ahir' => floatval(self::saldoTerakhir()[1]) - floatval($nominal)
        ], ['id' => self::saldoTerakhir()[0]]);
    }
    private static function saldoTerakhir()
    {
        $get = self::all()->row();
        return [
            $get->id,
            $get->saldo_ahir
        ];
    }
    public static function month()
    {
        return Wesel::select("SUM(nominal) as total")
            ->where('MONTH (tgl_diterima)', '=' . date('m'), FALSE)
            ->get()->row()->total;
    }
}

/* End of file Saldo_awal.php */
