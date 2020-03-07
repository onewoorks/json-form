<form id='addNewElement' class='form-horizontal'>

    <div class='panel panel-default'>
<!--        <div class='panel-heading'>Properties</div>-->
        <div class='panel-body'>
             <input type='hidden' name="doc_id" value="<?= $doc_id; ?>" />
            <input type='hidden' name="section_code" value='<?= $section_id; ?>' />
            <input type="hidden" name="section_sorting" value="<?= $section_sorting->section_sorting; ?>" />
            <div class='form-group form-group-sm'>
                <label class='control-label col-sm-2'>Element Description</label>
                <div class='col-sm-8'>
                    <input type='text' name='element_desc' id='element_desc' class="form-control elemList" list="elemList"/>
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
                    <input type='text' name='element_group' id='element_group' class="form-control elemList" list="elemList"/>
                    <datalist id="elemList">
                        <?php foreach ($elements as $element): ?>
                            <option value="<?php echo $element['element_desc']; ?>" data-id="<?php echo $element['element_code']; ?>"><?php echo $element['element_code']; ?></option>
                        <?php endforeach; ?>
                    </datalist>                
                </div>
            </div>
            
             <div class='form-group form-group-sm'>
                <label class='control-label col-sm-2'>Element Level</label>
                <div class='col-sm-8'>
                    <input type='number' name='element_level' class='form-control required' style="width:8%" autocomplete="off" />
                </div>
            </div>

            <div class="form-group form-group-sm">
                <label class="control-label col-sm-2">Position</label>
                <div class="col-sm-8">
                    <label class="radio-inline">
                        <input name="position" type="radio" value="L" checked> Left
                    </label>
                    <label class="radio-inline">
                        <input name="position" type="radio" value="R"> Right
                    </label>
                </div>
            </div>

            <div class='form-group form-group-sm'>
                <label class='control-label col-sm-2'>Element Properties</label>
                <div class='col-sm-8'>
                    <label class='radio-inline'>
                        <input type='radio' name='element_properties' value='DECORATION_NEW'/> Decoration
                    </label>
                    <label class='radio-inline'>
                        <input type='radio' name='element_properties' value='BASIC' checked="checked"/> Basic
                    </label>
                    <label class='radio-inline'>
                        <input type='radio' name='element_properties' value='SUBSECTION_NEW'/> Subsection
                    </label>
                </div>
                <div id='formelement'></div>
            </div>   
        </div>
    </div>

    <div class='form-group form-group-sm'>
        <label class='control-label col-sm-3'></label>
        <div class='col-sm-10 text-right'>
            <button type='submit' class='btn btn-sm btn-primary insertElement'><i class="glyphicon glyphicon-floppy-save"></i> Insert</button>
        </div>
        &nbsp;
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
                data : { values: $(this).serializeArray(),basic: $('#basic').serializeArray(),rowinput:$('#rowinput').serializeArray()},
                success : function(data){
                  console.log(data);
                  $('#myModal').modal('hide');
                    swal({
                      title: "New Element Inserted!",
                      text: "Data successfully inserted into database",
                      type: "success"
                    });
                }
            });
        });
        });
</script>