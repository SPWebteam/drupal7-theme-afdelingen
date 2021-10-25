<?php

/**
 * @file
 * Default theme implementation for field collection items.
 *
 * Available variables:
 * - $content: An array of comment items. Use render($content) to print them
 *   all, or print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $title: The (sanitized) field collection item label.
 * - $url: Direct url of the current entity if specified.
 * - $page: Flag for the full page state.
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. By default the following classes are available, where
 *   the parts enclosed by {} are replaced by the appropriate values:
 *   - entity-field-collection-item
 *   - field-collection-item-{field_name}
 *
 * Other variables:
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 *
 * @see template_preprocess()
 * @see template_preprocess_entity()
 * @see template_process()
 */

// GET SITE NAME
$site_name = variable_get('site_name');
if ($site_name == 'West-Friesland Oost'){
  $site_name = 'Enkhuizen';
}
if ($site_name == 'Zaanstreek'){
  $site_name = 'Zaanstad';
}

?>
<div <?php print $attributes; ?>>
  <div class="content lijsttrekker"<?php print $content_attributes; ?>>
    <div class="lijststrekker-foto">
        <?php print render($content['field_kandidaat_foto']) ?>
    </div>
    <div class="lijsttrekker-content">
        <h2><?php print render($content['field_kandidaat_naam']) ?></h2>
        <div class="lijsttrekker-functie">Lijsttrekker <?php echo $site_name; ?></div>
        <?php print render($content); ?>
    </div>
  </div>
</div>
