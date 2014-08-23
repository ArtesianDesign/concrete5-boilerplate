<?php  defined('C5_EXECUTE') or die("Access Denied."); ?>

<footer class="footer" role="contentinfo">
  <?php
  // Footer area
  $footerArea = new GlobalArea('Footer');
  $areaLayouts = $footerArea->getAreaLayouts($c);
  if (($footerArea->getTotalBlocksInArea($c) > 0) || !empty($areaLayouts) || ($c->isEditMode()) ) {
    echo '<div class="footer-content">';
    $footerArea->display($c);
    echo '</div>';
  }
  ?>
  <p class="footer-copyright">&copy;<?php  echo date('Y')?> <?php  echo SITE . '. ' . t('All rights reserved.'); ?></p>
</footer>
