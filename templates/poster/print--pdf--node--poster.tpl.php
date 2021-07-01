<?php

/**
 * @file
 * Default print module template
 *
 * @ingroup print
 */
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php print $print['language']; ?>" xml:lang="<?php print $print['language']; ?>">
  <head>
    <?php print $print['head']; ?>
    <?php print $print['base_href']; ?>
    <title><?php print $print['title']; ?></title>
    <?php print $print['scripts']; ?>
    <?php print $print['sendtoprinter']; ?>
    <?php print $print['robots_meta']; ?>
    <?php print $print['favicon']; ?>
    <?php print $print['css']; ?>
  </head>
  <body>
    <?php 
      $bezoeker_tekst = str_replace(' ', '<br/>', strtoupper($print['title'])) . '<br/>';
      $afdeling_tekst = str_replace(' ', '<br/>', strtoupper($print['node']->field_poster_tekst['und'][0]['taxonomy_term']->name));
    ?>
      
    <div id="poster" class="print-content" style="font-family: Impact; font-size: 115px; color: #000; line-height: 90%;"><span class="bezoeker-tekst" style="color: #000;"><?php print $bezoeker_tekst; ?></span><span class="afdeling-tekst" style="color: #f00;"><?php print $afdeling_tekst; ?></span></div>
  </body>
</html>
