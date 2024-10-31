<!doctype html>
<html lang="en" data-critters-container>
<head>
  <meta charset="utf-8">
  <title><?php wp_title(); ?></title>
  <?php wp_head(); ?>
  <base href="/">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/x-icon" href="<?php bloginfo('template_url'); ?>/favicon.ico">
  <style>*{margin:0;padding:0;box-sizing:border-box}body{font-family:Arial,sans-serif;line-height:1.6;color:#333}</style>
  <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/styles.css">
</head>
<body>
  <app-root></app-root>

  <?php wp_footer(); ?>
  <script src="<?php bloginfo('template_url'); ?>/runtime.js" type="module"></script>
  <script src="<?php bloginfo('template_url'); ?>/polyfills.js" type="module"></script>
  <script src="<?php bloginfo('template_url'); ?>/main.js" type="module"></script>
</body>
</html>