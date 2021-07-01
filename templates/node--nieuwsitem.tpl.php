<?php
/**
 *  node--nieuwsitem.tpl.php - 2.0
 *  See: http://api.drupal.org/api/drupal/modules--node--node.tpl.php/7
 */
?>

<div id="nieuws-<?php print $node->nid; ?>" class="<?php print $classes; ?>"<?php print $attributes; ?>>
  <?php print render($title_prefix); ?>
  <?php if (!$page): ?>
    <div class="pub-date"><?php print render($afd_date); ?></div>
    <h2 class="title"><a href="<?php print $node_url; ?>"><?php print $title;  ?></a></h2>
  <?php else: ?>
    <div class="pub-date"><?php print render($afd_date); ?></div>
    <?php if ($title) { print '<h2 class="title">'.$title.'</h2>'; } ?>
  <?php endif; ?>
  <?php print render($title_suffix); ?>
<!--  <?php include(drupal_get_path('module', 'spreadspeaker') . '/templates/readspeaker.tpl.php'); ?>  -->
  <?php print render($content['field_afbeelding']); ?>
  <div class="node-content clearfix"<?php print $content_attributes; ?>> 
  <?php
    hide($content['comments']);
    hide($content['sp_share']);
    hide($content['field_taxonomie']);
    print render($content);
  ?>
  <?php if(!$teaser) : ?>
    <?php if (isset($content['field_taxonomie']['#items'])) : ?>
      <div class="zie-ook">
        <ul>
          <li>
            <span><?php print t('See also:'); ?></span>
          </li>
          <?php if (isset($content['field_taxonomie']['#items'])) : ?>
            <?php foreach ($content['field_taxonomie']['#items'] as $values) : ?>
              <?php
                $tid = $values['tid'];
                $term = taxonomy_term_load($tid); // load term object
                $term_uri = taxonomy_term_uri($term); // get array with path
                $path = drupal_get_path_alias($term_uri['path']);
              ?>
              <li><a class="zie-ook_dossier" href="/<?php print $path; ?>"><?php print $values['taxonomy_term']->name; ?></a></li>
            <?php endforeach ?>
          <?php endif ?>
        </ul>
      </div>
    <?php endif ?>
  <?php endif ?>
</div>

		<?php if(!$teaser) { print render($content['sp_share']); } ?>
		<?php print render($content['comments']); ?>
</div>
