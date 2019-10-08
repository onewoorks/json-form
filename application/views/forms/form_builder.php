<?php echo $header; ?>

<div id="formCreator">
    <div class="col-md-12" style="margin-left:30px">
        <div class="panel panel-default">
            <div class="panel-heading"><span style="font-size: 130%;color: #000000;">&#9312;</span>&nbsp;TITLE DETAILS<i class='glyphicon glyphicon-info-sign pull-right' title="Fill in Document Title"></i></div>
            <div class="panel-body" style="margin-bottom: -20px">
                <form id='formFilter' class='form-horizontal'>
                    <div class='form-group form-group-sm'>
                        <table class='listcolumn' style='font-size:12px;margin-left:250px;text-align:right;' >
                            <tbody>
                                <tr>
                                    <td><b>Discipline</b></td>
                                    <td>
                                        <select name='discipline' id='discipline' class='form-control col-md-10'>
                                            <option value='0' selected="selected">Please Select Discipline</option>
                                            <?php foreach ($main_discipline as $discipline): ?>
                                                <option value='<?php echo $discipline['code']; ?>'><?php echo $discipline['label']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td><b>Document Group</b></td>
                                    <td><select name='doc_group' id='doc_group' class='form-control'>
                                            <option value='0' selected="selected">Please Select Document Group</option>
                                            <?php foreach ($doc_group as $doc): ?>
                                                <option value='<?php echo $doc['code']; ?>'><?php echo $doc['label']; ?></option>
                                            <?php endforeach; ?>
                                        </select></td>
                                </tr>
                                <tr>
                                    <td><b>Sub Discipline</b></td>
                                    <td><select name='general_discipline' id='general_discipline' class='form-control'>
                                            <?php if (!$preset_select): ?>
                                                <option value='0'>Please Select Discipline</option>
                                            <?php else: ?>
                                                <option value='0' selected="selected" >Please Select Sub Discipline</option>
                                                <?php foreach ($general_discipline as $general): ?>
                                                    <option value='<?php echo $general['code']; ?>'><?php echo $general['label']; ?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select></td>
                                    <td><b>Document Type</b></td>
                                    <td><select name='doc_type' id='doc_type' class='form-control'>
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
                                        </select></td>
                                </tr>
                                <tr>
                                    <td><b>Document Title</b></td>
                                    <td>
                                        <input name="doc_name_desc" id="doc_name_desc" type="text" class="form-control docList text-uppercase" list="docList" autocomplete="off" required/>
                                        <datalist id="docList">
                                            <?php foreach ($list_of_documents as $document): ?>
                                                <option class="form-control text-uppercase" value="<?php echo $document['doc_name_desc']; ?>" data-id="<?php echo $document['doc_name_id']; ?>"><?php echo $document['doc_name_desc']; ?></option>
                                            <?php endforeach; ?>
                                        </datalist>
                                    </td>
                                    <td class='pull-left' style='margin-left: -25px'><b style='color: red'>*</b></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <?php if (!$list_of_documents): ?>
                                            <p style="font-size:10px;color:red;text-align:right">No Record Found</p>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </form>    
            </div>
        </div> 
    </div>

    <select id="section_desc_list" name="section_desc_list" class="form-control hidden">
        <?php foreach ($sections as $section): ?>
            <option value="<?php echo $section['section_desc']; ?>" data-code="<?php echo $section['section_code']; ?>" data-id="<?php echo $section['json_section']; ?>"><?php echo $section['section_desc']; ?></option>
        <?php endforeach; ?>    
    </select>

    <select id="element_desc_list" name="element_desc_list" class="form-control hidden">
        <?php foreach ($elements as $element): ?>
            <option value='<?php echo $element['element_desc']; ?>' data-id="<?php echo $element['element_code']; ?>"><?php echo $element['element_code']; ?></option>
        <?php endforeach; ?>    
    </select>

    <!--SECTION ID'S-->
    <div class="col-sm-6" style="margin-left:30px">
        <form id="sectionBuilder" class="form-horizontal">
            <div class='panel panel-default'>
                <div class='panel-heading'><span style="font-size: 130%;color: #000000;">&#9313;</span>&nbsp;SECTION DETAILS<i class='glyphicon glyphicon-info-sign pull-right' title="Insert Section by Order"></i></div>
                <div class='panel-body'>
                    <div id='sectionGroup'>
                        <div class='sectionMain1'>
                            <div class='form-group form-group-sm' >
                                <label class='control-label col-sm-4'>Section Description</label>
                                <div class='col-sm-6'>
                                    <input type='text' name='section_desc1' id="section_desc" class='form-control secList' list="secList" />
                                    <datalist name="secList" id="secList">
                                        <?php foreach ($sections as $section): ?>
                                            <option value="<?php echo $section['section_desc']; ?>" data-code="<?php echo $section['section_code']; ?>" data-id="<?php echo $section['json_section']; ?>"><?php echo $section['section_desc']; ?></option>
                                        <?php endforeach; ?>
                                    </datalist>
                                </div>
                                <div class='col-sm-2 sectionAction' data-sectionno='1'>
                                    <div class='btn btn-default btn-sm plusSection' data-sectionno='1' style='padding:4px'><i class='glyphicon glyphicon-plus'></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2 pull-right">
                        <div class="btn btn-primary btn-sm" id="addSection" data-number='1' disabled="disabled">Add Section</div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!--ELEMENT'S ID-->
    <div class="col-sm-6" style="margin-right:-30px">
        <form id="elementBuilder" class="form-horizontal">
            <div class="panel panel-default">
                <div class="panel-heading"><span style="font-size: 130%;color: #000000;">&#9314;</span>&nbsp;ELEMENT DETAILS<i class='glyphicon glyphicon-info-sign pull-right' title="1. Insert Element by Order & Click 'Save Form' &#10;2. Click 'Details' and Update Each Element's Data"></i></div>
                <div class="panel-body">
                    <div id="displaySection"></div>
                    <!--tmpt display section dlm element (DARI SCRIPT)-->
                    <!--        <div class='row'>
                            <div class='col-sm-12 text-right'>
                                <div class='btn btn-primary btn-sm' id='createForm'>Add Element</div>
                            </div>
                            </div>-->
                </div>
            </div>
        </form>
    </div>

    <!--ELEMENT POP UP-->
    <div id="myModal" class="modal fade" role="dialog">
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

    <div class="col-sm-12 pull-right" style="margin-right:-30px">
        <div class="btn btn-default pull-right addForm" disabled>Save Form</div>
    </div>
