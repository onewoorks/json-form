<?php echo $header; ?>
<div id="formCreator">
    <div class="col-md-12" style="margin-left:30px">
        <div class="panel panel-default">
            <div class="panel-heading"><span style="font-size: 130%;color: #000000;">&#9312;</span>&nbsp;TITLE DETAILS<i class='glyphicon glyphicon-info-sign pull-right' title="Fill in Document Title"></i></div>
            <div class="panel-body" style="margin-bottom: -10px">
                <form id='formFilter' class='form-horizontal'>
                    <div class='form-group form-group-sm' >
                        <label class='control-label col-sm-3'>Document Title</label>
                        <div class='col-sm-4'>
                            <input name="doc_template" id="doc_template"  value="<?= $template_id; ?>" type="hidden"  class="form-control docList text-uppercase" />
                            <input name="doc_name_id" id="doc_name_id"  value="<?= $document_id; ?>" type="hidden"  class="form-control docList text-uppercase" />
                            <input name="doc_name_desc" id="doc_name_desc"  value="<?= $document_title; ?>" type="text"  class="form-control docList text-uppercase"/>
                        </div>
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
                                <label class='control-label col-sm-4'>Section Name</label>
                                <div class='col-sm-6'>
                                    <input type='text' name='section_desc1' id="section_desc" class='form-control text-uppercaseupper secList' onkeyup="this.value = this.value.toUpperCase();" list="secList" />
                                    <datalist id="secList">
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
                        <div class="btn btn-primary btn-sm" id="addSection" data-number='1' >Add Section</div>
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

    <div class="col-sm-12 pull-right" style="margin-right:-37px">
        <div class='text-right'>
            <div class='btn-group btn-group-sm'>
                <a class="btn btn-primary btn-sm backForm" href="<?php echo SITE_ROOT; ?>/formview/edit-form-new/<?php echo $template_id; ?>'" ><i class='glyphicon glyphicon-arrow-left'></i> Back</a>
            </div>  
            <div class='btn-group btn-group-sm'>
                <a href='#' class="btn btn-primary btn-sm addForm" /><i class='glyphicon glyphicon-floppy-disk'></i> Save</a> 
            </div>
            <div class='btn-group btn-group-sm'>
                <a class="btn btn-primary btn-sm genForm"><i class='glyphicon glyphicon-send'></i> Generate JSON</a>
            </div>
            <div class='btn-group btn-group-sm'>
                <a class="btn btn-primary btn-sm viewForm"  ><i class='glyphicon glyphicon-send'></i> Preview</a>
            </div>
        </div>
    </div>
</div>
<div></div>

<div id="viewForm" data-toggle="modal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header no-border">	
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body"></div>
        </div>
    </div>
</div>



<script>
    $(document).ready(function () {
        var count = 2;
        var x;
        var y = 2;
//        $("#json").hide();
        var option = $('#section_desc_list').html();
        var option2 = $('#element_desc_list').html();

        //PLUS SECTION
        $('#sectionGroup').on('click', '.plusSection', function () {
            var $section = '<div class="sectionMain' + count + '">';
            $section += '<div class="form-group form-group-sm">';
            $section += '<label class="control-label col-sm-4">Section Name</label>';
            $section += '<div class="col-sm-6">';
            $section += '<input type="text" name="section_desc' + count + '" id="section_desc" class="form-control text-uppercaseupper secList" onkeyup="this.value = this.value.toUpperCase();" list="secList" />';
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
        //REMOVE ELEMENT TEXTFIELD
        $('#displaySection').on('click', '.elementDel', function () {
            var cari = $(this).closest('[class^="elementListing"]').first().attr("data", 'delete');
            $(cari).remove();
        });
        //ADD SECTION
        $('#addSection').click(function () {
            var input = $('#sectionBuilder').serializeArray();
            //  console.log('input', input);
            var $sectionPanel = '';
            $(input).each(function (key, value) {
//                console.log('key', key);
//                console.log('value', value);
                var no = key + 1;
//                console.log('no', no);
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
//            console.log('plusElement No', no);

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
        $('#displaySection').on('click', '.addDetail', function (e) {
            e.preventDefault();
            var docId = '<?= $document_id; ?>';
            console.log('Display doc_name_id', docId);
            var data = $(this).attr('data-sectionno');
//            console.log('data', data);
            var div = $(this).closest('div[class^="col-sm-6"]').find('input[id^="elementName' + data + '"]').val();
//            console.log('div', div);
            var elemCode = $('#elemList [value="' + div + '"]').data('id');
//            console.log('elemCode', elemCode);
            var sectCode = $(this).attr('data-sectionCode');
//            console.log('sectCode', sectCode);
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
//            return false;
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

    $(".genForm").click(function () {

        var selected = [];
        var type = 'regenerate';

        $('#doc_name_id').each(function (key, documentId) {
            $('#doc_template').each(function (key, templateId) {

                var item = {doc_name_id: $(documentId).val(), template_id: $(templateId).val()};
                selected.push(item);
                console.log(item);
            });
        });
        $.ajax({
            url: '<?= SITE_ROOT; ?>/formbuilder/generate-json/',
            data: {type: type, documents: selected},
            success: function (data) {
                swal({
                    title: "Generated!",
                    text: "System successfully created form template for selected data,",
                    type: "success"
                });
            }
        });
    });

    $('.viewForm').click(function () {

        var templateId = '<?= $template_id; ?>';
        console.log(templateId);
        $.ajax({
            method: 'GET',
            url: '<?= SITE_ROOT; ?>/formview/form-template-view/' + templateId,
            success: function (event) {
                $('.modal-body').html(event);
            }
        });

        $('#viewForm').modal('show');
        return false;
    });
</script>
<?php echo $footer; ?>