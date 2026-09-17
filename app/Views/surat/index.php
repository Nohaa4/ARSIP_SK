<?php

$title = 'Data IA / SK - Arsip IA / SK';

include(APPPATH . 'Views/layout/header.php');
?>

<div class="page-title">

    <div>
        <h1>Data IA / SK</h1>

        <p>
            Kelola dan cari seluruh dokumen IA / SK.
        </p>
    </div>

</div>


<!-- =====================================
     FILTER
===================================== -->

<div class="filter-card">

    <form
        action="<?= base_url('data-ia-sk') ?>"
        method="get"
    >

        <div class="filter-grid">

            <!-- PENCARIAN -->
            <div class="filter-item keyword">

                <label>Pencarian</label>
                

                <div class="input-search">

                    <i class="fa-solid fa-magnifying-glass"></i>

                    <input
                        type="text"
                        name="keyword" 
                        value="<?= esc($keyword ?? '') ?>"
                    >

                </div>

            </div>


            <!-- TAHUN -->
            <div class="filter-item">

                <label>Tahun</label>

                <select name="tahun">

                    <?php
                    $tahunSekarang = date('Y');

                    for (
                        $t = $tahunSekarang;
                        $t >= $tahunSekarang - 10;
                        $t--
                    ):
                    ?>

                        <option
                            value="<?= $t ?>"
                            <?= (($tahun ?? '') == $t)
                                ? 'selected'
                                : '' ?>
                        >
                            <?= $t ?>
                        </option>

                    <?php endfor; ?>

                </select>

            </div>


            <!-- JENIS -->
            <div class="filter-item">

                <label>Jenis</label>

                <select name="jenis">

                    <option value="">
                        Semua Jenis
                    </option>

                    <option
                        value="IA"
                        <?= (($jenis ?? '') == 'IA')
                            ? 'selected'
                            : '' ?>
                    >
                        IA
                    </option>

                    <option
                        value="SK"
                        <?= (($jenis ?? '') == 'SK')
                            ? 'selected'
                            : '' ?>
                    >
                        SK
                    </option>

                </select>

            </div>


            <!-- STATUS -->
            <div class="filter-item">

                <label>Status</label>

                <select name="status">

                    <option value="">
                        Semua Status
                    </option>

                    <option
                        value="Aktif"
                        <?= (($status ?? '') == 'Aktif')
                            ? 'selected'
                            : '' ?>
                    >
                        Aktif
                    </option>

                    <option
                        value="Tidak Aktif"
                        <?= (($status ?? '') == 'Tidak Aktif')
                            ? 'selected'
                            : '' ?>
                    >
                        Tidak Aktif
                    </option>

                    <option
                        value="Akan Berakhir"
                        <?= (($status ?? '') == 'Akan Berakhir')
                            ? 'selected'
                            : '' ?>
                    >
                        Akan Berakhir
                    </option>

                </select>

            </div>


            <!-- TANGGAL BERLAKU -->
            <div class="filter-item tanggal">

                <label>Tanggal Berlaku</label>

                <div class="tanggal-wrapper">

                    <input
                        type="date"
                        name="tanggal_mulai"
                        value="<?= esc($tanggalMulai ?? '') ?>"
                    >

                    <span>—</span>

                    <input
                        type="date"
                        name="tanggal_selesai"
                        value="<?= esc($tanggalSelesai ?? '') ?>"
                    >

                </div>

            </div>


            <!-- BUTTON -->
            <div class="filter-buttons">

                <a
                    href="<?= base_url('data-ia-sk') ?>"
                    class="btn-reset"
                >
                    Reset
                </a>

                <button
                    type="submit"
                    class="btn-filter"
                >
                    Terapkan
                </button>

            </div>

        </div>

    </form>

</div>


<!-- =====================================
     TOMBOL TAMBAH
===================================== -->

