<?php
/**
 *  html.tpl.php - beta 2.1
 */

?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="nl"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="nl"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="nl"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="nl"> <!--<![endif]-->
<head>
  <meta charset="utf-8" />
  <meta name="author" content="Socialistische Partij" />
  <meta name="google-site-verification" content="_Ci3443QcEuyTVHxUUCR2XKKbYqLsTs09A44ztEJF1M" />
  <meta name="viewport" content="width=device-width" />
  <?php print $head; ?>
  <title><?php print $head_title; ?></title>
  <?php print $styles; ?>
  <?php
  /**
   * Only load tracking html elements, such as facebook 'pixel', when user consent is given.
   * When caching is enabled for the site, use the cookie_aware_page_cache module to cache variants
   * Depending on the value of the sprivacy (tracking consent) cookie
   */
  if(isset($_COOKIE['sprivacy']) && $_COOKIE['sprivacy'] == 2) :?>
  <!-- Only load advertising/tracking when consent is given -->
  <!-- INSERT CODE SNIPPET HERE -->
  <!-- End advertising/tracking -->
  <?php endif; ?>
  <?php if(isset($_COOKIE['sprivacy']) && ($_COOKIE['sprivacy'] == 1 || $_COOKIE['sprivacy'] == 2)) :?>
  <!-- Only load anonymized statistical tracking -->
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-20896723-11"></script>
  <script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'UA-20896723-11',{ 'anonymize_ip': true });
  </script>
  <!-- End anonymized statistical tracking -->
  <?php endif; ?>
</head>

<body class="<?php print $classes; ?>" <?php print $attributes;?>>
  <div id="skip-link">
    <a href="#main-content" class="hidden">
      <?php print t('Skip to main content'); ?></a>
  </div>
  <!-- Site structure container -->
  <div id="container" >
    <?php print $page_top; ?>
    <?php print $page; ?>
    <?php print $page_bottom; ?>
  </div>
  <div id="cookiebar" class="cookiebar"></div>
  <?php print $scripts; ?>
</body>
</html>
