<?php $documents = $block->content()->get('documents')->toStructure(); ?>

<?php if ($documents->isNotEmpty()): ?>
  <div class="pdf-collection">
    <?php foreach ($documents as $doc): ?>
      <?php $file = $doc->file()->toFile(); ?>
      <?php if ($file): ?>
        <a class="pdf-collection__item" href="<?= $file->url() ?>" target="_blank" rel="noopener">
          <?= $doc->label()->html() ?>
        </a>
      <?php endif ?>
    <?php endforeach ?>
  </div>
<?php endif ?>