<?php echo $header; ?>
<div class='panel panel-default'>
    <div class='panel-heading'>SQL Statement</div>
    <div class='panel-body'>
        <form id='sqlform' class='form'>
            <div class='row'>
                <div class='col-sm-12'>
                    <label>Document Id</label>
                    <input type='text' name='doc_name_id' value='' class='form-control' style="width:50px;" />
                </div> 
            </div>
            <div class='row'>
                <div class='col-sm-12'>
                    <label>Paste your sql statement here</label>
                    <textarea name='insert_statement' rows="20" class='form-control'></textarea>
                </div> 
            </div>
            <br>
            <div class='row text-right'>
                <div class='col-sm-12'>
                    <button type='submit' class='btn btn-primary'>Run Query</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $(function () {
        $('#sqlform').submit(function (e) {
            e.preventDefault();
            var values = $(this).serializeArray();
            var docNameId = $('[name=doc_name_id]').val();
            $.ajax({
                url: '<?php echo SITE_ROOT; ?>/formview/insert-sql/',
                data: {values: values},
                success: function (data) {
                    swal({
                        title: "Insertion Success",
                        text: "Do you want to generate JSON document template for this execution?",
                        type: "success",
                        showCancelButton: true,
                        confirmButtonColor: "#80bf07",
                        confirmButtonText: "Yes, Please generate!",
                        closeOnConfirm: false
                    },
                    function () {
                        $.ajax({
                            url: '<?php echo SITE_ROOT; ?>/formview/document/'+docNameId+'/',
                            data: {},
                            success: function () {
                                swal("Generated!", "JSON template for this document has been generated.", "success");
                            }
                        });

                    });
                }
            });
        });
    });
</script>
<?php echo $footer; ?>