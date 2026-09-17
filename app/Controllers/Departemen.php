<?php

namespace App\Controllers;

use App\Models\DepartemenModel;

class Departemen extends BaseController
{
    protected $departemenModel;

    public function __construct()
    {
        $this->departemenModel = new DepartemenModel();
    }

    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $keyword = $this->request->getGet('keyword');

        $builder = $this->departemenModel;

        if ($keyword) {
            $builder->groupStart()
                ->like('nama_departemen', $keyword)
                ->orLike('keterangan', $keyword)
                ->groupEnd();
        }

        $data = [
            'departemen' => $builder
                ->orderBy('id_departemen', 'DESC')
                ->findAll(),

            'keyword' => $keyword
        ];

        return view('departemen/index', $data);
    }

    public function tambah()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        return view('departemen/tambah');
    }

    public function simpan()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $this->departemenModel->insert([
            'nama_departemen' => $this->request->getPost('nama_departemen'),
            'keterangan'      => $this->request->getPost('keterangan'),
            'status'          => $this->request->getPost('status') ?? 'aktif'
        ]);

        return redirect()
            ->to('/departemen')
            ->with('success', 'Departemen berhasil ditambahkan.');
    }

    public function edit($id)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $departemen = $this->departemenModel->find($id);

        if (!$departemen) {
            return redirect()
                ->to('/departemen')
                ->with('error', 'Data departemen tidak ditemukan.');
        }

        return view('departemen/edit', [
            'departemen' => $departemen
        ]);
    }

    public function update($id)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $this->departemenModel->update($id, [
            'nama_departemen' => $this->request->getPost('nama_departemen'),
            'keterangan'      => $this->request->getPost('keterangan'),
            'status'          => $this->request->getPost('status')
        ]);

        return redirect()
            ->to('/departemen')
            ->with('success', 'Departemen berhasil diperbarui.');
    }

    public function hapus($id)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $departemen = $this->departemenModel->find($id);

        if (!$departemen) {
            return redirect()
                ->to('/departemen')
                ->with('error', 'Data departemen tidak ditemukan.');
        }

        $this->departemenModel->delete($id);

        return redirect()
            ->to('/departemen')
            ->with('success', 'Departemen berhasil dihapus.');
    }
}