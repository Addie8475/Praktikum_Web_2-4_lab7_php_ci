<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h3><?= esc($title) ?></h3>
                    <p class="mb-0">Selamat datang kembali, Admin!</p>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-4">
                            <div class="p-3 border rounded">
                                <h5>Total Artikel</h5>
                                <h2 class="fw-bold"><?= esc($totalArtikel) ?></h2>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 border rounded">
                                <h5>Menu</h5>
                                <a href="<?= base_url('/admin/artikel') ?>" class="btn btn-outline-primary mt-2">Kelola Artikel</a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 border rounded">
                                <h5>Aksi Cepat</h5>
                                <a href="<?= base_url('/admin/artikel/add') ?>" class="btn btn-outline-success mt-2">Tambah Artikel</a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <p>Gunakan menu di atas untuk mengelola artikel, edit, dan hapus konten.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>