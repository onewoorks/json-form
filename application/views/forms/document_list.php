<?php echo $header; ?>
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>        

<div id='listOfDocument' >
    <form id='documentFilter' class='form-horizontal col-md-offset-2 col-md-offset-2'>
        <div class='form-group form-group-sm'>
            <div class="col-md-12">
                <div class='form-row'>
                    <div class='form form-inline'>
                        <div class="form-group col-md-4 text-right" >    
                            <label class="control-label ">Discipline</label>
                            <select name='discipline' id='discipline' class='form-control' style="width:55%; background-color:#FFFF99"> 
                                <option value='0' selected="selected">Please Select Discipline</option>
                                <?php foreach ($main_discipline as $discipline): ?>
                                    <option value='<?php echo $discipline['code']; ?>'><?php echo $discipline['label']; ?></option>
                                <?php endforeach; ?>
                            </select>&nbsp;<b style='color: red'>*</b>
                        </div> 

                        <div class="form-group col-md-4 text-right">    
                            <label class="control-label" >Document Group</label>
                            <select name='doc_group' class='form-control' style="width:55%; background-color:#FFFF99">
                                <option value='0' selected="selected">Please Select Document Group</option>
                                <?php foreach ($doc_group as $doc): ?>
                                    <option value='<?php echo $doc['code']; ?>'><?php echo $doc['label']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            &nbsp;<span style='color: red'>*</span>
                        </div>

                    </div>
                </div>
            </div>

            <br><br>

            <div class="col-md-12">
                <div class='form-row'>
                    <div class='form form-inline' >
                        <div class="form-group col-md-4 text-right">
                            <label class="control-label">Sub Discipline</label>
                            <select name='general_discipline' class='form-control' style="width:55%; background-color:#FFFF99">
                                <?php if (!$preset_select): ?>
                                    <option value='0'>Please Select Discipline</option>
                                <?php else: ?>
                                    <option value='0' selected="selected" >Please Select Sub Discipline</option>
                                    <?php foreach ($general_discipline as $general): ?>
                                        <option value='<?php echo $general['code']; ?>'><?php echo $general['label']; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>&nbsp;<b style='color: red'>*</b>
                        </div> 

                        <div class="form-group col-md-4 text-right">    
                            <label class="control-label" >Document Type</label>
                            <select name='doc_type' class='form-control' style="width:55%; background-color:#FFFF99">
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
                            &nbsp;<span style='color: red'>*</span>
                        </div>
                    </div>    
                </div>
            </div>
            <br><br>
            <div class="col-md-12">
                <div class='row'>
                    <div class='form-inline'>
                        <label class="control-label" style="margin-left:87px">Document Title</label>
                        <input type="text" name="doc_name_desc" id='doc_name_desc1'  data-no ='1' class="form-control text-uppercase" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" style="width:56.2%; background-color:#FFFF99; margin-left: 5px"/>
                        &nbsp;<b style='color: red'>*</b>
                        <br>
                        <span id='validateF1' style="margin-left:181px;font-size:10px;color:red;text-align:left" hidden>Record Found</span>
                        <span id='validateT1'  style="margin-left:181px;font-size:10px;color:green;text-align:left" hidden>No Record Found</span>
                        <span id='validateFY1' style="margin-left:181px;font-size:10px;color:red;text-align:left" >Please select all Mandatory Field above</span>
                        <select id='list_doc_desc' class='form-control hidden'>
                            <?php foreach ($list_of_titles as $titles): ?>
                                <option value='<?php echo $titles['doc_name_desc']; ?>'><?php echo $titles['doc_name_desc']; ?></option>
                            <?php endforeach; ?>
                        </select>  
                    </div>
                </div>    
            </div>
        </div>

        <div class='col-sm-10 text-right' style='margin-left:-85px'>
            <div class='btn btn-primary btn-sm addForm' disabled="disabled">Add Form</div>
        </div>
        <br>
    </form>

    <br>

    <!--    <div class='container-fluid'>-->
    <div class='container-fluid col-md-12' style='margin-left: 45px;'>
        <div class='row'>
            <div class='panel panel-primary'>
                <div class='panel-heading'>
                    List of Template Documents</div>
                <div class='panel-body'>
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
                                <th style=" font-size: smaller;">Status</th>
                                <th style=" font-size: smaller;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                            <?php
                            $no = 1;
                            foreach ($list_of_documents as $document):
                                ?>
                                <tr>
                                    <td  style=" font-size: smaller; text-align: center;"><?php
                                        echo $no;
                                        $no++;
                                        ?></td>
                                    <td  style=" font-size: smaller;"><?php echo $document['main_discipline_name']; ?></td>
                                    <td  style=" font-size: smaller;"><?php echo $document['discipline_name']; ?></td>
                                    <td  style=" font-size: smaller;"><?php echo $document['doc_group_desc']; ?></td>
                                    <td  style=" font-size: smaller;"><?php echo $document['dc_type_desc']; ?></td>
                                    <td class='text-uppercase'  style=" font-size: smaller;"><a href='<?php echo SITE_ROOT; ?>/formview/form-template/<?php echo $document['template_id']; ?>'><?php echo $document['doc_name_desc']; ?></a></td>
                                     <td class='text-uppercase'  style=" font-size: smaller;">
                                        <?php if ($document['available']) : ?>
                                            <input type="checkbox" data-toggle="toggle"  name="opt1" class="docStatus" id="<?php echo $document['doc_name_id']; ?>"  data-size="mini" data-onstyle="success" data-offstyle="danger" checked="checked">
                                        <?php else : ?>
                                            <input type="checkbox" data-toggle="toggle"  name="opt2" class="docStatus" id="<?php echo $document['doc_name_id']; ?>"  data-size="mini" data-onstyle="success" data-offstyle="danger" >
                                        <?php endif; ?>
                                    </td>
                                    <td class='text-center'>
                                        <div class='btn-group btn-group-xs'>    
                                            <a href='<?php echo SITE_ROOT; ?>/formview/edit-form-new/<?php echo $document['template_id']; ?>' class='btn btn-default' >EDIT</a>
                                            <div data-docid="<?php echo $document['doc_name_id']; ?>" data-tempid="<?php echo $document['template_id']; ?>" data-tempdesc="<?php echo $document['doc_name_desc']; ?>" class='btn btn-default cloneForm'>CLONE</div>                                    
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!--            </div>-->
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
                        <div style="padding-bottom:5px" class="form-inline">
                            <label style="padding-left:29px;padding-right:27px" class="control-label">Change Title</label>
                            <input id="doc_name1" name="doc_name" data-no="1" class="form-control text-uppercase" onkeyup="this.value = this.value.toUpperCase();" style="height:25px;width:600px;background-color:#FFFF99" type="text"  autocomplete="off"/>
                            &nbsp;<b style='color: red'>*</b>
                            <br>
                            <span id='validateFF1' style="margin-left:132px;font-size:10px;color:red;text-align:left" hidden>Record Found</span>
                            <span id='validateTT1' style="margin-left:132px;font-size:10px;color:green;text-align:left" hidden>No Record Found</span>
                            <select id='list_doc' class='form-control hidden'>
                                <?php foreach ($list_of_titles as $titles): ?>
                                    <option value='<?php echo $titles['doc_name_desc']; ?>'><?php echo $titles['doc_name_desc']; ?></option>
                                <?php endforeach; ?>
                            </select> 
                        </div>

                    </div>
                    <div class="modal-footer">
                        <div class='btn btn-success btn-md save' disabled="disabled" >Save</div>
                        <div class='btn btn-danger btn-md' data-dismiss="modal">Cancel</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--ELEMENT POP UP-->
    <div id="myModalNew" class="modal fade" role="dialog">
        <div class='col-md-12'>
            <div class="modal-dialog modal-lg">
                <!--MODAL CONTENT-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">
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
//            console.log(docDesc);
            window.location.href = '<?= SITE_ROOT; ?>/main/clone_view/' + docid + '/' + docDesc + '';
            return false;
        });

        $('.cloneForm').click(function () {
            tempid = $(this).data('tempid');
//            console.log('tempid', tempid);
            docid = $(this).data('docid');
//            console.log('docid', docid);
            desc = $(this).data('tempdesc');
//            console.log('desc', desc);
            $("#inputId").html('Duplicate ' + desc + ' ?');
            $('#myModal').modal('show');
            return false;
        });

        $('.save').click(function () {
            var docDesc = $('#doc_name1').val();
//            console.log(docDesc);

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
            setTimeout(
                    function () {
                        window.location.reload(true);
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
//                    console.log(data);
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
                url: '<?php echo SITE_ROOT; ?>/main/create-filter/',
                data: {documentValues: values},
                success: function (data) {
//                    console.log("data", data);
                    $('#listOfDocument').html(data);
                    $('#listDoc').DataTable(data);
                }
            });
        });

        //ADDFORMBUTTON
        $('.addForm').click(function () {

            var values = $('#documentFilter').serializeArray();
            var dis = $("#discipline").val();
            var subDis = $("#general_discipline").val();
            var docGroup = $("#doc_group").val();
            var docType = $("#doc_type").val();
            var docName = $("#doc_name_desc").val();
//            console.log(values);
            $(this).text('Creating new title...');
            $('.addForm').attr('disabled', 'disabled');

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
                    }, 1000);

        });

    });
