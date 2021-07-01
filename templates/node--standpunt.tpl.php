<?php

/**
 *  node.tpl.php - beta 1.0
 *  See: http://api.drupal.org/api/drupal/modules--node--node.tpl.php/7
 */

?>

<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?>"<?php print $attributes; ?>>

	<?php print render($title_prefix); ?>
		<?php if (!$page): ?>
			<h2 class="title"><a href="<?php print $node_url; ?>"><?php print $title;  ?></a></h2>
		<?php endif; ?>
	<?php print render($title_suffix); ?>

		<div class="node-content clearfix"<?php print $content_attributes; ?>>
			<?php

			hide ($content['comments']);
			hide ($content['sp_share']);
			hide ($content['field_standpunt_categorie']);
			hide ($content['field_gerelateerde_standpunten']);
			hide ($content['field_cat']);

			print render($content);
			?>

    <?php if(!$teaser) : ?>
      <?php if (isset($content['field_standpunt_categorie']['#items']) || isset($content['field_gerelateerde_standpunten']['#items']) || isset($content['field_cat']['#items'])) : ?>
        <div class="zie-ook">
        <ul>
          <li>
            <span><?php print t('See also:'); ?></span>
          </li>
          <?php if (isset($content['field_gerelateerde_standpunten']['#items'])) : ?>
              <?php foreach ($content['field_gerelateerde_standpunten']['#items'] as $values) : ?>
                <?php
                  $standpunt = $values['entity']; // load standpunt
                  $path = drupal_get_path_alias('node/' . $standpunt->nid);
                ?>
                <li><a href="/<?php print $path; ?>"><?php print t('Related position:') . ' ' . $standpunt->title; ?></a></li>
              <?php endforeach ?>
          <?php endif ?>
          <?php if (isset($content['field_standpunt_categorie']['#items'])) : ?>
            <?php foreach ($content['field_standpunt_categorie']['#items'] as $values) : ?>
              <?php
                $tid = $values['tid'];
                $term = taxonomy_term_load($tid); // load term object
                $term_uri = taxonomy_term_uri($term); // get array with path
                $path = drupal_get_path_alias($term_uri['path']);
              ?>
              <li><a class="zie-ook_categorie" href="/<?php print $path; ?>"><?php print t('Categorie:') . ' ' . $values['taxonomy_term']->name; ?></a></li>
            <?php endforeach ?>
          <?php endif ?>
          <?php if (isset($content['field_cat']['#items'])) : ?>
            <?php foreach ($content['field_cat']['#items'] as $values) : ?>
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
		<?php print render($content['comments']); ?>
</div>
