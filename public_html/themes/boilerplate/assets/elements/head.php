<?php  defined('C5_EXECUTE') or die("Access Denied."); ?><!doctype html>
<html class="no-js">
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link href="//www.google-analytics.com" rel="dns-prefetch">
  <link href="//ajax.googleapis.com" rel="dns-prefetch">

<?php  Loader::element('header_required'); ?>

  <link href="<?php  echo $this->getThemePath(); ?>/assets/css/style.min.css" rel="stylesheet">
  <link rel="stylesheet" media="screen" type="text/css" href="<?php  echo $this->getStyleSheet('typography.css')?>" />

  <script src="<?php  echo $this->getThemePath(); ?>/assets/components/modernizr.js"></script>

</head>

<body>
<?php $this->inc('_/elements/header.php'); ?>
