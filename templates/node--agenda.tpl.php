<?php
/**
 *  node--agenda.tpl.php - beta 1.0
 *  See: http://api.drupal.org/api/drupal/modules--node--node.tpl.php/7
 */
 
?>

<div id="agenda-<?php print $node->nid; ?>" class="<?php print $classes; ?>"<?php print $attributes; ?>>
	
	<?php print render($title_prefix); ?>
		<?php if (!$page): ?>
			<h2 class="title"><a href="<?php print $node_url; ?>"><?php print $title;  ?></a></h2>
		<?php endif; ?>  
	<?php print render($title_suffix); ?>	
	
		<div class="node-content clearfix"<?php print $content_attributes; ?>> 
			<?php 
			
			hide ($content['comments']);
			hide ($content['sp_share']);
			
			print render($content['field_afbeelding']);
			print render($content); 
			
			?>   
		
		</div>
		<?php print render($content['comments']); ?>
</div>
