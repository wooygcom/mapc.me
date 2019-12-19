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
  <title><?= $v['head']['title']; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

  <meta property="og:url" content="<?= $config['site_url']; ?>">
  <meta property="og:title" content="<?= $config['title']; ?>">
  <meta property="og:description" content="<?= $config['description']; ?>">
  <meta property="og:type" content="<?= $config['type']; ?>">
  <meta property="og:image" content="<?= $config['og_image']; ?>">
  <meta property="og:image:type" content="<?= $config['og_image_type']; ?>">
  <meta property="og:image:width" content="<?= $config['og_image_width']; ?>">
  <meta property="og:image:height" content="<?= $config['og_image_height']; ?>">

  <meta name="author" content="<?= $config['author']; ?>">
  <meta name="description" content="<?= $config['description']; ?>">
  <meta name="keywords" content="<?= $config['keywords']; ?>">

  <link rel="shortcut icon" href="<?= $config['favicon']; ?>" type="image/x-icon">
  <link rel="icon" href="<?= $config['favicon']; ?>" type="image/x-icon">

  <?= $v['head']['extension']; ?>

</head>
