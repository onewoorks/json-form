<?php echo $header; ?>
<div class='panel panel-default'>
    <div class='panel-heading'>SQL Statement</div>
    <div class='panel-body'>
        <form id='sqlform' class='form'>
            <div class='row'>
                <div class='col-sm-12'>
                    <label>Paste your sql statement here</label>
                    <textarea id='insert_statement' name='insert_statement' rows="20" class='form-control'></textarea>
                </div> 
            </div>
            <br>
            <div class='row text-right'>
                <div class='col-sm-12'>
                    <button type='submit' class='btn btn-primary runQuery'>Run Query</button>
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
            var query = $('#insert_statement').val();
            $('.runQuery').text('Executing...');
            $.ajax({
                url: '<?php echo SITE_ROOT; ?>/formview/insert-sql/',
                data: {values: query},
                success: function (data) {
                    console.log(data);
                    swal({
                        title: "Insertion Success",
                        text: "Please go to Generate JSON Format link to execute the builder?",
                        type: "success",
                        showCancelButton: false,
                        confirmButtonColor: "#80bf07",
                        confirmButtonText: "Ok!",
                        closeOnConfirm: false
                    },
                    function () {
                        window.location.href = './generate-json-format';
                    });
                }
            });
        });
    });
</script>
<?php echo $footer; ?>