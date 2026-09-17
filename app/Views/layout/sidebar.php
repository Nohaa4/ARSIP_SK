<!-- app/Views/layout/sidebar.php -->

<aside class="sidebar">

    <div class="brand">
        <div class="brand-icon">▤</div>

        <div>
            <strong>Arsip IA / SK</strong>
            <small>Document Management</small>
        </div>
    </div>

    <nav>

        <a href="<?= base_url('beranda') ?>"
           class="menu">
            <span>⌂</span>
            Beranda
        </a>

        <a href="<?= base_url('data-ia-sk') ?>"
           class="menu">
            <span>▤</span>
            Data IA / SK
        </a>

        <a href="<?= base_url('program') ?>"
           class="menu">
            <span>▦</span>
            Program
        </a>

        <a href="<?= base_url('departemen') ?>"
           class="menu">
            <span>▥</span>
            Departemen
        </a>

        <?php if (session()->get('role') === 'admin') : ?>

        <a href="<?= base_url('pengguna') ?>"
           class="menu">
            <span>♙</span>
            Pengguna
        </a>

        <?php endif; ?>

    </nav>

    <div class="sidebar-bottom">

        <div class="user-info">
            <div class="user-icon">A</div>

            <div>
                <strong><?= esc(session()->get('nama')) ?></strong>
                <small><?= ucfirst(session()->get('role')) ?></small>
            </div>
        </div>

        <a href="<?= base_url('logout') ?>" class="logout">
            Keluar
        </a>

    </div>

</aside>