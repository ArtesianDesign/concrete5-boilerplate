<?php  defined('C5_EXECUTE') or die("Access Denied."); ?>

<header class="header inverse" role="banner">
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

  <?php
  // Search area
  $tsArea = new GlobalArea('Top Search');
  $areaLayouts = $tsArea->getAreaLayouts($c);
  if (($tsArea->getTotalBlocksInArea($c) > 0) || !empty($areaLayouts) || ($c->isEditMode()) ) {
    echo '<div class="search">';
    $tsArea->setBlockLimit(1);
    $tsArea->display($c);
    echo '</div>';
  }
  ?>

</header>

<?php
// Header Image area
$hiArea = new Area('Header Image');
$areaLayouts = $hiArea->getAreaLayouts($c);
if (($hiArea->getTotalBlocksInArea($c) > 0) || !empty($areaLayouts) || ($c->isEditMode()) ) {
  echo '<div class="header-image">';
  $hiArea->display($c);
  echo '</div>';
}
?>
