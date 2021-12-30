<?php
  // see theme-settings.php for types
  $type = theme_get_setting('afdelingen_type');
  // load main menu as variable
  $main_menu_tree = menu_tree(variable_get('menu_main_links_source', 'main-menu')); 
  $main_menu_render = drupal_render($main_menu_tree);

  switch ($type) {
    case 'afdeling':
      // FOOTER AFDELING
      $footer = '
        <div class="container">
          <div class="row">
            <div class="footer_section col-6 col-sm-6 col-md-3">
              <h2 class="footer_title">SP '.$site_name.'</h2>
              '.$main_menu_render.'
            </div>
            <div class="footer_section col-6 col-sm-6 col-md-3">
              <h2 class="footer_title">SP.nl</h2>
              <ul class="footer_menu">
                <li class="footer_menu-item"><a class="footer_menu-link" target="_blank" href="https://sp.nl/nieuws?ref=afd-footer">Nieuws</a></li>
                <li class="footer_menu-item"><a class="footer_menu-link" target="_blank" href="https://sp.nl/standpunten?ref=afd-footer">Standpunten</a></li>
                <li class="footer_menu-item"><a class="footer_menu-link" target="_blank" href="https://sp.nl/partij?ref=afd-footer">Partij</a></li>
                <li class="footer_menu-item"><a class="footer_menu-link" target="_blank" href="https://sp.nl/onze-mensen/gekozen?ref=afd-footer">Onze mensen</a></li>
                <li class="footer_menu-item"><a class="footer_menu-link" target="_blank" href="https://sp.nl/afdelingen?ref=afd-footer">Afdelingen</a></li>
                <li class="footer_menu-item"><a class="footer_menu-link" target="_blank" href="https://doemee.sp.nl?ref=afd-footer">Doe mee</a></li>
                <li class="footer_menu-item"><a class="footer_menu-link" target="_blank" href="https://wordlid.sp.nl?ref_source=spnl-afdelingssites&ref=afd-footer">Word lid</a></li>
                <li class="footer_menu-item"><a class="footer_menu-link" target="_blank" href="https://sp.nl/contact?ref=afd-footer">Contact</a></li>
                <li class="footer_menu-item"><a class="footer_menu-link" target="_blank" href="https://sp.nl/privacy?ref=afd-footer">Privacy</a></li>
                <li class="footer_menu-item"><a class="footer_menu-link" target="_blank" href="https://sp.nl/vacatures?ref=afd-footer">Vacatures</a></li>
                <li class="footer_menu-item"><a class="footer_menu-link" target="_blank" href="https://spnet.nl?ref=afd-footer">SPnet</a></li>
                <li class="footer_menu-item"><a class="footer_menu-link" target="_blank" href="https://sp.nl/shop?ref=afd-footer">Shop</a></li>
              </ul>
            </div>
            <div class="footer_section col-12 col-sm-6 col-md-3">
              <h2 class="footer_title">Blijf op de hoogte</h2>
              <ul class="footer_menu">
                <li class="footer_menu-item"><a class="footer_menu-link" target="_blank" href="https://sp.nl/nieuwsbrief?ref=afd-footer">SP Nieuwsbrief</a></li>
              </ul>
            </div>
          </div>
        </div>
      ';
      break;
    case 'provincie':
      // FOOTER PROVINCIE
      $footer = '
        <div class="container">
          <div class="row">
            <div class="footer_section col-6 col-sm-6 col-md-3">
              <h2 class="footer_title">SP '.$site_name.'</h2>
              '.$main_menu_render.'
            </div>
            <div class="footer_section col-6 col-sm-6 col-md-3">
              <h2 class="footer_title">SP.nl</h2>
              <ul class="footer_menu">
                <li class="footer_menu-item"><a class="footer_menu-link" target="_blank" href="https://sp.nl/nieuws?ref=afd-footer">Nieuws</a></li>
                <li class="footer_menu-item"><a class="footer_menu-link" target="_blank" href="https://sp.nl/standpunten?ref=afd-footer">Standpunten</a></li>
                <li class="footer_menu-item"><a class="footer_menu-link" target="_blank" href="https://sp.nl/partij?ref=afd-footer">Partij</a></li>
                <li class="footer_menu-item"><a class="footer_menu-link" target="_blank" href="https://sp.nl/onze-mensen/gekozen?ref=afd-footer">Onze mensen</a></li>
                <li class="footer_menu-item"><a class="footer_menu-link" target="_blank" href="https://sp.nl/afdelingen?ref=afd-footer">Afdelingen</a></li>
                <li class="footer_menu-item"><a class="footer_menu-link" target="_blank" href="https://doemee.sp.nl?ref=afd-footer">Doe mee</a></li>
                <li class="footer_menu-item"><a class="footer_menu-link" target="_blank" href="https://wordlid.sp.nl?ref_source=spnl-afdelingssites&ref=afd-footer">Word lid</a></li>
                <li class="footer_menu-item"><a class="footer_menu-link" target="_blank" href="https://sp.nl/contact?ref=afd-footer">Contact</a></li>
                <li class="footer_menu-item"><a class="footer_menu-link" target="_blank" href="https://sp.nl/vacatures?ref=afd-footer">Vacatures</a></li>
                <li class="footer_menu-item"><a class="footer_menu-link" target="_blank" href="https://spnet.nl?ref=afd-footer">SPnet</a></li>
                <li class="footer_menu-item"><a class="footer_menu-link" target="_blank" href="https://sp.nl/shop?ref=afd-footer">Shop</a></li>
              </ul>
            </div>
            <div class="footer_section col-12 col-sm-6 col-md-3">
              <h2 class="footer_title">Blijf op de hoogte</h2>
              <ul class="footer_menu">
                <li class="footer_menu-item"><a class="footer_menu-link" target="_blank" href="https://sp.nl/nieuwsbrief?ref=afd-footer">SP Nieuwsbrief</a></li>
              </ul>
            </div>
          </div>
        </div>
      ';
      break;
    case 'international':
      // FOOTER INTERNATIONAL
      $footer = '
        <div class="container">
          <ul class="footer_menu text-center">
            <li class="footer_menu-item footer_menu-item--international"><a class="footer_menu-link" href="/">Home (EN)</a></li>
            <li class="footer_menu-item footer_menu-item--international"><a class="footer_menu-link" target="_blank" href="http://sp.nl?ref=afd-footer">Home (NL)</a></li>
            <li class="footer_menu-item footer_menu-item--international"><a class="footer_menu-link" href="/news?ref=afd-footer">News</a></li>
            <li class="footer_menu-item footer_menu-item--international"><a class="footer_menu-link" href="/dossiers?ref=afd-footer">Dossiers</a></li>
            <li class="footer_menu-item footer_menu-item--international"><a class="footer_menu-link" href="/publications?ref=afd-footer">Publications</a></li>
            <li class="footer_menu-item footer_menu-item--international"><a class="footer_menu-link" href="/representatives?ref=afd-footer">Representatives</a></li>
            <li class="footer_menu-item footer_menu-item--international"><a class="footer_menu-link" href="/blog?ref=afd-footer">Blog</a></li>
            <li class="footer_menu-item footer_menu-item--international"><a class="footer_menu-link" href="/history?ref=afd-footer">History</a></li>
            <li class="footer_menu-item footer_menu-item--international"><a class="footer_menu-link" href="/contact?ref=afd-footer" class="last">Contact</a></li>
          </ul>
        </div>
      ';
      break;
  }
?>
