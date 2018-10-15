<?php echo $header; ?>

<div id="sectionGroup">
<form id="sectionBuilder" class="form-horizontal">
                <div class='panel-body'>
                   
                    <div class='form-group form-group-sm'>
                        <label class='control-label col-sm-2'>Section Description</label>
                        <div class='col-sm-6'>
                            <input type='text' name='section_desc' class='form-control' autocomplete="off"/>
                        </div>
                        
                        <label class='control-label col-sm-2'>Search</label>
                        <div class='form-inline'>
                            <input type='text' name='search' class='form-control' placeholder="Search Section...." />
                            <button type="button" class="btn btn-primary btn-sm searchSection" style='padding-top:3px;padding-bottom:3px'>
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </div>
                    </div>
                        
                    <div class="form-group form-group-sm">
                    <label class="control-label col-sm-2">Layout</label>
                    <div class="col-sm-8">
                            <label class="radio-inline">
                                <input name="layout" type="radio" value="1" /> 1
                            </label>
                            <label class="radio-inline">
                                <input name="layout" type="radio" value="2"  /> 2
                            </label>
                            <button type="button" class="btn btn-primary btn-sm addSection" style='margin-left:54%'>Add Section</button>

                    </div>
                    </div>
                </div>
</form>

<div class='container-fluid'>
    <div class='panel panel-primary'>
        <div class='panel-heading'>
            <div class="btn-group pull-right">
            </div>

            Result of Existing Section</div>
        <div class='panel-body'>
            <div class ='pull-left' style=" font-size: 12px; padding-bottom: 3px;"><b>Total Section = <?= count($list_of_sections);?></b></div>
            <div class='clearfix'></div>

            <table id="tableForm" class='table table-bordered table-condensed'>
                <thead>
                    <tr>
                        <th style=" font-size: smaller;">Section Code</th>
                        <th style=" font-size: smaller;">Section Desc</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!$list_of_sections):?>
                    <tr>
                        <td colspan="7"><i>No Record Found</i></td>
                    </tr>
                    <?php endif;?>
                    <?php $no=1; foreach ($list_of_sections as $sections): ?>
                        <tr>
                            <td  style=" font-size: smaller; text-align: center"><?php echo $sections['section_code']; ?></td>
                            <td  style=" font-size: smaller;"><?php echo $sections['section_desc']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>

<script>
    $(document).ready(function() {
        $('#tableForm').DataTable();
    } );
    
    
$(function () {

        //FILTERSECTION
        $('.searchSection').click(function () {
            var values = $('#sectionBuilder').serializeArray();
            var search = $("#search").val();
            $.ajax({
                url: '<?php echo SITE_ROOT; ?>/main/search-section/',
                data: {values: values, search:search},
                success: function (data) {
//                    alert(data);
                    $('#sectionGroup').html(data);
                }
            });
        });
        
        //ADDSECTION
        $('.addSection').click(function () {
        var values = $('#sectionBuilder').serializeArray();
        var layout=$("#layout").val();
        var secDesc=$("#section_desc").val();
        console.log(values);
        $.ajax({
            url : '<?= SITE_ROOT;?>/formview/create-section/',
            data : { values: values, layout:layout, secDesc:secDesc },
            success : function(data){
//                alert(data);
                swal({
                title: "Section Created!",
                text: "Data successfully inserted into database",
                type: "success"
                });
            }
        });
        setTimeout( 
          function() {
            window.location.reload(true);
          }, 1200);
        });
    });
</script>

<?php echo $footer;