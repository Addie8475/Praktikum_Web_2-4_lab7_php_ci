<?= $this->include('template/header'); ?> 
<article class="entry"> 
    <h2><?= esc($artikel['judul']); ?></h2> 
    <?php if (!empty($artikel['gambar'])): ?>
    <img src="<?= base_url('/gambar/' . esc($artikel['gambar']));?>" alt="<?= esc($artikel['judul']); ?>"> 
    <?php endif; ?>
    <p><?= esc($artikel['isi']); ?></p> 
</article> 
<?= $this->include('template/footer'); ?>