<div class="tambah-wrapper">

    <a
        href="<?= base_url('surat/tambah') ?>"
        class="btn-tambah"
    >
        <i class="fa-solid fa-plus"></i>
        Tambah IA / SK
    </a>

</div>


<!-- =====================================
     TABEL DATA
===================================== -->

<div class="data-card">

    <div class="data-header">

        <div>

            <h2>
                Daftar Dokumen
            </h2>

            <p>
                Menampilkan <?= count($surat ?? []) ?> dokumen.
            </p>

        </div>

    </div>


    <div class="table-wrapper">

        <table>

            <thead>

                <tr>

                    <th>No</th>

                    <th>Nomor IA / SK</th>

                    <th>Judul / Perihal</th>

                    <th>Jenis</th>

                    <th>Program</th>

                    <th>Departemen</th>

                    <th>Berlaku Sampai</th>

                    <th>Status</th>

                    <th>Aksi</th>

                </tr>

            </thead>


            <tbody>

            <?php if (!empty($surat)): ?>

                <?php foreach ($surat as $i => $row): ?>

                    <?php
                    /*
                     * STATUS OTOMATIS
                     *
                     * Tidak ada kolom status di database.
                     * Status dihitung berdasarkan tanggal berlaku_sampai.
                     *
                     * - Tidak ada tanggal       = Aktif
                     * - Sudah melewati tanggal  = Tidak Aktif
                     * - Sisa <= 30 hari         = Akan Berakhir
                     * - Selain itu              = Aktif
                     */

                    $today = new DateTime();

                    $status = 'Aktif';

                    if (!empty($row['berlaku_sampai'])) {

                        $tanggalBerlaku = new DateTime(
                            $row['berlaku_sampai']
                        );

                        $selisihHari = (int) $today->diff(
                            $tanggalBerlaku
                        )->format('%r%a');

                        if ($selisihHari < 0) {

                            $status = 'Tidak Aktif';

                        } elseif ($selisihHari <= 30) {

                            $status = 'Akan Berakhir';

                        } else {

                            $status = 'Aktif';

                        }
                    }

                    $statusClass = strtolower(
                        str_replace(
                            ' ',
                            '-',
                            $status
                        )
                    );
                    ?>

                    <tr>

                        <!-- NO -->
                        <td>
                            <?= $i + 1 ?>
                        </td>


                        <!-- NOMOR -->
                        <td>

                            <strong class="nomor">
                                <?= esc(
                                    $row['nomor_surat']
                                ) ?>
                            </strong>

                        </td>


                        <!-- JUDUL -->
                        <td>

                            <div class="judul">
                                <?= esc(
                                    $row['judul']
                                ) ?>
                            </div>

                        </td>


                        <!-- JENIS -->
                        <td>

                            <span class="jenis">
                                <?= esc(
                                    $row['jenis_surat']
                                    ?? $row['jenis']
                                    ?? '-'
                                ) ?>
                            </span>

                        </td>


                        <!-- PROGRAM -->
                        <td>
                            <?= esc(
                                $row['nama_program']
                                ?? '-'
                            ) ?>
                        </td>


                        <!-- DEPARTEMEN -->
                        <td>
                            <?= esc(
                                $row['nama_departemen']
                                ?? '-'
                            ) ?>
                        </td>


                        <!-- BERLAKU -->
                        <td>

                            <?php if (
                                !empty(
                                    $row['berlaku_sampai']
                                )
                            ): ?>

                                <?= date(
                                    'd-m-Y',
                                    strtotime(
                                        $row['berlaku_sampai']
                                    )
                                ) ?>

                            <?php else: ?>

                                Tidak Terbatas

                            <?php endif; ?>

                        </td>


                        <!-- STATUS OTOMATIS -->
                        <td>

                            <span
                                class="status <?= $statusClass ?>"
                            >
                                <?= esc($status) ?>
                            </span>

                        </td>


                        <!-- AKSI -->
                        <td>

                            <div class="aksi">

                                <a
                                    href="<?= base_url(
                                        'surat/detail/' .
                                        $row['id_surat']
                                    ) ?>"
                                    class="aksi-btn lihat"
                                    title="Lihat"
                                >
                                    <i class="fa-regular fa-eye"></i>
                                </a>


                                <?php if (
                                    !empty(
                                        $row['file_path']
                                    )
                                ): ?>

                                    <a
                                        href="<?= base_url(
                                            'surat/download/' .
                                            $row['id_surat']
                                        ) ?>"
                                        class="aksi-btn download"
                                        title="Download"
                                    >
                                        <i class="fa-solid fa-download"></i>
                                    </a>

                                <?php endif; ?>


                                <a
                                    href="<?= base_url(
                                        'surat/edit/' .
                                        $row['id_surat']
                                    ) ?>"
                                    class="aksi-btn edit"
                                    title="Edit"
                                >
                                    <i class="fa-solid fa-pen"></i>
                                </a>

                            </div>

                        </td>

                    </tr>

                <?php endforeach; ?>

            <?php else: ?>

                <tr>

                    <td
                        colspan="9"
                        class="empty"
                    >
                        Tidak ada dokumen yang sesuai
                        dengan pencarian atau filter.
                    </td>

                </tr>

            <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>


