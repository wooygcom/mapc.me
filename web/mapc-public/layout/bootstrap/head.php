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
  <!-- Tell the browser to be responsive to screen width -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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

  <link rel="shortcut icon" href="<?= $config['favicon']; ?>">
  <link rel="apple-touch-icon" href="<?= $config['favicon']; ?>" />

  <title><?= $config['title']; ?></title>

  <?= $v['head']['extension']; ?>

  <!-- Bootstrap core CSS -->
  <link href="../../npm/bootstrap.min.css" rel="stylesheet">
  <link href="<?= ROOT_URL; ?>layout/bootstrap/signin.css" rel="stylesheet">
</head>
