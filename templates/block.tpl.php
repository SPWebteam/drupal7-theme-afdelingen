<?php
/**
 *  block.tpl.php - beta 1.0
 */
?>

<div id="<?php print $block_html_id; ?>" class="<?php print $classes; ?>"<?php print $attributes; ?>>
	<?php if ($block->subject): ?><h2 class="title"><?php print $block->subject ?></h2><?php endif;?>
	<div class="content"><?php print $content ?></div>
</div>
