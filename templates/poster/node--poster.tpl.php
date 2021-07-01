<?php
/**
 *  node.tpl.php - 1.1
 *  See: http://api.drupal.org/api/drupal/modules--node--node.tpl.php/7
 */
?>
<?php
  drupal_add_css(path_to_theme() . '/css/poster-node.css');
?>
<?php 
  $bezoeker_tekst = str_replace(' ', '<br/>', strtoupper($variables['title'])) . '<br/>';
  $afdeling_tekst = str_replace(' ', '<br/>', strtoupper($variables['field_poster_tekst'][0]['taxonomy_term']->name));
?>

<div id="poster">
  <?php if (arg(1) !== 'add') : ?>
    <a href="/printpdf/<?php print $node->nid; ?>">
  <?php endif; ?>
    <span class="poster-tekst">
      <span class="bezoeker-tekst"><?php print $bezoeker_tekst; ?></span>
      <span class="afdeling-tekst"><?php print $afdeling_tekst; ?></span>
    </span>
  <?php if (arg(0) !== 'add') : ?>
    </a>
  <?php endif; ?>
</div>


