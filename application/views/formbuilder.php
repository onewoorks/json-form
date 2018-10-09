<?php echo $header; ?>
<?php // print_r($_SESSION['form_element']);                                          ?>
<h2>FORM BUILDER CONSTRUCT JSON FORMAT</h2>
<div class="row">
    <div class="col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading">FORM PROPERTIES</div>
            <div class="panel-body">
                <form id="formBuilder" class="form-horizontal">
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-4">Form Name</label>
                        <div class="col-sm-8">
                            <input name="form_name" type="text" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-4">Form Title</label>
                        <div class="col-sm-8">
                            <input name="form_name" type="text" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-4">Discipline</label>
                        <div class="col-sm-8">
                            <select name="form_discipline" class="form-control">
                                <option value="1">General Surgery</option>
                                <option value="2">General Medicine</option>
                                <option value="3">Orthopedic</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-4">Type Of Document</label>
                        <div class="col-sm-8">
                            <select name="form_discipline" class="form-control">
                                <option value="1">Notes</option>
                                <option value="2">Clerking Notes</option>
                                <option value="3">Progress Notes</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class='panel panel-default'>
            <div class='panel-heading'>FORM COMPONENT</div>
            <div class='panel-body'>
                <div class='form-group form-group-sm'>
                    <label class='control-label col-sm-4'>Type</label>
                    <div class='col-sm-8'>
                        <label class='radio-inline'>
                            <input type='radio' name='form_type' value='decoration' checked/>Decoration
                        </label>
                        <label class='radio-inline'>
                            <input type='radio' name='form_type' value='element' />Element
                        </label>
                        <label class='radio-inline'>
                            <input type='radio' name='form_type' value='method' />Method
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class='panel panel-default'>
            <form id="elementBuilder" class="form-horizontal">
                <div id='formelement'></div>
                <div class='panel-body'>
                <div class="form-group form-group-sm">
                    <div class="col-sm-12 text-right">
                        <button type="submit" class="btn btn-primary">Insert</button>
                    </div>
                </div>
                </div>
            </form>
        </div>
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
<script src='assets/js/json-parse.js'></script>
<script>
    function ElementBuilder($elementName){
        $.ajax({
           url : '<?php echo SITE_ROOT;?>/formbuilder/formelement/',
           data: { value: $elementName},
           success: function(data){
               $('#formelement').html(data);
           }
        });
    };
    $(function () {
        var $formType = 'decoration';
        ElementBuilder($formType);
        $('[name=form_element').val($formType);
        $('[name=form_type]').on('change', function () {
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
                data: {values: $elements, 'form_type': $formType},
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