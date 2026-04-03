<?= $this->include('template/admin_header'); ?> 

<h2><?= $title; ?></h2>
<a href="<?= base_url('/admin/artikel/add');?>" class="btn btn-large">+ Tambah Artikel</a>
<hr>
 
<table class="table"> 
    <thead> 
        <tr> 
            <th>ID</th> 
            <th>Judul</th> 
            <th>Aksi</th> 
        </tr> 
    </thead> 
    <tbody> 
    <?php if($artikel): foreach($artikel as $row): ?> 
    <tr> 
        <td><?= $row['id']; ?></td> 
        <td> 
            <b><?= $row['judul']; ?></b> 
            <p><small><?= substr($row['isi'], 0, 50); ?></small></p> 
        </td> 
        <td> 
            <a class="btn" href="<?= base_url('/admin/artikel/edit/' . $row['id']);?>">Ubah</a> 
            <a class="btn btn-danger" onclick="return confirm('Yakin menghapus data?');" href="<?= base_url('/admin/artikel/delete/' . $row['id']);?>">Hapus</a> 
        </td> 
    </tr> 
    <?php  endforeach; else: ?> 
    <tr> 
        <td colspan="3">Belum ada data.</td> 
    </tr> 
    <?php endif; ?> 
    </tbody> 
    <tfoot> 
        <tr> 
            <th>ID</th> 
            <th>Judul</th> 
            <th>Aksi</th> 
        </tr> 
    </tfoot> 
</table>

<p>
    <a href="<?= base_url('/') ?>" class="btn-guest">&larr; Kembali ke Guest</a>
</p>

<?= $this->include('template/admin_footer'); ?> 
