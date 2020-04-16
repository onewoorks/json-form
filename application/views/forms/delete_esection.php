<form id='deleteSection' class='form-horizontal'>
<div class='form-group form-group-sm'>
    <p style='padding-left:15px'><b>Are you sure?</b></p>
        <input type='hidden' name='doc_id' id='doc_id'  value='<?= $doc_id;?>'/>
        <input type='hidden' name='section_id' id='section_id'  value='<?= $section_id;?>'/>
    <div class='col-sm-12 text-right'>
        <button type='button' class='btn btn-sm btn-danger yesDelete'>Yes</button>
        <button type='button' class='btn btn-sm btn-success cancel' data-dismiss="modal">Cancel</button>
    </div>    
</div>
  
</form>
<script>
    $('.yesDelete').click(function () {
        var values = $('#deleteSection').serializeArray();

            $.ajax({
                url: '<?= SITE_ROOT; ?>/formview/delete-edit-section/',
                data: {values:values},
                success: function (data) {
                    $('#deleteModal').modal('hide');
                    swal({
                        title:"Section Removed!",
                        text: "Data successfully removed from database",
                        type: "success"
                    });
                }
            });
        });  
        
</script>