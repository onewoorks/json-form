    <form id='addNewElement' class='form-horizontal'>
    <div class='panel panel-default'>        
        <div class='panel-heading'>Properties</div>
        <div class='panel-body'>
            <input type='hidden' name="section_number" value="<?= $section_no; ?>" />
            
            <div class='form-group form-group-sm'>
                <label class='control-label col-sm-4'>Element Description</label>
                <div class='col-sm-8'>
                    <input type='text' name='element_desc' value='' class='form-control' autocomplete="off"/>
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
        $('[name=form_element').val($formType);
        $('[name=element_properties]').on('change', function () {
            var selector = $(this).val();
            $('#' + selector).show();
            $('[name=form_element').val(selector);
            ElementBuilder(selector);
        });
    });
    
    $(function(){
        $('#addNewElement').submit(function(e){
            e.preventDefault();   
            alert('sampai');
            $.ajax({
                url : '<?= SITE_ROOT;?>/formview/pass-element/',
                data : { values: $(this).serializeArray(),basic: $('#basic').serializeArray(),rowinput:$('#rowinput').serializeArray()},
                success : function(){
                }
            });
        });
        });   
</script>

