<?php

autoload_add_namespace(__DIR__ . '/src/', 'MicroweberPackages\\DynamicText\\');

event_bind('mw.front', function ($params) {
    if (!defined('MW_DYNAMIC_TEXT_SHOULD_REPLACE')) {
        define('MW_DYNAMIC_TEXT_SHOULD_REPLACE', 1);
    }
});

document_ready('exec_dynamic_text_replace_in_layout');
function exec_dynamic_text_replace_in_layout($layout)
{
    if (defined('MW_DYNAMIC_TEXT_SHOULD_REPLACE')) {
        if (!in_live_edit()) {
            $texts = \MicroweberPackages\DynamicText\Models\DynamicTextVariable::get()->toArray();
            if ($texts) {
                $replaces = array();
                $searches = array();
                foreach ($texts as $text) {
                    if (isset($text['name']) and $text['name']) {
                        $searches[] = '[' . $text['name'] . ']';
                        $replaces[] = $text['content'];
                    }

                    if (isset($text['name']) and $text['name']) {
                        $searches[] = '%5B' . $text['name'] . '%5D';
                        $replaces[] = $text['content'];
                    }
                }
                if ($searches) {
                    $layout = str_replace($searches, $replaces, $layout);
                    // nested replace
                    $layout = str_replace($searches, $replaces, $layout);
                    $layout = str_replace($searches, $replaces, $layout);
                    $layout = str_replace($searches, $replaces, $layout);
                    $layout = str_replace($searches, $replaces, $layout);
                    $layout = str_replace($searches, $replaces, $layout);
                    $layout = str_replace($searches, $replaces, $layout);
                    $layout = str_replace($searches, $replaces, $layout);
                    $layout = str_replace($searches, $replaces, $layout);
                    $layout = str_replace($searches, $replaces, $layout);
                    return $layout;
                }
            }
        }
    }
    return $layout;
}

event_bind('parser.process', function ($layout) {
    if (defined('MW_DYNAMIC_TEXT_SHOULD_REPLACE')) {

        $texts =  \MicroweberPackages\DynamicText\Models\DynamicTextVariable::get()->toArray();
        if ($texts) {
            $replaces = array();
            $searches = array();
            foreach ($texts as $text) {
                if (isset($text['name']) and $text['name']) {
                    $searches[] = '[' . $text['name'] . ']';
                    $replaces[] = $text['name'];
                }
            }
            if ($searches) {
                $layout = str_replace($searches, $replaces, $layout);
//dd($layout);
                return $layout;
            }
        }
    }
});


function save_dynamic_text($data)
{
    if (!is_admin()) {
        return;
    }

    if (isset($data['id']) && $data['id'] > 0) {
        $dynamicText = \MicroweberPackages\DynamicText\Models\DynamicTextVariable::whereId($data['id'])->first();
    } else {
        $dynamicText = new \MicroweberPackages\DynamicText\Models\DynamicTextVariable();
    }

    $dynamicText->fill($data);
    $dynamicText->save();

    return $dynamicText;
}
