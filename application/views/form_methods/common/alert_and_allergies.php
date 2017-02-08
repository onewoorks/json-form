<div class='row'>
    <div class='col-sm-12'>
        <h5 class='text-uppercase'>Allergies And Alert <span id="alergyAdd"><i class="glyphicon glyphicon-zoom-in"></i></span></h5>
            
    </div>
</div>

<div id='allergiesAndAlertPanel' class='hidden'>
    <div class="row" >
        <div class="col-sm-12">
            <h5>Alergies</h5>
            <table class="table table-bordered table-condensed small">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Substance</th>
                        <th>Subcategory</th>
                        <th>Reaction</th>
                        <th>Severity</th>
                        <th>Source Of Information</th>
                        <th>Estimated Onset</th>
                        <th>Audit Trail</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-7">
            <h5>Medical Alert</h5>
            <table class="table table-bordered table-condensed small">
                <thead>
                    <tr>
                        <th>Medical Alert</th>
                        <th>Status</th>
                        <th>Action</th>
                        <th>Audit Trail</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-7">
            <h5>Isolation Precautions</h5>
            <table class="table table-bordered table-condensed small">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Subcategory</th>
                        <th>Status</th>
                        <th>Audit Trail</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $(function () {
        $('#alergyAdd').click(function () {
            $.ajax({
                url: '<?php echo SITE_ROOT; ?>/formview/load-ajax-method/',
                data: {methodpage: 'common/alert_and_allergies_popup'},
                success: function (data) {
                    $('.modal-dialog').addClass('modal-xl');
                    $('.modal-title').text('Alert And Allergies');
                    $('.modal-body').html(data);
                    $('#myModal').modal('toggle');
                }
            });
        })
    });
</script>