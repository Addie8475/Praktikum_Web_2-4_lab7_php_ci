<?= $this->include('template/admin_header'); ?> 

<h2><?= $title; ?></h2> 
<form action="<?= base_url('/admin/artikel/add');?>" method="post"> 
    <?= csrf_field(); ?>
    <p> 
        <input type="text" name="judul" placeholder="Judul Artikel" required> 
    </p> 
    <p> 
        <textarea name="isi" cols="50" rows="10" placeholder="Isi Artikel"></textarea> 
    </p> 
    <p><input type="submit" value="Kirim" class="btn btn-large"></p> 
</form> 

<?= $this->include('template/admin_footer'); ?>