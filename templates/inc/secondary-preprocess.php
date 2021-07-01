<?php
/*
 * The spsocialmedia custom module provides afdelingen a block to set their social media pages.
 * The block can than be set to a specific region.
 * This snippet reuses those custom block settings to regenerate a markup string used for the secondary region.
 */

$secondary_string = '';
// check if value is present and set as variable for markup
if (!empty(variable_get('spsocialmedia_facebook'))){
  $secondary_facebook = l('f',variable_get('spsocialmedia_facebook'), array('attributes' => array('class' => array('btn icon'), 'target' => '_blank')));
  $secondary_string .= $secondary_facebook;
}
if (!empty(variable_get('spsocialmedia_twitter'))){
  $secondary_twitter = l('t',variable_get('spsocialmedia_twitter'), array('attributes' => array('class' => array('btn icon'), 'target' => '_blank')));
  $secondary_string .= $secondary_twitter;
}
/* missing icon font for linkedin, for now disabled
if (!empty(variable_get('spsocialmedia_linkedin'))){
  $secondary_linkedin = l('',variable_get('spsocialmedia_linkedin'), array('attributes' => array('class' => array('btn icon'), 'target' => '_blank')));
  $secondary_string .= $secondary_linkedin;
}
*/
if (!empty(variable_get('spsocialmedia_youtube'))){
  $secondary_youtube = l('y',variable_get('spsocialmedia_youtube'), array('attributes' => array('class' => array('btn icon'), 'target' => '_blank')));
  $secondary_string .= $secondary_youtube;
}
if (!empty(variable_get('spsocialmedia_instagram'))){
  $secondary_instagram = l('i',variable_get('spsocialmedia_instagram'), array('attributes' => array('class' => array('btn icon'), 'target' => '_blank')));
  $secondary_string .= $secondary_instagram;
}
?>