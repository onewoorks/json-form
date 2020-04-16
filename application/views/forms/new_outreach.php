
<form id='newOutreach' class='form-horizontal'>

    <div class='form-group form-group-sm'>
        <label class='control-label col-sm-3'>Document Title</label>
        <div class='col-sm-8'>
            <input type='text' name='doc_name' id="doc_name"  value='<?= $title->doc_name_desc; ?>' class='form-control'  autocomplete="off" readonly/>
        </div>
    </div>

    <div class='form-group form-group-sm'>
        <label class='control-label col-sm-3'>Outreach Type</label>
        <div class='col-sm-8'>
            <select class='form-control' name="outType" onchange="getComboA(this)" >
                <option value='0'>Please Select Outreach Type</option>
                <?php foreach ($list_of_outreach as $outrch): ?>
                    <option value='<?php echo $outrch['code']; ?>'><?php echo $outrch['name']; ?></option>
                <?php endforeach; ?>
            </select>  
        </div>
    </div>

    <input type='hidden' name='doc_id' id='doc_id' value='<?= $title->doc_name_id; ?>' />
    <div class='form-group form-group-sm'>
        <label class='control-label col-sm-3'></label>
        <div class='col-sm-8 text-right'>
            <div class='btn btn-sm btn-primary updateDoc'>Update</div>
            <button type='button' class='btn btn-sm btn-success cancel' data-dismiss="modal">Cancel</button>
        </div>
    </div>  
</form>

<script>

    function getComboA(selectObject) {
        var vals = selectObject.value;
      
        $('.updateDoc').click(function () {
            var values = $('#newOutreach').serializeArray();
            
            values.push({
                name: 'outreach_types',
                value: vals
            });
          
            $.ajax({
                url: '<?= SITE_ROOT; ?>/formview/create-outreach/',
                data: {documentValues: values},
                success: function (data) {
                    console.log(data);
                    $('#myModal').modal('hide');
                    swal({
                        title: "Outreach Updated!",
                        text: "Data successfully updated into database",
                        type: "success"
                    });
                }
            });
             setTimeout(
                    function () {
                        window.location.reload(true);
                    }, 1200);
            return false;
        });
    }
    
    $('.cancel').click(function(e) {
             e.preventDefault();
             $(".outreachStatus[id='" + <?= $doc_id;?> + "']").prop("checked",false);
             window.close();
          });
    
</script>
