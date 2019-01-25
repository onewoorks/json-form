<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>CD Document JSON Generator</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="json form formatted from structured dataset">
        <link rel="shortcut icon" href="<?php echo SITE_ASSET; ?>/assets/favicon.ico" type="image/x-icon">
        <link rel="icon" href="<?php echo SITE_ASSET; ?>/assets/favicon-JSON.ico" type="image/x-icon">
        <link href="<?php echo SITE_ASSET; ?>/assets/library/bootstrap/css/bootstrap.css" rel="stylesheet">
        <script src="<?php echo SITE_ASSET; ?>/assets/library/ajax/jquery/2.1.4/jquery.js"></script>
        <script src="<?php echo SITE_ASSET; ?>/assets/library/bootstrap/js/bootstrap.js"></script> 
        <link href="<?php echo SITE_ASSET; ?>/assets/library/summernote/summernote.css" rel="stylesheet">
        <script src="<?php echo SITE_ASSET; ?>/assets/library/summernote/summernote.js"></script>
        <script src="<?php echo SITE_ASSET; ?>/assets/library/sweetalert/sweetalert.min.js"></script>
        <link href="<?php echo SITE_ASSET; ?>/assets/library/sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
        <link href='<?php echo SITE_ASSET; ?>/assets/library/datepicker/css/datepicker.css' rel="stylesheet" />
        <link href="//use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous"  rel="stylesheet">
        <script src="<?php echo SITE_ASSET; ?>/assets/library/ajax/jquery/1.5.0-rc1/Sortable.js"></script>
    </head>

    <div class="row">
        <form id="notesForm">
            <div class="col-sm-9">
                <div id='maintitle'>
                    <div class="form-inline">
                        <label class='control-label' style='padding: 15px;font-size: 15px'><b><?= $document_title; ?>&nbsp;</b></label>
                        <div class="btn btn-primary btn-xs editTitle"></i>Edit Title</div>
                        <div class="btn btn-primary btn-xs pull-right updateSection" style="margin-top:15px"></i>Update Section Sorting</div>
                        <div class="btn btn-primary btn-xs pull-right updateElement" style="margin-top:15px"></i>Update Element Sorting</div>
                    </div>
                </div>
                <div id="panel-group1" class="panel-group" role="tablist">
                    <?php foreach ($json_elements as $key => $section): $sectionKod = $section->section_code; ?>
                        <div class="panel panel-default dragble" data-section='<?= $key; ?>' style="cursor:move">
                            <div class="panel-heading" role="tab" id="collapseListGroupHeading1" style='margin-bottom:-5px'>
                                <div class="panel-title" style="font-size:12.5px">
                                    <input type='hidden' name="sectionList[]" data-section='<?= $key; ?>' value='<?= $section->section_code; ?>'>
                                    <?php if ($section->section_code != '0'): ?>
                                        <a href="#collapseListGroup1" role="button" data-toggle="collapse"  aria-expanded="true"  data-section='<?= $key; ?>'><?= $section->section_desc; ?>&nbsp;<i class="glyphicon glyphicon-move" style="font-size:11px;"></i></a>
                                    <?php else: ?>
                                        <a href="#collapseListGroup1" role="button" data-toggle="collapse"  aria-expanded="true"  data-section='<?= $key; ?>'>&nbsp;<i class="glyphicon glyphicon-move" style="font-size:11px;"></i></a>
                                    <?php endif; ?>
                                    <div class="btn-group pull-right" style="margin-top: -3px;margin-right:-10px">        
                                        <a class="btn btn-xs btn-default editSection" data-section='<?= $key; ?>' data-sectioncode='<?= $section->section_code; ?>'></i> Edit Section</a>
                                        <a class="btn btn-default btn-xs expandButton" data-section='<?= $key; ?>' data-current='expand'><i class='glyphicon glyphicon-resize-full'></i> Expand</a>
                                    </div>
                                </div>
                            </div>

                            <div class="panel-collapse collapse in hidden" role="tabpanel" id="collapseListGroup1" style="margin-top:10px"aria-labelledby="collapseListGroupHeading1" data-section='<?= $key; ?>' data-sectioncode='<?= $section->section_code; ?>'>
                                <div class="list-group" data-sectionkey='<?= $key; ?>' data-sectioncode='<?= $section->section_code; ?>'>
                                    <?php $column = $section->layout;
                                    switch ($column):case '1': $set = 12; ?>
            <?php foreach ($section->elements as $elem => $element): $thecode = $element->element_code;
                if ($element->element_code === $element->child_element_code): ?>
                                                    <div class='form-group form-group-sm' data-elemsort='<?= $elem; ?>'style='border:1px solid #ccc; margin:4px;cursor:move;display: inline-block;width:99%'>
                                                        <label class='control-label col-md-6' style='padding-top:7px;text-align: right' data-elem="<?= $element->element_code; ?>" data-sectioncode='<?= $section->section_code; ?>'><?= $element->element_desc; ?></label>
                                                        <div class='btn btn-link editElement' data-elementid='<?= $element->element_code; ?>' data-sectioncode='<?php echo $sectionKod; ?>'>Edit</div>
                                                        <div class='btn btn-link deleteElement' data-elementid='<?= $element->element_code; ?>' data-sectioncode='<?php echo $sectionKod; ?>' data-docid='<?= $document_id; ?>' ><i class='glyphicon glyphicon-remove'></i></div>
                                                    </div>
                <?php else: ?>
                                                    <div class='form-group form-group-sm' data-elemsort='<?= $elem; ?>'style='border:1px solid #ccc; margin:4px;cursor:move;display: inline-block;width:99%'>
                                                        <label class='control-label col-md-6' style='padding-top:7px;text-align: right;color:#737373' data-elem="<?= $element->element_code; ?>" data-sectioncode='<?= $section->section_code; ?>'><?= $element->element_desc; ?></label>
                                                        <div class='btn btn-link editElement' data-elementid='<?= $element->element_code; ?>' data-sectioncode='<?php echo $sectionKod; ?>'>Edit</div>
                                                        <div class='btn btn-link deleteElement' data-elementid='<?= $element->element_code; ?>' data-sectioncode='<?php echo $sectionKod; ?>' data-docid='<?= $document_id; ?>' ><i class='glyphicon glyphicon-remove'></i></div>
                                                    </div>
                                                <?php endif;
                                            endforeach; ?>

                                            <?php break;
                                        case '2': $set = 12; ?>
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
                        if ($element->element_code === $element->child_element_code): ?> 
                                                            <div class='form-group form-group-sm'  data-elemsort='<?= $elem; ?>' style='border:1px solid #ccc;margin:4px;padding-top:5px;cursor:move;display: inline-block;width:99%'>
                                                                <label class='control-label col-md-6' style='padding-top:7px;text-align: right' data-elem="<?= $element->element_code; ?>" data-sectioncode='<?= $section->section_code; ?>'><?= $element->element_desc; ?></label>
                                                                <div class='btn btn-link editElement' data-elementid='<?= $element->element_code; ?>' data-sectioncode='<?php echo $sectionKod; ?>'>Edit</div>
                                                                <div class='btn btn-link deleteElement' data-elementid='<?= $element->element_code; ?>' data-sectioncode='<?php echo $sectionKod; ?>' data-docid='<?= $document_id; ?>' ><i class='glyphicon glyphicon-remove'></i></div>
                                                            </div>    
                                                        <?php else: ?>
                                                            <div class='form-group form-group-sm' data-elemsort='<?= $elem; ?>'style='border:1px solid #ccc; margin:4px;cursor:move;display: inline-block;width:99%'>
                                                                <label class='control-label col-md-6' style='padding-top:7px;text-align: right;color:#737373' data-elem="<?= $element->element_code; ?>" data-sectioncode='<?= $section->section_code; ?>'><?= $element->element_desc; ?></label>
                                                                <div class='btn btn-link editElement' data-elementid='<?= $element->element_code; ?>' data-sectioncode='<?php echo $sectionKod; ?>'>Edit</div>
                                                                <div class='btn btn-link deleteElement' data-elementid='<?= $element->element_code; ?>' data-sectioncode='<?php echo $sectionKod; ?>' data-docid='<?= $document_id; ?>' ><i class='glyphicon glyphicon-remove'></i></div>
                                                            </div>
                                            <?php endif;
                                        endif;
                                    endforeach; ?>
            <?php endfor; ?>
            <?php break;
        endswitch;?>
                                </div>
                            </div>
                        </div>
                            <?php endforeach; ?>
                </div>
            </div>

            <div class='col-md-3' style="position: fixed; z-index: 6; right: 0; margin-left: 10px; margin-top: 50px;">
                <div class='panel panel-default'>
                    <div class='panel-heading'><b>Notes Component</b></div>
                    <div class='panel-body' >
                        <ul class='list-unstyled'  style=" font-size: 12.5px;">
