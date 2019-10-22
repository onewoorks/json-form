<form id='editMethod' class='form-horizontal'>
<div class='form-group form-group-sm'>
    <label class='control-label col-sm-3'  style="text-align: right">Method Name</label>
    <div class='col-sm-8 column'>
        <input type='text' name='method_desc'  value='<?= $method->doc_method_desc;?>' class='form-control text-capitalize' autocomplete="off"/>
        <div>
        <input type='hidden' name='doc_id' value='<?= $doc_id;?>' autocomplete="off"/>
        </div>
        <input type='hidden' name='selected_method' value='<?= $method->doc_method_desc;?>' />
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
        var values = $('#editMethod').serializeArray();
      $.ajax({
                url : '<?= SITE_ROOT;?>/formview/edit-method/',
                data : { values: values },
                success : function(){
                    $('#title').modal('hide');
                    swal({
                      title:"Method Updated!",
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
        $('input[name=method_desc').change(function(){
            console.log($(this).val());
            $('[name=selected_method]').val($(this).val());
        }); 
    });
</script>
