<?php

namespace App\Controllers;

use App\Models\ProgramModel;

class Program extends BaseController
{
    protected $programModel;

    public function __construct()
    {
        $this->programModel = new ProgramModel();
    }

    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $keyword = $this->request->getGet('keyword');

        $builder = $this->programModel;

        if (!empty($keyword)) {
            $builder->groupStart()
                ->like('nama_program', $keyword)
                ->orLike('kode_program', $keyword)
                ->groupEnd();
        }

        $data = [
            'title'    => 'Program - Arsip IA / SK',
            'program'  => $builder
                ->orderBy('nama_program', 'ASC')
                ->findAll(),
            'keyword'  => $keyword
        ];

        return view('program/index', $data);
    }

    public function tambah()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        return view('program/tambah');
    }

    public function simpan()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $kodeProgram = $this->request->getPost('kode_program');
        $namaProgram = $this->request->getPost('nama_program');
        $keterangan  = $this->request->getPost('keterangan');
        $status      = $this->request->getPost('status');

        if (empty($kodeProgram) || empty($namaProgram)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Kode program dan nama program wajib diisi.');
        }

        $this->programModel->insert([
            'kode_program' => $kodeProgram,
            'nama_program' => $namaProgram,
            'keterangan'   => $keterangan,
            'status'       => $status ?? 'aktif'
        ]);

        return redirect()
            ->to('/program')
            ->with('success', 'Program berhasil ditambahkan.');
    }
}