<?php  defined('C5_EXECUTE') or die("Access Denied."); ?>

<footer class="footer inverse" role="contentinfo">

    <?php
    // Footer area
    $footerArea = new GlobalArea('Footer');
    $faAreaLayouts = $footerArea->getAreaLayouts($c);
    if (($footerArea->getTotalBlocksInArea($c) > 0) || !empty($faAreaLayouts) || ($c->isEditMode()) ) { ?>
    <div class="footer-content">
      <div class="container">
        <div class="row">
        <?php
        $footerArea->setCustomTemplate('autonav', 'templates/footer_nav/view.php');
        $footerArea->display($c);
        ?>
        </div>
      </div>
    </div>
    <?php
    } ?>

    <?php
    // Footer area
    $footernavArea = new GlobalArea('Footer Navigation');
    $fnaAreaLayouts = $footernavArea->getAreaLayouts($c);
    if (($footernavArea->getTotalBlocksInArea($c) > 0) || !empty($fnaAreaLayouts) || ($c->isEditMode()) ) { ?>
    <div class="navbar navbar-footer">
      <div class="container">
        <?php
        $footernavArea->setCustomTemplate('autonav', 'templates/footer_nav/view.php');
        $footernavArea->display($c);
        ?>
      </div>
    </div>
    <?php
    } ?>

  <div class="container-fluid">
    <div class="row">
      <div class="container">
        <p class="footer-copyright">&copy;<?php  echo date('Y')?> <?php  echo SITE . '. ' . t('All rights reserved.'); ?></p>
      </div>
    </div>
  </div>

</footer>

</div><?php // #page-content ?>
