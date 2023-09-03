<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('format_helper')) {
    function datetime($datetime)
    {
        $date   = date_create($datetime);
        return date_format($date, "d/m/Y H:i:s");
    }

    function onlydate($datetime)
    {
        $date   = date_create($datetime);
        return date_format($date, "d/m/Y");
    }

    function onlyMonth($datetime)
    {
        $date   = date_create($datetime);
        return date_format($date, "F");
    }

    function tipefile($jenis)
    {
        $tipe = '';
        if ($jenis == 'KTP') {
            $tipe = 'JPG/PDF';
        } else if ($jenis == 'PAS FOTO') {
            $tipe = 'JPG';
        } else if ($jenis == 'IJAZAH TERAKHIR atau KETERANGAN AKTIF MAHASISWA') {
            $tipe = 'JPG';
        } else if ($jenis == 'SERTIFIKAT') {
            $tipe = 'PDF';
        }
        return $tipe;
    }
}
