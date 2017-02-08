<div id='formJson' style='white-space: pre' class=''>

</div>

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
                        <input type='radio' name='element_properties' value='decoration'/> Decoration
                    </label>
                    <label class='radio-inline'>
                        <input type='radio' name='element_properties' value='basic'/> Basic
                    </label>
                    <label class='radio-inline'>
                        <input type='radio' name='element_properties' value='method'/> Method
                    </label>
                </div>
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
    $(function () {
        $('[name=element_properties]').val('decoration');
        
        var json_parse = JSON.parse('<?= $json_format; ?>');
        $('#formJson').text(JSON.stringify(json_parse, null, 4));

        $('#editSection').submit(function (e) {
            e.preventDefault();
            $.ajax({
                url: '<?= SITE_ROOT; ?>/formview/edit-attributes/',
                data: {values: $(this).serializeArray()},
                success: function () {
                    $('#myModal').modal('hide');
                    location.reload();
                }
            });
        });

    });
</script>

