<?php echo $header; ?>

<div id='elementGroup'>

    <form id='elementBuilder' class='form-horizontal'>
        <div class='panel-body'>
            <div class='form-group form-group-sm'>
                <label class='control-label col-sm-2'>Element Description</label>
                <div class='col-sm-6'>
                    <input type='text' name='element_desc' value='' class='form-control' autocomplete="off"/>
                </div>
                
                <label class='control-label col-sm-2'>Search</label>
                <div class='form-inline'>
                    <input type='text' name='search' class='form-control' placeholder="Search Element...." />
                    <button type="button" class="btn btn-primary btn-sm searchElement" style='padding-top:3px;padding-bottom:3px'>
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </div>
            </div>
            
           <div class="col-sm-8 text-right">
            <button type="button" class="btn btn-primary btn-sm addElement">Add Element</button>
            </div> 
        </div>
</form> 

<div class='container-fluid'>
    <div class='panel panel-primary'>
        <div class='panel-heading'>
            <div class="btn-group pull-right">
            </div>

            Result of Existing Element</div>
        <div class='panel-body'>
            <div class ='pull-left' style=" font-size: 12px; padding-bottom: 3px;"><b>Total Element = <?= count($list_of_elements);?></b></div>
            <div class='clearfix'></div>

            <table id="tableForm" class='table table-bordered table-condensed'>
                <thead>
                    <tr>
                        <!--<th style=" font-size: smaller;">No</th>-->
                        <th style=" font-size: smaller;">Element Code</th>
                        <th style=" font-size: smaller;">Element Desc</th>
                        <!--<th style=" font-size: smaller;">Json Element</th>-->
                        <!--<th style=" font-size: smaller;">Layout</th>-->
                        <!--<th style=" font-size: smaller;">Active Status</th>-->
                    </tr>
                </thead>
                <tbody>
                    <?php if(!$list_of_elements):?>
                    <tr>
                        <td colspan="7"><i>No Record Found</i></td>
                    </tr>
                    <?php endif;?>
                    <?php $no=1; foreach ($list_of_elements as $elements): ?>
                        <tr>
                            <td  style=" font-size: smaller; text-align: center"><?php echo $elements['element_code']; ?></td>
                            <td  style=" font-size: smaller;"><?php echo $elements['element_desc']; ?></td>
                            <!--<td  style=" font-size: smaller;"><?php echo $elements['json_element']; ?></td>-->
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

        //FILTERELEMENT
        $('.searchElement').click(function () {
            var values = $('#elementBuilder').serializeArray();
            var search = $("#search").val();
            $.ajax({
                url: '<?php echo SITE_ROOT; ?>/main/search-element/',
                data: {values: values, search:search},
                success: function (data) {
//                    alert(data);
                    $('#elementGroup').html(data);
                }
            });
        });
        
        //ADDELEMENT
        $('.addElement').click(function () {
        var values = $('#elementBuilder').serializeArray();
//        var layout=$("#layout").val();
        var elemDesc=$("#element_desc").val();
        console.log(values);
        $.ajax({
            url : '<?= SITE_ROOT;?>/formview/create-element/',
            data : { values: values, elemDesc:elemDesc },
            success : function(data){
//                alert(data);
                swal({
                title: "Element Created!",
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