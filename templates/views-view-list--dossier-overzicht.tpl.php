<?php
/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * - $title : The title of this group of rows.  May be empty.
 * - $options['type'] will either be ul or ol.
 * @ingroup views_templates
 */
?>

<?php
    // Prepare data
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
?>

<?php print $wrapper_prefix; ?>
  <?php if (!empty($title)) : ?>
    <h3><?php print $title; ?></h3>
  <?php endif; ?>
    <?php
      // Generate content
      if (empty($children)) {
        // No hierarchy
        print '<ul class="dossier">';
        foreach ($parents as $parent) {
          // Get path to dossier
          $path = 'taxonomy/term/' . $parent->tid;
          $alias = drupal_get_path_alias($path);
          print '<li><a href="/' . $alias . '">' . $parent->name . '</a></li>';
        }
        print '</ul>';
      }
      else {
        // Show hierarchy
        foreach ($parents as $parent) {
          if (isset($parent->tid) && isset($children[$parent->tid])) {
            print '<h3>' . $parent->name . '</h3><ul class="dossier">';
            foreach ($children[$parent->tid] as $child) {
              // Get path to dossier
              $path = 'taxonomy/term/' . $child->tid;
              $alias = drupal_get_path_alias($path);
              print '<li><a href="/' . $alias . '">' . $child->name . '</a></li>';
            }
            print '</ul>';
          }
        }
        // Voeg eventueel overige categorie toe
        $output = '';
        foreach ($parents as $parent) {
          if (isset($parent->tid) && !isset($children[$parent->tid])) {
            $path = 'taxonomy/term/' . $parent->tid;
            $alias = drupal_get_path_alias($path);
            $output .= '<li><a href="/' . $alias . '">' . $parent->name . '</a></li>';
          }
        }
        if ($output) {
          print '<h3>Overige</h3><ul class="dossier">';
          print $output;
          print '</ul>';
        }
      }
    ?>
<?php print $wrapper_suffix; ?>
