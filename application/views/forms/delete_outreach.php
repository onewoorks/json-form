<form id='deleteDocument' class='form-horizontal'>
<div class='form-group form-group-sm'>
    <p style='padding-left:15px'><b>Are you sure want to delete <strong class="text-uppercase"><?= $title->doc_name_desc;?></strong> ?</b></p>
        <input type='hidden' name='doc_id' id='doc_id'  value='<?= $doc_id;?>'/>
    <div class='col-sm-12 text-right'>
        <button type='button' class='btn btn-sm btn-danger yesDelete'>Yes</button>
        <button type='button' class='btn btn-sm btn-success' data-dismiss="modal">Cancel</button>
    </div>    
</div>
  
</form>
<script>
    $('.yesDelete').click(function () {
        var values = $('#deleteDocument').serializeArray();
            $.ajax({
                url: '<?= SITE_ROOT; ?>/formview/delete-current-outreach/',
                data: {values:values},
                success: function (data) {
                    console.log(data);
                    $('#deleteModal').modal('hide');
                    swal({
                        title:"Document Removed!",
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
</script>