</div>

<script>
    $(function () {
        $('[name=doc_group]').change(function () {
            var groupCode = $(this).val();
            $.ajax({
                url: '<?php echo SITE_ROOT; ?>/main/filter/',
                data: {group_code: groupCode},
                success: function (data) {
                    $('[name=doc_type]').html(data);
                    $('#formFilter').submit();
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
                    $('#formFilter').submit();
                }
            });
        });
        $('[name=general_discipline]').change(function () {
            $('[name=doc_group]').html('<option value="0">Please Select</option>');
            $('[name=doc_type]').html('<option value="0">Please Select</option>');
            $('#formFilter').submit();
        });
        $('[name=doc_type]').change(function () {
            $('#formFilter').submit();
        });
    });
    $(function () {

<?php if ($preset_select): ?>
            $('[name=discipline]').val("<?php echo $preset_select['active_discipline']; ?>");
            $('[name=general_discipline]').val("<?php echo $preset_select['active_general']; ?>");
            $('[name=doc_group]').val("<?php echo $preset_select['active_group']; ?>");
            $('[name=doc_type]').val("<?php echo $preset_select['active_type']; ?>");
<?php else: ?>
            $("[name=discipline]").change();
            $("[name=doc_group]").change();
<?php endif; ?>

        $('#formFilter').submit(function (e) {
            e.preventDefault();
            var values = $(this).serializeArray();
            $.ajax({
                url: '<?php echo SITE_ROOT; ?>/main/filter-form-builder/',
                data: {documentValues: values},
                success: function (data) {
                    $('#formCreator').html(data);
                }
            });
        });
    });</script>

