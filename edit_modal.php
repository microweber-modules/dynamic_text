<?php only_admin_access(); ?>

<script>
    $(document).ready(function () {
        $("#save-dynamic-text-form").submit(function (event) {

            var data = $(this).serialize();
            var url = "<?php print api_url('save_dynamic_text'); ?>";
            var post = $.post(url, data);
            post.done(function (data) {
                mw.reload_module_everywhere('dynamic_text/select')
                mw.reload_module_everywhere('dynamic_text/list')
                mw.reload_module_everywhere('dynamic_text')
                $('.js-toggle-form').toggle();
                mw.notification.success("<?php _ejs("All changes are saved"); ?>.");

            });
            event.preventDefault();
        });
    });

    function edit_dynamic_text(id) {

        $('.js-dynamic-text-id').val(id);
        $('#save-dynamic-text-form').show();
        $('#save-dynamic-text-form-add-btn').hide();
        $.get("<?php print api_url('get_dynamic_text'); ?>", {single: 1, id: id})
            .done(function (data) {
                $('.js-dynamic-text-name').val(data.name);
                $('.js-dynamic-text-content').html(data.content);

            });

    }
</script>

<script>
    mw.lib.require('jqueryui');
    mw.require("<?php print $config['url_to_module'];?>css/main.css");
</script>

<form id="save-dynamic-text-form" class="form-group">

    <div class="col-12">
        <label class="control-label"><?php _e("Dynamic text"); ?></label>
        <small class="text-muted d-block mb-3"><?php _e("Add new dynamic text then drop it in live edit."); ?></small>
    </div>

    <div class="col-12">
        <label><?php _e("Variable key"); ?>:</label>
        <small class="text-muted d-block mb-3"><?php _e("Example: 'my-cool-name'"); ?></small>

        <?php
        $model = new \MicroweberPackages\DynamicText\Models\DynamicTextVariable();
        $formBuilder = App::make(\MicroweberPackages\Form\FormElementBuilder::class);
        ?>

        <?php echo $formBuilder->text('name')->setModel($model)->value(''); ?>

        <br>
        <label><?php _e("Variable value"); ?>:</label>
        <small class="text-muted d-block mb-3"><?php _e("Type your dynamic text content in the text area below"); ?></small>

        <?php echo $formBuilder->textarea('content')->setModel($model)->value(''); ?>

        <br/>
        <br/>
        <input type="hidden" value="0" name="id" class="js-dynamic-text-id"/>
        <button type="submit" name="submit" class="btn btn-primary"><?php _e("Save"); ?></button>
    </div>
</form>
