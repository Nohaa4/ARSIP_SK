<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        <?= $title ?? 'Arsip IA / SK' ?>
    </title>

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f3f6f9;
            color: #26384a;
        }

        /* =================================
           SIDEBAR
        ================================= */

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;

            width: 230px;
            height: 100vh;

            background: #132f49;
            color: #ffffff;

            display: flex;
            flex-direction: column;

            z-index: 1000;
        }

        .sidebar-brand {
            height: 78px;

            padding: 17px 18px;

            display: flex;
            align-items: center;

            gap: 12px;
        }

        .brand-icon {
            width: 40px;
            height: 40px;

            background: #ffffff;

            border-radius: 5px;

            display: flex;
            align-items: center;
            justify-content: center;

            color: #174f7d;

            font-size: 18px;
        }

        .brand-text strong {
            display: block;

            font-size: 15px;
            font-weight: 700;

            margin-bottom: 4px;
        }

        .brand-text span {
            display: block;

            font-size: 9px;

            color: #b9c9d8;
        }


        /* MENU */

        .sidebar-menu {
            padding: 13px 10px;
        }

        .menu-link {
            height: 43px;

            padding: 0 13px;

            margin-bottom: 4px;

            display: flex;
            align-items: center;

            gap: 13px;

            border-radius: 5px;

            color: #d7e1ea;

            text-decoration: none;

            font-size: 12px;

            transition: 0.2s;
        }

        .menu-link i {
            width: 17px;

            text-align: center;

            font-size: 13px;
        }

        .menu-link:hover {
            background: #1c4568;
            color: #ffffff;
        }

        .menu-link.active {
            background: #2878c4;
            color: #ffffff;
        }


        /* BOTTOM PROFILE */

        .sidebar-bottom {
            margin-top: auto;

            border-top: 1px solid #29445b;

            padding: 14px 15px;
        }

        .admin-profile {
            display: flex;

            align-items: center;

            gap: 10px;

            margin-bottom: 12px;
        }

        .admin-avatar {
            width: 34px;
            height: 34px;

            border-radius: 50%;

            background: #dce8f2;

            color: #174f7d;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 13px;
            font-weight: 700;
        }

        .admin-info strong {
            display: block;

            font-size: 11px;

            color: #ffffff;
        }

        .admin-info span {
            display: block;

            margin-top: 3px;

            font-size: 8px;

            color: #aebdca;
        }

        .logout-link {
            display: block;

            color: #d6e1ea;

            text-decoration: none;

            font-size: 10px;

            padding: 7px 0;
        }

        .logout-link:hover {
            color: #ffffff;
        }


        /* =================================
           TOP HEADER
        ================================= */

        .topbar {
            position: fixed;

            top: 0;
            left: 230px;
            right: 0;

            height: 76px;

            background: #ffffff;

            border-bottom: 1px solid #e1e7ed;

            display: flex;
            align-items: center;

            padding: 0 28px;

            z-index: 900;
        }

        .topbar-left {
            display: flex;
            align-items: center;

            gap: 22px;

            flex: 1;
        }

        .menu-toggle {
            color: #64748b;

            font-size: 15px;

            cursor: pointer;
        }

        .header-search {
            width: 430px;

            height: 34px;

            border: 1px solid #dce4eb;

            border-radius: 5px;

            display: flex;
            align-items: center;

            padding: 0 11px;

            background: #fafcfd;
        }

        .header-search i {
            color: #9aa9b7;

            font-size: 11px;

            margin-right: 8px;
        }

        .header-search input {
            width: 100%;

            border: none;
            outline: none;

            background: transparent;

            font-size: 10px;

            color: #475569;
        }

        .header-search input::placeholder {
            color: #a2adb8;
        }

        .topbar-right {
            display: flex;

            align-items: center;

            gap: 22px;
        }

        .header-date {
            color: #52677a;

            font-size: 11px;
        }

        .header-admin {
            width: 30px;
            height: 30px;

            border-radius: 50%;

            background: #dbe7f0;

            color: #174f7d;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 10px;
            font-weight: 700;
        }


        /* =================================
           CONTENT
        ================================= */

        .main-content {
            margin-left: 230px;

            padding: 104px 28px 35px;

            min-height: 100vh;
        }


        /* =================================
           RESPONSIVE
        ================================= */

        @media (max-width: 850px) {

            .sidebar {
                width: 200px;
            }

            .topbar {
                left: 200px;
            }

            .main-content {
                margin-left: 200px;
            }

            .header-search {
                width: 280px;
            }

        }

        @media (max-width: 650px) {

            .sidebar {
                width: 65px;
            }

            .brand-text,
            .menu-link span,
            .admin-info,
            .logout-link {
                display: none;
            }

            .sidebar-brand {
                justify-content: center;
            }

            .menu-link {
                justify-content: center;
            }

            .sidebar-bottom {
                padding: 12px 8px;
            }

            .admin-profile {
                justify-content: center;
            }

            .topbar {
                left: 65px;
                padding: 0 15px;
            }

            .main-content {
                margin-left: 65px;
                padding: 95px 15px 25px;
            }

            .header-search {
                width: 200px;
            }

            .header-date {
                display: none;
            }

        }

    </style>

