    <form id='addNewElement' class='form-horizontal'>
    <div class='panel panel-default'>        
        <div class='panel-heading'>Properties</div>
        <div class='panel-body'>
            <input type='hidden' name="doc_id" value="<?= $doc_id; ?>" />
            <input type='hidden' name="section_code" value='<?= $section_id; ?>' />
            <input type="hidden" name="section_sorting" value="<?= $section_sorting->section_sorting; ?>" />
            
            <div class='form-group form-group-sm'>
                <label class='control-label col-sm-4'>Element Description</label>
                <div class='col-sm-8'>
                    <input type='text' name='element_desc' value='' class='form-control' autocomplete="off"/>
                </div>
            </div>
            
            <div class="form-group form-group-sm">
                <label class="control-label col-sm-4">Element Group</label>
                <div class="col-sm-8">                      
                    <select name='element_group' class='form-control'>
                            <option value='-1'>No group</option>
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
                          <input name="position" type="radio" value="L" checked="checked"> Left
                     </label>
                     <label class="radio-inline">
                            <input name="position" type="radio" value="R" > Right
                     </label>
                </div>
            </div>
          
            <div class='form-group form-group-sm'>
                <label class='control-label col-sm-4'>Element Properties</label>
                <div class='col-sm-8'>
                    <label class='radio-inline'>
                        <input type='radio' name='element_properties' value='DECORATION' checked="checked" /> Decoration
                    </label>
                    <label class='radio-inline'>
                        <input type='radio' name='element_properties' value='BASIC' /> Basic
                    </label>
                    <label class='radio-inline'>
                        <input type='radio' name='element_properties' value='METHOD' /> Method
                    </label>
                </div>
                <div id='formelement'></div>
            </div>   
            
        </div>
    </div>

    <div class='form-group form-group-sm'>
        <label class='control-label col-sm-3'></label>
        <div class='col-sm-12 text-right'>
            <button type='submit' class='btn btn-sm btn-primary'>Insert</button>
        </div>
    </div>       
</form>          
<script>
        function ElementBuilder($elementName) {
        $.ajax({
            url: '<?php echo SITE_ROOT;?>/formbuilder/formelement/',
            data: {value: $elementName},
            success: function (data) {
                $('#formelement').html(data);
            }
        });
    }
    ;

    $(function () {
        var $formType = 'decoration';
        ElementBuilder($formType);
        $('[name=form_element]').val($formType);
        $('[name=element_properties]').on('change', function () {
            var selector = $(this).val();
            $('#' + selector).show();
            $('[name=form_element]').val(selector);
            ElementBuilder(selector);
        });
    });
    
    $(function(){
        $('#addNewElement').submit(function(e){
            e.preventDefault();          
            $.ajax({
                url : '<?= SITE_ROOT;?>/formview/add-new-element/',
                data : { values: $(this).serializeArray(),basic: $('#case').serializeArray(),rowinput:$('#rowinput').serializeArray()},
                success : function(data){
                  console.log(data);
                 // $('#myModal').modal('hide');
                 location.reload();
                }
            });
        });
        });
</script>