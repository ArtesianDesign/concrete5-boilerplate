<?php defined('C5_EXECUTE') or die("Access Denied."); ?>
<?php $this->inc('assets/elements/head.php'); ?>
<?php $this->inc('assets/elements/header.php'); ?>

<div class="container">
  <div class="row">
    <div class="col-sm-8">
      <main class="main" role="main">
        <?php
          Loader::element('system_errors', array('error' => $error));
          print $innerContent;
        ?>
        <?php
          $mainArea = new Area('Main');
          $mainArea->display($c);
        ?>
      </main>
    </div>

    <div class="col-sm-4">
      <aside class="sidebar" role="complementary">
        <?php
          $sbArea = new Area('Sidebar');
          $sbArea->display($c);
        ?>
      </aside>
    </div>
  </div>
</div>

<?php $this->inc('assets/elements/footer.php'); ?>
<?php $this->inc('assets/elements/foot.php'); ?>
