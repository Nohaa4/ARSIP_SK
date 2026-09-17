<?php $title = 'Beranda - Arsip IA / SK'; ?>

<?php include(APPPATH . 'Views/layout/header.php'); ?>


<div class="page-title">

    <h1>
        Selamat datang, <?= esc(session()->get('nama')) ?>
    </h1>

    <p>
        Berikut ringkasan pengelolaan dokumen IA / SK.
    </p>

</div>


<!-- =================================
     STATISTIK
================================= -->

<div class="stats">

    <div class="stat-card">
        <span>Total Dokumen</span>
        <strong><?= $total ?></strong>
    </div>


    <div class="stat-card stat-aktif">
        <span>Aktif</span>
        <strong><?= $aktif ?></strong>
    </div>


    <div class="stat-card stat-tidak">
        <span>Tidak Aktif</span>
        <strong><?= $tidakAktif ?></strong>
    </div>


    <div class="stat-card stat-akan">
        <span>Akan Berakhir</span>
        <strong><?= $akanBerakhir ?></strong>
    </div>

</div>


<!-- =================================
     DOKUMEN TERBARU
================================= -->

<div class="section-card">

    <div class="section-header">

        <div>
            <h2>Dokumen Terbaru</h2>

            <p>
                10 dokumen IA / SK yang terakhir ditambahkan.
            </p>
        </div>


        <a href="<?= base_url('data-ia-sk') ?>">
            Lihat Semua
        </a>

    </div>


    <div class="table-wrapper">

        <table>

            <thead>

                <tr>

                    <th>No</th>

                    <th>Nomor IA / SK</th>

                    <th>Judul</th>

                    <th>Jenis</th>

                    <th>Program</th>

                    <th>Departemen</th>

                    <th>Berlaku Sampai</th>

                    <th>Status</th>

                </tr>

            </thead>


            <tbody>

            <?php if (!empty($terbaru)): ?>

                <?php
                    $today = date('Y-m-d');

                    $tigaBulan =
                        date(
                            'Y-m-d',
                            strtotime('+3 months')
                        );
                ?>


                <?php foreach (array_slice($terbaru, 0, 10) as $i => $row): ?>

                    <?php

                        $tanggalBerakhir =
                            $row['berlaku_sampai'] ?? null;


                        if (empty($tanggalBerakhir)) {

                            $status = 'Aktif';

                        } elseif ($tanggalBerakhir < $today) {

                            $status = 'Tidak Aktif';

                        } elseif ($tanggalBerakhir <= $tigaBulan) {

                            $status = 'Akan Berakhir';

                        } else {

                            $status = 'Aktif';

                        }

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
                                    $row['nomor_surat'] ?? '-'
                                ) ?>
                            </strong>
                        </td>


                        <!-- JUDUL -->
                        <td>
                            <?= esc(
                                $row['judul'] ?? '-'
                            ) ?>
                        </td>


                        <!-- JENIS -->
                        <td>
                            <?= esc(
                                $row['jenis_surat'] ?? '-'
                            ) ?>
                        </td>


                        <!-- PROGRAM -->
                        <td>
                            <?= esc(
                                $row['nama_program'] ?? '-'
                            ) ?>
                        </td>


                        <!-- DEPARTEMEN -->
                        <td>
                            <?= esc(
                                $row['nama_departemen'] ?? '-'
                            ) ?>
                        </td>


                        <!-- BERLAKU SAMPAI -->
                        <td>

                            <?php if (!empty($tanggalBerakhir)): ?>

                                <?= date(
                                    'd-m-Y',
                                    strtotime($tanggalBerakhir)
                                ) ?>

                            <?php else: ?>

                                -

                            <?php endif; ?>

                        </td>


                        <!-- STATUS -->
                        <td>

                            <span class="status <?= strtolower(
                                str_replace(
                                    ' ',
                                    '-',
                                    $status
                                )
                            ) ?>">

                                <?= $status ?>

                            </span>

                        </td>

                    </tr>


                <?php endforeach; ?>


            <?php else: ?>

                <tr>

                    <td
                        colspan="8"
                        class="empty-data"
                    >
                        Belum ada dokumen IA / SK.
                    </td>

                </tr>

            <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>