</script>
<script>
    $(document).ready(function () {

        $('#documentFilter input').keyup(function () {
            var dis = $('[name=discipline]').val();
            var subDis = $('[name=general_discipline]').val();
            var docGroup = $('[name=doc_group]').val();
            var docType = $('[name=doc_type]').val();
            var empty = false;

            $('#documentFilter input').each(function () {
                if ($(this).val().length === 0) {
                    empty = true;
                }
            });

            if (empty) {
                if ((dis, subDis, docGroup, docType) === '0') {
                    $('.addForm').attr('disabled', true);
                }
            } else {
                if ((dis, subDis, docGroup, docType) !== '0') {
                    $('.addForm').attr('disabled', false);
                }
            }
        });
    });
</script>
<script>
    //add new form
    $(document).ready(function () {

        var selText;
        var array = [];

        var thisValue;

        $("#list_doc_desc option").each(function () {
            var $this = $(this);
            selText = $this.text();
            array.push(selText);
        });

        $(document).on('focus', 'input', function () {
            thisValue = $(this).attr('data-no');

            $('#doc_name_desc' + thisValue).keyup(function () {
                var str = $(this).val();
//                console.log("string", str);

                if (str !== "") {
                    if (array.indexOf(str) > -1) {
                        $('#validateT' + thisValue).attr('hidden', 'hidden');
                        $('#validateF' + thisValue).attr('hidden', false); //record found
                        $('#validateFY' + thisValue).attr('hidden', true);
                        $('.addForm').attr('disabled', true);
                    } else {
                        $('#validateT' + thisValue).attr('hidden', false); //no record found
                        $('#validateF' + thisValue).attr('hidden', 'hidden');
                        $('#validateFY' + thisValue).attr('hidden', true);
                    }
                } else {
                    $('#validateT' + thisValue).attr('hidden', 'hidden');
                    $('#validateF' + thisValue).attr('hidden', 'hidden');
                    $('.addForm').attr('disabled', 'disabled');
                }
            });
        });//endOfFocus
    });//endOfDocument
</script>   
<script>
    $(document).ready(function () {
        //clone form
        var selText;
        var array = [];

        var thisValue;

        $("#list_doc option").each(function () {
            var $this = $(this);
            selText = $this.text();
            array.push(selText);
        });

        $(document).on('focus', 'input', function () {
            thisValue = $(this).attr('data-no');

            $('#doc_name' + thisValue).keyup(function () {
                var str = $(this).val();

                if (str !== "") {
                    if (array.indexOf(str) > -1) {
                        $('#validateTT' + thisValue).attr('hidden', 'hidden');
                        $('#validateFF' + thisValue).attr('hidden', false);
                        $('.save').attr('disabled', true);
                    } else {
                        $('#validateTT' + thisValue).attr('hidden', false);
                        $('#validateFF' + thisValue).attr('hidden', 'hidden');
                        $('.save').attr('disabled', false);
                    }
                    //  $('.addForm').attr('disabled', false);
                } else {
                    $('#validateTT' + thisValue).attr('hidden', 'hidden');
                    $('#validateFF' + thisValue).attr('hidden', 'hidden');
                    $('.save').attr('disabled', true);
                }
                return false;
            });
        });//endOfFocus
    });//endOfDocument
</script>   
<?php echo $footer; ?>