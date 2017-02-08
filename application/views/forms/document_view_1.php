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

                            <?= InputTypeCaller($element, $element->json_element, $document_title); ?>

                            <?php
//                            if (strtolower($element->input_type) == 'method'):
//                                if (isset($element->additional_attribute->method)):
//                                    echo MethodCaller($element->additional_attribute->method->page, $element->method);
//                                else:
//                                    echo MethodCaller('Obstetrics_Clerking_Notes', $element->method);
//                                endif;
//                            endif;
                            ?>
                            <?php if (strtolower($element->input_type) == 'multiple answer remove'): ?>
                                <div id='<?= $element->json_element; ?>' class='form-group form-group-sm'>
                                    <label class='control-label col-md-3 hidden'><?= $element->element_desc; ?></label>

                                    <?php $referal = ReferenceCaller($element->element_code); ?>
                                    <?php if (strtolower($referal->type) == 'dropdown-remove'): ?>
                                        <div class='col-md-3'>
                                            <select name='<?= $elem; ?>' class='<?= $element->json_element; ?> form-control'>
                                                <option value='0' >Please Select</option>
                                                <?php foreach ($referal->data as $ref): ?>
                                                    <option><?= $ref['multi_answer_desc']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class='col-md-6 other_<?= $element->json_element; ?> hidden'>
                                            <input type='text' name='other_<?= $element->json_element; ?>' 
                                                   class='form-control'/>
                                        </div>
                                        <script>
                                            $(function () {
                                                var $class = '<?= $element->json_element; ?>';
                                                $('.' + $class).change(function () {
                                                    if ($(this).val().toLowerCase() == 'others, specify') {
                                                        $('.other_' + $class).removeClass('hidden');
                                                    } else {
                                                        $('.other_' + $class).addClass('hidden');
                                                    }
                                                });
                                            });
                                        </script>
                                    <?php endif; ?>

                                    <?php if (strtolower($referal->type) == 'checkbox-remove'): ?>
                                        <div class='col-md-9'>
                                            <?php if ($element->additional_attribute): ?>
                                                <?php if ($element->additional_attribute->styling->mode == 'column'): ?>
                                                    <div id='<?= $element->json_element; ?>' class='row'>
                                                        <?php
                                                        $noOfColumn = 12 / $element->additional_attribute->styling->number_of_column;
                                                        $listOfOption = $referal->data;
                                                        $perColumn = ceil(count($listOfOption) / $element->additional_attribute->styling->number_of_column);
                                                        $listNo = 1;
                                                        for ($i = 1; $i <= $element->additional_attribute->styling->number_of_column; $i++):
                                                            ?>
                                                            <div class="<?= 'col-sm-' . $noOfColumn; ?>">
                                                                <?php while ($listNo <= $perColumn * $i and $listNo <= count($listOfOption)): ?>
                                                                    <div class='checkbox'>
                                                                        <label>
                                                                            <input type='checkbox' 
                                                                                   class='<?= $element->json_element; ?>'
                                                                                   data-parentname='<?= $element->json_element; ?>'
                                                                                   data-optionname='<?= $listOfOption[($listNo - 1)]['multi_answer_desc']; ?>'
                                                                                   value='<?= $listOfOption[($listNo - 1)]['multi_answer_desc']; ?>'
                                                                                   /> <?= $listOfOption[($listNo - 1)]['multi_answer_desc']; ?>
                                                                        </label>
                                                                    </div>
                                                                    <?php $listNo++; ?>
                                                                <?php endwhile; ?>
                                                            </div>
                                                        <?php endfor; ?>
                                                        <script>
                                                            $(function () {
                                                                var $class = '<?= $element->json_element; ?>';
                                                                $('.' + $class).change(function () {
                                                                    if ($(this).val().toLowerCase() == 'others, specify') {
                                                                        if ($(this).is(':checked')) {
                                                                            $('.other_' + $class).removeClass('hidden');
                                                                        } else {
                                                                            $('.other_' + $class).addClass('hidden');
                                                                        }
                                                                    }
                                                                });
                                                            });
                                                        </script>
                                                    </div>
                                                <?php endif; ?>

                                            <?php else: ?>
                                                <?php foreach ($referal->data as $ref): ?>
                                                    <div class='checkbox'>
                                                        <label>
                                                            <input type='checkbox' name='<?= $element->json_element; ?>'
                                                                   class='<?= $element->json_element; ?>'
                                                                   value='<?= $ref['multi_answer_desc']; ?>'/> <?= $ref['multi_answer_desc']; ?>
                                                        </label>
                                                    </div>
                                                    <?php if ($ref['parent_element_code']): ?>
                                                        <?php $childs = ReferenceCaller($ref['parent_element_code'], 'child'); ?>
                                                        <?php if (strtolower($childs->type) == 'freetext'): ?>
                                                            <textarea class='form-control' style='height: 100px;'></textarea>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                    <?php if ($ref['method']): ?>
                                                        <?php $method = json_decode($ref['method']); ?>
                                                        <?php $logicRef = ReferenceCaller($method->logic->element_to_trigger, 'child'); ?>
                                                        <div style='margin-left:40px;' 
                                                             class="<?= ($method->logic->default == 'hide') ? 'hidden' : ''; ?>"
                                                             data-multiplesection='<?= $ref['multi_answer_desc']; ?>'>
                                                                 <?php if (strtolower($method->logic->input_type) == 'multiple answer'): ?>
                                                                     <?php foreach ($logicRef->data as $lref): ?>
                                                                    <div class='<?= strtolower($logicRef->type); ?>'>
                                                                        <input type='<?= strtolower($logicRef->type); ?>' /> <?= $lref['multi_answer_desc']; ?>
                                                                    </div>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
                                                        </div>
                                                    <?php endif; ?>

                                                <?php endforeach; ?>
                                                <script>
                                                    $(function () {
                                                        var $class = '<?= $element->json_element; ?>';
                                                        $('.' + $class).change(function () {
                                                            var $multipleValue = $(this).val();
                                                            if ($(this).is(':checked')) {
                                                                $('#' + $class + ' [data-multiplesection="' + $multipleValue + '"]').removeClass('hidden');
                                                            } else {
                                                                $('#' + $class + ' [data-multiplesection="' + $multipleValue + '"]').addClass('hidden');
                                                            }

                                                        });
                                                    });
                                                </script>
                                            <?php endif; ?>

                                            <br>
                                            <div class='row other_<?= $element->json_element; ?> hidden'>
                                                <div class='form-group form-group-sm'>
                                                    <label class='control-label col-sm-2'>Please Specify</label>
                                                    <div class='col-sm-6'>
                                                        <input type='text' class='form-control' />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (strtolower($referal->type) == 'radio button remove'): ?>
                                        <div class='col-md-9'>

                                            <?php if ($element->additional_attribute): ?>
                                                <?php if ($element->additional_attribute->styling->mode == 'inline'): ?>
                                                    <?php foreach ($referal->data as $ref): ?>
                                                        <label class='radio-inline'>
                                                            <input type='radio' /> <?= $ref['multi_answer_desc']; ?>
                                                        </label>
                                                    <?php endforeach; ?>

                                                <?php endif; ?>
                                            <?php else: ?>

                                                <?php foreach ($referal->data as $ref): ?>
                                                    <div class='radio'>
                                                        <label>
                                                            <input type='radio' /> <?= $ref['multi_answer_desc']; ?>
                                                        </label>
                                                    </div>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (strtolower($referal->type) == 'textbox-remove'): ?>
                                        <?php foreach ($referal->data as $ref): ?>
                                            <div class='col-sm-2'>
                                                <div class='input-group'>
                                                    <input type='text' class='form-control input-sm' />
                                                    <span class='input-group-addon'> <?= $ref['multi_answer_desc']; ?></span>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>

                                    <?php if (strtolower($referal->type) == 'list-remove'): ?>
                                        <div class='col-sm-9'>
                                            <?php foreach ($referal->data as $ref): ?>
                                                <div class='form-group form-group-sm'>
                                                    <label class='control-label col-sm-3' style='font-weight: normal;'><?= $ref['multi_answer_desc']; ?></label>

                                                    <?php if (strtolower($ref['input_type']) == 'list'): ?>
                                                        <div class='col-sm-4'>
                                                            <?php if ($ref['parent_element_code']): ?>
                                                                <?php $childs = ReferenceCaller($ref['parent_element_code'], 'child'); ?>
                                                                <?php if (strtolower($childs->type) == 'dropdown'): ?>                                                                
                                                                    <select class='form-control' >
                                                                        <option value='0'>Please Select</option>
                                                                        <?php foreach ($childs->data as $child): ?>
                                                                            <option value=''><?= $child['multi_answer_desc']; ?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                <?php endif; ?>

                                                            <?php endif; ?>
                                                        </div>
                                                    <?php endif; ?>

                                                    <?php if (strtolower($ref['input_type']) == 'textbox'): ?>
                                                        <div class='col-sm-3'>
                                                            <input type='text' class='form-control' />
                                                        </div>
                                                    <?php endif; ?>

                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (strtolower($referal->type) == 'textbox'): ?>
                                        <div class='col-sm-9'>

                                        </div>
                                    <?php endif; ?>
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