<form id='deleteDocument' class='form-horizontal'>
    
    <div class='form-group form-group-sm'>
        <p style='padding-left:45px'><b>Are you sure to delete Outreach Document?</b></p>
         <input type='hidden' name='doc_id' id='doc_id'  value='<?= $doc_id; ?>'/>
    </div>

    <div class='form-group form-group-sm'>
        <label class='control-label col-sm-3'>Document Title</label>
        <div class='col-sm-8'>
            <input type='text' name='doc_names' id="doc_names"  value='<?= $title->doc_name_desc; ?>' class='form-control'  autocomplete="off" readonly/>
        </div>
    </div>

    <div class='form-group form-group-sm'>
        <label class='control-label col-sm-3'>Outreach Type</label>
        <div class='col-sm-8'>
            <input type='text' name='doc_type' id="doc_type"  value='<?= $title->outrch_type_name; ?>' class='form-control'  autocomplete="off" readonly/>
        </div>
    </div>

    <div class='form-group form-group-sm'>
        <label class='control-label col-sm-3'></label>
        <div class='col-sm-8 text-right'>
            <button type='button' class='btn btn-sm btn-danger yesDelete'>Yes</button>
            <button type='button' class='btn btn-sm btn-success ' data-dismiss="modal">Cancel</button>
        </div>
    </div>  
  
</form>
<script>
    $(document).ready(function(){
        
    $('.yesDelete').click(function () {
        var values = $('#deleteDocument').serializeArray();
            $.ajax({
                url: '<?= SITE_ROOT; ?>/formview/delete-current-outreach/',
                data: {values:values},
                success: function (data) {
                    console.log(data);
                    $('#deleteModal').modal('hide');
                    swal({
                        title:"Outreach Document Deleted",
                        text: "Data successfully removed from database",
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
