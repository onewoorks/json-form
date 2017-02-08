<div id='vitalSignAdd' class='btn btn-default btn-xs'><i class='glyphicon glyphicon-search'></i></div>
<script>
    $(function () {
        $('#vitalSignAdd').click(function () {
            $.ajax({
                url: '<?php echo SITE_ROOT; ?>/formview/load-ajax-method/',
                data: {methodpage: 'common/vital_sign_popup'},
                success: function (data) {
                    $('.modal-dialog').addClass('modal-xl');
                    $('.modal-title').text('Vital Sign');
                    $('.modal-body').html(data);
                    $('#myModal').modal('toggle');
                }
            });
        })
    });
</script>
