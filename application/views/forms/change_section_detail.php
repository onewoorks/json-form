<form id='editSection' class='form-horizontal'>
<div class='form-group form-group-sm'>
    <label class='control-label col-sm-3'>Description</label>
    <div class='col-sm-8 column'>
        <div>
        <input type='text' name='section_desc'  value='<?= $section->section_desc;?>' class='form-control text-uppercase' onkeyup="this.value = this.value.toUpperCase();" autocomplete="off"/>
        <input type='hidden' name='doc_id' value='<?= $doc_id;?>' autocomplete="off"/>
        </div>
        <input type='hidden' name='selected_section' value='<?= $section->section_desc;?>' />
    </div>
</div>

<div class='form-group form-group-sm'>
    <label class='control-label col-sm-3'></label>
    <div class='col-sm-8 text-right'>
        <button type='button' class='btn btn-sm btn-primary' onclick='javascript:checkNew()'>Update</button>
         <!--<button type='submit' class='btn btn-sm btn-primary'>Update</button>-->
    </div>
</div>    
</form>
<script>
    function checkNew(){
        var values = $('#editSection').serializeArray();
      $.ajax({
                url : '<?= SITE_ROOT;?>/formview/edit-section/',
                data : { values: values },
                success : function(){
                    $('#title').modal('hide');
                    swal({
                      title: "Section Updated!",
                      text: "Data successfully updated into database",
                      type: "success"
                    });
                }
            });
             setTimeout(
                    function () {
                        window.location.reload(true);
                    }, 1200);
    };
    
    $(function(){
        $('input[name=section_desc').change(function(){
            console.log($(this).val());
            $('[name=selected_section]').val($(this).val());
        }); 
    });
</script>