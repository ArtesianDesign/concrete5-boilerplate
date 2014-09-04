<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

<?php if (isset($error)) { ?>
  <?php echo $error?>
<?php } ?>

<form action="<?php echo $this->url( $resultTargetURL )?>" method="get" class="ccm-search-block-form search-form">

  <?php /*if( strlen($title)>0){ ?><h3><?php echo $title?></h3><?php } */ ?>

  <?php if(strlen($query)==0){ ?>
  <input name="search_paths[]" type="hidden" value="<?php echo htmlentities($baseSearchPath, ENT_COMPAT, APP_CHARSET) ?>" />
  <?php } else if (is_array($_REQUEST['search_paths'])) {
    foreach($_REQUEST['search_paths'] as $search_path){ ?>
      <input name="search_paths[]" type="hidden" value="<?php echo htmlentities($search_path, ENT_COMPAT, APP_CHARSET) ?>" />
  <?php  }
  } ?>

  <i class="fa fa-search"></i>

  <input name="query" type="text" value="<?php echo htmlentities($query, ENT_COMPAT, APP_CHARSET)?>" class="ccm-search-block-text" />

  <input name="submit" type="submit" value="<?php echo $buttonText?>" class="ccm-search-block-submit" />

</form>
