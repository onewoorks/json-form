<?php echo $header; ?>


<div class="row">
    <div class="col-sm-12 text-center" style="height: 40px;">
        <i>< patient info ></i>
    </div>
</div>

<div class='row'>
    <div class='col-sm-9'>
        <form id='notesForm' class='form-horizontal'>
            <div class='panel panel-default'>
                <div class='panel-heading'><?php echo $form_title; ?></div>
                <div class='panel-body'>
                </div>

                <?php foreach ($doc_components->form_components->sections as $key => $sections): ?>
                    <div class='panel-heading panel-parent' data-section='<?php echo $key; ?>'><?php echo $sections->label_name; ?></div>
                    <div class='panel-body' data-section='<?php echo $key; ?>'>
                        <?php foreach ($sections->attributes as $attribute): ?>
                            <?php if ($attribute->field_type == 'text'): ?>
                                <div class='form-group form-group-sm'>
                                    <label class='control-label col-sm-3'><?php echo $attribute->label_name; ?></label>
                                    <div class='col-sm-9'>
                                        <input type='text' class='form-control' name='<?php echo $key; ?>' value='<?php echo $attribute->value; ?>'/>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if ($attribute->field_type == 'textarea'): ?>
                                <div class='form-group form-group-sm'>
                                    <label class='control-label col-sm-3'><?php echo $attribute->label_name; ?></label>
                                    <div class='col-sm-9'>
                                        <?php $vals = ''; ?>
                                        <?php if (is_array($attribute->value)): ?>
                                            <?php foreach ($attribute->value as $k => $newline): ?>
                                                <?php $vals .= trim($newline) . PHP_EOL; ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        <textarea style='height: 130px;' class='form-control text-left'><?php echo $vals; ?></textarea>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if ($attribute->field_type == 'method'): ?>
                                <div class='form-group form-group-sm'>
                                    <label class='control-label col-sm-3'><?php echo $attribute->label_name; ?></label>
                                    <div class='col-sm-9'>
                                        <p class="form-control-static">
                                            <small><i>this area will be constructed based on method name = "<?php echo ($attribute->method_name) ? $attribute->method_name : 'undefined'; ?>"</i></small>
                                        </p>
                                    </div>
                                </div>
                            <?php endif; ?>

                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </form>
    </div>
    <div class='col-sm-3' style="position: fixed; right: 0;">
        <div class='panel panel-default'>
            <div class='panel-heading'>Note Components</div>
            <div class='panel-body'>
                <ul class='list-unstyled'>
                    <?php foreach ($doc_components->form_components->sections as $key => $sections): ?>
                        <li><input type='checkbox' class='selectedsection' value='<?php echo $key; ?>' checked /> <?php echo $sections->label_name; ?></li>
                        <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {
        $('.selectedsection').change(function () {
            var section = $(this).val();
            $('#notesForm').find("[data-section='" + section + "']").fadeToggle("fast", "linear");
        });
    });
</script>
<?php echo $footer; ?>

