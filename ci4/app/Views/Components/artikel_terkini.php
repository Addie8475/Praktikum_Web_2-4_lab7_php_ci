<div class="widget-box">
    <h3 class="title">Artikel Terbaru</h3>

    <?php if (! empty($artikel) && is_array($artikel)): ?>
        <ul>
            <?php foreach ($artikel as $item): ?>
                <li>
                    <a href="<?= site_url('artikel/' . ($item['slug'] ?? $item['id'])); ?>"><?= esc($item['judul']); ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Tidak ada artikel terbaru.</p>
    <?php endif; ?>
</div>