<style>

/* ==============================
   PAGE TITLE
============================== */

.page-title {
    display: flex;
    align-items: center;
    margin-bottom: 18px;
}

.page-title h1 {
    margin: 0 0 6px;
    color: #173f63;
    font-size: 26px;
    font-weight: 700;
}

.page-title p {
    margin: 0;
    color: #64748b;
    font-size: 13px;
}


/* ==============================
   TAMBAH
============================== */

.tambah-wrapper {
    margin-bottom: 12px;
    display: flex;
    justify-content: flex-start;
}

.btn-tambah {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 9px 14px;
    background: #174f7d;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    font-size: 12px;
    font-weight: 600;
}

.btn-tambah:hover {
    background: #123e63;
}


/* ==============================
   FILTER CARD
============================== */

.filter-card {
    background: #fff;
    border: 1px solid #dfe6ec;
    border-radius: 7px;
    padding: 15px 17px;
    margin-bottom: 12px;
}

.filter-grid {
    display: grid;
    grid-template-columns:
        2.2fr
        0.8fr
        0.8fr
        1fr
        1.8fr
        auto;
    gap: 9px;
    align-items: end;
}

.filter-item label {
    display: block;
    margin-bottom: 5px;
    color: #475569;
    font-size: 11px;
    font-weight: 600;
}

.filter-item select,
.filter-item input {
    width: 100%;
    height: 34px;
    padding: 0 8px;
    border: 1px solid #d7e0e7;
    border-radius: 5px;
    background: #fff;
    color: #475569;
    font-size: 11px;
    outline: none;
    box-sizing: border-box;
}

.filter-item select:focus,
.filter-item input:focus {
    border-color: #174f7d;
}


/* ==============================
   SEARCH
============================== */

.input-search {
    position: relative;
}

.input-search i {
    position: absolute;
    left: 10px;
    top: 50%;
    transform: translateY(-50%);
    color: #94a3b8;
    font-size: 10px;
}

.input-search input {
    padding-left: 29px;
}


/* ==============================
   TANGGAL
============================== */

.tanggal {
    width: 100%;
}

.tanggal-wrapper {
    display: flex;
    align-items: center;
    gap: 5px;
}

.tanggal-wrapper input {
    flex: 1;
    min-width: 0;
}

.tanggal-wrapper span {
    color: #94a3b8;
    font-size: 11px;
}


/* ==============================
   BUTTON FILTER
============================== */

.filter-buttons {
    display: flex;
    gap: 6px;
}

