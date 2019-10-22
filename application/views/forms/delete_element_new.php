<form id='deleteElement' class='form-horizontal'>
<div class='form-group form-group-sm'>
    <p style='padding-left:15px'><b>Are you sure want to delete <strong class="text-uppercase"><?= $element->element_desc?></strong> ?</b></p>
        <input type='hidden' name='doc_id' id='doc_id'  value='<?= $doc_id;?>'/>
    <div class='col-sm-12 text-right'>
        <button type='button' class='btn btn-sm btn-danger yesDelete'>Yes</button>
        <button type='button' class='btn btn-sm btn-success' data-dismiss="modal">Cancel</button>
    </div>    
</div>
  
</form>
<script>
    $('.yesDelete').click(function () {
        var values = $('#deleteElement').serializeArray();
            $.ajax({
                url: '<?= SITE_ROOT; ?>/formview/delete-new-element/',
                data: {values:values},
                success: function (data) {
                    $('#deleteModal').modal('hide');
                    swal({
                        title:"Element Removed!",
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