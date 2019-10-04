<?php echo $header; ?>

<div class='panel panel-default'>
    <div class='panel-heading'>Document Template In JSON Format</div>
    <div class='panel-body'>
       <div class="text-uppercase">
                   <div class='col-xs-2'>Discipline </div>
                   <div class='col-xs-10'>: <strong><?= $discipline; ?></strong></div>
                   <div class='col-xs-2'>Sub Discipline </div>
                   <div class='col-xs-10'>: <strong><?= $sub_discipline; ?></strong></div>
                   <div class='col-xs-2'>Document Title </div>
                   <div class='col-xs-10 upperCase'>: <strong><a href='<?php echo SITE_ROOT; ?>/formview/form-template/<?php echo $template_id; ?>'><?php echo $document_title; ?></a></strong></div>
        </div>
                   <br><br><br><br><br>
        <div id='formJson' style='white-space: pre'></div>
    </div>
</div>

<script>
    $(function () {
        $('.summernote').summernote({
            height: 150
        });
    });
    
    $('#formJson').text(JSON.stringify(<?= $json_elements; ?>, null, 4));    
</script>
<?php echo $footer; ?>
