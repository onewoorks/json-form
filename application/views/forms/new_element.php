<?php echo $header; ?>

<div id='elementGroup'>

    <form id='elementBuilder' class='form-horizontal'>
        <div class='panel-body'>
            <div class='form-group form-group-sm'>
                <label class='control-label col-sm-2'>Element Description&nbsp;<b style='color: red'>*</b></label>
                <div class='col-sm-6'>
                    <input type='text' name='element_desc' id='element_desc' class='form-control' autocomplete="off" required/>
                </div>
                <div class="col-sm-4 text-right">
                    <button type="button" class="btn btn-primary btn-sm addElement" disabled>Add Element</button>
                </div> 
            </div>
        </div>
    </form> 

    <div class='container-fluid col-md-12' style='margin-left: 40px;'>
        <div class='panel panel-primary'>
            <div class='panel-heading'>
                <div class="btn-group pull-right">
                </div>

                Result of Existing Element</div>
            <div class='panel-body'>
                <table id="tableForm" class='table table-bordered table-condensed'>
                    <thead>
                        <tr>
                            <th style=" font-size: smaller;">Element Code</th>
                            <th style=" font-size: smaller;">Element Desc</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!$list_of_elements): ?>
                            <tr>
                                <td colspan="7"><i>No Record Found</i></td>
                            </tr>
                        <?php endif; ?>
                        <?php $no = 1;
                        foreach ($list_of_elements as $elements): ?>
                            <tr>
                                <td  style=" font-size: smaller; text-align: center"><?php echo $elements['element_code']; ?></td>
                                <td  style=" font-size: smaller;"><?php echo $elements['element_desc']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<script>
    $(document).ready(function () {
        $('#tableForm').DataTable();
    });

    $(function () {

        //ADDELEMENT
        $('.addElement').click(function () {
            var values = $('#elementBuilder').serializeArray();
            var elemDesc = $("#element_desc").val();
            console.log(values);
            $.ajax({
                url: '<?= SITE_ROOT; ?>/formview/create-element/',
                data: {values: values, elemDesc: elemDesc},
                success: function (data) {
                    swal({
                        title: "Element Created!",
                        text: "Data successfully inserted into database",
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

<script>
    $(document).ready(function () {

        $('#elementBuilder input').keyup(function () {

            var empty = false;
            $('#elementBuilder input').each(function () {
                if ($(this).val().length === 0) {
                    empty = true;
                }
            });

            if (empty) {
                $('.addElement').attr('disabled', 'disabled');
            } else {
                $('.addElement').attr('disabled', false);
            }
        });

    });

</script>

<?php
echo $footer;
