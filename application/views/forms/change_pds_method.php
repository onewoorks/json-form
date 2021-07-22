
<form id='editNcpMethod' class='form-horizontal'>  
 <div class='panel panel-default'>
        <br>
            <div class='form-group form-group-sm'>
                <label class='control-label col-sm-2'>Patient Disease Summary</label>
                <div class='col-sm-8'>
                    <input name="doc_id" id="doc_id" type="text" class="form-control hidden" value="<?= $values->doc_name_id; ?>" readonly=""/>
                    <input name="temp_id" id="temp_id" type="text" class="form-control hidden" value="<?= $values->template_id; ?>" readonly=""/>
                    <input name="doc_desc" id="doc_desc" type="text" class="form-control" value="<?= $values->doc_name_desc; ?>" readonly=""/>
                </div>
            </div>
        
         <div class='form-group form-group-sm'>
                <label class='control-label col-sm-2'>Method</label>
                <div class='col-sm-8'>
                <textarea name="pds_method" id="pds_method" type="json" class="form-control" style="height:360px" ><?= $values->json_template; ?></textarea>
                </div>
            </div>
        
        <div class='form-group form-group-sm'>
            <label class='control-label col-sm-3'></label>
            <div class='col-sm-12 text-right' style="margin-left: -80px">
                    <div   class='btn btn-md btn-primary updateMethod'>Update</div>
            </div>
        </div>  
 </div>
</form>

<script>
    $(function () {
        $('.updateMethod').click(function () {
            var values = $('#editNcpMethod').serializeArray();
            $.ajax({
            url : '<?= SITE_ROOT;?>/formview/change-pds-method/',
            type: 'POST',
            data : { values: values},
            success : function(data){
                //console.log(data);
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
       });
      });
 </script>