<!--<div id='formJson' style='white-space: pre' class=''>

</div>

-->

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
    <div class='panel panel-default'>
        
        <div class='panel-heading'>Properties</div>
        <div class='panel-body'>
            
            <div class='form-group form-group-sm'>
                <label class='control-label col-sm-4'>Element Description</label>
                <div class='col-sm-8'>
                    <input type='text' name='element_desc' value='<?= $values->element_desc; ?>' class='form-control' autocomplete="off"/>
                </div>
            </div>
            
            <div class="form-group form-group-sm">
                <label class="control-label col-sm-4">Element Group</label>
                <div class="col-sm-8">                      
                    <select name='element_group' class='form-control'>                        
                             <?php foreach ($grouping as $group): 
                                 if($group['element_code']=== $values->element_code ){
                                    echo "<option value='".$group['element_code']."'>No group</option>"; 
                                 }elseif($group['element_code']=== $values->child_element_code){
                                    echo "<option value='".$group['element_code']."'>".$group['element_desc']."</option>";
                                    echo "<option value='".$values->element_code."'>No group</option>";
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
            
            <div class="form-group form-group-sm">
                <label class="control-label col-sm-4">Position</label>
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
                <label class='control-label col-sm-4'>Element Properties</label>
                <div class='col-sm-8'>
                    <label class='radio-inline'>
                        <input type='radio' name='element_properties' value='DECORATION' <?php if($values->element_properties==='DECORATION'){echo 'checked';} ?>  /> Decoration
                    </label>
                    <label class='radio-inline'>
                        <input type='radio' name='element_properties' value='BASIC'<?php if($values->element_properties==='BASIC'){echo 'checked';} ?>/> Basic
                    </label>
                    <label class='radio-inline'>
                        <input type='radio' name='element_properties' value='METHOD' <?php if($values->element_properties==='METHOD'){echo 'checked';} ?>/> Method
                    </label>
                </div>
                <div id='formelement'></div>
            </div>   
            
        </div>
    </div>

                     <div class='form-group form-group-sm'>
        <label class='control-label col-sm-3'></label>
        <div class='col-sm-12 text-right'>
            <button type='submit' class='btn btn-sm btn-primary'>Update</button>
        </div>
    </div>       
</form>

<script>
    function ElementBuilder($elementName) {
        var formValue = $('#editElement').serializeArray();
        
     //console.log(formValue);
        $.ajax({
            url: '<?php echo SITE_ROOT;?>/formbuilder/formelement/',
            data: {value: $elementName , params : formValue },
            success: function (data) {
                $('#formelement').html(data);
            }
        });
            }
    ;
    $(function () {
        var $formType = $('input[name=element_properties]:checked').val();
        var $sc = $('[name=section_code]').val();
        //var $formType = 'decoration';
        ElementBuilder($formType,$sc);
        $('[name=form_element').val($formType);
        $('[name=element_properties]').on('change', function () {
            var selector = $(this).val();
            $('#' + selector).show();
            $('[name=form_element').val(selector);
            ElementBuilder(selector);
        });
    });

    $(function(){
        $('#editElement').submit(function(e){
            e.preventDefault();
            var a = $('#case').serializeArray();
            var b = $('#rowinput').serializeArray();           
            $.ajax({
                url : '<?= SITE_ROOT;?>/formview/update-section-element/',
                data : { values: $(this).serializeArray(), basic: $('#case').serializeArray(), rowinput: b},
                success : function(data){
                  console.log(data);
                  $('#myModal').modal('hide');
                  swal({
                      title: "Element Updated!",
                      text:  "Data successfully updated into database",
                      type:  "success"
                    });
                }
            });
        });
        });
</script>
