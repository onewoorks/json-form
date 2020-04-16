<?php echo $config; ?>

<div class="row">
    <form id="notesForm">
        <div class="col-md-12">
            <div id='maintitle' style="padding-left: 15px">
                <div class="form-inline ">
                    <input type='hidden' name='doc_name_id' value='<?= $document_id;?>' />
                    <input type='hidden' name='template_id' value='<?= $template_id;?>' />
                    <label class='control-label text-uppercase' style='padding: 15px;font-size: 15px'><b><?php echo $document_title; ?></b></label>
                    <div class="btn btn-default btn-sm editTitle" style='padding:3px' title="Rename Title"><i class='glyphicon glyphicon-pencil'></i></div>
<!--                <div class="btn btn-default btn-sm newSection" style='padding: 3px' title="Add New Section" ><i class='glyphicon glyphicon-plus-sign' style="position: inherit"></i></div>-->
                    <div class="btn btn-default btn-sm updateSection" style="margin-top:0px">Update Section Sorting</div>
                    <div class="btn btn-default btn-sm updateElement" style="margin-top:0px">Update Element Sorting</div>
                </div>
            </div>
            <br><br>
            <!--Add New Section Panel-->
            <div id='newSection' class="panel-group col-md-9" style="display:none" role="tablist" >
                <div class="panel panel-default dragble" data-section='1' style='margin-bottom:-5px;cursor:move'>
                    <div class="panel-heading" role="tab" id="collapseListGroupHeading1"  style='margin-bottom:20px'>
                        <div id='sectionGroup'>
                            <div class="sectionMain1" style="margin-bottom: 10px">
                                <div class='form-group form-group-sm' style="background-color: #f5f5f5">
                                    <label class='control-label col-md-2' style='padding-top:7px;text-align: left'  data-sectioncode=''>Section Name</label>                                        
                                    <input  type='text' name='section_desc1' id="section_desc" style="margin-top:3px; height:23px ; width: 250px" class='form-control col-md-4 secList' list="secList" />
                                    <datalist id="secList">
                                        <?php foreach ($sections as $section): ?>
                                            <option value="<?php echo $section['section_desc']; ?>" data-code="<?php echo $section['section_code']; ?>" data-id="<?php echo $section['json_section']; ?>"><?php echo $section['section_desc']; ?></option>
                                        <?php endforeach; ?>
                                    </datalist>
                                    &nbsp;
                                    <div class="btn btn-default btn-sm plusSection" data-sectionno='1' style='padding: 4px ; margin-top: 2.5px ; margin-left: -3px' title="Add New Section" ><i class='glyphicon glyphicon-plus' style="position: inherit"></i></div> 
                                    <div class="btn btn-primary btn-sm addSection disabled" style="margin-top:3px" >Add Section</div>
                                    <div class="btn-group pull-right" style="margin-top: -3px;margin-right:-10px">    
                                        <button type="button" class="close closeNewSection" >&times;</button>
                                    </div>
                                </div>
                               </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--<SECTION & ELEMENT LIST>-->
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

            <!--Display Section & Element Sorting-->
            <div id="panel-group1" class="panel-group col-md-9" role="tablist">
                <?php foreach ($json_elements as $key => $section): 
                    $sectionKod = $section->section_code;?>
                    <div class="panel panel-default dragble" data-section='<?= $key; ?>' style="cursor:move">
                        <div class="panel-heading" role="tab" id="collapseListGroupHeading1" style='margin-bottom:-5px'>
                            <div class="panel-title" style="font-size:12.5px">
                                <input type='hidden' name="sectionList[]" data-section='<?= $key; ?>' value='<?= $section->section_code; ?>'>
                                <?php if ($section->section_code != '0'):?>
                                    <a href="#collapseListGroup1" role="button" data-toggle="collapse"  aria-expanded="true"  data-section='<?= $key; ?>'><?= $section->section_desc; ?>&nbsp;<i class="glyphicon glyphicon-move" style="font-size:11px;"></i></a>
                                <?php else: ?>
                                    <a href="#collapseListGroup1" role="button" data-toggle="collapse"  aria-expanded="true"  data-section='<?= $key; ?>'>&nbsp;<i class="glyphicon glyphicon-move" style="font-size:11px;"></i></a>
                                <?php endif; ?>
                                <div class="btn-group pull-right" style="margin-top: -3px;margin-right:-10px">        
                                    <a class="btn btn-default btn-sm editSection" style='padding:3px' data-section='<?= $key; ?>' data-sectioncode='<?= $section->section_code; ?>' title="Rename Section"><i class='glyphicon glyphicon-pencil'></i></a>
                                    <a class="btn btn-default btn-xs addElement" style='padding:2px' data-sectioncode='<?php echo $sectionKod; ?>'  ><i class='glyphicon glyphicon-plus-sign'></i> Add Element</a>
                                    <a class="btn btn-default btn-xs expandButton" style='padding:2px' data-section='<?= $key; ?>' data-current='expand'><i class='glyphicon glyphicon-resize-full'></i> Expand</a>
                              </div>
                            </div>
                        </div>

                        <!--Add New Element Panel-->
                        <div class="panel-collapse collapse in hidden" role="tabpanel" id="collapseListGroup1" style="margin-top:10px"aria-labelledby="collapseListGroupHeading1" data-section='<?= $key; ?>' data-sectioncode='<?= $section->section_code; ?>'>
                            <div class="list-group" data-sectionkey='<?= $key; ?>' data-sectioncode='<?= $section->section_code; ?>'>
                                <?php
                                $column = $section->layout;
                                switch ($column):
                                    case '1': $set = 12;
                                        ?>
                                        <?php
                                        foreach ($section->elements as $elem => $element): $thecode = $element->element_code;
                                            if ($element->element_code === $element->child_element_code):
                                                ?>
                                                <div class='form-group form-group-sm' data-elemsort='<?= $elem; ?>'style='border:1px solid #ccc; margin:4px;cursor:move;display: inline-block;width:99%'>
                                                    <label class='control-label col-md-6' style='margin:6px;text-align: right' data-elem="<?= $element->element_code; ?>" data-sectioncode='<?= $section->section_code; ?>'><?= $element->element_desc; ?></label>
                                                    <div class='btn btn-link editElement' data-elementid='<?= $element->element_code; ?>' data-sectioncode='<?php echo $sectionKod; ?>'>Edit</div>
                                                    <div class='btn btn-link deleteElement' data-elementid='<?= $element->element_code; ?>' data-sectioncode='<?php echo $sectionKod; ?>' data-docid='<?= $document_id; ?>' ><i class='glyphicon glyphicon-remove'></i></div>
                                                </div>
                                            <?php else: ?>

                                                <div class='form-group form-group-sm' data-elemsort='<?= $elem; ?>'style='border:1px solid #ccc; margin:4px;cursor:move;display: inline-block;width:99%'>
                                                   <ul style="margin:3px; margin-right: -20px">
                                                        <label class='control-label col-md-6' style='padding-top:7px;text-align: right;color:#737373' data-elem="<?= $element->element_code; ?>" data-sectioncode='<?= $section->section_code; ?>'><?= $element->element_desc; ?></label>
                                                        <div class='btn btn-link editElement' data-elementid='<?= $element->element_code; ?>' data-sectioncode='<?php echo $sectionKod; ?>'>Edit</div>
                                                        <div class='btn btn-link deleteElement' data-elementid='<?= $element->element_code; ?>' data-sectioncode='<?php echo $sectionKod; ?>' data-docid='<?= $document_id; ?>' ><i class='glyphicon glyphicon-remove'></i></div>
                                                    </ul>
                                                </div>

                                            <?php
                                            endif;
                                        endforeach;
                                        ?>

                                        <?php
                                        break;
                                    case '2': $set = 12;
                                        ?>
                                        <?php
                                        for ($x = 1; $x <= 2; $x++):
                                            if ($x == 1) {
                                                $position = 'L';
                                                $dir = 'left-defaults';
                                            } elseif ($x == 2) {
                                                $position = 'R';
                                                $dir = 'right-defaults';
                                            }
                                            ?>
                                            <?php foreach ($section->elements as $elem => $element): if ($element->element_position === $position):$thecode = $element->element_code;
                                                    if ($element->element_code === $element->child_element_code):?> 
                                                        <div class='form-group form-group-sm'  data-elemsort='<?= $elem; ?>' style='border:1px solid #ccc;margin:4px;padding-top:5px;cursor:move;display: inline-block;width:99%'>
                                                            <label class='control-label col-md-6' style='margin:6px;text-align: right' data-elem="<?= $element->element_code; ?>" data-sectioncode='<?= $section->section_code; ?>'><?= $element->element_desc; ?></label>
                                                            <div class='btn btn-link editElement' data-elementid='<?= $element->element_code; ?>' data-sectioncode='<?php echo $sectionKod; ?>'>Edit</div>
                                                            <div class='btn btn-link deleteElement' data-elementid='<?= $element->element_code; ?>' data-sectioncode='<?php echo $sectionKod; ?>' data-docid='<?= $document_id; ?>' ><i class='glyphicon glyphicon-remove'></i></div>
                                                        </div>    
                                                    <?php else: ?>

                                                        <div class='form-group form-group-sm' data-elemsort='<?= $elem; ?>'style='border:1px solid #ccc; margin:4px;cursor:move;display: inline-block;width:99%'>
                                                           <ul style="margin:3px; margin-right: -20px">
                                                                <label class='control-label col-md-6' style='padding-top:7px;text-align: right;color:#737373' data-elem="<?= $element->element_code; ?>" data-sectioncode='<?= $section->section_code; ?>'><?= $element->element_desc; ?></label>
                                                                <div class='btn btn-link editElement' data-elementid='<?= $element->element_code; ?>' data-sectioncode='<?php echo $sectionKod; ?>'>Edit</div>
                                                                <div class='btn btn-link deleteElement' data-elementid='<?= $element->element_code; ?>' data-sectioncode='<?php echo $sectionKod; ?>' data-docid='<?= $document_id; ?>' ><i class='glyphicon glyphicon-remove'></i></div>
                                                            </ul>
                                                        </div>
                                                    <?php
                                                    endif;
                                                endif;
                                            endforeach;
                                            ?>
                                        <?php endfor; ?>
                                        <?php
                                        break;
                                endswitch;
                                ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class='col-md-3' style="position: fixed; z-index: 6; right: 0; margin-left: 10px; margin-top: 50px;">
            <div class='text-center'>
                 <div class='btn-group btn-group-sm'>
                    <a class="btn btn-primary btn-sm backForm" href="<?php echo SITE_ROOT; ?>" ><i class='glyphicon glyphicon-arrow-left'></i> Back</a>
                </div>
                <div class='btn-group btn-group-sm'>
                    <input type='hidden' id='documentId' value='<?= $document_id; ?>'/>
                    <input type='hidden' id='templateId' value='<?= $template_id; ?>'/>
                    <a href='#' class="btn btn-primary btn-sm executeAction" /><i class='glyphicon glyphicon-floppy-disk'></i> Save</a> 
                </div>
                <div class='btn-group btn-group-sm'>
                    <a class="btn btn-primary btn-sm " href='<?php echo SITE_ROOT; ?>/formview/form-template-preview/<?php echo $template_id; ?>'><i class='glyphicon glyphicon-send'></i> Preview</a>
                </div>
                <div class='btn-group btn-group-sm'>
                    <a class="btn btn-primary btn-sm" href='<?php echo SITE_ROOT; ?>/formview/build-form/<?php echo $template_id; ?>'><i class='glyphicon glyphicon-send'></i> Build Form</a>
                </div>
            </div>
        </div>
        <br><br>
        <div class='col-md-3' style="position: fixed; z-index: 6; right: 15; margin-left: 10px; margin-top: 50px;">
            <div class='panel panel-default'>
                <div class='panel-heading'><b>Navigation</b></div>
                <div class='panel-body' >
                    <ul class='list-unstyled'  style=" font-size: 12.5px;">
                        <?php foreach ($json_elements as $key => $section): ?>
                            <li><input type='checkbox' class='selectedsection' name="total" id="total" data-sectioncode="<?= $section->section_code ?>" value="<?= $key; ?>" checked /><?= $section->section_desc; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>

    </form>
