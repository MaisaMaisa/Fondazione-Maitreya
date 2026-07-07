<?php
$amounts = $block->content()->get('amounts')->toStructure();
$uid = 'donate-' . $block->id();
?>

<div class="donate-block" id="<?= $uid ?>">
  <div class="donate-block__amounts">
    <?php foreach ($amounts as $i => $item): ?>
      <div class="donate-block__option">
        <button type="button" class="donate-block__amount <?= $i === 0 ? 'is-selected' : '' ?>" data-amount="<?= $item->value()->value() ?>">
          DONA <?= $item->value()->value() ?> EURO
        </button>
        <?php if ($item->description()->isNotEmpty()): ?>
          <p class="donate-block__description"><?= $item->description()->html() ?></p>
        <?php endif ?>
      </div>
    <?php endforeach ?>

    <div class="donate-block__option">
      <button type="button" class="donate-block__amount donate-block__amount--free" data-amount="free">
        <?= $block->content()->get('free_amount_label')->html() ?>
      </button>
      <?php if ($block->content()->get('free_amount_description')->isNotEmpty()): ?>
        <p class="donate-block__description"><?= $block->content()->get('free_amount_description')->html() ?></p>
      <?php endif ?>
    </div>
  </div>

  <div class="donate-block__free-input" hidden>
    <label for="<?= $uid ?>-input">Importo (EUR)</label>
    <input type="number" id="<?= $uid ?>-input" min="1" step="1" placeholder="Es. 25">
  </div>

  <button type="button" class="donate-block__submit">
    <?= $block->content()->get('button_label')->html() ?>
  </button>
</div>

<script>
(function () {
  const root = document.getElementById('<?= $uid ?>');
  if (!root || root.dataset.bound) return;
  root.dataset.bound = 'true';

  const freeInputWrap = root.querySelector('.donate-block__free-input');
  const freeInput = root.querySelector('.donate-block__free-input input');

  let selected = parseInt(root.querySelector('.donate-block__amount.is-selected')?.dataset.amount, 10) || null;

  root.querySelectorAll('.donate-block__amount').forEach(btn => {
    btn.addEventListener('click', () => {
      root.querySelectorAll('.donate-block__amount').forEach(b => b.classList.remove('is-selected'));
      btn.classList.add('is-selected');

      if (btn.dataset.amount === 'free') {
        freeInputWrap.hidden = false;
        selected = null;
      } else {
        freeInputWrap.hidden = true;
        selected = parseInt(btn.dataset.amount, 10);
      }
    });
  });

  root.querySelector('.donate-block__submit').addEventListener('click', async () => {
    let amount = selected;

    if (!freeInputWrap.hidden) {
      amount = parseInt(freeInput.value, 10);
      if (!amount || amount < 1) {
        freeInput.focus();
        return;
      }
    }

    if (!amount) return;

    const res = await fetch('/donate/create-session?amount=' + (amount * 100), { method: 'POST' });
    const data = await res.json();
    if (data.url) window.location.href = data.url;
  });
})();
</script>