<?= $this->include('layout/header') ?>

<div class="page-content">

    <div class="page-header">
        <div>
            <h1>Tambah Data IA / SK</h1>
            <p>Tambahkan data dokumen IA / SK</p>
        </div>
    </div>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <div class="form-card">

        <form action="<?= base_url('surat/simpan') ?>" method="post" enctype="multipart/form-data">

            <?= csrf_field() ?>

            <div class="form-grid">

                <div class="form-group">
                    <label>Nomor Surat</label>
                    <input
                        type="text"
                        name="nomor_surat"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Judul</label>
                    <input
                        type="text"
                        name="judul"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Jenis Surat</label>
                    <select name="jenis_surat" required>
                        <option value="">-- Pilih Jenis --</option>
                        <option value="IA">IA</option>
                        <option value="SK">SK</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Program</label>
                    <select name="id_program" required>
                        <option value="">-- Pilih Program --</option>

                        <?php foreach ($program as $p) : ?>
                            <option value="<?= $p['id_program'] ?>">
                                <?= esc($p['nama_program']) ?>
                            </option>
                        <?php endforeach; ?>

                    </select>
                </div>

                <div class="form-group">
                    <label>Departemen</label>
                    <select name="id_departemen" required>
                        <option value="">-- Pilih Departemen --</option>

                        <?php foreach ($departemen as $d) : ?>
                            <option value="<?= $d['id_departemen'] ?>">
                                <?= esc($d['nama_departemen']) ?>
                            </option>
                        <?php endforeach; ?>

                    </select>
                </div>

                <div class="form-group">
                    <label>Tanggal Terbit</label>
                    <input
                        type="date"
                        name="tanggal_terbit"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Berlaku Mulai</label>
                    <input
                        type="date"
                        name="berlaku_mulai"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Berlaku Sampai</label>
                    <input
                        type="date"
                        name="berlaku_sampai"
                    >
                </div>

            </div>

            <div class="form-group full">
                <label>Keterangan</label>
                <textarea
                    name="keterangan"
                    rows="4"
                    placeholder="Masukkan keterangan jika ada"
                ></textarea>
            </div>

            <div class="form-group full">
                <label>Dokumen PDF</label>

                <div class="upload-box">
                    <input
                        type="file"
                        name="dokumen"
                        accept=".pdf,application/pdf"
                        required
                    >

                    <small>
                        Format PDF, maksimal 10 MB.
                    </small>
                </div>
            </div>

            <div class="form-actions">
                <a href="<?= base_url('data-ia-sk') ?>" class="btn-cancel">
                    Batal
                </a>

                <button type="submit" class="btn-save">
                    Simpan Data
                </button>
            </div>

        </form>

    </div>

</div>

<style>
.page-content {
    padding: 28px 30px;
}

.page-header {
    margin-bottom: 22px;
}

.page-header h1 {
    margin: 0;
    font-size: 25px;
    color: #1d3448;
}

.page-header p {
    margin: 6px 0 0;
    color: #7a8792;
    font-size: 14px;
}

.form-card {
    background: #fff;
    border-radius: 10px;
    padding: 28px;
    box-shadow: 0 2px 10px rgba(0,0,0,.05);
    max-width: 1000px;
}

.form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group.full {
    width: 100%;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-size: 14px;
    font-weight: 600;
    color: #33485c;
}

.form-group input,
.form-group select,
.form-group textarea {
    width: 100%;
    box-sizing: border-box;
    padding: 11px 13px;
    border: 1px solid #d5dce2;
    border-radius: 6px;
    font-family: inherit;
    font-size: 14px;
    outline: none;
    background: #fff;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    border-color: #2878c4;
}

.form-group textarea {
    resize: vertical;
}

.upload-box {
    border: 1px dashed #c8d1d9;
    border-radius: 7px;
    padding: 15px;
    background: #fafbfc;
}

.upload-box input {
    border: none;
    padding: 0;
}

.upload-box small {
    display: block;
    margin-top: 8px;
    color: #7a8792;
}

.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    margin-top: 10px;
    padding-top: 20px;
    border-top: 1px solid #edf0f2;
}

.btn-cancel,
.btn-save {
    padding: 10px 18px;
    border-radius: 6px;
    font-size: 14px;
    text-decoration: none;
    cursor: pointer;
    border: none;
}

.btn-cancel {
    background: #eef1f3;
    color: #44515d;
}

.btn-save {
    background: #2878c4;
    color: #fff;
}

.btn-save:hover {
    background: #2069ad;
}

.alert {
    padding: 12px 15px;
    border-radius: 6px;
    margin-bottom: 20px;
}

.alert-danger {
    background: #fdecec;
    color: #a33a3a;
}

@media (max-width: 700px) {
    .form-grid {
        grid-template-columns: 1fr;
    }

    .page-content {
        padding: 20px;
    }

    .form-card {
        padding: 20px;
    }
}
</style>

<?= $this->include('layout/footer') ?>