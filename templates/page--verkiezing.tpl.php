<?php
/**
 *  page--verkiezing.tpl.php
 *  Special page for verkiezingen content type.
 */
include('inc/verkiezingen-preprocess.php');

if ($type == 'provincie') {
  $verkiezing = 'Provinciale Statenverkiezingen 2019';
  include('inc/verkiezingen-ps.php');
}
if ($type == 'afdeling') {
  $verkiezing = 'Gemeenteraadsverkiezingen 2020';
  include('inc/verkiezingen-gr.php');
}

?>