</div>

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal </h4>
            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>

<div id="layout" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Change Layout </h4>
            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>

<div id="title" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!--Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Change Title</h4>
            </div>
            <div class="modal-body"></div>
        </div>
    </div>
</div>

<div id="deleteModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!--Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Delete Element</h4>
            </div>
            <div class="modal-body"></div>
        </div>
    </div>
</div>

<div id="viewForm" data-toggle="modal"class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header" >	
	    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	</div>
        <div class="modal-body"></div>
    </div>
  </div>
</div>
<script>
    function byId(id) {
        return document.getElementById(id);
    }
    Sortable.create(byId('panel-group1'), {
        animation: 150,
        draggable: '.panel',
        handle: '.panel-heading'
    });

    [].forEach.call(byId('panel-group1').getElementsByClassName('list-group'), function (el) {
        Sortable.create(el, {
            group: 'photo',
            animation: 150
        });
    });
</script>

<script>
    $(function () {

        $('.updateSection').click(function () {
            var docId = '<?= $document_id; ?>';
            var section = [];
            $('input[name="sectionList[]"]').each(function () {
                section.push(this.value);
            });
            console.log(section);
            var total = $('#notesForm').serializeArray();

            $.ajax({
                url: '<?= SITE_ROOT; ?>/formview/update-attributes/',
                data: {docId: docId, section: section, total: total},
                success: function () {
                    $('#myModal').modal('hide');
                    swal({
                        title:"Section Sorting Updated!",
                        text: "Data successfully updated into database",
                        type: "success"
                    });
                }
            });
        });

        $('.updateElement').click(function () {
            var docId = JSON.stringify(<?= $document_id; ?>);
            var data_array = [];
            data_array.push({'docId': docId});
            $(".list-group").each(function () {
                var section = $(this).attr('data-sectioncode');

                $(this).find('label.control-label').each(function () {
                    var current = $(this).attr('data-sectioncode');
                    for (var i in $(this).data()) {
                        var element = $(this).data(i);
                    }
                    data_array.push({'section': section, 'element': element, 'current': current});
                });
            });

            var curr_data = JSON.stringify(data_array);
            console.log('curr_data', curr_data);

            $.ajax({
                url: '<?= SITE_ROOT; ?>/formview/update-attributes2/',
                type: 'POST',
                data: {data_array: curr_data},
                success: function () {
                    $('#myModal').modal('hide');
                    swal({
                        title: "Element Sorting Updated!",
                        text: "Data successfully updated into database",
                        type: "success"
                    });
                }
            });
        });

        $('.expandButton').click(function () {
            var a = $('#panel-group1').find(".panel-collapse[data-section='" + $(this).data('section') + "']").toggleClass('hidden');
            var current = $(this).data('current');
            if (current === 'expand') {
                $(this).data('current', 'hide');
                $(this).html('<i class="glyphicon glyphicon-resize-small"></i> Hide');
            } else {
                $(this).data('current', 'expand');
                $(this).html('<i class="glyphicon glyphicon-resize-full"></i> Expand');
            }
            return false;
        });

        $('.summernote').summernote({
            height: 100
        });

        $('.editElement').click(function () {
            var key = $(this).data('elementid');
            var documentId = '<?= $document_id; ?>';
            var templateId = '<?= $template_id; ?>';
            var sectionId = $(this).data('sectioncode');
            console.log('edit-form: ELEMID=', key, '| DOCID=', documentId, '| TEMPID=', templateId, '| SECID=', sectionId);
            $.ajax({
                url: '<?= SITE_ROOT; ?>/formview/load-selected-json/',
                data: {key: key, component: 'element', documentId: documentId, templateId: templateId, sectionId: sectionId},
                success: function (data) {
                    var obj = $.parseJSON(data);
                    $('.modal-dialog').addClass('modal-lg');
                    $('.modal-title').text(obj.component);
                    $('.modal-body').html(obj.html);
                }
            });
            $('#myModal').modal('show');
            return false;
        });

        $('.addElement').click(function () {
            var documentId = '<?= $document_id; ?>';
            var templateId = '<?= $template_id; ?>';
            var sectionId = $(this).data('sectioncode');
           console.log('sectionId -',sectionId)
             
            console.log('ADD ELEMENT: DOCID=', documentId, '| TEMPID=', templateId, '| SECID=', sectionId );
            $.ajax({
                url: '<?= SITE_ROOT; ?>/formview/add-element/',
                data: {documentId: documentId, templateId: templateId, sectionId: sectionId},
                success: function (data) {
                    var obj = $.parseJSON(data);
                    $('.modal-dialog').addClass('modal-lg');
                    $('.modal-title').text(obj.component);
                    $('.modal-body').html(obj.html);
                }
            });
            $('#myModal').modal('show');
            return false;
        });
        $('.editSection').click(function () {
            var key = $(this).data('sectioncode');
            var documentId = '<?= $document_id; ?>';
            var templateId = '<?= $template_id; ?>';
            console.log(key);
            $.ajax({
                url: '<?= SITE_ROOT; ?>/formview/load-selected-json/',
                data: {key: key, component: 'section', documentId: documentId, templateId: templateId},
                success: function (data) {
                    var obj = $.parseJSON(data);
                    $('.modal-dialog').removeClass('modal-lg');
                    $('.modal-title').text(obj.component);
                    $('.modal-body').html(obj.html);
                }
            });
            $('#myModal').modal('show');
            return false;
        });

        $('.editTitle').click(function () {
            var documentId = '<?= $document_id; ?>';
            console.log(documentId);
            $.ajax({
                url: '<?= SITE_ROOT; ?>/formview/change-title-new/',
                data: {documentId: documentId},
                success: function (data) {
                    var obj = $.parseJSON(data);
                    $('.modal-dialog').removeClass('modal-lg');
                    $('.modal-title').text(obj.component);
                    $('.modal-body').html(obj.html);
                }
            });
            $('#title').modal('show');
            return false;
        });

        $('.executeAction').click(function () {
            var selected = [];
            var type = '';
            $('#documentId').each(function (key, documentId) {
                $('#templateId').each(function (key, templateId) {
                    type = 'regenerate';
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
            setTimeout(
                    function () {
                        window.location.reload(true);
                    }, 1200);
            });
        });

        $('.deleteElement').click(function (e) {
            e.preventDefault();
            var documentId = '<?= $document_id; ?>';
            var id = $(this).data('elementid');
            var sectionCode = $(this).data('sectioncode');
            $.ajax({
                url: '<?= SITE_ROOT; ?>/formview/delete-element/',
                data: {documentId: documentId, elementId: id, sectionCode: sectionCode},
                success: function (data) {
                    var obj = $.parseJSON(data);
                    $('.modal-dialog').removeClass('modal-sm');
                    $('.modal-title').text(obj.component);
                    $('.modal-body').html(obj.html);
                }
            });
            $('#deleteModal').modal('show');
            
        });
</script>

<script>
    $(document).ready(function () {
        var countt = 2;
        var count = 2;

        var sect = $('#section_desc_list').html();
        var elem = $('#element_desc_list').html();

        $('#sectionGroup').on('click', '.plusSection', function () {
            var $section = '<div class="sectionMain' + countt + '">';
            $section += '<div class="form-group form-group-sm" >';
            $section += '<label class="control-label col-md-2" style="padding-top:7px;text-align: left" >Section Name</label>';
            $section += '<input  type="text" name="section_desc' + countt + '" id="section_desc" style="margin-top:3px; height:23px ; width: 250px" class="form-control col-md-4 secList" list="secList" />';
            $section += '<datalist name="secList" id="secList">' + sect + '</datalist>';
            $section += '&nbsp;';
            $section += '<div class="btn btn-default btn-sm minusSection"  data-sectionno="' + countt + '" style="padding: 4px ; margin-top: 3px"  title="MinusSection" ><i class="glyphicon glyphicon-minus" style="position: inherit"></i></div> ';
            $section += '</div>';
            $section += '</div>';
            $($section).appendTo('#sectionGroup');
            countt++;
            
            return false;
        });

        //MINUS SECTION
        $('#sectionGroup').on('click', '.minusSection', function () {
            var dropid = $(this).data('sectionno');
            $('.sectionMain' + dropid).remove();
            
            return false;
        });

        //Add New Section
        $('#notesForm').on('click', '.newSection', function () {
            $('#newSection').show();
            return false;
        });

        //Closed Section
        $('#notesForm').on('click', '.closeNewSection', function () {
            $('#newSection').hide();
            return false;
        });

        $('#elementGroup').on('click', '.plusElement', function () {
            var $element = '<div class="elementMain' + count + '">';
            $element += ' <div class="form-group form-group-sm" data-elemsort=" " style="border:1px solid #ccc; margin:4px;cursor:move;display: inline-block;width:99%">';
            $element += '<label class="control-label col-md-6" style="padding-top:7px;text-align: right" data-elem=" " data-sectioncode="">Element Name</label>';
            $element += '<input  type="text" name="element_desc' + count + '" id="element_desc" style="margin-top:3px; height:23px ; width: 250px" class="form-control col-md-4 eleList" list="eleList" />';
            $element += '<datalist name="eleList" id="eleList">' + elem + '</datalist>';
            $element += '&nbsp;';
            $element += '<div class="btn btn-default btn-sm minusElement"  data-elementno="' + count + '" style="padding: 4px ; margin-top: 3px"    title="Add New Element" ><i class="glyphicon glyphicon-minus" style="position: inherit"></i></div> ';
            $element += '</div>';
            $element += '</div>';
            $($element).appendTo('#elementGroup');
            count++;

            return false;
        });

        //MINUS SECTION
        $('#elementGroup').on('click', '.minusElement', function () {
            var dropid = $(this).data('elementno');
            $('.elementMain' + dropid).remove();
        });

    }); //End of document ready
</script>
<script>
    $(document).ready(function () {

        $('#newSection input').keyup(function () {

            var empty = false;
            $('#newSection input').each(function () {
                if ($(this).val().length === 0) {
                    empty = true;
                }
            });

            if (empty) {
                $('.addSection').attr('disabled', 'disabled');
            } else {
                $('.addSection').attr('disabled', false);
            }
            return false;
        });
   
    $('.viewForm').click(function () {
        
            var templateId = $(this).attr('value');
                console.log(templateId);
                $.ajax({
                    method: 'GET',
                    url: '<?= SITE_ROOT; ?>/formview/form-template-preview/'+templateId,
                    success: function (event) {
                        $('.modal-body').html(event);
                    }
                });
               
                $('#viewForm').modal('show');
                return false;
        });
        
        $(".buildForm").click(function () {
                var documentId = $(this).attr('id');
                console.log(documentId);
                $.ajax({
                    url: '<?= SITE_ROOT; ?>/formview/form-builder',
                    data: {documentId: documentId}
                });
                 
                return false;
        });
        
//         $('.selectedsection').change(function () {
//            var section = $(this).val();
//            var a = $('#panel-group1').find(".panel-default[data-section='" + section + "']").fadeToggle("fast", "linear");
//            
//        });

        $('.selectedsection').click(function (e) {
        e.preventDefault();
            var documentId = '<?= $document_id; ?>';
            var sectionCode = $(this).data('sectioncode');
            $.ajax({
                url: '<?= SITE_ROOT; ?>/formview/delete-section-edit/',
                data: {documentId: documentId, sectionCode: sectionCode},
                success: function (data) {
                    var obj = $.parseJSON(data);
                    $('.modal-dialog').removeClass('modal-sm');
                    $('.modal-title').text(obj.component);
                    $('.modal-body').html(obj.html);
                }
            });
            $('#deleteModal').modal('show');
        });
 });

</script>
<?= $footer; ?>