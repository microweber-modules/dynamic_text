<?php only_admin_access(); ?>

<script>
    $(document).ready(function () {

        $('.selectpicker').selectpicker('refresh');

        $("#save-dynamic-text-form").submit(function (event) {

            var data = $(this).serialize();
            var url = "<?php print api_url('save_dynamic_text'); ?>";
            var post = $.post(url, data);
            post.done(function (data) {

                if (data.errors) {
                    mw.notification.error(data.errors.name[0]);
                } else {

                    mw.reload_module_everywhere('dynamic_text/select')
                    mw.reload_module_everywhere('dynamic_text/list')
                    mw.reload_module_everywhere('dynamic_text')
                    $('.js-toggle-form').toggle();
                    mw.notification.success("<?php _ejs("All changes are saved"); ?>.");
                }

            });
            event.preventDefault();
        });

    });
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
        if (isset($params['id']) && $params['id'] > 0) {
            $model = \MicroweberPackages\DynamicText\Models\DynamicTextVariable::whereId($params['id'])->first();
        } else {
            $model = new \MicroweberPackages\DynamicText\Models\DynamicTextVariable();
        }

        $formBuilder = App::make(\MicroweberPackages\Form\FormElementBuilder::class);
        ?>

        <input type="text" class="form-control" name="name" value="<?php echo $model->name; ?>">

        <br>
        <label><?php _e("Variable value"); ?>:</label>
        <small class="text-muted d-block mb-3"><?php _e("Type your dynamic text content in the text area below"); ?></small>

        <?php echo $formBuilder->textarea('content')->setModel($model)->value($model->content); ?>

        <br/>
        <br/>
        <input type="hidden" value="<?php echo $params['id'];?>" name="id" />
        <button type="submit" name="submit" class="btn btn-primary"><?php _e("Save"); ?></button>
    </div>
</form>
