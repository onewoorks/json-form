<?php echo $header; ?>
<h2>FORM BUILDER (JSON Formatter)</h2>
<div class="row">
    <div class="col-sm-6">

        <div class="panel panel-default">
            <div class="panel-heading">FORM PROPERTIES</div>
            <div class="panel-body">
                <form id="formBuilder" class="form-horizontal">
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-4">Document Name</label>
                        <div class="col-sm-8">
                            <input name="doc_name_desc" type="text" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-4">Discipline</label>
                        <div class="col-sm-8">
                            <select name='discipline' class='form-control' >
                                <?php foreach ($main_discipline as $discipline): ?>
                                    <option value='<?php echo $discipline['value']; ?>'><?php echo $discipline['label']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-4">Type Of Document</label>
                        <div class="col-sm-8">
                            <select name='doc_type' class='form-control' >
                                <?php foreach ($doc_types as $doc): ?>
                                    <option value='<?php echo $doc['code']; ?>'><?php echo $doc['label']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <form id="elementBuilder" class="form-horizontal">
            <div class='panel panel-default'>
                <div class='panel-heading'>SECTION</div>
                <div class='panel-body'>
                    <div class='form-group form-group-sm'>
                        <label class='control-label col-sm-4'>Section Name</label>
                        <div class='col-sm-8'>
                            <input type='text' name='section_desc' class='form-control'/>
                        </div>
                    </div>
                </div>
            </div>


            <div class='panel panel-default'>
                <div class='panel-heading'>FORM COMPONENT</div>
                <div class='panel-body'>
                    <div class='form-group form-group-sm'>
                        <label class='control-label col-sm-4'>Type</label>
                        <div class='col-sm-8'>
                            <label class='radio-inline'>
                                <input type='radio' name='element_properties' value='decoration' checked/>DECORATION
                            </label>
                            <label class='radio-inline'>
                                <input type='radio' name='element_properties' value='element' />BASIC
                            </label>
                            <label class='radio-inline'>
                                <input type='radio' name='element_properties' value='method' />METHOD
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class='panel panel-default'>

                <div id='formelement'></div>
                <div class='panel-body'>
                    <div class="form-group form-group-sm">
                        <div class="col-sm-12 text-right">
                            <button type="submit" class="btn btn-primary">Insert</button>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>

    <div class="col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading">JSON OUTPUT FORMAT</div>
            <div class="panel-body">
                <div id='json_view' class='row'></div>
                <div class='row'>
                    <div class='col-sm-12 text-right'>
                        <div class='btn btn-primary btn-sm' id='createForm'>Create Form</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function ElementBuilder($elementName) {
        $.ajax({
            url: '<?php echo SITE_ROOT;?>/formbuilder/formelement/',
            data: {value: $elementName},
            success: function (data) {
                $('#formelement').html(data);
            }
        });
    }
    ;
    $(function () {
        var $formType = 'decoration';
        ElementBuilder($formType);
        $('[name=form_element').val($formType);
        $('[name=element_properties]').on('change', function () {
            var selector = $(this).val();
            $('#' + selector).show();
            $('[name=form_element').val(selector);
            ElementBuilder(selector);
        });
        $('#elementBuilder').submit(function (e) {
            e.preventDefault();
            var $elements = $(this).serializeArray();
            $.ajax({
                url: '<?php echo SITE_ROOT;?>/formbuilder/insertelement/',
                data: {values: $elements, 'element_properties': $formType},
                success: function (data) {
                    var json_parse = JSON.parse(data);
                    $('#json_view').text(JSON.stringify(json_parse, null, 4));
                }
            });
        });
        $('#createForm').click(function () {
            $.ajax({
                url: '<?php echo SITE_ROOT;?>/formbuilder/createform/',
                success: function () {
                    alert('form created');
                    $('#json_view').text('');
                }
            });
        });
        $('#predefinedList').on('click', '.addPredefined', function () {
            var index = $(this).data('listid') + 1;
            var current = $(this).data('listid');
            var $deleteButton = "<div class='btn btn-default btn-sm deletePredefined' data-listid='" + current + "'><i class='glyphicon glyphicon-trash'></i></div>";
            $('.predefinedActionButton[data-listid="' + current + '"]').html($deleteButton);
            var $html = '<div class="prelist' + index + '">';
            $html += '<div class="form-group form-group-sm input-list">';
            $html += '<label class="control-label col-sm-4"></label>';
            $html += '<div class="col-sm-2 list-padding-right">';
            $html += '<input type="text" class="form-control" placeholder= "value" />';
            $html += '</div>';
            $html += '<div class="col-sm-4 list-padding-left" >';
            $html += '<input type="text" class="form-control" placeholder= "label / title" />';
            $html += '</div>';
            $html += '<div class="col-sm-2 predefinedActionButton" data-listid=' + index + ' >';
            $html += '<div class="btn btn-default btn-sm addPredefined" data-listid=' + index + ' ><i class="glyphicon glyphicon-plus"></i></div>';
            $html += '</div>';
            $html += '</div>';
            $html += '</div>';
            $($html).appendTo('#predefinedList');
        });

        $('#predefinedList').on('click', '.deletePredefined', function () {
            var deleteid = $(this).data('listid');
            if (deleteid > 0) {
                $('.prelist' + deleteid).remove();
            }
        });
    });
</script>
<?php echo $footer; ?>