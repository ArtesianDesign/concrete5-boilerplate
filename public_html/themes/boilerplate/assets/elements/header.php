<?php  defined('C5_EXECUTE') or die("Access Denied."); ?>

<header class="header navbar navbar-default navbar-fixed-top inverse navbar-inverse" role="banner" id="top">

  <div class="container">
    <div class="navbar-brand logo">
      <?php
        $sitenameArea = new GlobalArea('Site Name');
        $sitenameArea->display();
      ?>
    </div>

    <input type="checkbox" id="nav-toggle-button" role="button">
    <label for="nav-toggle-button" class="nav-toggle-label"><i class="fa fa-bars"></i></label>

    <div class="nav-container navbar-collapse collapse in" id="navbar-main" role="navigation">
      <?php
        // Main Navigation
        //
        $navArea = new GlobalArea('Header Nav');
        $navArea->setCustomTemplate('autonav', 'templates/header_nav/view.php');
        $navArea->display($c);
      ?>

      <?php
      // Sub-navigation / Search area
      //
      $subnav = new GlobalArea('Header Sub-Nav');
      $subnavAreaLayouts = $subnav->getAreaLayouts($c);
      if (($subnav->getTotalBlocksInArea($c) > 0) || !empty($subnavAreaLayouts) || ($c->isEditMode()) ) {
        echo '<div class="navbar-right">';
        //$subnav->setBlockLimit(1);
        $subnav->setCustomTemplate('search', 'templates/form_only/view.php');
        $subnav->setCustomTemplate('autonav', 'templates/header_subnav/view.php');
        $subnav->display($c);
        echo '</div>';
      }
      ?>
    </div>
  </div>

</header>

<div id="page-content">
  <?php
  // Header Image area
  $hiArea = new Area('Header Image');
  $hiAreaLayouts = $hiArea->getAreaLayouts($c);
  if (($hiArea->getTotalBlocksInArea($c) > 0) || !empty($hiAreaLayouts) || ($c->isEditMode()) ) {
    echo '<div class="header-image inverse">';
    $hiArea->display($c);
    echo '</div>';
  }
  ?>
