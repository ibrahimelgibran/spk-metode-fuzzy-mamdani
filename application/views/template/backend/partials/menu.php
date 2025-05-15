<?php $pag= $this->uri->segment(1); ?>
<?php $page= $this->uri->segment(2); ?>
<?php $pages= $this->uri->segment(3); ?>

<div class="sidebar-menu">
    <header class="logo-env">
        <!-- Logo -->
        <div class="logo">
            <a href="<?= base_url() ?>">
                <img src="<?= base_url() ?>assets/images/logo.jpg" width="100%" alt="Logo" />
            </a>
        </div>

        <!-- Mobile Menu -->
        <div class="sidebar-mobile-menu visible-xs">
            <a href="#" class="with-animation">
                <i class="entypo-menu"></i>
            </a>
        </div>
    </header>

    <ul id="main-menu" class="auto-inherit-active-class">
        <!-- Dashboard -->
        <li <?= ($page == "Dashboard") ? 'class="active opened active"' : ''; ?>>
            <?= anchor('admin/Dashboard', '<i class="entypo-gauge"></i><span>Dashboard</span>'); ?>
        </li>

         <li <?= ($pag == "Kriteria") ? 'class="active opened active"' : ''; ?>>
                    <?= anchor('Kriteria', '<span class="entypo-layout">Kriteria</span>'); ?>
                </li>

        <!-- Kriteria -->
        <!-- <li <?= ($pag == "Kriteria" || $pag == "Subkriteria") ? 'class="active opened active multiple-expanded"' : ''; ?>>
            <a href="#">
                <i class="entypo-layout"></i>
                <span>Kriteria</span>
            </a>
            <ul>
               
                <li <?= ($pag == "Subkriteria") ? 'class="active opened active"' : ''; ?>>
                    <?= anchor('Subkriteria', '<span class="entypo-menu">Subkriteria</span>'); ?>
                </li>
            </ul>
        </li> -->

        <!-- Alat dan Bahan -->
        <li <?= ($pag == "sekolah") ? 'class="active opened active"' : ''; ?>>
            <?= anchor('Sekolah', '<i class="entypo-doc-text"></i><span>Alat dan Bahan</span>'); ?>
        </li>

        <li <?= ($pag == "Penilaian") ? 'class="active opened active"' : ''; ?>>
                    <?= anchor('Alternatif', '<span class="entypo-direction">Penilaian</span>'); ?>
                </li>

                <li <?= ($pag == "Penilaian") ? 'class="active opened active"' : ''; ?>>
                    <?= anchor('Alternatif', '<span class="entypo-chart-bar">Hasil Perhitungan</span>'); ?>
                </li>

                  <li <?= ($pag == "Penilaian") ? 'class="active opened active"' : ''; ?>>
                    <?= anchor('Alternatif', '<span class="entypo-chart-bar">Riwayat</span>'); ?>
                </li>

        <!-- Perhitungan -->
        <!-- <li <?= ($pag == "Alternatif" || $page == "Banding" || $page == "Hasil") ? 'class="active opened active multiple-expanded"' : ''; ?>>
            <a href="#">
                <i class="entypo-book"></i>
                <span>Perhitungan</span>
            </a>
            <ul>
                
                <li <?= ($page == "Banding") ? 'class="active opened active"' : ''; ?>>
                    <?= anchor('Perbandingan/banding', '<span class="entypo-switch">Perbandingan</span>'); ?>
                </li>
                <li <?= ($page == "Hasil") ? 'class="active opened active"' : ''; ?>>
                    <?= anchor('Perbandingan/hasil', '<span class="entypo-chart-bar">Hasil Perhitungan</span>'); ?>
                </li>
            </ul>
        </li> -->

        <!-- Pengaturan -->
        <li <?= ($page == "Auth") ? 'class="active opened active multiple-expanded"' : ''; ?>>
            <a href="#">
                <i class="entypo-tools"></i>
                <span>Pengaturan</span>
            </a>
            <ul>
                <li <?= ($page == "Auth") ? 'class="active opened active"' : ''; ?>>
                    <?= anchor('admin/Auth', '<span class="entypo-user">Users</span>'); ?>
                </li>
            </ul>
        </li>

        <!-- Logout -->
        <li>
            <a href="<?= base_url() ?>admin/Auth/logout">
                <i class="entypo-logout"></i>
                Logout
            </a>
        </li>
    </ul>
</div>

<!-- Modal Tentang -->
<div class="modal fade" id="modal-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Tentang Website</h4>
            </div>

            <div class="modal-body">
                <strong>Tentang Website</strong><br>
                <i class="glyphicon glyphicon-ok"></i> Bismillah<br>
                <i class="glyphicon glyphicon-ok"></i> Skripsi<br>
                <i class="glyphicon glyphicon-ok"></i> Selesai dengan cepat<br>
                <i class="glyphicon glyphicon-ok"></i> CP Programmer : 082394315392 (Akbar Abustang)<br><br>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
