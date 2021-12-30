<?php
/**
 *  page--blog.tpl.php
 */

// required for footer
include('inc/footer-preprocess.php');
include('inc/secondary-preprocess.php');

// required for footer and readspeaker
$type = theme_get_setting('afdelingen_type');  //also used for other functions such as footer

// readspeaker
if ($type == 'international') {
  $rs_alttext = 'Listen to this article using Readspeaker';
  $rs_text = 'Read';
  $countrycode = 'en_uk';
}
else {
  $rs_alttext = 'Laat de tekst voorlezen door Readspeaker';
  $rs_text = 'Voorlezen';
  $countrycode = 'nl_nl';
}

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
    <?php // if (!empty($variables['node']->type) && in_array($variables['node']->type, array('blog'))) : ?>
    <?php if (1): ?>
      <?php $front = drupal_is_front_page() ? ' rs_frontpage' : ' rs_nofrontpage'; ?>
<!--      <div id="readspeaker_button1" class="rs_skip">
        <a accesskey="L" href="https://app-eu.readspeaker.com/cgi-bin/rsent?customerid=5359&amp;lang=<?php print $countrycode; ?>&amp;url=<?php global $base_url; print urlencode($base_url . '/' . current_path()); ?>;" target="_blank" onclick="readspeaker(this.href+'&amp;selectedhtml='+escape(selectedString), 'rs_1'); return false;">
        <span><?php print $rs_text; ?></span>
        </a>
      </div>
-->

      <div id='rs_1'></div>
    <?php endif; ?>

    <!-- RSPEAK_START -->
    <?php  /* Title */
      print render($title_prefix);
      // Custom title
      $arg = arg(2);
      if(module_load_include('inc','pathauto','pathauto') !== FALSE) {
        if (function_exists('pathauto_cleanstring')) {
      	  // Get blog title
      	  $realnamedata = db_query("SELECT realname FROM {realname}");
      	  while ($realname = $realnamedata->fetchAssoc()) {
            $realname = $realname['realname'];
            $realname_url = pathauto_cleanstring($realname);
            if (!empty($realname) && $realname_url == $arg) {
              $title = 'Blog ' . $realname;
              break;
            }
      	  }
      	}
      }
      if ($title) { print '<h2 class="page-title">'.$title.'</h2>'; }
      print render($title_suffix);
      print render($page['content']);
    ?>
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

  <!-- RIGHT SIDEBAR-->
  <?php if ($page['sidebar_second']): ?>
    <div id="sidebar-right" class="sidebar"><?php print render($page['sidebar_second']); ?></div>
  <?php endif; ?>

</div><!-- end div #content-container -->


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
        <a class="btn" href="https://wordlid.sp.nl?ref_source=spnl-afdelingssites&ref=afd-secondary">Word lid</a>
      </div>
      <?php else: ?>
      <div class="secondary-subscribe col-12 offset-sm-3 col-sm-6">
        <a class="btn" href="/contact?ref=afd-secondary">Contact</a>
        <a class="btn" href="https://wordlid.sp.nl?ref_source=spnl-afdelingssites&ref=afd-footer">Word lid</a>
      </div>
      <?php endif; ?>
    </div>
  </div>
</div>


<!-- FOOTER -->
<div class="footer">
  <?php if(isset($footer)) { print $footer; } ?>
  <div class="footer-bottom">
    <?php if ($type !== 'international'): ?>
      <?php print render($page['license-info']); ?>
    <?php else : ?>
      <?php print render($page['license-info_international']); ?>
    <?php endif; ?>
  </div>
</div>
