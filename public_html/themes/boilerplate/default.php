<?php defined('C5_EXECUTE') or die("Access Denied."); ?>
<?php $this->inc('assets/elements/head.php'); ?>
<?php $this->inc('assets/elements/header.php'); ?>

  <main class="main" role="main">
    <?php
      $mainArea = new Area('Main');
      $mainArea->display($c);
    ?>
  </main>

  <aside class="sidebar" role="complementary">
    <?php
      $sbArea = new Area('Sidebar');
      $sbArea->display($c);
    ?>
  </aside>

<?php $this->inc('assets/elements/footer.php'); ?>
<?php $this->inc('assets/elements/foot.php'); ?>
