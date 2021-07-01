<?php
/**
 *  page.tpl.php
 */

// required for footer
include('inc/footer-preprocess.php');
include('inc/secondary-preprocess.php');

?>


<!-- HEADER-->
<div id="header-container">
  <div id="header">
  <?php print render($page['header']);
	print render($branding);
  ?>
  </div>
  <!--HAMBURGER-->
  <div id="hamburger">h</div>
</div>


<div id="content-container" class="clearfix">


  <!--LEFT SIDEBAR-->
  <?php if ($page['sidebar_first']): ?>
  <div id="sidebar-left" class="sidebar">
    <?php print render($page['sidebar_first']); ?>
  </div>
  <?php endif; ?>


  <!--PRIMARY CONTENT-->
  <div id="primary" class="content">
    <?php print render($page['help']); ?>

    <?php if (!empty($tabs['#primary']) || !empty($messages)) : ?>
    <div class="interface">
      <?php print render($tabs); ?>
      <?php print $messages; ?>
    </div>
    <?php endif; ?>
    <?php // if ((!empty($variables['node']->type) && in_array($variables['node']->type, array('nieuwsitem','page','standpunt'))) || drupal_is_front_page()) : ?>
    <?php if (1): ?>
      <?php $front = drupal_is_front_page() ? ' rs_frontpage' : ' rs_nofrontpage'; ?>
      <?php include(drupal_get_path('module', 'spreadspeaker') . '/templates/readspeaker.tpl.php'); ?>

      <div id='rs_1'></div>
    <?php endif; ?>

    <?php if (isset($variables['book_top_node']) && isset($variables['node']->book) && $variables['node']->book['nid'] !== $variables['node']->book['bid']) : ?> 
      <h5 class="book-title">
        <a href="/<?php print drupal_get_path_alias('node/' . $variables['book_top_node']->nid); ?>"><?php print $variables['book_top_node']->title; ?></a>
      </h5>
    <?php endif; ?>

    <?php  /* Title */
      print render($title_prefix);
      if ($title) { print '<h2 class="page-title">'.$title.'</h2>'; }
      print render($title_suffix);
    ?>

    <!-- RSPEAK_START --> 
    <?php print render($page['content']); ?>
    <!-- RSPEAK_STOP -->

    <?php if ($page['extra']): ?>
      <!-- EXTRA -->
      <div id="extra">
      <?php print render($page['extra']); ?>
      </div>
    <?php endif; ?>
  
    <?php if ($breadcrumb): ?>
      <!-- BREADCRUMB -->
      <?php print $breadcrumb; ?>
    <?php endif; ?>
  
  </div> <!-- end div #primary -->


  <!-- RIGHT SIDEBAR -->
  <?php if ($page['sidebar_second']): ?>
    <div id="sidebar-right" class="sidebar">
    <?php print render($page['sidebar_second']); ?>
    </div>
  <?php endif; ?>

</div> <!-- end div #content-container -->


<!-- SECONDARY -->
<div id="secondary">
  <div class="container">
    <div class="row">
      <?php if (!empty($secondary_string)) : ?>
      <div class="secondary-social col-12 col-sm-6">
        <?php print ($secondary_string); ?>
      </div>
      <div class="secondary-subscribe col-12 col-sm-6">
        <a class="btn" href="/contact?ref=afd-secondary">Contact</a>
        <a class="btn" href="https://www.spnet.nl/aanmelden/lid?ref_source=spnl-afdelingssites&ref=afd-secondary">Word lid</a>
      </div>
      <?php else: ?>
      <div class="secondary-subscribe col-12 offset-sm-3 col-sm-6">
        <a class="btn" href="/contact?ref=afd-secondary">Contact</a>
        <a class="btn" href="https://www.spnet.nl/aanmelden/lid?ref_source=spnl-afdelingssites&ref=afd-footer">Word lid</a>
      </div>
      <?php endif; ?>
    </div>
  </div>
</div>


<!-- FOOTER -->
<div class="footer">
  <?php if(isset($footer)) { print $footer; } ?>
  <div class="footer-bottom">
    <span><a target="_blank" href="https://www.sp.nl/privacy">Privacy</a> | </span>
    <?php if ($type !== 'international'): ?>
      <?php print render($page['license-info']); ?>
    <?php else : ?>
      <?php print render($page['license-info_international']); ?>
    <?php endif; ?>
  </div>
</div>