<?php foreach ($json_elements as $key => $section): ?>
                                <li><input type='checkbox' class='selectedsection' name="total" id="total" value="<?= $key; ?>" checked /> <?= $section->section_desc; ?></li>
<?php endforeach; ?>
                        </ul>
                        <div class='text-right'>
                            <div class='btn-group btn-group-sm'>
                                <a href='#' class='btn btn-default changelayout' >Change Layout</a>
                                <input type='hidden' id='documentId' value='<?= $document_id; ?>'/>
                                <input type='hidden' id='templateId' value='<?= $template_id; ?>'/>
                                <a href='#' class='btn btn-xs btn-default executeAction' />Generate JSON</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div><!-- end div=row -->

    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <a href="edit-form.php"></a>
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
        <div class="modal-dialog">
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

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Delete Element</h3>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger btn-ok" id="btnYes" >Delete</a>
                </div>
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
                            title: "Section Sorting Updated!",
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
            });

            $('.summernote').summernote({
                height: 100
            });

            $('.selectedsection').change(function () {
                var section = $(this).val();
                var a = $('#panel-group1').find(".panel-default[data-section='" + section + "']").fadeToggle("fast", "linear");
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
                console.log('ADD ELEMENT: DOCID=', documentId, '| TEMPID=', templateId, '| SECID=', sectionId);
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
                $.ajax({
                    url: '<?= SITE_ROOT; ?>/formview/change-title/',
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

            $('.changelayout').click(function () {
                var documentId = '<?= $document_id; ?>';
                $.ajax({
                    url: '<?= SITE_ROOT; ?>/formview/change-layout/',
                    data: {documentId: documentId},
                    success: function (data) {
                        var obj = $.parseJSON(data);
                        $('.modal-dialog').removeClass('modal-lg');
                        $('.modal-title').text(obj.component);
                        $('.modal-body').html(obj.html);
                    }
                });
                $('#layout').modal('show');
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
                            type: "success",
                            showCancelButton: true,
                            confirmButtonColor: "#80bf07",
                            confirmButtonText: "Go To Document List!",
                            closeOnConfirm: false
                        },
                        function (isConfirm) {
                            if (isConfirm) {
                                window.location.href = '<?php echo SITE_ROOT; ?>';
                            } else {
                                window.location.reload;
                            }
                        });
                    }
                });
            });
        });

        $('#deleteModal').on('show', function () {
            var id = $(this).data('elementid'),
                    removeBtn = $(this).find('.danger');
        });
        $('.deleteElement').on('click', function (e) {
            e.preventDefault();
            var id = $(this).data('elementid');
            var docID = $(this).data('docid');
            var sectionCode = $(this).data('sectioncode');

            $('#deleteModal').data('elementid', id).modal('show');
            $('#deleteModal').data('docId', docID);
            $('#deleteModal').data('sectionCode', sectionCode);
            $('.modal-body').html('Are you sure ?');
        });
        $('#btnYes').click(function () {
            var id = $('#deleteModal').data('elementid');
            var docId = $('#deleteModal').data('docId');
            var sectionCode = $('#deleteModal').data('sectionCode');
            $.ajax({
                url: '<?= SITE_ROOT; ?>/formview/delete-element/',
                data: {elementId: id, documentId: docId, sectionCode: sectionCode},
                success: function (data) {
                    $('#deleteModal').modal('hide');
                    swal({
                        title: "Element Removed!",
                        text: "Data successfully removed from database",
                        type: "success"
                    });
                }
            });
        });
    </script>

<?= $footer; ?>