<style>

/* =================================
   JUDUL HALAMAN
================================= */

.page-title {
    margin-bottom: 22px;
}

.page-title h1 {
    margin: 0 0 7px;
    color: #173f63;
    font-size: 28px;
    font-weight: 700;
}

.page-title p {
    margin: 0;
    color: #52677a;
    font-size: 14px;
}


/* =================================
   STATISTIK
================================= */

.stats {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 14px;
    margin-bottom: 22px;
}


.stat-card {
    background: #ffffff;
    border: 1px solid #dce4ec;
    border-radius: 7px;

    padding: 17px 19px;

    min-height: 92px;

    box-sizing: border-box;
}


.stat-card span {
    display: block;

    color: #64748b;

    font-size: 12px;

    margin-bottom: 9px;
}


.stat-card strong {
    display: block;

    color: #164b78;

    font-size: 25px;

    line-height: 1;

    font-weight: 600;
}


/* GARIS SAMPING */

.stat-card.stat-aktif {
    border-left: 4px solid #3d8b5f;
}

.stat-card.stat-tidak {
    border-left: 4px solid #c75c55;
}

.stat-card.stat-akan {
    border-left: 4px solid #c99535;
}


/* =================================
   SECTION DOKUMEN
================================= */

.section-card {
    background: #ffffff;

    border: 1px solid #e1e7ed;

    border-radius: 7px;

    padding: 22px;
}


.section-header {
    display: flex;

    justify-content: space-between;

    align-items: center;

    margin-bottom: 18px;
}


.section-header h2 {
    margin: 0 0 5px;

    color: #173f63;

    font-size: 18px;
}


.section-header p {
    margin: 0;

    color: #64748b;

    font-size: 12px;
}


.section-header a {
    color: #174f7d;

    text-decoration: none;

    font-size: 13px;

    font-weight: 600;
}


.section-header a:hover {
    text-decoration: underline;
}


/* =================================
   TABLE
================================= */

.table-wrapper {
    width: 100%;

    overflow-x: auto;
}


table {
    width: 100%;

    border-collapse: collapse;

    min-width: 950px;
}


th {
    background: #edf3f8;

    color: #334e68;

    text-align: left;

    padding: 12px;

    font-size: 12px;

    font-weight: 600;

    white-space: nowrap;
}


td {
    padding: 13px 12px;

    border-bottom: 1px solid #edf1f5;

    color: #52677a;

    font-size: 12px;

    white-space: nowrap;
}


tbody tr:hover {
    background: #fafcfd;
}


.nomor {
    color: #174f7d;

    font-weight: 600;
}


/* =================================
   STATUS
================================= */

.status {
    display: inline-block;

    padding: 5px 10px;

    border-radius: 12px;

    font-size: 10px;

    font-weight: 600;

    white-space: nowrap;
}


.status.aktif {
    background: #e7f6ed;

    color: #21834b;
}


.status.tidak-aktif {
    background: #fdecec;

    color: #c0392b;
}


.status.akan-berakhir {
    background: #fff4d6;

    color: #a66a00;
}


/* =================================
   DATA KOSONG
================================= */

.empty-data {
    text-align: center;

    padding: 45px 15px;

    color: #94a3b8;
}


/* =================================
   RESPONSIVE
================================= */

@media (max-width: 1000px) {

    .stats {
        grid-template-columns: repeat(2, 1fr);
    }

}


@media (max-width: 600px) {

    .stats {
        grid-template-columns: 1fr;
    }

    .page-title h1 {
        font-size: 23px;
    }

}

</style>


<?php include(APPPATH . 'Views/layout/footer.php'); ?>