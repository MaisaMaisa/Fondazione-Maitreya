<?php
$images = $block->images()->toFiles();
if ($images->isEmpty()) return;
$uid = 'slideshow-' . $block->id();
?>

<div class="slideshow" id="<?= $uid ?>" data-slideshow>
  <div class="slideshow__track">
    <?php $i = 0; foreach ($images as $image): ?>
      <div class="slideshow__slide" data-index="<?= $i ?>" <?= $i === 0 ? '' : 'hidden' ?>>
        <img src="<?= $image->url() ?>" alt="<?= $image->alt()->esc() ?>" loading="<?= $i === 0 ? 'eager' : 'lazy' ?>">
      </div>
    <?php $i++; endforeach ?>
  </div>

  <?php if ($images->count() > 1): ?>
    <button class="slideshow__arrow slideshow__arrow--prev" type="button" aria-label="Previous slide">&larr;</button>
    <button class="slideshow__arrow slideshow__arrow--next" type="button" aria-label="Next slide">&rarr;</button>
  <?php endif ?>
</div>

<?php if ($images->count() > 1): ?>
<script>
(function () {
  const root = document.getElementById('<?= $uid ?>');
  if (!root || root.dataset.bound) return;
  root.dataset.bound = 'true';

  const slides = root.querySelectorAll('.slideshow__slide');
  const prev = root.querySelector('.slideshow__arrow--prev');
  const next = root.querySelector('.slideshow__arrow--next');
  let current = 0;

  function show(index) {
    slides[current].hidden = true;
    current = (index + slides.length) % slides.length;
    slides[current].hidden = false;
  }

  prev.addEventListener('click', () => show(current - 1));
  next.addEventListener('click', () => show(current + 1));
})();
</script>
<?php endif ?>