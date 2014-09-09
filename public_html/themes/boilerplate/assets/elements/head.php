<?php  defined('C5_EXECUTE') or die("Access Denied.");

$th = Loader::helper('text');

$page_handle = ($pt = $c->getCollectionTypeHandle()) ? $pt : 'view';
$page_name = $th->urlify($c->getCollectionName());
$edit_class = ($c->isEditMode() ? 'edit-mode' : null);

?><!doctype html>
<html class="no-js">
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link href="//www.google-analytics.com" rel="dns-prefetch">
  <link href="//ajax.googleapis.com" rel="dns-prefetch">

<?php  Loader::element('header_required'); ?>

  <link href="<?php  echo $this->getThemePath(); ?>/assets/css/style.min.css" rel="stylesheet">
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
  <?php
  $p = new Permissions(Page::getCurrentPage());
  if ($p->canViewToolbar() || $c->isEditMode()) {
    echo '<link href="' . $this->getThemePath() . '/assets/css/concrete5-conflicts.min.css" rel="stylesheet">';
  }
  ?>

  <script src="<?php  echo $this->getThemePath(); ?>/assets/components/modernizr.js"></script>

</head>

<body class="pt-<?php echo $page_handle . ' ' . $page_name . ' ' . $edit_class; ?>">
