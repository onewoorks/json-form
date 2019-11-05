<form id='editTitle' class='form-horizontal'>
<div class='form-group form-group-sm'>
    <label class='control-label col-sm-3'>Description</label>
    <div class='col-sm-8 column'>
        <div>
        <input type='text' name='title_desc'  value='<?= $title->doc_name_desc;?>' class='form-control text-uppercase' onkeyup="this.value = this.value.toUpperCase();" autocomplete="off"/>
        <input type='hidden' name='doc_id' value='<?= $doc_id;?>' autocomplete="off"/>
        </div>
        <input type='hidden' name='selected_title' value='<?= $title->doc_name_desc;?>' />
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
        var values = $('#editTitle').serializeArray();
      $.ajax({
                url : '<?= SITE_ROOT;?>/formview/edit-title/',
                data : { values: values },
                success : function(){
                    $('#title').modal('hide');
                    swal({
                      title: "Title Updated!",
                      text: "Data successfully updated into database",
                      type: "success"
                    });
                }
            });
    };
    
    $(function(){
        $('input[name=title_desc').change(function(){
            console.log($(this).val());
            $('[name=selected_title]').val($(this).val());
        }); 
    });
</script>