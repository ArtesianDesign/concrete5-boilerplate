<?php  defined('C5_EXECUTE') or die("Access Denied."); ?>

<header class="header" role="banner">
  <div class="logo">
    <?php
      $sitenameArea = new GlobalArea('Site Name');
      $sitenameArea->display();
    ?>
  </div>
  <nav class="nav" role="navigation">
    <?php
      $navArea = new GlobalArea('Header Nav');
      $navArea->display($c);
    ?>
  </nav>
</header>

<?php
// Header Image
$hiArea = new Area('Header Image');
$areaLayouts = $hiArea->getAreaLayouts($c);
if (($hiArea->getTotalBlocksInArea($c) > 0) || !empty($areaLayouts) || ($c->isEditMode()) ) {
  echo '<div class="header-image">';
  $hiArea->display($c);
  echo '</div>';
}
?>
