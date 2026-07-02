<!-- bottom footer -->
<footer class="site-footer">
  <h3><?= $site->content()->get('footer_headline')->or($site->title()) ?></h3>

  <div class="footer-grid">

    <div class="footer-col footer-addresses">
      <?php foreach ($site->content()->get('footer_addresses')->toStructure() as $location): ?>
        <p>
          <strong><?= $location->name()->html() ?></strong><br>
          <?= nl2br($location->address()->html()) ?>
        </p>
      <?php endforeach ?>
    </div>

    <div class="footer-col footer-social">
      <ul>
        <?php foreach ($site->content()->get('footer_social')->toStructure() as $social): ?>
          <li><a href="<?= $social->url()->esc() ?>" target="_blank" rel="noopener"><?= $social->label()->html() ?></a></li>
        <?php endforeach ?>
      </ul>
    </div>

    <div class="footer-col footer-legal">
      <ul>
        <?php foreach ($site->content()->get('footer_legal')->toStructure() as $legal): ?>
          <li><a href="<?= $legal->link()->toUrl() ?>"><?= $legal->label()->html() ?></a></li>
        <?php endforeach ?>
      </ul>
    </div>

    <div class="footer-col footer-newsletter">
      <h4><?= $site->content()->get('footer_newsletter_heading')->html() ?></h4>
      <form class="newsletter-form" action="<?= $site->content()->get('footer_newsletter_action')->esc() ?>" method="post">
        <input
          type="email"
          name="email"
          placeholder="<?= $site->content()->get('footer_newsletter_placeholder')->esc() ?>"
          required
        >
        <button type="submit"><?= $site->content()->get('footer_newsletter_button')->html() ?></button>
      </form>
    </div>

  </div>

  <?php if ($site->content()->get('footer_affiliations')->isNotEmpty()): ?>
    <p class="footer-affiliations"><?= $site->content()->get('footer_affiliations')->kirbytext() ?></p>
  <?php endif ?>

</footer>