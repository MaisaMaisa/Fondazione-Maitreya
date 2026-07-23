<?php
// build a conic-gradient string from an array of slices
function buildPieGradient($slices) {
  $stops = [];
  $cursor = 0;
  foreach ($slices as $slice) {
    $pct = (float)$slice->percentage()->value();
    $color = $slice->color()->value() ?: '#cccccc';
    $start = $cursor;
    $end = $cursor + $pct;
    $stops[] = "{$color} {$start}% {$end}%";
    $cursor = $end;
  }
  return implode(', ', $stops);
}

$chartOneSlices = $block->content()->get('chart_one_slices')->toStructure();
$chartTwoSlices = $block->content()->get('chart_two_slices')->toStructure();

$reportFileField = $block->content()->get('report_file');
$reportFile = $reportFileField->isNotEmpty() ? $reportFileField->toFile() : null;
?>

<div class="charts-report">

  <div class="charts-report__row">

    <div class="pie-chart">
      <div class="pie-chart__circle" style="background: conic-gradient(<?= buildPieGradient($chartOneSlices) ?>);"></div>
      <div class="pie-chart__legend">
        <h3><?= $block->content()->get('chart_one_title')->html() ?></h3>
        <ul>
          <?php foreach ($chartOneSlices as $slice): ?>
            <li>
              <span><?= $slice->label()->html() ?> &rarr; <?= $slice->percentage()->value() ?>%</span>
              <i style="background:<?= $slice->color()->esc() ?>"></i>
            </li>
          <?php endforeach ?>
        </ul>
      </div>
    </div>

    <div class="pie-chart">
      <div class="pie-chart__circle" style="background: conic-gradient(<?= buildPieGradient($chartTwoSlices) ?>);"></div>
      <div class="pie-chart__legend">
        <h3><?= $block->content()->get('chart_two_title')->html() ?></h3>
        <ul>
          <?php foreach ($chartTwoSlices as $slice): ?>
            <li>
              <span><?= $slice->label()->html() ?> &rarr; <?= $slice->percentage()->value() ?>%</span>
              <i style="background:<?= $slice->color()->esc() ?>"></i>
            </li>
          <?php endforeach ?>
        </ul>
      </div>
    </div>

  </div>

  <?php if ($reportFile): ?>
    <div class="charts-report__button">
      <a href="<?= $reportFile->url() ?>" target="_blank" rel="noopener">
        <?= $block->content()->get('button_label')->html() ?>
      </a>
    </div>
  <?php endif ?>

</div>