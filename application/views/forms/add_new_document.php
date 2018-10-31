<form id='editElement' class='form-horizontal'>
    
    <div class='panel panel-default'>
        <div class='panel-heading'>Properties</div>
        <div class='panel-body'>
            <div class='form-group form-group-sm'>
                <label class='control-label col-sm-3'>Element Description</label>
                <div class='col-sm-8'>
                    <input type='text' name='element_desc' value='<?= $element; ?>' class='form-control' autocomplete="off"/>
                </div>
            </div>
            
            <div class="form-group form-group-sm">
                <label class="control-label col-sm-3">Position</label>
                <div class="col-sm-8">
                      <label class="radio-inline">
                            <input name="position" type="radio" value="L"> Left
                     </label>
                     <label class="radio-inline">
                            <input name="position" type="radio" value="R"> Right
                     </label>
                </div>
            </div>
            
            <div class='form-group form-group-sm'>
                <label class='control-label col-sm-3'>Element Properties</label>
                <div class='col-sm-8'>
                    <label class='radio-inline'>
                        <input type='radio' name='element_properties' value='DECORATION_NEW'/> Decoration
                    </label>
                    <label class='radio-inline'>
                        <input type='radio' name='element_properties' value='BASIC_NEW' checked="checked"/> Basic
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
    //DISPLAY PROPERTY'S DETAIL   
    $(function () {
        var formType = $('input[name=element_properties]:checked').val();
        ElementBuilder(formType);
        $('[name=form_element').val(formType);
        $('[name=element_properties]').on('change', function () {
            var selector = $(this).val();
            $('#' + selector).show();
            $('[name=form_element').val(selector);
            ElementBuilder(selector);
        });
    });
    
    //BAWA KE PAGE->BASIC
    function ElementBuilder(formType) {
//        console.log(formType);
        var formValue = $('#editElement').serializeArray();

        $.ajax({
            url: '<?php echo SITE_ROOT;?>/formbuilder/formelement/',
            data: {value:formType, params:formValue},
            success: function (data) {
                $('#formelement').html(data);
            }
        });
    };
            
</script>