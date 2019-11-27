<?php
/**
 *
 * Core Head View
 *
 * @version 0.1
 *
 */
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title><?= $v['site']['title']; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <meta property="og:url" content="<?= $v['site']['site_url']; ?>">
  <meta property="og:title" content="<?= $v['site']['title']; ?>">
  <meta property="og:description" content="<?= $v['site']['description']; ?>">
  <meta property="og:type" content="<?= $v['site']['type']; ?>">
  <meta property="og:image" content="<?= $v['site']['og_image']; ?>">
  <meta property="og:image:type" content="<?= $v['site']['og_image_type']; ?>">
  <meta property="og:image:width" content="<?= $v['site']['og_image_width']; ?>">
  <meta property="og:image:height" content="<?= $v['site']['og_image_height']; ?>">

  <meta name="author" content="<?= $v['site']['author']; ?>">
  <meta name="description" content="<?= $v['site']['description']; ?>">
  <meta name="keywords" content="<?= $v['site']['keywords']; ?>">

  <link rel="shortcut icon" href="<?= $v['site']['favicon']; ?>" type="image/x-icon">
  <link rel="icon" href="<?= $v['site']['favicon']; ?>" type="image/x-icon">

  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,700" rel="stylesheet">

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <link rel="stylesheet" href="<?= ROOT_URL; ?>layout/capture/css/open-iconic-bootstrap.min.css">
  <link rel="stylesheet" href="<?= ROOT_URL; ?>layout/capture/css/animate.css">
  
  <link rel="stylesheet" href="<?= ROOT_URL; ?>layout/capture/css/owl.carousel.min.css">
  <link rel="stylesheet" href="<?= ROOT_URL; ?>layout/capture/css/owl.theme.default.min.css">
  <link rel="stylesheet" href="<?= ROOT_URL; ?>layout/capture/css/magnific-popup.css">

  <link rel="stylesheet" href="<?= ROOT_URL; ?>layout/capture/css/aos.css">

  <link rel="stylesheet" href="<?= ROOT_URL; ?>layout/capture/css/ionicons.min.css">

  <link rel="stylesheet" href="<?= ROOT_URL; ?>layout/capture/css/bootstrap-datepicker.css">
  
  <link rel="stylesheet" href="<?= ROOT_URL; ?>layout/capture/css/flaticon.css">
  <link rel="stylesheet" href="<?= ROOT_URL; ?>layout/capture/css/icomoon.css">
  <link rel="stylesheet" href="<?= ROOT_URL; ?>layout/capture/css/style.css">

  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>

  <?= $v['head']['extension']; ?>
    
  </head>
