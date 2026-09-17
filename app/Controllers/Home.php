<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Home extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();

        // =========================
        // STATISTIK DOKUMEN
        // =========================

        $total = $db->table('tbl_surat')
            ->countAllResults();

        // Dokumen masih aktif
        $aktif = $db->table('tbl_surat')
            ->where('berlaku_sampai >=', date('Y-m-d'))
            ->countAllResults();

        // Dokumen sudah tidak aktif
        $tidakAktif = $db->table('tbl_surat')
            ->where('berlaku_sampai <', date('Y-m-d'))
            ->countAllResults();

        // Akan berakhir dalam 3 bulan
        $akanBerakhir = $db->table('tbl_surat')
            ->where('berlaku_sampai >=', date('Y-m-d'))
            ->where(
                'berlaku_sampai <=',
                date('Y-m-d', strtotime('+3 months'))
            )
            ->countAllResults();


        // =========================
        // 10 DOKUMEN TERBARU
        // =========================

        $dokumenTerbaru = $db->table('tbl_surat')
            ->select('
                tbl_surat.*,
                tbl_program.nama_program,
                tbl_departemen.nama_departemen
            ')
            ->join(
                'tbl_program',
                'tbl_program.id_program = tbl_surat.id_program',
                'left'
            )
            ->join(
                'tbl_departemen',
                'tbl_departemen.id_departemen = tbl_surat.id_departemen',
                'left'
            )
            ->orderBy('tbl_surat.created_at', 'DESC')
            ->limit(10)
            ->get()
            ->getResultArray();


        $data = [
            'title'          => 'Beranda',
            'total'          => $total,
            'aktif'          => $aktif,
            'tidakAktif'     => $tidakAktif,
            'akanBerakhir'   => $akanBerakhir,
            'dokumenTerbaru' => $dokumenTerbaru
        ];

        return view('beranda/index', $data);
    }
}