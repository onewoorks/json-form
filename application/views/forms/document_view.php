<?= $header; ?>
<div class='row'>
    <div class='col-md-9'>
        <div class='panel panel-default' >
            <div class='panel-heading'><?= $document_title; ?></div>
            <div class='panel-body'>
                <form class='form-horizontal '>
                    <?= MethodCaller('Common_Form', 'SeenDiscussedRecord'); ?>
                    <div class='hidden'>
                        <br>
                        <?= MethodCaller('Common_Form', 'Orders'); ?>
                        <br>
                        <?= MethodCaller('Common_Form', 'VitalSign'); ?>
                    </div>
                </form>
            </div>
        </div>
        <form id='notesForm' class='form-horizontal'>
            <div class='panel panel-default'>
                <?php foreach ($json_elements as $key => $section): ?>
                    <div class='panel-heading' data-section='<?= $key; ?>'><?= $section->section_desc; ?></div>
                    <div class='panel-body' data-section='<?= $key; ?>'>
                        <?php foreach ($section->elements as $elem => $element): ?>
                            <div style='color:grey; font-size: 0.7em' class='hidden'><i><?= $element->input_type . ' | ' . $element->element_code; ?></i></div>
                            <?= InputTypeCaller($element, $element->json_element, $document_title, $document_id); ?>

                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </form>
    </div>

    <div class='col-sm-3' style="position: fixed; right: 0;">
        <div class='panel panel-default'>
            <div class='panel-heading'>Notes Component</div>
            <div class='panel-body'>
                <ul class='list-unstyled'>
                    <?php foreach ($json_elements as $key => $section): ?>
                        <li><input type='checkbox' class='selectedsection'  name='<?= $key; ?>' value='<?= $key; ?>' checked /> <?= $section->section_desc; ?></li>
                    <?php endforeach; ?>
                </ul>

                <div class='text-right'>
                    <div class='btn-group btn-group-sm'>
                        <a href='<?= SITE_ROOT; ?>/formview/edit-form/<?= $document_id; ?>' class='btn btn-default'>Edit Form</a>
                        <a href='<?= SITE_ROOT; ?>/formview/json-format/<?= $document_id; ?>' target="_blank" class='btn btn-default'>View JSON</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body">
            </div>
        </div>

    </div>
</div>

<script src='<?= SITE_ROOT; ?>/assets/library/datepicker/js/bootstrap-datepicker.js'></script>
<script>
                                function HideAndShowOtherSpecify(object) {
                                    var $selected = $(object).val();
                                    if ($selected.toLowerCase() == 'others, specify') {
                                        var $name = 'other_specify_' + $(object).attr('name');
                                        $("[name='" + $name + "']").show();
                                        if ($(object).is(':checked')) {
                                            $("[name='" + $name + "']").removeClass('hidden');
                                        } else {
                                            $("[name='" + $name + "']").addClass('hidden');
                                        }
                                    }
                                }
                                
</script>
<script>
    $(function () {
        $('.summernote').summernote({
            height: 100
        });
        $('.selectedsection').change(function () {
            var section = $(this).val();
            $('#notesForm').find("[data-section='" + section + "']").fadeToggle("fast", "linear");
        });

        $('.datepicker').datepicker({
            'format': 'dd/mm/yyyy'
        });
        $("input[name^=other_specify_]").hide();

        $('input[type="checkbox"]').change(function () {
            HideAndShowOtherSpecify(this);
            var $parentcode = $(this).data('parentcode');
            console.log($parentcode);
            if ($(this).is(':checked')) {
                $('.multicheckbox_' + $parentcode).removeClass('hidden');
                $('textarea[data-parentcode="'+$parentcode+'"]').removeAttr('disabled');
            } else {
                $('.multicheckbox_' + $parentcode).addClass('hidden');
                $('textarea[data-parentcode="'+$parentcode+'"]').attr('disabled','disabled');
            }
        });

    });
</script>

<?= $footer; ?>