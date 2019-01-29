<?php echo $header; ?>

<!--DOCUMENT ID'S-->
<div id="formCreator">
    <div class="panel-body">
        <form id="formBuilder" class="form-horizontal">  

            <div class='form-group form-group-sm'>
                <table class='listcolumn' style='font-size:12px;margin-left:250px;text-align:right;' >
                    <tbody>
                        <tr>
                            <td><b>Discipline</b>&nbsp;<b style='color: red'>*</b></td>
                            <td>
                                <select name='discipline' id='discipline' class='form-control' >
                                    <?php foreach ($main_discipline as $discipline): ?>
                                        <option value='<?php echo $discipline['code']; ?>'><?php echo $discipline['label']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td><b>Document Group</b>&nbsp;<b style='color: red'>*</b></td>
                            <td>
                                <select name='doc_group' id='doc_group' class='form-control' >
                                    <option value='0' selected="selected">Please Select Document Group</option>
                                    <?php foreach ($doc_group as $doc): ?>
                                        <option value='<?php echo $doc['code']; ?>'><?php echo $doc['label']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Sub Discipline</b>&nbsp;<b style='color: red'>*</b></td>
                            <td>
                                <select name='general_discipline' id='general_discipline' class='form-control' >
                                    <?php if (!$preset_select): ?>
                                        <option value='0'>Please Select Sub Discipline</option>
                                    <?php else: ?>
                                        <option value='0' selected="selected" >Please Select Sub Discipline</option>
                                        <?php foreach ($general_discipline as $general): ?>
                                            <option value='<?php echo $general['code']; ?>'><?php echo $general['label']; ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </td>
                            <td><b>Document Type</b>&nbsp;<b style='color: red'>*</b></td>
                            <td>
                                <select name='doc_type' id='doc_type' class='form-control'>
                                    <?php if (!$preset_select): ?>
                                        <option value='0' selected="selected">Please Select Document Type</option>
                                    <?php else: ?>
                                        <option value='0' >Please Select Document Type</option>
                                        <?php foreach ($doc_types as $doc): ?>
                                            <option value='<?php echo $doc['code']; ?>'><?php echo $doc['label']; ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="form-group form-group-sm" style='margin-left:-55px;margin-top: -5px'>
                <label class="control-label col-sm-4">Document Title&nbsp;<b style='color: red'>*</b></label>
                <div class="col-sm-6" style='width:48.55%'>
                    <input name="doc_name_desc" id="doc_name_desc" type="text" class="form-control" required/>
                </div>  
            </div>

            <div class='col-sm-10 text-right' style='margin-left:-18px'>
                <div class='btn btn-primary btn-sm addForm' disabled>Add Form</div>
            </div>

        </form>
    </div>

    <div class='container-fluid'>
        <div class='panel panel-primary'>
            <div class='panel-heading'>
                <div class="btn-group pull-right">
                </div>

                Result of Existing Title</div>
            <div class='panel-body'>
    <!--            <div class ='pull-left' style=" font-size: 12px; padding-bottom: 3px;"><b>Total Title = <?= count($list_of_titles); ?></b></div>
                <div class='clearfix'></div>-->

                <table id="tableForm" class='table table-bordered table-condensed'>
                    <thead>
                        <tr>
                            <th style=" font-size: smaller;">Document Id</th>
                            <th style=" font-size: smaller;">Title Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!$list_of_titles): ?>
                            <tr>
                                <td colspan="7"><i>No Record Found</i></td>
                            </tr>
                        <?php endif; ?>
                        <?php $no = 1;
                        foreach ($list_of_titles as $titles): ?>
                            <tr>
                                <td  style=" font-size: smaller; text-align: center"><?php echo $titles['doc_name_id']; ?></td>
                                <td  style=" font-size: smaller;"><?php echo $titles['doc_name_desc']; ?></td>
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

        $('[name=doc_group]').change(function () {
            var groupCode = $(this).val();
            $.ajax({
                url: '<?php echo SITE_ROOT; ?>/main/filter/',
                data: {group_code: groupCode},
                success: function (data) {
                    $('[name=doc_type]').html(data);
                    $('#formBuilder').submit();
                }
            });
        });

        $('[name=discipline]').change(function () {
            var disCode = $(this).val();
            $.ajax({
                url: '<?php echo SITE_ROOT; ?>/main/filter-discipline/',
                data: {dis_code: disCode},
                success: function (data) {
                    $('[name=general_discipline]').html(data);
                    $('[name=doc_group]').html('<option value="0">Please Select</option>');
                    $('[name=doc_type]').html('<option value="0">Please Select</option>');
                    $('#formBuilder').submit();
                }
            });
        });

        $('[name=general_discipline]').change(function () {
            $('[name=doc_group]').html('<option value="0">Please Select</option>');
            $('[name=doc_type]').html('<option value="0">Please Select</option>');
            $('#formBuilder').submit();
        });

        $('[name=doc_type]').change(function () {
            $('#formBuilder').submit();
        });

<?php if ($preset_select): ?>
            $('[name=discipline]').val("<?php echo $preset_select['active_discipline']; ?>");
            $('[name=general_discipline]').val("<?php echo $preset_select['active_general']; ?>");
            $('[name=doc_group]').val("<?php echo $preset_select['active_group']; ?>");
            $('[name=doc_type]').val("<?php echo $preset_select['active_type']; ?>");
<?php else: ?>
            $("[name=discipline]").change();
            $("[name=doc_group]").change();
<?php endif; ?>

        //NEWFORMPAGE
        $('#formBuilder').submit(function (e) {
            e.preventDefault();
            var values = $(this).serializeArray();
            $.ajax({
                url: '<?php echo SITE_ROOT; ?>/main/form-builder/',
                data: {documentValues: values},
                success: function (data) {
                    $('#formCreator').html(data);
                }
            });
        });

        //ADDFORMBUTTON
        $('.addForm').click(function () {
            var values = $('#formBuilder').serializeArray();
            var dis = $("#discipline").val();
            var subDis = $("#general_discipline").val();
            var docGroup = $("#doc_group").val();
            var docType = $("#doc_type").val();
            var docName = $("#doc_name_desc").val();
            console.log(values);
            $.ajax({
                url: '<?= SITE_ROOT; ?>/formview/add-title/',
                data: {values: values, dis: dis, subDis: subDis, docGroup: docGroup, docType: docType, docName: docName},
                success: function (data) {
                    swal({
                        title: "Title Created!",
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

        $('#formBuilder input').keyup(function () {

            var empty = false;
            $('#formBuilder input').each(function () {
                if ($(this).val().length === 0) {
                    empty = true;
                }
            });

            if (empty) {
                if (($("#general_discipline").val(), $("#doc_group").val(), $("#doc_type").val()) === '0') {
                    $('.addForm').attr('disabled', 'disabled');
                }
            } else {
                if (($("#general_discipline").val(), $("#doc_group").val(), $("#doc_type").val()) !== '0') {
                    $('.addForm').attr('disabled', false);
                }
            }
        });

    });

</script>

<?php
echo $footer;
