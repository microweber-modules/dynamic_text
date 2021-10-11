<?php
$selectedText = get_option('selected_text_name', $params['id']);
if ($selectedText) {
    $params['name'] = $selectedText;
}

if (isset($params['name']) && !empty($params['name'])) {

    $dynamicTextFind = \MicroweberPackages\DynamicText\Models\DynamicTextVariable::whereName($params['name'])->first();

    if ($dynamicTextFind != null) {
        echo $dynamicTextFind->content;
    } else {
        $save = array();

        if (isset ($params['content'])) {
            $save['content'] = $params['content'];
        }

        $save['name'] = $params['name'];

        if (isset($dynamicTextFind['content'])) {
            $save['content'] = $params['content'];
        }

        save_dynamic_text($save);

        if (isset ($save['content'])) {
            echo $save['content'];
        }
    }
} else {
    print lnotif('Click here to edit dynamic text');
}
