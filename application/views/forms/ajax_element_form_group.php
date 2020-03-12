<form id='editElement' class='form-horizontal'>
    <input type='hidden' name='element_code' value='<?= $values->element_code; ?>' />
    <input type='hidden' name='document_id' value='<?= $document_id; ?>' />
    <input type='hidden' name='template_id' value='<?= $template_id; ?>' />    
    <input type='hidden' name='json_element' value='<?= $values->json_element; ?>' /> 
    <input type='hidden' name='element_desc' value='<?= $values->element_desc; ?>' />
    <input type='hidden' name='input_type' value='<?= $values->input_type; ?>' />
    <input type='hidden' name='additional_attribute' value='<?= $values->additional_attribute; ?>' />
    <input type='hidden' name='method' value='<?= $values->method; ?>' />
    <input type='hidden' name='data_type' value='<?= $values->data_type; ?>' />
    <input type='hidden' name='method_code' value='<?= $values->doc_method_code; ?>' />
    <input type='hidden' name='section_code' value='<?= $values->section_code; ?>' />

<!--    <div class='panel panel-default' style="margin-right: 13px">
        <div class='panel-heading'>Properties</div>
        <div class='panel-body'>-->
            <div class='form-group form-group-sm'>
                <label class='control-label col-sm-2'>Element Description</label>
                <div class='col-sm-8'>
                    <input name="element_desc" id="element_desc" type="text" class="form-control elemList" list="elemList" value="<?= $values->element_desc; ?>"/>
                    <datalist id="elemList">
                        <?php foreach ($elements as $element): ?>
                            <option value="<?php echo $element['element_desc']; ?>" data-id="<?php echo $element['element_code']; ?>"><?php echo $element['element_code']; ?></option>
                        <?php endforeach; ?>
                    </datalist>
                </div>
            </div>
            <div class="form-group form-group-sm">
                <label class="control-label col-sm-2">Element Group</label>
                <div class="col-sm-8">                      
                    <select name='element_group' class='form-control'>
                        <?php foreach ($grouping as $group):
                            if($group['element_code']=== $values->element_code ){
                                    echo "<option value='".$group['element_code']."'>No group</option>"; 
                                 }elseif($group['element_code']=== $values->child_element_code){
                                    echo "<option value='".$group['element_code']."'>".$group['element_desc']."</option>";
                                    echo "<option value='".$values->element_code."'>No group</option>";
                                }
                                elseif($group['element_desc']=== '' ){
                                    echo "<option value='".$group['element_code']."'>No group</option>"; 
                                 }
                        endforeach;
                        foreach ($grouping as $group):
                                  if($group['element_code']=== $values->child_element_code ){
                                 }else{
                                ?>
                                <option value='<?php echo $group['element_code']; ?>'><?php echo $group['element_desc']; ?></option>
        <?php } endforeach; ?> 
                    </select>
                </div>
            </div>
 <div class='form-group form-group-sm'>
                <label class='control-label col-sm-2'>Element Level</label>
                <div class='col-sm-8'>
                    <input type='number' name='element_level' id='element_level' class='form-control' style="width:8%" value="<?= $values->element_level; ?>" autocomplete="off"/>
                </div>
            </div>
            <div class="form-group form-group-sm">
                <label class="control-label col-sm-2">Position</label>
                <div class="col-sm-8">
                    <label class="radio-inline">
                            <input name="position" type="radio" value="L" <?php if($values->element_position==='L'){echo 'checked';} ?>> Left
                    </label>
                    <label class="radio-inline">
                            <input name="position" type="radio" value="R" <?php if($values->element_position==='R'){echo 'checked';} ?> > Right
                    </label>
                </div>
            </div>
            <div class='form-group form-group-sm'>
                <label class='control-label col-sm-2'>Element Properties</label>
                <div class='col-sm-8'>
                    <label class='radio-inline'>
                        <input type='radio' name='element_properties' value='DECORATION' <?php if($values->element_properties==='DECORATION'){echo 'checked';} ?>  /> Decoration
                    </label>
                    <label class='radio-inline'>
                        <input type='radio' name='element_properties' value='BASIC'<?php if($values->element_properties==='BASIC'){echo 'checked';} ?>/> Basic
                    </label>
                        <label class='radio-inline'>
                            <input type='radio' name='element_properties' value='SUBSECTION'<?php if($values->element_properties==='SUBSECTION'){echo 'checked';} ?>/> Subsection
                        </label>
                </div>
                <div id='formelement'></div>
<!--            </div>   
        </div>
    </div>-->

    <div class='form-group form-group-sm'  style="margin-right: 0px">
        <label class='control-label col-sm-3'></label>
        <div class='col-sm-12 text-right'>
            <button type='submit' class='btn btn-sm btn-primary'>Update</button>
        </div>
    </div>       
</form>

<script>
    //DISPLAY PROPERTY'S DETAIL   
    $(function () {
        var formType = $('input[name=element_properties]:checked').val();
        ElementBuilder(formType);
        $('[name=form_element').val(formType);
        $('[name=element_properties]').on('change', function () {
            var selector = $(this).val();
            console.log("this is selector selector",selector);
            $('#' + selector).show();
            $('[name=form_element').val(selector);
            ElementBuilder(selector);
        });
    });

    //BAWA KE PAGE->BASIC
    function ElementBuilder(formType) {
        var formValue = $('#editElement').serializeArray();
        console.log('FORMTYPE:', formType);
        console.log('ajax_element_form_group: FORMVALUE=', formValue);
        $.ajax({
             url: '<?PHP echo SITE_ROOT; ?>/formbuilder/formelement/',
            data: {value: formType, params: formValue}, //bawa value satu form page ni
            success: function (data) {
                $('#formelement').html(data);
            }
        });
    };

    //UPDATE_ELEMENT
    $(function () {
        $('#editElement').submit(function (e) {
            e.preventDefault();
            var test = $(this).serializeArray();
            var new_desc = $('#element_desc').val();
            var elemDesc = $('#elemList [value="' + new_desc + '"]').data('id');
            test.push({name: 'new_element', value: '' + elemDesc + ''});

            var datas = JSON.stringify(test);
            var method = JSON.stringify($('#basicMethod').serializeArray());
            var multAns = JSON.stringify($('#basicMultAns').serializeArray());
            var subSec = JSON.stringify($('#basicSubSec').serializeArray());
            $.ajax({
                url: '<?= SITE_ROOT; ?>/formview/update-section-element/',
                type: 'POST',
                data: {dummy: null, values: datas, basicMethod: method, basicMultAns: multAns, basicSubSec: subSec},
                success: function (data) {
                    console.log("Update Section Element",data);
                    $('#myModal').modal('hide');
                    swal({
                        title: "Element Updated!",
                        text: "Data successfully updated into database",
                        type: "success"
                    });
                }
            });
        });
    });

</script> 