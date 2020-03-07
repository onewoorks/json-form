<?= $header; ?>
<div class='row' style="margin-left:30px">
    <!--<div id="setsini" class='col-md-12' style="padding-left: 30px">-->
    <div id="setsini" class='col-md-12' style="padding-right: 30px">
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
        <div class='btn-group btn-group-sm'>
            <a class="btn btn-primary btn-sm" href='<?php echo SITE_ROOT; ?>/formview/edit-form-new/<?php echo $template_id; ?>' ><i class='glyphicon glyphicon-arrow-left'></i> Back</a>
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
            else {
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


</script>

<?= $footer; ?>
