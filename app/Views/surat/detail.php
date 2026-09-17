<?= $this->include('layout/header') ?>

<div class="page-content">

    <div class="page-header">
        <div>
            <h1>Detail Dokumen</h1>
            <p>Informasi lengkap dokumen IA / SK</p>
        </div>
    </div>

    <div class="detail-card">

        <div class="detail-grid">

            <div class="detail-item">
                <label>Nomor Surat</label>
                <div><?= esc($surat['nomor_surat']) ?></div>
            </div>

            <div class="detail-item">
                <label>Jenis Surat</label>
                <div><?= esc($surat['jenis_surat']) ?></div>
            </div>

            <div class="detail-item full">
                <label>Judul / Perihal</label>
                <div><?= esc($surat['judul']) ?></div>
            </div>

            <div class="detail-item">
                <label>Program</label>
                <div><?= esc($surat['nama_program'] ?? '-') ?></div>
            </div>

            <div class="detail-item">
                <label>Departemen</label>
                <div><?= esc($surat['nama_departemen'] ?? '-') ?></div>
            </div>

            <div class="detail-item">
                <label>Tanggal Terbit</label>
                <div>
                    <?= !empty($surat['tanggal_terbit'])
                        ? date('d-m-Y', strtotime($surat['tanggal_terbit']))
                        : '-' ?>
                </div>
            </div>

            <div class="detail-item">
                <label>Berlaku Mulai</label>
                <div>
                    <?= !empty($surat['berlaku_mulai'])
                        ? date('d-m-Y', strtotime($surat['berlaku_mulai']))
                        : '-' ?>
                </div>
            </div>

            <div class="detail-item">
                <label>Berlaku Sampai</label>
                <div>
                    <?= !empty($surat['berlaku_sampai'])
                        ? date('d-m-Y', strtotime($surat['berlaku_sampai']))
                        : 'Tidak Terbatas' ?>
                </div>
            </div>

            <div class="detail-item full">
                <label>Keterangan</label>
                <div><?= esc($surat['keterangan'] ?? '-') ?></div>
            </div>

            <div class="detail-item full">
                <label>Dokumen</label>

                <?php if (!empty($surat['file_path'])) : ?>

                    <a
                        href="<?= base_url('surat/download/' . $surat['id_surat']) ?>"
                        class="btn-download"
                    >
                        <i class="fa-solid fa-download"></i>
                        Download PDF
                    </a>

                <?php else : ?>

                    <div>-</div>

                <?php endif; ?>

            </div>

        </div>

        <div class="form-actions">

            <a
                href="<?= base_url('data-ia-sk') ?>"
                class="btn-cancel"
            >
                Kembali
            </a>

            <a
                href="<?= base_url('surat/edit/' . $surat['id_surat']) ?>"
                class="btn-edit"
            >
                Edit
            </a>

        </div>

    </div>

</div>

<style>

.page-content {
    padding: 28px 30px;
}

.page-header {
    margin-bottom: 20px;
}

.page-header h1 {
    margin: 0 0 5px;
    color: #173f63;
    font-size: 25px;
}

.page-header p {
    margin: 0;
    color: #64748b;
    font-size: 13px;
}

.detail-card {
    background: #fff;
    border: 1px solid #dfe6ec;
    border-radius: 8px;
    padding: 25px;
    max-width: 1000px;
}

.detail-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

.detail-item.full {
    grid-column: span 2;
}

.detail-item label {
    display: block;
    margin-bottom: 7px;
    color: #64748b;
    font-size: 11px;
    font-weight: 600;
}

.detail-item div {
    color: #334e68;
    font-size: 13px;
    line-height: 1.6;
}

.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 8px;
    margin-top: 25px;
    padding-top: 18px;
    border-top: 1px solid #edf1f5;
}

.btn-cancel,
.btn-edit,
.btn-download {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 9px 14px;
    border-radius: 5px;
    text-decoration: none;
    font-size: 12px;
    font-weight: 600;
}

.btn-cancel {
    background: #eef1f3;
    color: #52606d;
}

.btn-edit {
    background: #174f7d;
    color: #fff;
}

.btn-download {
    background: #edf6ef;
    color: #39734b;
}

@media (max-width: 700px) {
    .detail-grid {
        grid-template-columns: 1fr;
    }

    .detail-item.full {
        grid-column: auto;
    }

    .page-content {
        padding: 20px;
    }
}

</style>

<?= $this->include('layout/footer') ?>