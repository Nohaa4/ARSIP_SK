<?php

namespace App\Controllers;

use App\Models\SuratModel;
use App\Models\ProgramModel;
use App\Models\DepartemenModel;

class Surat extends BaseController
{
    protected $suratModel;
    protected $programModel;
    protected $departemenModel;

    public function __construct()
    {
        $this->suratModel = new SuratModel();
        $this->programModel = new ProgramModel();
        $this->departemenModel = new DepartemenModel();
    }

    // =====================================================
    // DATA IA / SK
    // =====================================================

    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $keyword = $this->request->getGet('keyword');
        $program = $this->request->getGet('program');
        $departemen = $this->request->getGet('departemen');

        $data = [
            'surat' => $this->suratModel
                ->getData($keyword, $program, $departemen),

            'program' => $this->programModel
                ->where('status', 'aktif')
                ->findAll(),

            'departemen' => $this->departemenModel
                ->where('status', 'aktif')
                ->findAll(),

            'keyword' => $keyword,
            'selectedProgram' => $program,
            'selectedDepartemen' => $departemen
        ];

        return view('surat/index', $data);
    }


    // =====================================================
    // TAMBAH DATA
    // =====================================================

    public function tambah()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        return view('surat/tambah', [
            'program' => $this->programModel
                ->where('status', 'aktif')
                ->findAll(),

            'departemen' => $this->departemenModel
                ->where('status', 'aktif')
                ->findAll()
        ]);
    }


    // =====================================================
    // SIMPAN DATA
    // =====================================================

    public function simpan()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $jenisSurat = $this->request->getPost('jenis_surat');

        if (empty($jenisSurat)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Jenis surat wajib dipilih.');
        }

        $file = $this->request->getFile('dokumen');

        if (!$file || !$file->isValid()) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Dokumen PDF wajib diupload.');
        }

        if (strtolower($file->getExtension()) !== 'pdf') {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'File harus berformat PDF.');
        }

        if ($file->getSize() > 10 * 1024 * 1024) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Ukuran PDF maksimal 10 MB.');
        }

        $folder = FCPATH . 'uploads/dokumen';

        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }

        $namaFile = $file->getRandomName();

        $file->move($folder, $namaFile);

        $this->suratModel->insert([
            'nomor_surat' => $this->request->getPost('nomor_surat'),
            'judul' => $this->request->getPost('judul'),
            'jenis_surat' => $jenisSurat,
            'id_program' => $this->request->getPost('id_program'),
            'id_departemen' => $this->request->getPost('id_departemen'),
            'tanggal_terbit' => $this->request->getPost('tanggal_terbit'),
            'berlaku_mulai' => $this->request->getPost('berlaku_mulai'),
            'berlaku_sampai' => $this->request->getPost('berlaku_sampai'),
            'keterangan' => $this->request->getPost('keterangan'),
            'nama_file' => $file->getClientName(),
            'file_path' => 'uploads/dokumen/' . $namaFile,
            'created_by' => session()->get('id_user')
        ]);

        return redirect()
            ->to('/data-ia-sk')
            ->with('success', 'Dokumen berhasil ditambahkan.');
    }


    // =====================================================
    // DETAIL / LIHAT
    // =====================================================

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


    // =====================================================
    // DOWNLOAD PDF
    // =====================================================

   public function download($id)
   {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $surat = $this->suratModel->find($id);

        if (!$surat) {
            return redirect()
            ->to('/data-ia-sk')
            ->with('error', 'Dokumen tidak ditemukan.');
        }

        $path = FCPATH . $surat['file_path'];

        if (!file_exists($path)) {
            return redirect()
            ->to('/data-ia-sk')
            ->with('error', 'File dokumen tidak ditemukan.');
        }

        $namaDownload = $surat['nama_file'];

        return $this->response
        ->download($path, null)
        ->setFileName($namaDownload);
    }   


    // =====================================================
    // EDIT
    // =====================================================

    public function edit($id)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $surat = $this->suratModel->find($id);

        if (!$surat) {
            return redirect()
                ->to('/data-ia-sk')
                ->with('error', 'Dokumen tidak ditemukan.');
        }

        return view('surat/edit', [
            'surat' => $surat,

            'program' => $this->programModel
                ->where('status', 'aktif')
                ->findAll(),

            'departemen' => $this->departemenModel
                ->where('status', 'aktif')
                ->findAll()
        ]);
    }


    // =====================================================
    // UPDATE DATA
    // =====================================================

    public function update($id)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $surat = $this->suratModel->find($id);

        if (!$surat) {
            return redirect()
                ->to('/data-ia-sk')
                ->with('error', 'Dokumen tidak ditemukan.');
        }

        $data = [
            'nomor_surat' => $this->request->getPost('nomor_surat'),
            'judul' => $this->request->getPost('judul'),
            'jenis_surat' => $this->request->getPost('jenis_surat'),
            'id_program' => $this->request->getPost('id_program'),
            'id_departemen' => $this->request->getPost('id_departemen'),
            'tanggal_terbit' => $this->request->getPost('tanggal_terbit'),
            'berlaku_mulai' => $this->request->getPost('berlaku_mulai'),
            'berlaku_sampai' => $this->request->getPost('berlaku_sampai'),
            'keterangan' => $this->request->getPost('keterangan')
        ];

        // Jika upload PDF baru
        $file = $this->request->getFile('dokumen');

        if ($file && $file->isValid() && !$file->hasMoved()) {

            if (strtolower($file->getExtension()) !== 'pdf') {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', 'File harus berformat PDF.');
            }

            if ($file->getSize() > 10 * 1024 * 1024) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', 'Ukuran PDF maksimal 10 MB.');
            }

            $folder = FCPATH . 'uploads/dokumen';

            if (!is_dir($folder)) {
                mkdir($folder, 0777, true);
            }

            // Hapus file lama
            if (!empty($surat['file_path'])) {

                $oldFile = FCPATH . $surat['file_path'];

                if (file_exists($oldFile)) {
                    unlink($oldFile);
                }
            }

            $namaFile = $file->getRandomName();

            $file->move($folder, $namaFile);

            $data['nama_file'] = $file->getClientName();
            $data['file_path'] = 'uploads/dokumen/' . $namaFile;
        }

        $this->suratModel->update($id, $data);

        return redirect()
            ->to('/data-ia-sk')
            ->with('success', 'Dokumen berhasil diperbarui.');
    }
}