.btn-reset,
.btn-filter {
    height: 34px;
    padding: 0 10px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 5px;
    font-size: 10px;
    text-decoration: none;
    cursor: pointer;
    white-space: nowrap;
}

.btn-reset {
    border: 1px solid #d7e0e7;
    background: #fff;
    color: #64748b;
}

.btn-filter {
    border: none;
    background: #174f7d;
    color: #fff;
}

.btn-filter:hover {
    background: #123e63;
}


/* ==============================
   DATA CARD
============================== */

.data-card {
    background: #fff;
    border: 1px solid #dfe6ec;
    border-radius: 7px;
    overflow: hidden;
}

.data-header {
    padding: 17px 20px;
    border-bottom: 1px solid #e5ebf0;
}

.data-header h2 {
    margin: 0 0 5px;
    color: #173f63;
    font-size: 17px;
}

.data-header p {
    margin: 0;
    color: #64748b;
    font-size: 11px;
}


/* ==============================
   TABLE
============================== */

.table-wrapper {
    width: 100%;
    overflow-x: auto;
}

table {
    width: 100%;
    min-width: 1100px;
    border-collapse: collapse;
}

thead {
    background: #edf3f8;
}

th {
    padding: 12px 11px;
    color: #334e68;
    text-align: left;
    font-size: 11px;
    font-weight: 600;
    white-space: nowrap;
}

td {
    padding: 12px 11px;
    border-bottom: 1px solid #edf1f5;
    color: #52677a;
    font-size: 11px;
    white-space: nowrap;
}

tbody tr:hover {
    background: #fafcfd;
}

.nomor {
    color: #174f7d;
    font-weight: 600;
}

.judul {
    max-width: 220px;
    overflow: hidden;
    text-overflow: ellipsis;
}


/* ==============================
   JENIS
============================== */

.jenis {
    display: inline-block;
    padding: 4px 9px;
    background: #edf3f8;
    color: #174f7d;
    border-radius: 4px;
    font-size: 10px;
    font-weight: 600;
}


/* ==============================
   STATUS
============================== */

.status {
    display: inline-block;
    padding: 5px 9px;
    border-radius: 12px;
    font-size: 9px;
    font-weight: 600;
}

.status.aktif {
    background: #e6f5eb;
    color: #287447;
}

.status.tidak-aktif {
    background: #fdeaea;
    color: #bd4038;
}

.status.akan-berakhir {
    background: #fff2d8;
    color: #a56b08;
}


/* ==============================
   AKSI
============================== */

.aksi {
    display: flex;
    gap: 5px;
}

.aksi-btn {
    width: 28px;
    height: 28px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 4px;
    text-decoration: none;
    font-size: 10px;
}

.aksi-btn.lihat {
    background: #edf3f8;
    color: #174f7d;
}

.aksi-btn.download {
    background: #edf6ef;
    color: #39734b;
}

.aksi-btn.edit {
    background: #fff3df;
    color: #a56b08;
}

.aksi-btn:hover {
    opacity: .75;
}


/* ==============================
   EMPTY
============================== */

.empty {
    text-align: center;
    padding: 50px 20px;
    color: #94a3b8;
}


/* ==============================
   RESPONSIVE
============================== */

@media (max-width: 1100px) {

    .filter-grid {
        grid-template-columns:
            1.8fr
            0.8fr
            0.8fr
            1fr;
    }

    .tanggal {
        grid-column: span 2;
    }

    .filter-buttons {
        grid-column: span 2;
        justify-content: flex-start;
    }

}


@media (max-width: 600px) {

    .page-title {
        align-items: flex-start;
        flex-direction: column;
        gap: 15px;
    }

    .filter-grid {
        grid-template-columns: 1fr;
    }

    .tanggal {
        grid-column: auto;
    }

    .filter-buttons {
        grid-column: auto;
    }

    .tanggal-wrapper {
        width: 100%;
    }

}

</style>


<?php include(APPPATH . 'Views/layout/footer.php'); ?>