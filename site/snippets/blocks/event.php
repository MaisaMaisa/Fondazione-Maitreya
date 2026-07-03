<!-- <?php $image = $block->image()->toFile(); ?>

<div class="event-block">
  <div class="event-block__date">
    <?= $block->date()->html() ?>
  </div>

  <div class="event-block__content">
    <h2><?= $block->eventTitle()->html() ?></h2>
    <p class="event-block__location"><?= $block->location()->html() ?></p>

    <div class="event-block__description">
      <?= $block->description()->kirbytext() ?>
    </div>

    <?php if ($block->buttonLabel()->isNotEmpty()): ?>
      <a class="event-block__button" href="<?= $block->buttonLink()->toUrl() ?>">
        <?= $block->buttonLabel()->html() ?>
      </a>
    <?php endif ?>
  </div>

  <?php if ($image): ?>
    <div class="event-block__media">
      <img src="<?= $image->url() ?>" alt="<?= $image->alt()->esc() ?>" loading="lazy">
    </div>
  <?php endif ?>
</div> -->

<?php $image = $block->image()->toFile(); ?>

<div class="event-block">
  <div class="event-block__date">
    <?= $block->date()->html() ?>
  </div>

  <div class="event-block__content">
    <h2><?= $block->content()->get('event_title')->html() ?></h2>
    <p class="event-block__location"><?= $block->location()->html() ?></p>

    <div class="event-block__description">
      <?= $block->description()->kirbytext() ?>
    </div>

    <?php if ($block->content()->get('button_label')->isNotEmpty()): ?>
      <a class="event-block__button" href="<?= $block->content()->get('button_link')->toUrl() ?>">
        <?= $block->content()->get('button_label')->html() ?>
      </a>
    <?php endif ?>
  </div>

  <?php if ($image): ?>
    <div class="event-block__media">
      <img src="<?= $image->url() ?>" alt="<?= $image->alt()->esc() ?>" loading="lazy">
    </div>
  <?php endif ?>
</div>