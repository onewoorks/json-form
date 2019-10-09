<?php echo $header; ?>

<div id='listOfDocument' >
    <form id='documentFilter' class='form-horizontal col-md-offset-2 col-md-offset-2'>
        <div class='form-group form-group-sm'>
            <div class="col-md-12">
                <div class='row'>
                    <div class='form-inline'>
                        <label class="control-label col-md-2">Discipline</label>
                        <select name='discipline' id='discipline'  class='form-control col-md-8' style="width:20%">
                            <option value='0' selected="selected">Please Select Discipline</option>
                            <?php foreach ($main_discipline as $discipline): ?>
                                <option value='<?php echo $discipline['code']; ?>'><?php echo $discipline['label']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label class="control-label col-md-2">Document Group</label>
                        <select name='doc_group' class='form-control col-md-8' style="width:20%">
                            <option value='0' selected="selected">Please Select Document Group</option>
                            <?php foreach ($doc_group as $doc): ?>
                                <option value='<?php echo $doc['code']; ?>'><?php echo $doc['label']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>    
                </div>
            </div>

            <br><br>

            <div class="col-md-12">
                <div class='row'>
                    <div class='form-inline'>
                        <label class="control-label col-md-2">Sub Discipline</label>
                        <select name='general_discipline' class='form-control col-md-8' style="width:20%">
                            <?php if (!$preset_select): ?>
                                <option value='0'>Please Select Discipline</option>
                            <?php else: ?>
                                <option value='0' selected="selected" >Please Select Sub Discipline</option>
                                <?php foreach ($general_discipline as $general): ?>
                                    <option value='<?php echo $general['code']; ?>'><?php echo $general['label']; ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                        <label class="control-label col-md-2">Document Type</label>
                        <select name='doc_type' class='form-control col-md-8' style="width:20%">
                            <?php if (!$preset_select): ?>
                                <option value='0' selected="selected">Please Select Document Group</option>
                            <?php else: ?>
                                <option value='0' >Please Select Document Type</option>
                                <?php if (isset($doc_types)): ?>
                                    <?php foreach ($doc_types as $doc): ?>
                                        <option value='<?php echo $doc['code']; ?>'><?php echo $doc['label']; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            <?php endif; ?>
                        </select>
                    </div>    
                </div>
            </div>
        </div>
    </form>

    <br>

    <div class='container-fluid'>
        <div class='row'>
            <div class="col-md-offset-1 col-md-offset-1">
                <div class='panel panel-primary'>
                    <div class='panel-heading'>
                        <!--            <div class="btn-group pull-right">
                                        <a href="#" class="btn btn-default btn-xs syncButton"><i class='glyphicon glyphicon-refresh'></i> Synchronize</a>
                                    </div>-->
                        List of Template Documents</div>
                    <div class='panel-body'>
                        <div class="form-inline">
                            <div class ='pull-left' style=" font-size: smaller; padding-bottom: 3px;"><b>Total Document = <?= count($list_of_documents); ?></b></div>
                            <input type="text" class="pull-right col-sm-2 text-uppercase" style="font-size:12px;padding:5px 10px;height:25px;line-height: 1.5;border:1px solid #cccccc;border-radius:4px" id="search" placeholder="Search" hidden/>
                        </div>
                        <br><br>  
                        <div class='clearfix'></div>

                        <table id="listDoc" class='table table-bordered table-condensed'>
                            <thead>
                                <tr>
                                    <th style=" font-size: smaller;">No</th>
                                    <th style=" font-size: smaller;">Discipline</th>
                                    <th style=" font-size: smaller;">Sub Discipline</th>
                                    <th style=" font-size: smaller;">Document Group</th>
                                    <th style=" font-size: smaller;">Document Type</th>
                                    <th style=" font-size: smaller;">Document Title</th>
                                    <th style=" font-size: smaller;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!$list_of_documents): ?>
                                    <tr>
                                        <td colspan="7"><i style="font-size: 11px;">No Record Found</i></td>
                                    </tr>
                                <?php endif; ?>
                                <?php $no = 1;
                                foreach ($list_of_documents as $document): ?>
                                    <tr>
                                        <td  style=" font-size: smaller; text-align: center;"><?php echo $no;
                                    $no++; ?></td>
                                        <td  style=" font-size: smaller;"><?php echo $document['main_discipline_name']; ?></td>
                                        <td  style=" font-size: smaller;"><?php echo $document['discipline_name']; ?></td>
                                        <td  style=" font-size: smaller;"><?php echo $document['doc_group_desc']; ?></td>
                                        <td  style=" font-size: smaller;"><?php echo $document['dc_type_desc']; ?></td>
                                        <td class='text-uppercase'  style=" font-size: smaller;"><a href='<?php echo SITE_ROOT; ?>/formview/form-template/<?php echo $document['template_id']; ?>'><?php echo $document['doc_name_desc']; ?></a></td>
                                        <td class='text-center'>
                                            <div class='btn-group btn-group-xs'>
                                                <a href='<?php echo SITE_ROOT; ?>/formview/form-template/<?php echo $document['template_id']; ?>' class='btn btn-default' target="_blank">VIEW</a>
                                                <a href='<?php echo SITE_ROOT; ?>/formview/edit-form/<?php echo $document['template_id']; ?>' class='btn btn-default' target="_blank">UPDATE</a>
                                                <div data-docid="<?php echo $document['doc_name_id']; ?>" data-tempid="<?php echo $document['template_id']; ?>" data-tempdesc="<?php echo $document['doc_name_desc']; ?>" class='btn btn-default cloneForm'>CLONE</div>                                    
                                            </div>
                                        </td>
                                    </tr>
