<?php
$path = kirby()->root('site') . '/data/donations.json';
$data = file_exists($path) ? json_decode(file_get_contents($path), true) : ['total_cents' => 0, 'donor_count' => 0];

$raised = $data['total_cents'] / 100;
$goal = (float) $block->content()->get('goal')->value();
$percent = $goal > 0 ? min(100, round(($raised / $goal) * 100)) : 0;
$donors = $data['donor_count'];
?>

<div class="donation-progress">
  <p class="donation-progress__amounts">
    <?= number_format($raised, 0, ',', '.') ?> Euro raccolti su <?= number_format($goal, 0, ',', '.') ?> Euro
  </p>

  <div class="donation-progress__bar">
    <div class="donation-progress__fill" style="width: <?= $percent ?>%"></div>
    <span class="donation-progress__percent"><?= $percent ?>%</span>
  </div>

  <p class="donation-progress__donors"><?= $donors ?> donatori hanno già contribuito</p>
</div>