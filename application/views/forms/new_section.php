<?php echo $header; ?>

<div id="sectionGroup">
    <form id="sectionBuilder" class="form-horizontal">
        <div class='panel-body'>
            <div class='form-group form-group-sm'>
                <label class='control-label col-sm-2'>Section Description&nbsp;<b style='color: red'>*</b></label>
                <div class='col-sm-4'>
                    <input type='text' name='section_desc' id='section_desc' class='form-control' autocomplete="off" required/>
                </div>
                <label class="control-label col-sm-2">Layout&nbsp;<b style='color: red'>*</b></label>
                <div class="col-sm-4">
                    <label class="radio-inline">
                        <input name="layout" id="layout" type="radio" value="1" /> 1
                    </label>
                    <label class="radio-inline">
                        <input name="layout" id="layout" type="radio" value="2" checked/> 2
                    </label>
                    <button type="button" class="btn btn-primary btn-sm pull-right addSection" disabled>Add Section</button>

                </div>
            </div>
        </div>
    </form>

    <div class='container-fluid col-md-12' style='margin-left: 40px;'>
        <div class='panel panel-primary'>
            <div class='panel-heading'>
                <div class="btn-group pull-right">
                </div>

                Result of Existing Section</div>
            <div class='panel-body'>
                <table id="tableForm" class='table table-bordered table-condensed'>
                    <thead>
                        <tr>
                            <th style=" font-size: smaller;">Section Code</th>
                            <th style=" font-size: smaller;">Section Desc</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!$list_of_sections): ?>
                            <tr>
                                <td colspan="7"><i>No Record Found</i></td>
                            </tr>
                        <?php endif; ?>
                        <?php $no = 1;
                        foreach ($list_of_sections as $sections): ?>
                            <tr>
                                <td  style=" font-size: smaller; text-align: center"><?php echo $sections['section_code']; ?></td>
                                <td  style=" font-size: smaller;"><?php echo $sections['section_desc']; ?></td>
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

        //ADDSECTION
        $('.addSection').click(function () {
            var values = $('#sectionBuilder').serializeArray();
            var layout = $("#layout").val();
            var secDesc = $("#section_desc").val();
            console.log(values);
            $.ajax({
                url: '<?= SITE_ROOT; ?>/formview/create-section/',
                data: {values: values, layout: layout, secDesc: secDesc},
                success: function (data) {
//                alert(data);
                    swal({
                        title: "Section Created!",
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

        $('#sectionBuilder input').keyup(function () {

            var empty = false;
            $('#sectionBuilder input').each(function () {
                if ($(this).val().length === 0) {
                    empty = true;
                }
            });

            if (empty) {
                $('.addSection').attr('disabled', 'disabled');
            } else {
                $('.addSection').attr('disabled', false);
            }
        });

    });

</script>

<?php
echo $footer;
