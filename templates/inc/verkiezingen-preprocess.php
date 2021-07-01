<?php

  /**
   * Check afdeling type and set/load custom specific styling/settings/js
   */

  $theme_path = drupal_get_path('theme',$GLOBALS['theme']);
  $type = theme_get_setting('afdelingen_type');
  if ($type == 'provincie') {
    drupal_add_js($theme_path  . '/js/ps2019.js');
    drupal_add_css($theme_path  . '/css/pages/ps2019.css');
  }
  if ($type == 'afdeling') {
    drupal_add_js($theme_path  . '/js/gr2018.js');
    drupal_add_css($theme_path  . '/css/pages/gr2018.css');
  }
  drupal_add_js($theme_path  . '/js/fontfaceobserver.min.js');
  drupal_add_js($theme_path  . '/js/lazyload.min.js');
  

  // Set needed variables.
  $wrapper = entity_metadata_wrapper('node', $node);
  $verkiezingsdossier_tid = !empty($wrapper->field_verk_nieuws_dossier->value()->tid) ? $wrapper->field_verk_nieuws_dossier->value()->tid : '';
  $verk_dossier_path = !empty($verkiezingsdossier_tid) ? url('taxonomy/term/' . $verkiezingsdossier_tid) : NULL;
  $programma_id = !empty($wrapper->field_verkiezingsprogramma->value()->nid) ? $wrapper->field_verkiezingsprogramma->value()->nid : '';
  $slogan = !empty($wrapper->field_verk_slogan->value()) ? check_plain($wrapper->field_verk_slogan->value()) : '';

  // Optional tabs
  // Standpunten
  $standpunten = views_get_view('verkiezingsstandpunten');
  $standpunten->init_display();
  $standpunten->pre_execute();
  $standpunten->execute();
  if (!empty($standpunten->result[0]->_field_data)) $standpunt_found = TRUE;
  // Nieuws
  $nieuws_titles = views_get_view('verkiezingsnieuws');
  $nieuws_titles->set_display('attachment_1');
  $nieuws_titles->set_arguments(array($verkiezingsdossier_tid));
  $nieuws_titles->pre_execute();
  $nieuws_titles->execute();
  if (!empty($nieuws_titles->result[0]->nid)) $nieuws_found = TRUE;
  $nieuws_messages = views_get_view('verkiezingsnieuws');
  $nieuws_messages->set_display('attachment_2');
  $nieuws_messages->set_arguments(array($verkiezingsdossier_tid));
  $nieuws_messages->pre_execute();
  $nieuws_messages->execute();
  // Agenda
  $agenda = views_get_view('verkiezingsagenda');
  $agenda->init_display();
  $agenda->pre_execute();
  $agenda->execute();
  if (!empty($agenda->result[0]->_field_data)) $agendaitem = TRUE;

  // Get link to afdelingen site
  if ($is_front) {
    $linkto = '/nieuws';
  }
  else {
    $linkto = $front_page;
  }
  global $base_url;
