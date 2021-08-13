<?php

// required for footer
$type = theme_get_setting('afdelingen_type');
include('inc/footer-preprocess.php');
include('inc/secondary-preprocess.php');

/**
 *  page--user.tpl.php - beta 2.0
 */

// Show a nice clean login box when logging in,.

if (!user_is_logged_in()) { ?>

  <div id="primary" class="content">
    <h1 class="site-title"><a href="<?php print $front_page; ?>">
      <img src="<?php print $logo ?>" alt="SP" title="Socialistische Partij" class="logo" /><?php print $site_name; ?></a>
    </h1>
    <h2 class="title">Inloggen</h2>
    <?php print $messages;
      /* Always render the page content (login / new password) */
      $block = module_invoke('system', 'block_view', 'main');
      print render($block['content']);
      print render($tabs); ?>
  </div>

<?php } else { ?>

  <!-- HEADER-->
  <div id="header-container">
    <div id="header">
      <?php
        print render($page['header']);
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
      <div class="seperator"> 
        <h3 class="title">Gegevens gebruiker:<?php 
          if ($title) : 
            print ',&nbsp;'.$title; 
          endif; ?>
        </h3>  
      </div>
      <?php print render($page['highlight']); ?>
      <?php print render($page['help']); ?>        
      <?php if (!empty($tabs['#primary']) || !empty($messages)) : ?>
        <div class="interface">         
          <?php print render($tabs); ?> 
          <?php print $messages; ?>
        </div>
      <?php endif; ?>   
      <?php print render($title_prefix); ?>
        <?php if ($title) : ?>
          <h2 class="title"><?php print $title ?></h2>
        <?php endif; ?> 
      <?php print render($title_suffix); ?>
      <?php print render($page['content']); ?>

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

    </div><!-- end div #primary --> 
  

    <!-- RIGHT SIDEBAR -->
    <?php if ($page['sidebar_second']): ?>
      <div id="sidebar-right" class="sidebar"><?php print render($page['sidebar_second']); ?></div>
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
      <span><a target="_blank" href="https://www.sp.nl/privacy">Privacy</a> | </span>
      <?php if ($type !== 'international'): ?>
        <?php print render($page['license-info']); ?>
      <?php else : ?>
        <?php print render($page['license-info_international']); ?>
      <?php endif; ?>
    </div>
  </div>

<?php } ?>

