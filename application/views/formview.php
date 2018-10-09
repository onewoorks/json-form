<?php echo $header; ?>
<form class='form-horizontal'>
    <div class='panel panel-default'>
        <div class='panel-heading'><i>Panel Form Title</i></div>
        <div class='panel-body'>
            <?php foreach ($form_element as $element): ?>
                <?php if ($element['element']['field_type'] == 'text'): ?>
                    <div class='form-group form-group-sm'>
                        <label class='control-label col-sm-3'><?php echo $element['element']['label']; ?></label>
                        <div class='col-sm-9'>
                            <input type='<?php echo $element['element']['field_type']; ?>' class='form-control'/>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ($element['element']['field_type'] == 'dropdown'): ?>
                    <div class='form-group form-group-sm'>
                        <label class='control-label col-sm-3'><?php echo $element['element']['label']; ?></label>
                        <div class='col-sm-9'>
                            <select class='form-control'>
                                <option>1</option>
                                <option>2</option>
                            </select>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ($element['element']['field_type'] == 'calendar'): ?>
                    <div class='form-group form-group-sm'>
                        <label class='control-label col-sm-3'><?php echo $element['element']['label']; ?></label>
                        <div class='col-sm-9'>
                            <div class='input-group'>
                                <input type='text' class='form-control' />
                                <span class='input-group-addon'><i class='glyphicon glyphicon-calendar'></i></span>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ($element['element']['field_type'] == 'richtext'): ?>
                    <div class='form-group form-group-sm'>
                        <label class='control-label col-sm-3'><?php echo $element['element']['label']; ?></label>
                        <div class='col-sm-9' >
                            <div class='summernote'>
                            
                            </div>
                            <textarea class="hidden" name="<?php echo $element['element']['identifier']; ?>"></textarea>
                        </div>
                    </div>
                <?php endif; ?>


            <?php endforeach; ?>
        </div>
    </div>
</div>


<div id='formJson' style='white-space: pre;'></div>
<script src='assets/js/bootstrap-wysiwyg.js'></script>
<script src='assets/js/json-parse.js'></script>
<script>
    $(function () {
        $('.summernote').summernote({
            height: 150
        });

        var json_parse = JSON.parse('<?php echo $json_form; ?>');
        $('#formJson').text(JSON.stringify(json_parse, null, 4));
    });
</script>
<?php echo $footer; 