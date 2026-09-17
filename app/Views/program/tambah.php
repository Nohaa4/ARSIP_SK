<?= $this->include('layout/header') ?>

<div class="page-content">

    <div class="page-header">
        <div>
            <h1>Tambah Program</h1>
            <p>Tambahkan data program baru</p>
        </div>
    </div>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <div class="form-card">

        <form action="<?= base_url('program/simpan') ?>" method="post">

            <?= csrf_field() ?>

            <div class="form-group">
                <label>Kode Program</label>
                <input
                    type="text"
                    name="kode_program"
                    value="<?= old('kode_program') ?>"
                    required
>
            </div>

            <div class="form-group">
                <label>Nama Program</label>
                <input
                    type="text"
                    name="nama_program"
                    value="<?= old('nama_program') ?>"
                    required
                >
            </div>

            <div class="form-group">
                <label>Keterangan</label>
                <textarea
                    name="keterangan"
                    rows="4"
                ><?= old('keterangan') ?></textarea>
            </div>

            <div class="form-group">
                <label>Status</label>
                <select name="status" required>
                    <option value="aktif">Aktif</option>
                    <option value="tidak aktif">Tidak Aktif</option>
                </select>
            </div>

            <div class="form-actions">

                <a href="<?= base_url('program') ?>" class="btn-cancel">
                    Batal
                </a>

                <button type="submit" class="btn-save">
                    Simpan
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
    max-width: 900px;
}

.form-group {
    margin-bottom: 20px;
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
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    border-color: #2878c4;
}

.form-group textarea {
    resize: vertical;
}

.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    padding-top: 18px;
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
</style>

<?= $this->include('layout/footer') ?>