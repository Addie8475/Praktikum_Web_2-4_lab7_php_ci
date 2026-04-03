<?= $this->include('template/admin_header'); ?> 
 
<h2><?= $title; ?></h2> 
<form action="<?= base_url('/admin/artikel/edit/' . $data['id']);?>" method="post"> 
    <?= csrf_field(); ?>
    <p> 
        <input type="text" name="judul" value="<?= esc($data['judul']);?>" required> 
    </p> 
    <p> 
        <textarea name="isi" cols="50" rows="10"><?= esc($data['isi']);?></textarea> 
    </p> 
    <p><input type="submit" value="Kirim" class="btn btn-large"></p> 
</form> 
 
<?= $this->include('template/admin_footer'); ?> 