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
            <select class='form-control' name="outreach_type" id="outreach_type">
                <option value='0' selected="selected" >Please Select Outreach Type</option>
                <?php foreach ($list_of_outreach as $outrch): ?>
                    <option value='<?php echo $outrch['outrch_type_code']; ?>'><?php echo $outrch['outrch_type_name']; ?></option>
                <?php endforeach; ?>
            </select>  
        </div>
    </div>
    <input type='hidden' name='doc_id' id='doc_id' value='<?= $title->doc_name_id; ?>' />
    <div class='form-group form-group-sm'>
        <label class='control-label col-sm-3'></label>
        <div class='col-sm-8 text-right'>
            <button type='submit' class='btn btn-sm btn-primary'>Update</button>
            </div>
        </div>  
</form>
<script>
 $(function () {
        $('#newOutreach').submit(function (e) {
            e.preventDefault();
             var values = $(this).serializeArray();
             var datas = JSON.stringify(values);
             console.log('values : ', datas);
             
            $.ajax({
                url: '<?php echo SITE_ROOT; ?>/formview/create-outreach/',
                type: 'POST',
                data: {dummy: null, values: datas},
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
        });
   
    });
</script>
