<?php only_admin_access(); ?>

<?php
$from_live_edit = false;
if (isset($params["live_edit"]) and $params["live_edit"]) {
    $from_live_edit = $params["live_edit"];
}
?>

<?php if (isset($params['backend'])): ?>
    <module type="admin/modules/info"/>
<?php endif; ?>

<div class="card style-1 mb-3 <?php if ($from_live_edit): ?>card-in-live-edit<?php endif; ?>">
    <div class="card-header">
        <?php $module_info = module_info($params['module']); ?>
        <h5>
            <?php if (isset ($module_info['icon']) && $module_info['icon']) { ?>
                <strong><?php _e($module_info['name']); ?></strong>
            <?php }

            if (isset($module_info['name']) && $module_info['name']) { ?>
                <img src="<?php echo $module_info['icon']; ?>"class="module-icon-svg-fill"/>
            <?php } ?>
        </h5>
    </div>
    <div class="card-body pt-3">
        <nav class="nav nav-pills nav-justified btn-group btn-group-toggle btn-hover-style-3">
            <a class="btn btn-outline-secondary justify-content-center active" data-toggle="tab" href="#list"><i class="mdi mdi-format-list-bulleted-square mr-1"></i> <?php _e('List'); ?></a>
            <?php if ($from_live_edit) : ?>
                <a class="btn btn-outline-secondary justify-content-center" data-toggle="tab" href="#templates"><i class="mdi mdi-pencil-ruler mr-1"></i> <?php _e('Templates'); ?></a>
            <?php endif; ?>
        </nav>
        <div class="tab-content py-3">
            <div class="tab-pane fade show active" id="list">

                <?php if ($from_live_edit) : ?>
                <module type="dynamic_text/dropdown_select" />
                <?php endif; ?>

                <module type="dynamic_text/list" />
            </div>
            <?php if ($from_live_edit) : ?>
                <div class="tab-pane fade" id="templates">
                    <module type="admin/modules/templates"/>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
