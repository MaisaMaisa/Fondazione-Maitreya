<!-- reusable "title + subtitle" block -->
 <?php
// expects: $title, $subtitle (passed in from the calling template)
?>
<section class="heading-block">
  <h2 class="heading-title"><?= $title ?? '' ?></h2>
  <?php if (isset($subtitle)): ?>
    <p class="heading-subtitle"><?= $subtitle ?></p>
  <?php endif ?>
</section>