<?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id='listOfDocument2'>
    <div id="myModal" class="modal fade" role="dialog">
        <div class='col-md-12'>
            <div class="modal-dialog modal-lg">
                <!--MODAL CONTENT-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">
                            <strong><span id='inputId'></span></strong>
                        </h4>
                    </div>
                    <div class="modal-body">
                        <div style="padding-bottom:5px"class="form-inline">
                            <label style="padding-left:29px;padding-right:27px" class="control-label">Change Title</label>
                            <input class="form-control" style="height:25px;width:600px"type="text" id="doc_name_desc" name="doc_name_desc" autocomplete="off"/>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <div class='btn btn-primary btn-md edit' onclick="$('.save').submit();">Edit</div>
                        <div class='btn btn-success btn-md save'>Save</div>
                        <div class='btn btn-danger btn-md cancel'>Cancel</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        var tempid;
        var docid;
        var desc;

        $('.edit').click(function () {
            var docDesc = $('#doc_name_desc').val();
            console.log(docDesc);
            window.location.href = '<?= SITE_ROOT; ?>/main/clone_view/' + docid + '/' + docDesc + '';
            return false;
        });

        $('.cloneForm').click(function () {
            tempid = $(this).data('tempid');
            console.log('tempid', tempid);
            docid = $(this).data('docid');
            console.log('docid', docid);
            desc = $(this).data('tempdesc');
            console.log('desc', desc);
            $("#inputId").html('Duplicate ' + desc + ' ?');
            $('#myModal').modal('show');
            return false;
        });

        $('.save').click(function () {
            var docDesc = $('#doc_name_desc').val();
            console.log(docDesc);

            $.ajax({
                url: '<?= SITE_ROOT; ?>/formview/duplicate-form/',
                data: {tempid: tempid, docid: docid, desc: desc, docDesc: docDesc},
                success: function (data) {
                    swal({
                        title: "Form Created!",
                        text: "Data successfully inserted into database",
                        type: "success"
                    });
                    $('#myModal').modal('hide');
                }
            });
            setTimeout(function () {
                return false;
            }, 1200);
        });

        $('.cancel').click(function () {
            window.location.href = '<?= SITE_ROOT; ?>';
            return false;
        });

        $('#myModal').on('hidden.bs.modal', function () {
            $(this).find("input").val('').end();
        });

    });

    $(function () {
        $('[name=doc_group]').change(function () {
            var groupCode = $(this).val();
            $.ajax({
                url: '<?php echo SITE_ROOT; ?>/main/filter/',
                data: {group_code: groupCode},
                success: function (data) {
                    $('[name=doc_type]').html(data);
                    $('#documentFilter').submit();
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
                    $('#documentFilter').submit();
                }
            });
        });

        $('[name=general_discipline]').change(function () {
            $('[name=doc_group]').html('<option value="0">Please Select</option>');
            $('[name=doc_type]').html('<option value="0">Please Select</option>');
            $('#documentFilter').submit();
        });

        $('[name=doc_type]').change(function () {
            $('#documentFilter').submit();
        });
    });

    $(function () {
        $('.syncButton').click(function () {
            $.ajax({
                url: '<?php echo SITE_ROOT; ?>/main/sync/',
                success: function (data) {
                    console.log(data);
                }
            });
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

        $('#documentFilter').submit(function (e) {
            e.preventDefault();
            var values = $(this).serializeArray();
            $.ajax({
                url: '<?php echo SITE_ROOT; ?>/main/search-by-filter/',
                data: {documentValues: values},
                success: function (data) {
                    $('#listOfDocument').html(data);
                }
            });

        });
    });
</script>

<script>
    $(document).ready(function () {

        $("#search").keyup(function () {
            var value = this.value.toLowerCase().trim();

            $("table tr").each(function (index) {
                if (!index)
                    return;
                $(this).find("td").each(function () {
                    var id = $(this).text().toLowerCase().trim();
                    var not_found = (id.indexOf(value) === -1);
                    $(this).closest('tr').toggle(!not_found);
                    return not_found;
                });
            });
        });

    });
    
    $(document).ready(function () {
        var selected = $('#discipline').val();
        if (selected !== '0') {
            $('#search').removeAttr('hidden');
        }
        else {
            $('#search').addClass('hidden');
        }
    });
</script>
<?php echo $footer; ?>