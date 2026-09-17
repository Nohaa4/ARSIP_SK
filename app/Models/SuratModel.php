<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratModel extends Model
{
    protected $table = 'tbl_surat';
    protected $primaryKey = 'id_surat';

    protected $allowedFields = [
        'nomor_surat',
        'judul',
        'jenis_surat',
        'id_program',
        'id_departemen',
        'tanggal_terbit',
        'berlaku_mulai',
        'berlaku_sampai',
        'keterangan',
        'nama_file',
        'file_path',
        'created_by'
    ];

    protected $useTimestamps = true;

    public function getData($keyword = null, $program = null, $departemen = null)
    {
        $builder = $this->select('
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
            );

        if ($keyword) {
            $builder->groupStart()
                ->like('tbl_surat.nomor_surat', $keyword)
                ->orLike('tbl_surat.judul', $keyword)
                ->orLike('tbl_program.nama_program', $keyword)
                ->orLike('tbl_departemen.nama_departemen', $keyword)
                ->groupEnd();
        }

        if ($program) {
            $builder->where('tbl_surat.id_program', $program);
        }

        if ($departemen) {
            $builder->where('tbl_surat.id_departemen', $departemen);
        }

        return $builder
            ->orderBy('tbl_surat.created_at', 'DESC')
            ->findAll();
    }

    public function detail($id)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $surat = $this->suratModel
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
        ->where('tbl_surat.id_surat', $id)
        ->first();

        if (!$surat) {
        return redirect()
            ->to('/data-ia-sk')
            ->with('error', 'Dokumen tidak ditemukan.');
        }

    return view('surat/detail', [
        'surat' => $surat
    ]);
}
}