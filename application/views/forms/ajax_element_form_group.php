<!--<div id='formJson' style='white-space: pre' class=''>

</div>

-->

    <form id='editElement' class='form-horizontal'>
    <input type='hidden' name='section_code' value='<?= $values->element_code; ?>' />
    <input type='hidden' name='document_id' value='<?= $document_id; ?>' />
    <input type='hidden' name='template_id' value='<?= $template_id; ?>' />
    <div class='panel panel-default'>
        
        <div class='panel-heading'>Properties</div>
        <div class='panel-body'>
            <div class='form-group form-group-sm'>
                <label class='control-label col-sm-4'>Element Description</label>
                <div class='col-sm-8'>
                    <input type='text' name='section_desc' value='<?= $values->element_desc; ?>' class='form-control' autocomplete="off"/>
                </div>
            </div>
            
            <div class='form-group form-group-sm'>
                <label class='control-label col-sm-4'>Element Properties</label>
                <div class='col-sm-8'>
                    <label class='radio-inline'>
                        <input type='radio' name='element_properties' value='decoration' <?php if($values->element_properties==='DECORATION'){echo 'checked';} ?>  /> Decoration
                    </label>
                    <label class='radio-inline'>
                        <input type='radio' name='element_properties' value='element'<?php if($values->element_properties==='BASIC'){echo 'checked';} ?>/> Basic
                    </label>
                    <label class='radio-inline'>
                        <input type='radio' name='element_properties' value='method' <?php if($values->element_properties==='METHOD'){echo 'checked';} ?>/> Method
                    </label>
                </div>
            </div>
            
        </div>
    </div>
        
    <div class='panel panel-default'>

                <div id='formelement'></div>
        
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
</script>
