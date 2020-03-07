<?= $header; ?>
<div class='row' style="margin-left:30px">
    <!--<div id="setsini" class='col-md-12' style="padding-left: 30px">-->
    <div id="setsini" class='col-md-offset-0 col-md-12'>
        <div class='panel panel-default' >
            <div class='panel-heading text-uppercase' style='font-size: 12px'>
                <div class='row'>
                    <div class='col-xs-2'>Discipline </div>
                    <div class='col-xs-10'>: <strong><?= $main_discipline; ?></strong></div>
                    <div class='col-xs-2'>Sub Discipline </div>
                    <div class='col-xs-10'>: <strong><?= $sub_discipline; ?></strong></div>
                    <div class='col-xs-2'>Document Title </div>
                    <div class='col-xs-10'>: <strong><?= $document_title; ?></strong></div>
                </div>
            </div>

            <form class='form-horizontal'>
                <?php foreach ($json_elements as $key => $section): ?>
                    <?php if ($section->section_code == '0'): ?>
                        <div class='panel-body' data-section='<?= $key; ?>' style="padding-top: 8px;" >
                            <!--display element-->
                            <?php echo ColumnRender($section->elements, $section->layout, $document_title, $document_id, $section->layout); ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </form>
        </div>

        <form id='notesForm' class='form-horizontal'>
            <div class='panel panel-default'> 
                <?php foreach ($json_elements as $key => $section): ?>
                    <?php if ($section->section_code != '0'): ?>
                        <div class='panel-heading' style="background-color: #0088cc; color: white; " data-section='<?= $key; ?>'><b><?= $section->section_desc; ?></b></div>
                        <div class='panel-body' data-section='<?= $key; ?>'>
                            <!--display element-->
                            <?php echo ColumnRender($section->elements, $section->layout, $document_title, $document_id, $section->layout); ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </form>
    </div>

    <br><br> 
    <div class='col-md-1-right' style="position: fixed; z-index: 7; right: 25px;">
        <button class="btn btn-default expandComponent" style='background-color:#f5f5f5' data-current='expand'><i class="glyphicon glyphicon-chevron-down"></i></button>
    </div>   
    <div class="col-md-3 hidden" id="sidebar" style="position: fixed; z-index: 6; right: 16px;">
        <div class='panel panel-default' id='notecomponent'>
            <div class='panel-heading'><b>Notes Component</b></div>
            <div class='panel-body'>
                <ul class='list-unstyled'>
                    <?php foreach ($json_elements as $key => $section): ?>
                        <?php if ($section->section_code != '0'): ?>
                            <li><input type='checkbox' class='selectedsection' name='<?= $key; ?>' value='<?= $key; ?>' checked /> <?= $section->section_desc; ?></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>

                <div class='text-right'>
                    <div class='btn-group btn-group-sm' style="right:10px">
                        <a href='<?php echo SITE_ROOT; ?>/formview/edit-form/<?= $template_id; ?>' class='btn btn-default'>Edit Form</a>
<!--                        <a href='<?php echo SITE_ROOT; ?>/formview/json-format/<?= $document_id; ?>' class='btn btn-default'>View JSON</a>-->
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>

<div id="Modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4>Change Layout</h4>
            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>
<script src='<?= SITE_ASSET; ?>/assets/library/datepicker/js/bootstrap-datepicker.js'></script>
<script src="<?php echo SITE_ASSET; ?>/assets/library/summernote/summernote.js"></script>

<script>
    $(document).ready(function () {
        
        var checkName;

        //DROPDOWN
        $(document).on('click', '.selectList', function () {
            var className = $(this).val();
            console.log('dropdown refCode:', className);

            if (className) {
                $(this).closest('[class^="dropdown"]').find("[id^=" + className + "]").removeClass('hidden');
                checkName = className;
            }
            else{
                $(this).closest('[class^="dropdown"]').find("[id^=" + checkName + "]").addClass('hidden');
            }
        });

        //CHECKBOX
        $('input:checkbox').change(function () {
            var className = $(this).attr('data-ref');
            console.log('checkbox refCode:', className);

            if (className) {
                if ($(this).is(':checked')) {
                    $(this).closest('[class^="checkbox"]').find("[id^=" + className + "]").removeClass('hidden');
                }
                else {
                    $(this).closest('[class^="checkbox"]').find("[id^=" + className + "]").addClass('hidden');
                }
            }
        });

        //RADIOBUTTON
        $('input:radio').change(function () {
            var className = $(this).attr('data-ref');
            console.log('radio refCode:', className);
            var find = $(this).closest('div').children('div').first().attr('id');
            console.log('find div:', find);

            if (className) {
                $(this).closest('div').find("[id^=" + find + "]").removeClass('hidden');
            } else {
                $(this).closest('div').find("[id^=" + find + "]").addClass('hidden');
            }
        });

    });
</script>

<script>
    $(function () {
        $('.datepicker').datepicker({
            endDate: '+1d'
        });

        $('.datetimepicker').datepicker({
            'format': 'dd/mm/yyyy'
        });

        $('.timepicker').datepicker({
            'format': 'HH:mm'
        });
    });
</script>
<script>
    $(function () {

        $('.summernote').summernote({
            height: 100
        });

        $('.selectedsection').change(function () {
            var section = $(this).val();
            $('#notesForm').find("[data-section='" + section + "']").fadeToggle("fast", "linear");
        });

    });

    $('.expandComponent').click(function () {
        var a = $('#sidebar').toggleClass('hidden');
        var current = $(this).data('current');
        console.log(current);
        if (current !== 'expand') {
            $(this).data('current', 'expand');
            $(this).html('<i class="glyphicon glyphicon-chevron-down"></i>');
            document.getElementById("setsini").className = "col-md-12";
        } else {
            $(this).data('current', 'hide');
            $(this).html('<i class="glyphicon glyphicon-chevron-up"></i>');
            document.getElementById("setsini").className = "col-md-9";
        }
    });
</script>

<?= $footer; ?>