</head>


<body>


<!-- =================================
     SIDEBAR
================================= -->

<aside class="sidebar">

    <div class="sidebar-brand">

        <div class="brand-icon">
            <i class="fa-regular fa-file-lines"></i>
        </div>

        <div class="brand-text">

            <strong>Arsip IA / SK</strong>

            <span>
                Document Management
            </span>

        </div>

    </div>


    <nav class="sidebar-menu">

    <a
        href="<?= base_url('beranda') ?>"
        class="menu-link <?= uri_string() == 'beranda' ? 'active' : '' ?>"
    >
        <i class="fa-solid fa-house"></i>
        <span>Beranda</span>
    </a>


    <a
        href="<?= base_url('data-ia-sk') ?>"
        class="menu-link <?= uri_string() == 'data-ia-sk' ? 'active' : '' ?>"
    >
        <i class="fa-solid fa-file-lines"></i>
        <span>Data IA / SK</span>
    </a>


    <a
        href="<?= base_url('program') ?>"
        class="menu-link <?= uri_string() == 'program' ? 'active' : '' ?>"
    >
        <i class="fa-solid fa-layer-group"></i>
        <span>Program</span>
    </a>


    <a
        href="<?= base_url('departemen') ?>"
        class="menu-link <?= uri_string() == 'departemen' ? 'active' : '' ?>"
    >
        <i class="fa-solid fa-building"></i>
        <span>Departemen</span>
    </a>

</nav>


    <div class="sidebar-bottom">

        <div class="admin-profile">

            <div class="admin-avatar">

                <?= strtoupper(
                    substr(
                        session()->get('nama') ?? 'A',
                        0,
                        1
                    )
                ) ?>

            </div>

            <div class="admin-info">

                <strong>
                    <?= esc(
                        session()->get('nama') ?? 'admin'
                    ) ?>
                </strong>

                <span>
                    Administrator
                </span>

            </div>

        </div>


        <a
            href="<?= base_url('logout') ?>"
            class="logout-link"
        >

            <i class="fa-solid fa-right-from-bracket"></i>

            &nbsp; Keluar

        </a>

    </div>

</aside>


<!-- =================================
     TOPBAR
================================= -->

<header class="topbar">

    <div class="topbar-left">

    <div class="menu-toggle">
        <i class="fa-solid fa-bars"></i>
    </div>

    </div>


    <div class="topbar-right">

        <div class="header-date">

            <?= date('d F Y') ?>

        </div>


        <div class="header-admin">

            <?= strtoupper(
                substr(
                    session()->get('nama') ?? 'A',
                    0,
                    1
                )
            ) ?>

        </div>

    </div>

</header>


<!-- =================================
     MAIN CONTENT
================================= -->

<main class="main-content">