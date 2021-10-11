<?php
$selected_dynamic_text_name = get_option('selected_text_name', $params['id']);
if ($selected_dynamic_text_name) {
    $params['name'] = $selected_dynamic_text_name;
}

if (isset($params['name']) && !empty($params['name'])) {

    $dynamic_text = \MicroweberPackages\DynamicText\Models\DynamicTextVariable::whereName($params['name'])->first();

    if ($dynamic_text != null) {
        echo $dynamic_text->content;
    } else {
        $save = array();
        if (isset ($params['content'])) {
            $save['content'] = $params['content'];
        }
        $save['name'] = $params['name'];
        if (isset($dynamic_text['content'])) {
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
