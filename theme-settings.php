<?php // Theme settings

function afdelingen3_form_system_theme_settings_alter(&$form, &$form_state) {

  $form['afdeling'] = array(
    '#type' => 'fieldset',
    '#title' => t('Afdeling'),
    '#weight' => 5,
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
    '#description' => t('Als je een speciale afdeling bent, geef dat dan hier aan.'),
  );

  $form['afdeling']['afdelingen_type'] = array(
    '#type' => 'select',
    '#title' => t('Type afdeling'),
    '#default_value' => theme_get_setting('afdelingen_type'),
    '#options' => array(
      'afdeling'  => t('Afdeling'),
      'werkgroep' => t('Werkgroep'),
      'rood-jong' => t('ROOD'),
      'international' => t('International'),
      'provincie' => t('Provincie'),
    ),
  );
}
