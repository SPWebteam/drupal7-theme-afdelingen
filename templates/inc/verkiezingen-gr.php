<?php print render($tabs); ?>

  <!-- HEADER-->
  <div id="header-verkiezing">
    <h1 class="verkiezing-title">
      <a class="name-text" href="<?php print $linkto; ?>" target="_blank">
      <span class="verkiezing-name"><?php print $node->title; ?></span>
        <?php if ($site_name == 'West-Friesland Oost'): ?>
          <?php $site_name = 'Enkhuizen'; ?>
        <?php elseif ($site_name == 'Zaanstreek'): ?>
          <?php $site_name = 'Zaanstad'; ?>
        <?php endif; ?>
      <span class="verkiezing-location">SP <span class="locality"><?php print $site_name; ?></span></span></a>
    </h1>
    <h2 class="verkiezing-slogan"><?php print $node->field_verk_slogan['und'][0]['safe_value']; ?></h2>
  </div>
  <!-- RENDERED HEADER IMAGE -->
  <canvas id="header-verkiezing-rendered"></canvas>

  <div class="logo-link"><a href="<?php print url('<front>'); ?>"><?php include('logo-gr2018.tpl.php'); ?></a></div>

  <!--PRIMARY CONTENT-->
  <div id="primary-verkiezing" class="content">
    <?php print render($page['help']); ?>

    <?php if (!empty($messages)) : ?>
      <div class="interface">
        <?php print $messages; ?>
      </div>
      <?php endif; ?>

    <!-- NAVIGATION -->
    <nav class="page-navigation">
      <ul class="nav-tabs">
        <li class="active"><a href="#tab-overzicht">Overzicht</a></li>
        <li><a href="#tab-kandidaten">Kandidaten</a></li>
        <?php if ($standpunt_found) print '<li><a href="#tab-standpunten">Standpunten</a></li>'; ?>
        <?php if ($programma_id) print '<li><a href="#tab-programma">Programma</a></li>'; ?>
        <?php if (!empty($node->field_verk_etab_titel)) print '<li><a href="#tab-etab">' . $node->field_verk_etab_titel['und'][0]['safe_value'] . '</a></li>'; ?>
      </ul>
      <!-- VOLG ONS -->
      <?php if ((!empty($node->field_verk_facebook)) || (!empty($node->field_verk_instagram)) || (!empty($node->field_verk_youtube)) || (!empty($node->field_verk_twitter))): ?>
      <ul id="volgons">
        <li class="label"><p>Volg ons</p></li>
        <?php if (!empty($node->field_verk_facebook)) : ?>
        <li><a target="_blank" class="facebook" href="<?php print $node->field_verk_facebook['und'][0]['safe_value']; ?>">f</a></li>
        <?php endif; ?>
        <?php if (!empty($node->field_verk_instagram)) : ?>
        <li><a target="_blank" class="instagram" href="<?php print $node->field_verk_instagram['und'][0]['safe_value']; ?>">i</a></li>
        <?php endif; ?>
        <?php if (!empty($node->field_verk_youtube)) : ?>
        <li><a target="_blank" class="youtube" href="<?php print $node->field_verk_youtube['und'][0]['safe_value']; ?>">y</a></li>
        <?php endif; ?>
        <?php if (!empty($node->field_verk_twitter)) : ?>
        <li><a target="_blank" class="twitter" href="<?php print $node->field_verk_twitter['und'][0]['safe_value']; ?>">t</a></li>
        <?php endif; ?>
      </ul>

      <?php endif; ?>
    </nav>
    <div class="content-tabs">
      <!--OVERZICHT-->
      <div id="tab-overzicht" class="content-tab clearfix">

       <?php $output = field_view_field('node', $node, 'field_intro_verk_algemeen','default'); ?>
       <?php if(!empty($output)) :?>
        <div id="introductie" class="section">
          <div class="content-wrapper">
            <?php print render($output); ?>
          </div>
        </div>
      <?php endif; ?>

        <?php if (!empty($node->field_verk_foto_lijsttrekker['und'][0]['uri'])) : ?>
          <div id="lijsttrekker" class="section clearfix">
            <div class="content-wrapper">
              <h2 class="naam"><span class="crown">Lijsttrekker: </span><?php print $node->field_verk_naam_lijsttrekker['und'][0]['safe_value']; ?></h2>
              <div class="foto">
                <?php $output = field_view_field('node', $node, 'field_verk_foto_lijsttrekker','afd_portret'); ?>
                <?php print render($output); ?>
              </div>
              <?php $output = field_view_field('node', $node, 'field_verk_tekst_lijsttrekker', array('label' => 'hidden')); ?>
              <?php print render($output); ?>
            </div>
          </div>
        <?php endif; ?>

        <div class="nieuws-agenda clearfix">
          <?php if ($nieuws_found) : ?>
          <div id="nieuws" class="section">
            <div id="nieuws-titels">
              <!-- LAATSTE NIEUWS -->
              <h3>Laatste nieuws</h3>
                <?php print $nieuws_titles->render(); ?>
                <?php if (!empty($verk_dossier_path)) : ?>
        		  <a href="<?php print $verk_dossier_path . '?page=1'; ?>" target="_blank" class="btn">Meer nieuws</a>
        	  </div>
            <div id="nieuws-berichten">
                <?php print $nieuws_messages->render(); ?>
            </div>

	        <?php endif; ?>
          </div>
         <?php endif; ?>
          <?php if ($agendaitem) : ?>
          <div id="agenda" class="section">
            <h3>Agenda</h3>
            <?php print $agenda->preview('default'); ?>
          </div>
          <?php endif; ?>
        </div>
      </div>

      <!--KANDIDATEN-->
      <div id="tab-kandidaten" class="content-tab">
        <div class="top10">
        <?php $items = $wrapper->field_verk_kandidaat->value(); ?>
        <?php $top = empty($wrapper->field_verk_kand_top->value()) ? 10 : $wrapper->field_verk_kand_top->value(); ?>
        <?php foreach($items as $key => $item) : ?>
          <?php $i = $key + 1; ?>
          <?php if ($i > $top) break; ?>
          <?php $more = (empty($item->field_verk_kand_introductie['und'][0]['safe_value'])) ? false : true; ?>
          <div class="kandidaat">
            <?php if ($more) : ?><a class="kandidaat-link" href="#kandidaat-<?php print $i; ?>"><?php endif; ?>
              <div class="foto">
                <?php if (!empty($item->field_afbeelding['und'][0]['uri'])) : ?>
                  <?php $image = theme('image_style', array('path' => $item->field_afbeelding['und'][0]['uri'], 'style_name' => 'afd_portret')); ?>
                  <?php print $image; ?>
                <?php endif; ?>
              </div>
              <div class="profiel-kort">
                <h3 class="naam"><?php print $i . '. ' . $item->field_voornaam['und'][0]['safe_value'] . ' ' . $item->field_achternaam['und'][0]['safe_value'];?></h3>
                <?php if (!empty($item->field_verk_kandidaten_functie)) : ?><p class="functie"><?php print $item->field_verk_kandidaten_functie['und'][0]['safe_value']; ?></p><?php endif; ?>
                <?php if (!empty($item->field_verk_kand_introductie['und'][0]['safe_value'])) : ?>
                  <p class="meer-informatie">Meer informatie</p>
                <?php endif; ?>
              </div>
            <?php if ($more) : ?></a><?php endif; ?>
            <div id="kandidaat-<?php print $i; ?>" class="modal">
              <div class="wrapper">
                <a class="modal-close">x</a>
                <h3><?php print $i . '. ' . $item->field_voornaam['und'][0]['safe_value'] . ' ' . $item->field_achternaam['und'][0]['safe_value'];?></h3>
                <p class="introductie"></p>
                <div class="cc-image cc-hidden">
                  <?php if (!empty($item->field_afbeelding['und'][0]['uri'])) : ?>
                    <?php $image = theme('image_style', array('path' => $item->field_afbeelding['und'][0]['uri'], 'style_name' => 'afd_portret')); ?>
                    <?php print $image; ?>
                  <?php endif; ?>
                </div>
                  <?php if (!empty($item->field_verk_kand_introductie)) : ?><p><?php print $item->field_verk_kand_introductie['und'][0]['safe_value']; ?></p><?php endif; ?>
                <p class="modal-social">
                <?php if (!empty($item->field_telefoon)) : ?><a href="tel:+<?php print $item->field_telefoon['und'][0]['safe_value']; ?>" class="icon icon-phone"><span class="text">Telefoon</span></a><?php endif; ?>
                  <?php if (!empty($item->field_mobiel)) : ?><a href="tel:+<?php print $item->field_mobiel['und'][0]['safe_value']; ?>" class="icon icon-phone"><span class="text">Mobiel</span></a><?php endif; ?>
                  <?php if (!empty($item->field_email)) : ?><a href="mailto:<?php print $item->field_email['und'][0]['safe_value']; ?>" class="icon icon-mail"><span class="text">Mail</span></a><?php endif; ?>
                  <?php if (!empty($item->field_facebook)) : ?><a href="<?php print $item->field_facebook['und'][0]['display_url']; ?>" class="icon icon-facebook"><span class="text">Facebook</span></a><?php endif; ?>
                  <?php if (!empty($item->field_twitter)) : ?><a href="<?php print $item->field_twitter['und'][0]['display_url']; ?>" class="icon icon-twitter"><span class="text">Twitter</span></a><?php endif; ?>
                </p>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
        </div>
        <?php if ($i > $top) : ?>
          <div class="lijst">
            <div class="view-content">
                <?php foreach($items as $key => $item) : ?>
                  <?php $i = $key + 1; ?>
                  <?php if ($i > $top) : ?>
                    <h3 class = "naam"><?php print $i . '. ' . $item->field_voornaam['und'][0]['safe_value'] . ' ' . $item->field_achternaam['und'][0]['safe_value'];?></h3>
                  <?php endif; ?>
                <?php endforeach; ?>
            </div>
          </div>
        <?php endif; ?>
      </div>

      <!--STANDPUNTEN-->
      <?php if ($standpunt_found) : ?>
        <div id="tab-standpunten" class="content-tab">
          <?php print $standpunten->preview('default'); ?>
        </div>
      <?php endif; ?>

      <!--PROGRAMMA-->
      <?php if ($programma_id) : ?>
        <div id="tab-programma" class="content-tab clearfix">
          <div id="programma-index">
            <h4>Inhoudsopgave:</h4>
            <?php print views_embed_view('verkiezingsprogramma','index'); ?>
          </div>
          <div id="programma-chapters">
            <?php print views_embed_view('verkiezingsprogramma','chapters'); ?>
          </div>
        </div>
      <?php endif; ?>

      <!--EXTRA TAB-->
      <?php if (!empty($node->field_verk_etab_inhoud)) : ?>
        <div id="tab-etab" class="content-tab clearfix">
          <div id="etab" class="section">
            <div class="content-wrapper">
              <?php $output = field_view_field('node', $node, 'field_verk_etab_inhoud','default'); ?>
              <?php print render($output); ?>
            </div>
          </div>
        </div>
      <?php endif; ?>

      <!-- NIEUWS -->
      <div id="tab-nieuws" class="content-tab">
        <?php if ($nieuws_found) : ?>
          <?php print views_embed_view('verkiezingsnieuws'); ?>
        <?php endif; ?>
      </div>

      <!-- DOE MEE -->
      <div id="tab-doemee" class="content-tab">
        <div class="section">
          <h3>Doe mee</h3>
          <?php $output = field_view_field('node', $node, 'field_intro_verk_doemee','default'); ?>
          <?php print drupal_render($output); ?>
        </div>
        <hr/>
        <div class="section">
          <h3>Meld je aan</h3>
          <?php $output = drupal_get_form('afd_verkiezing_doemee'); ?>
          <?php print drupal_render($output); ?>
        </div>
      </div>

    </div>

  </div>

