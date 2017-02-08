<?php echo $header; ?>

<div class='panel panel-default'>
    <div class='panel-heading'>Document Template In JSON Format</div>
    <div class='panel-body'>
        <div id='formJson' style='white-space: pre'></div>
    </div>
</div>

<script>
    $(function () {
        $('.summernote').summernote({
            height: 150
        });

        var json_parse = JSON.parse('<?php echo $json_elements; ?>');
        $('#formJson').text(JSON.stringify(json_parse, null, 4));
    })
</script>
<?php echo $footer; ?>