<script>
    $(document).ready(function () {

        $('#formFilter input').keyup(function () {

            var empty = false;
            $('#formFilter input').each(function () {
                if ($(this).val().length === 0) {
                    empty = true;
                }
            });

            if (empty) {
                $('#addSection').attr('disabled', 'disabled');
            } else {
                $('#addSection').attr('disabled', false);
            }
        });
    });

</script>

<script>
    $(document).ready(function () {
        var count = 2;
        var x;
        var y = 2;
//        $("#json").hide();
        var option = $('#section_desc_list').html();
        var option2 = $('#element_desc_list').html();
//        //DISPLAY JSON
//        $(".addTitle").click(function () {
//            $("#json").toggle();
//            var doc_name_desc = $('#doc_name_desc').val();
//            var input = $('#docList [value="' + doc_name_desc + '"]').data('id');
//            console.log('doc_name_id', input);
//            var discipline = $('#discipline :selected').text();
//            var gen_discipline = $('#general_discipline :selected').text();
//            var doc_group = $('#doc_group :selected').text();
//            var doc_type = $('#doc_type :selected').text();
//            console.log(discipline, gen_discipline, doc_group, doc_type);
//            var $html = '<div class="col-xs-2">Discipline </div>';
//            $html += '<div class="col-xs-10">: <strong>' + discipline + '</strong></div>';
//            $html += '<div class="col-xs-2">Sub Discipline </div>';
//            $html += '<div class="col-xs-10">: <strong>' + gen_discipline + '</strong></div>';
//            $html += '<div class="col-xs-2">Document Group </div>';
//            $html += '<div class="col-xs-10">: <strong>' + doc_group + '</strong></div>';
//            $html += '<div class="col-xs-2">Document Type </div>';
//            $html += '<div class="col-xs-10">: <strong>' + doc_type + '</strong></div>';
//            $html += '<div class="col-xs-2">Document Title </div>';
//            $html += '<div class="col-xs-10">: <strong>' + doc_name_desc + '</strong></div>';
//            $($html).appendTo('.jsonTitle');
//        });
        //PLUS SECTION
        $('#sectionGroup').on('click', '.plusSection', function () {
            var $section = '<div class="sectionMain' + count + '">';
            $section += '<div class="form-group form-group-sm">';
            $section += '<label class="control-label col-sm-4">Section Description</label>';
            $section += '<div class="col-sm-6">';
            $section += '<input type="text" name="section_desc' + count + '" id="section_desc" class="form-control secList" list="secList" />';
            $section += '<datalist name="secList" id="secList">' + option + '</datalist>';
            $section += '</div>';
            $section += '<div class="col-sm-2 sectionAction" data-sectionno="' + count + '">';
            $section += '<div class="btn btn-default btn-sm minusSection" data-sectionno="' + count + '" style="padding:4px"><i class="glyphicon glyphicon-minus"></i></div>';
            $section += '</div>';
            $section += '</div>';
            $section += '</div>';
            $($section).appendTo('#sectionGroup');
            count++;
        });
        //MINUS SECTION
        $('#sectionGroup').on('click', '.minusSection', function () {
            var dropid = $(this).data('sectionno');
            $('.sectionMain' + dropid).remove();
        });
        //DELETE SECTION (PANEL ELEMENT)
//        $('#displaySection').on('click', '.delSection', function () {
//            var delid = $(this).data('secid');
//            $('#section_panel' + delid).remove();
//        });
        //REMOVE ELEMENT TEXTFIELD
        $('#displaySection').on('click', '.elementDel', function () {
            var cari = $(this).closest('[class^="elementListing"]').first().attr("data", 'delete');
            $(cari).remove();
        });
        //ADD SECTION
        $('#addSection').click(function () {
            var input = $('#sectionBuilder').serializeArray();
            console.log('input', input);
            var $sectionPanel = '';
            $(input).each(function (key, value) {
                console.log('key', key);
                console.log('value', value);
                var no = key + 1;
                console.log('no', no);
                x = 1;
                var section_desc = input[key].value;
                var section_code = $('#secList [value="' + section_desc + '"]').data('code');

                //DISPLAY SECTION DLM ELEMENT PANEL
                if (input[key].value === "" || input[key].value) {
                    $sectionPanel += '<div id="section_panel' + no + '">';
                    $sectionPanel += '<div class="panel panel-primary">';
                    $sectionPanel += '<div class="panel-heading" style="height:30px">' + input[key].value + '';
//                    $sectionPanel += '<div class="btn btn-default btn-xs delSection pull-right" data-secid=' + no + '><i class="glyphicon glyphicon-trash"></i></div>';
                    $sectionPanel += '<div class="btn btn-default btn-xs expandButton pull-right" data-toggle="collapse" data-target="#demo' + no + '" ><i class="glyphicon glyphicon-chevron-down"></i></div>';
                    $sectionPanel += '</div>';
                    $sectionPanel += '<div id="demo' + no + '" class="collapse">';
                    $sectionPanel += '<div class="col-sm-4 list-padding"><input type="hidden" name="section_desc" class="form-control" value="' + input[key].value + '" disabled /></div> ';
                    $sectionPanel += '<div id="section_body' + no + '" class="panel-body">';
                    $sectionPanel += '<div class="elementDetail' + no + '" data-section="' + input[key].value + '">';
                    $sectionPanel += '<div class="elementListing1">';
                    $sectionPanel += '<label class="control-label col-sm-3">Element Name</label>';
                    $sectionPanel += '<div class="col-sm-6">';
                    $sectionPanel += '<input type="text" name="element_desc' + no + '-' + x + '" id="elementName' + no + '-' + x + '" class="form-control elemList" style="height:25px;font-size:12px" list="elemList"/>';
                    $sectionPanel += '<datalist id="elemList">' + option2 + '</datalist>';
                    $sectionPanel += '</div>';
                    $sectionPanel += '<div class="col-sm-3 sectionAction" data-target=' + no + '>';
                    $sectionPanel += '<div class="btn btn-info btn-sm addDetail" data-sectionno=' + no + '-' + x + ' data-sectionCode = "' + section_code + '" data-elementcount="1" disabled="disabled"><i></i>Details</div>';
                    $sectionPanel += '<div class="btn btn-default btn-xs plusElement" data-target=' + no + ' style="padding:3px;"><i class="glyphicon glyphicon-plus"></i></div>'; //tambah element
                    $sectionPanel += '<br><br>';
                    $sectionPanel += '</div>';
                    $sectionPanel += '</div>';
                    $sectionPanel += '</div>';
                    $sectionPanel += '</div>';
                    $sectionPanel += '</div>';
                    $sectionPanel += '</div>';
                    $sectionPanel += '</div>';
                }
                //TMBH KT JSON DISPLAY
                var json_section = $('#secList [value="' + input[key].value + '"]').data('id');
                var section_code = $('#secList [value="' + input[key].value + '"]').data('code');
                var $html = '<div class="col-sm-12">';
                $html += '<div>"json_section": "' + json_section + '"</div>';
                $html += '<div>"section_code": "' + section_code + '"</div>';
                $html += '<div>"section_desc": "' + input[key].value + '"</div>';
                $html += '<div>"section_sorting": "' + no + '"</div>';
                $html += '</div><br><br><br><br><br>';
                $($html).appendTo('.jsonSection');
            });
            $('#displaySection').html($sectionPanel);
            $('.addForm').attr('disabled', false);
        });

        //PLUS ELEMENT
        $('#displaySection').on('click', '.plusElement', function () {
            var no = $(this).data('target');
            console.log('plusElement No', no);

            var section_desc = $(this).closest('[class^=elementDetail]').attr('data-section');
            var section_code = $('#secList [value="' + section_desc + '"]').data('code');

            var $addPanel = '<div class="elementListing' + y + '">';
            $addPanel += '<label class="control-label col-sm-3">Element Name</label>';
            $addPanel += '<div class="col-sm-6">';
            $addPanel += '<input type="text" name="element_desc' + no + '-' + y + '" id="elementName' + no + '-' + y + '" class="form-control elemList" style="height:25px;font-size:12px" list="elemList"/>';
            $addPanel += '<datalist id="elemList">' + option2 + '</datalist>';
            $addPanel += '</div>';
            $addPanel += '<div class="col-sm-3 sectionAction" data-target=' + y + '>';
            $addPanel += '<div class="btn btn-info btn-sm addDetail" data-sectionno=' + no + '-' + y + ' data-sectionCode = "' + section_code + '" data-elementcount="0" disabled="disabled"><i></i>Details</div>';
            $addPanel += '<div class="btn btn-default btn-xs elementDel" data-delete=' + y + ' style="padding:3px;"><i class="glyphicon glyphicon-minus"></i></div><br><br>'; //remove element
            $addPanel += '</div>';
            $addPanel += '</div>';
            $addPanel += '</div>';

            $($addPanel).appendTo('.elementDetail' + no); //DLM PANEL ELEMENT (FUNCTION NI)
            y++;

        });


    }); //end of document.ready

    $(function () {

        //BUTTON DETAILS  
        $('#displaySection').on('click', '.addDetail', function () {
            var doc_name_desc = $('#doc_name_desc').val();
            var docId = $('#docList [value="' + doc_name_desc + '"]').data('id');
            console.log('Display doc_name_id', docId);
            var data = $(this).attr('data-sectionno');
            console.log('data', data);
            var div = $(this).closest('div[class^="col-sm-6"]').find('input[id^="elementName' + data + '"]').val();
            console.log('div', div);
            var elemCode = $('#elemList [value="' + div + '"]').data('id');
            console.log('elemCode', elemCode);
            var sectCode = $(this).attr('data-sectionCode');
            console.log('sectCode', sectCode);
            $.ajax({
                url: '<?= SITE_ROOT; ?>/formview/new-doc-element/',
                data: {div: div, docId: docId, elemCode: elemCode, sectCode: sectCode},
                success: function (data) {
                    var obj = $.parseJSON(data);
                    $('.modal-title').text(obj.component);
                    $('.modal-body').html(obj.html);
                }
            });
            $('#myModal').modal('show');
            return false;
        });
    });
</script>

<script>
    $(".addForm").click(function () {

        $('.addDetail').attr('disabled', false);

        $.ajax({
            url: '<?= SITE_ROOT; ?>/formview/update-new-form/',
            type: 'POST',
            data: {dummy: null, docDetail: JSON.stringify($('#formFilter').serializeArray()), secDetail: JSON.stringify($('#sectionBuilder').serializeArray()), elemDetail: JSON.stringify($('#elementBuilder').serializeArray())},
            success: function (data) {
                console.log(data);
                $('#myModal').modal('hide');
                swal({
                    title: "Section & Element Inserted !",
                    text: "Data successfully inserted into database",
                    type: "success"
                });
            }
        });

        $('.addForm').attr('disabled', 'disabled');
        $('.plusElement').attr('disabled', 'disabled');
        $('.elementDel').attr('disabled', 'disabled');

    });
</script>

<?php echo $footer; ?>