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

  <link rel="apple-touch-icon" sizes="57x57" href="<?= ROOT_URL; ?>/favicon/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="<?= ROOT_URL; ?>/favicon/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="<?= ROOT_URL; ?>/favicon/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="<?= ROOT_URL; ?>/favicon/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="<?= ROOT_URL; ?>/favicon/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="<?= ROOT_URL; ?>/favicon/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="<?= ROOT_URL; ?>/favicon/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="<?= ROOT_URL; ?>/favicon/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="<?= ROOT_URL; ?>/favicon/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192"  href="<?= ROOT_URL; ?>/favicon/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= ROOT_URL; ?>/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="<?= ROOT_URL; ?>/favicon/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= ROOT_URL; ?>/favicon/favicon-16x16.png">
  <link rel="manifest" href="<?= ROOT_URL; ?>/favicon/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">

  <?= $v['head']['extension']; ?>
    
  </head>
