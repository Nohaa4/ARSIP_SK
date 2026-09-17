<?php

$title = 'Program - Arsip IA / SK';

include(APPPATH . 'Views/layout/header.php');
?>

<div class="page-title">

    <div>
        <h1>Program</h1>

        <p>
            Kelola data program yang digunakan dalam dokumen IA / SK.
        </p>
    </div>

</div>


<!-- =====================================
     PENCARIAN
===================================== -->

<div class="filter-card">

    <form
        action="<?= base_url('program') ?>"
        method="get"
    >

        <div class="search-row">

            <div class="search-item">

                <label>Pencarian</label>

                <div class="input-search">

                    <i class="fa-solid fa-magnifying-glass"></i>

                    <input
                        type="text"
                        name="keyword"
                        value="<?= esc($keyword ?? '') ?>"
                        placeholder="Cari nama program..."
                    >

                </div>

            </div>


            <div class="search-buttons">

                <a
                    href="<?= base_url('program') ?>"
                    class="btn-reset"
                >
                    Reset
                </a>

                <button
                    type="submit"
                    class="btn-filter"
                >
                    Cari
                </button>

            </div>

        </div>

    </form>

</div>


<!-- =====================================
     TOMBOL TAMBAH
===================================== -->

<div class="action-wrapper">

    <a
        href="<?= base_url('program/tambah') ?>"
        class="btn-tambah"
    >
        <i class="fa-solid fa-plus"></i>
        Tambah Program
    </a>

</div>


<!-- =====================================
     DATA PROGRAM
===================================== -->

<div class="data-card">

    <div class="data-header">

        <div>

            <h2>
                Daftar Program
            </h2>

            <p>
                Menampilkan <?= count($program ?? []) ?> program.
            </p>

        </div>

    </div>


    <div class="table-wrapper">

        <table>

            <thead>

                <tr>

                    <th>No</th>

                    <th>Nama Program</th>

                    <th>Keterangan</th>

                    <th>Status</th>

                    <th>Aksi</th>

                </tr>

            </thead>


            <tbody>

            <?php if (!empty($program)): ?>

                <?php foreach ($program as $i => $row): ?>

                    <tr>

                        <td>
                            <?= $i + 1 ?>
                        </td>


                        <td>

                            <strong class="nama-program">
                                <?= esc(
                                    $row['nama_program']
                                ) ?>
                            </strong>

                        </td>


                        <td>

                            <div class="keterangan">

                                <?= !empty(
                                    $row['keterangan']
                                )
                                    ? esc($row['keterangan'])
                                    : '-'
                                ?>

                            </div>

                        </td>


                        <td>

                            <?php
                            $status =
                                strtolower(
                                    $row['status'] ?? ''
                                );
                            ?>

                            <span
                                class="status
                                <?= $status === 'aktif'
                                    ? 'aktif'
                                    : 'tidak-aktif' ?>"
                            >

                                <?= esc(
                                    $row['status'] ?? '-'
                                ) ?>

                            </span>

                        </td>


                        <td>

                            <div class="aksi">

                                <a
                                    href="<?= base_url(
                                        'program/edit/' .
                                        $row['id_program']
                                    ) ?>"
                                    class="aksi-btn edit"
                                    title="Edit"
                                >
                                    <i class="fa-solid fa-pen"></i>
                                </a>


                                <a
                                    href="<?= base_url(
                                        'program/hapus/' .
                                        $row['id_program']
                                    ) ?>"
                                    class="aksi-btn hapus"
                                    title="Hapus"
                                    onclick="return confirm('Yakin ingin menghapus program ini?')"
                                >
                                    <i class="fa-solid fa-trash"></i>
                                </a>

                            </div>

                        </td>

                    </tr>

                <?php endforeach; ?>

            <?php else: ?>

                <tr>

                    <td
                        colspan="5"
                        class="empty"
                    >
                        Belum ada data program.
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
   FILTER
============================== */

.filter-card {
    background: #fff;
    border: 1px solid #dfe6ec;
    border-radius: 7px;
    padding: 15px 17px;
    margin-bottom: 12px;
}

.search-row {
    display: flex;
    align-items: flex-end;
    gap: 10px;
}

.search-item {
    width: 330px;
}

.search-item label {
    display: block;
    margin-bottom: 5px;
    color: #475569;
    font-size: 11px;
    font-weight: 600;
}

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
    width: 100%;
    height: 34px;
    padding: 0 8px 0 29px;
    border: 1px solid #d7e0e7;
    border-radius: 5px;
    background: #fff;
    color: #475569;
    font-size: 11px;
    outline: none;
}

.input-search input:focus {
    border-color: #174f7d;
}


/* ==============================
   BUTTON SEARCH
============================== */

.search-buttons {
    display: flex;
    gap: 6px;
}

.btn-reset,
.btn-filter {
    height: 34px;
    padding: 0 12px;
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
   TAMBAH
============================== */

.action-wrapper {
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
    border-collapse: collapse;
}

thead {
    background: #edf3f8;
}

th {
    padding: 12px 15px;
    color: #334e68;
    text-align: left;
    font-size: 11px;
    font-weight: 600;
    white-space: nowrap;
}

td {
    padding: 12px 15px;
    border-bottom: 1px solid #edf1f5;
    color: #52677a;
    font-size: 11px;
}

tbody tr:hover {
    background: #fafcfd;
}

.nama-program {
    color: #174f7d;
    font-weight: 600;
}

.keterangan {
    max-width: 450px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}


/* ==============================
   STATUS
============================== */

.status {
    display: inline-block;
    padding: 5px 10px;
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

.aksi-btn.edit {
    background: #fff3df;
    color: #a56b08;
}

.aksi-btn.hapus {
    background: #fdeaea;
    color: #bd4038;
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

@media (max-width: 600px) {

    .search-row {
        flex-direction: column;
        align-items: stretch;
    }

    .search-item {
        width: 100%;
    }

    .search-buttons {
        justify-content: flex-start;
    }

}

</style>


<?php include(APPPATH . 'Views/layout/footer.php'); ?>