<!-- TO TOP -->
<div id="to-top">
  <a href="#top">Terug naar boven</a>
  <nav class="footer-navigation">
      <ul class="footer-nav-tabs">
        <li><a href="#tab-overzicht">Overzicht</a></li>
        <li><a href="#tab-kandidaten">Kandidaten</a></li>
        <?php if ($standpunt_found) print '<li><a href="#tab-standpunten">Standpunten</a></li>'; ?>
        <?php if ($programma_id) print '<li><a href="#tab-programma">Programma</a></li>'; ?>
        <?php if (!empty($node->field_verk_etab_titel)) print '<li><a href="#tab-etab">' . $node->field_verk_etab_titel['und'][0]['safe_value'] . '</a></li>'; ?>
      </ul>
  </nav>
</div >

<!-- SECONDARY MENU -->
<div id="secondary-menu">
  <a href="#tab-doemee">Doe mee</a>
  <a href="https://www.spnet.nl/aanmelden/lid" target="_blank">Word lid</a>
  <a href="/contact" target="_blank">Contact</a>
  <?php //if ($is_front) : ?>
    <a href="<?php print $linkto; ?>" target="_blank">Normale website</a>
  <?php //endif; ?>

</div>

<!-- FOOTER -->
<div id="footer-verkiezing">
  <div class="menu"><p>
    <a href="https://www.sp.nl/" target="_blank">www.sp.nl</a>
    <a href="https://www.sp.nl/partij/" target="_blank">Partij</a>
    <a href="https://www.sp.nl/doneren" target="_blank">Doneren</a>
    <a href="https://www.sp.nl/wij-sp/lokale-afdelingen" target="_blank">Afdelingen</a>
    <a href="https://www.sp.nl/nieuws/" target="_blank">Nieuws</a>
    <a href="https://www.sp.nl/publicaties/" target="_blank">Publicaties</a>
    <a href="https://www.sp.nl/shop/" target="_blank">Shop</a>
    <a href="https://www.sp.nl/programma/" target="_blank">Programma</a>
    <a href="https://www.sp.nl/contact" target="_blank">Contact</a>
    <a href="https://www.sp.nl/word-lid" target="_blank">Word lid</a>
  </p>
</div>
  <p class="licence-info">Foto's en afbeeldingen zijn te gebruiken op
    <a rel="license" href="https://creativecommons.org/licenses/by-nc-nd/3.0/nl/"><span class="license-title">Creative Commons</span><span class="license-icons">bnd</span></a>
    <span class="license-exception">(tenzij anders vermeld)</span>
  </p>
</div>
