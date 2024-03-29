<?php
$config = array();
$config['name'] = "Dynamic Text";
$config['author'] = "Microweber";
$config['no_cache'] = false;
$config['ui'] = true;
$config['ui_admin'] = true;
$config['categories'] = "content,text";
$config['version'] = "0.6";
$config['position'] = 900;
$config['settings'] = array('html_tag' => 'span');

$config['settings']['service_provider'] = [
    \MicroweberPackages\DynamicText\DynamicTextServiceProvider::class
];

$config['tables'] = array(
    'dynamic_text_variables' => array(
        'id' => 'integer',
        'name' => 'text',
        'content' => 'text',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    )
);
