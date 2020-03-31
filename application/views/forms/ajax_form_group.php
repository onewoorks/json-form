<form id='editSection' class='form-horizontal'>
<div class='form-group form-group-sm'>
    <label class='control-label col-sm-3'>Description</label>
    <div class='col-sm-8'>
        <input type='text' name='section_desc' id='section_desc' value='<?= $values->section_desc;?>' class='form-control secList text-uppercase' onkeyup="this.value = this.value.toUpperCase();" list="secList" autocomplete="off"/>
        <datalist id="secList">
            <?php foreach ($sections as $section): ?>
                <option value="<?php echo $section['section_desc']; ?>" data-id="<?php echo $section['section_code']; ?>"></option>
            <?php endforeach; ?>
        </datalist>
        <input type='hidden' name='section_code' id='section_code' value='<?= $values->section_code;?>' />
        <input type='hidden' name='document_id' id='document_id' value='<?= $document_id;?>' />
        <input type='hidden' name='template_id' value='<?= $template_id;?>' />
    </div>
</div>
<div class='form-group form-group-sm'>
    <label class='control-label col-sm-3'></label>
    <div class='col-sm-8 text-right'>
        <div class='btn btn-sm btn-primary updateSection'>Update</button>
    </div>
</div>  
</div>
</form>
<script>
    $(function(){
        $('.updateSection').click(function (){
            var values = $('#editSection').serializeArray();
            console.log('values : ', values);
            $.ajax({
                url : '<?= SITE_ROOT;?>/formview/edit-attributes/',
                data : {documentValues:values},
                success : function(){
                    $('#myModal').modal('hide');
                    swal({
                      title: "Section Updated!",
                      text: "Data successfully updated into database",
                      type: "success"
                    });
                }
            });
            
        })
    })
</script>
