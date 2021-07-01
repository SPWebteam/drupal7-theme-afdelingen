<?php

/**
 * @file
 * Main view template.
 *
 * Variables available:
 * - $classes_array: An array of classes determined in
 *   template_preprocess_views_view(). Default classes are:
 *     .view
 *     .view-[css_name]
 *     .view-id-[view_name]
 *     .view-display-id-[display_name]
 *     .view-dom-id-[dom_id]
 * - $classes: A string version of $classes_array for use in the class attribute
 * - $css_name: A css-safe version of the view name.
 * - $css_class: The user-specified classes names, if any
 * - $header: The view header
 * - $footer: The view footer
 * - $rows: The results of the view query, if any
 * - $empty: The empty text to display if the view is empty
 * - $pager: The pager next/prev links to display, if any
 * - $exposed: Exposed widget form/info to display
 * - $feed_icon: Feed icon to display, if any
 * - $more: A link to view more, if any
 *
 * @ingroup views_templates
 */
?>

<?php
/*
 * Add class to list items that are a category
 *
 */



    $vocabulary = taxonomy_vocabulary_machine_name_load('dossiers');
    $tree = taxonomy_get_tree($vocabulary->vid);
    $parents = array();
    $children = array();
    foreach ($tree as $term) {
      // Check if child or parent
      if ($term->depth == 0) {
        $parents[] = $term;
      }
      else {
        $all_parents = taxonomy_get_parents_all($term->tid);
        $last = array_pop($all_parents);
        $children[$last->tid][] = $term;
      }
    }
    if (!empty($children)) {
      foreach ($parents as $parent) {
        if (isset($parent->tid) && isset($children[$parent->tid])) {
          $search = '/option value="' . $parent->tid . '"/';
          $replace = 'option value="' . $parent->tid . '" disabled="disabled"' . ' class="dossier-category"';
          $exposed = preg_replace($search, $replace, $exposed);
        }
        if (isset($parent->tid) && !isset($children[$parent->tid])) {
          $search = '/option value="' . $parent->tid . '"/';
          $replace = 'option value="' . $parent->tid . '" class="dossier-overige"';
          $exposed = preg_replace($search, $replace, $exposed);
        }
      }
    }
?>

<div class="<?php print $classes; ?>">
  <?php print render($title_prefix); ?>
  <?php if ($title): ?>
    <?php print $title; ?>
  <?php endif; ?>
  <?php print render($title_suffix); ?>
  <?php if ($header): ?>
    <div class="view-header">
      <?php print $header; ?>
    </div>
  <?php endif; ?>

  <?php if ($exposed): ?>
    <div class="view-filters">
      <?php print $exposed; ?>
    </div>
  <?php endif; ?>

  <?php if ($attachment_before): ?>
    <div class="attachment attachment-before">
      <?php print $attachment_before; ?>
    </div>
  <?php endif; ?>

  <?php if ($rows): ?>
    <div class="view-content">
      <?php print $rows; ?>
    </div>
  <?php elseif ($empty): ?>
    <div class="view-empty">
      <?php print $empty; ?>
    </div>
  <?php endif; ?>

  <?php if ($pager): ?>
    <?php print $pager; ?>
  <?php endif; ?>

  <?php if ($attachment_after): ?>
    <div class="attachment attachment-after">
      <?php print $attachment_after; ?>
    </div>
  <?php endif; ?>

  <?php if ($more): ?>
    <?php print $more; ?>
  <?php endif; ?>

  <?php if ($footer): ?>
    <div class="view-footer">
      <?php print $footer; ?>
    </div>
  <?php endif; ?>

  <?php if ($feed_icon): ?>
    <div class="feed-icon">
      <?php print $feed_icon; ?>
    </div>
  <?php endif; ?>

</div><?php /* class view */ ?>
