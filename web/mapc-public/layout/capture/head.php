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

  <?= $v['head']['extension']; ?>
    
  </head>
