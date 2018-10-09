<?=$header;?>

<body onload="myFunction()">
    
<!--POP UP BEFORE PAGE-->    
<div id="myPopup" class="modal fade" role="dialog">
    <form id="cloneBuilder">
    <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Clone document "<strong><?= $document_title; ?></strong>" ?</h4>
    </div>
    <div class="modal-body">
        <label>Change Title :</label>
        <input type="hidden" class="form-control" name="current_id" id="current_id" value="<?= $document_id;?>" />
        <input type="text" class="form-control" name="doc_name_desc" id="doc_name_desc" autocomplete="off"/><br>
        <div class="text-right">
            <div class='btn btn-success btn-md save'>Save</div>
            <div class='btn btn-danger btn-md cancel'>Cancel</div>
        </div>
    </div>
    </div>
    </div>
    </form>
</div>

<select hidden>
<?php foreach ($temp_id as $temp):?>
<option type='hidden' value='<?=$temp['template_id']?>'><?=$temp['template_id'];?></option>
<?php endforeach;?>
</select>

</body>

<script>
    function myFunction(){
    $('#myPopup').modal({backdrop: 'static', keyboard: false});
    };
    
    $('.save').click(function () {
    var values = $("#cloneBuilder").serializeArray();
    var docName = $("#doc_name_desc").val();
    var curName = $("#current_id").val();
    console.log(values);
    $.ajax({
                url: '<?= SITE_ROOT; ?>/main/copy-form/',
                data: {values:values, docName:docName, curName:curName},
                success: function (data) {
//                alert(data);
                swal({
                title: "Form Created!",
                text: "Data successfully inserted into database",
                type: "success"
                });
                $('#myPopup').modal('hide');
                }
            });
    setTimeout(function() {
    window.location.href = '<?= SITE_ROOT; ?>/formview/form-template/<?=$temp['template_id'];?>';
    return false;
    }, 1200);
    });
    
    $('.cancel').click(function () {
    window.location.href = '<?= SITE_ROOT; ?>';
    return false;
    });
</script>

<?=$footer;?>