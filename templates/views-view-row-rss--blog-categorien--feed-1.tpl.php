<?php

/**
 *  * @file
 *   * Default view template to display a item in an RSS feed.
 *    *
 *     * @ingroup views_templates
 *      */
?>
  <item>
    <title><?php print $title; ?></title>
    <link><?php print $link; ?></link>
    <description><?php print htmlspecialchars(strip_tags(html_entity_decode($description))); ?>&lt;br/&gt;&lt;a href="<?php print $link?>"&gt;Lees meer&lt;/a&gt;</description>
    <?php print $item_elements; ?>
  </item>
