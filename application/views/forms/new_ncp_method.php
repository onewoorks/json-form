<?php echo $header; ?>

<div id='listOfDocument' >
<form id="documentFilter" class="form-horizontal col-md-offset-16 col-md-offset-1">
    <div class='panel panel-default' style='margin:0px -20px 10px 0px'>
        <div class="panel-heading">ADD NEW NURSING CARE PLAN DIAGNOSIS METHOD</div>
        <br>
        <div class='form-group form-group-sm'>
            <div class="col-md-12">
                <div class='form-row'>
                    <div class='form form-inline'>
                        <div class="form-group col-md-4 text-right" >    
                            <label class="control-label ">Discipline</label>
                           <select name='discipline' id='discipline' class='form-control'> 
                                <option value='0' selected="selected">Please Select Discipline</option>
                                <?php foreach ($list_of_ncp as $discipline): ?>
                                    <option value='<?php echo $discipline['doc_name_id']; ?>'><?php echo $discipline['doc_name_desc']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div> 
                      
                        <div class="form-group col-md-6 text-right">    
                            <label class="control-label" >Nursing Diagnosis</label>
                            <select name='doc_group' id='doc_group' class='form-control'>
                                <?php if (!$preset_select): ?>
                                    <option value='0'>Please Select Nursing Diagnosis</option>
                                <?php else: ?>
                                    <option value='0' selected="selected">Please Select Nursing Diagnosis</option>
                                      <?php foreach ($ncp_diagnosis as $diagnosis): ?>
                                    <option value='<?php echo $diagnosis['code']; ?>'><?php echo $diagnosis['label']; ?></option>
                                <?php endforeach; 
                                endif; ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
         </div>
        <br>
    </div>
</form>

<div class='container-fluid'>
        <div class='row'>
            <div class="col-md-offset-1 col-md-offset-1">
                <div class='panel panel-primary'>
                    <div class='panel-heading'>
                    List of Nursing Care Plan Diagnosis</div>
                <div class='panel-body'>
                    <div class='clearfix'></div>
                    <table id="listDoc" class='table table-bordered table-condensed'>
                        <thead>
                            <tr>
                                <th style=" font-size: smaller;">No</th>
                                <th style=" font-size: smaller;">Element Code</th>
                                <th style=" font-size: smaller;">Discipline</th>
                                <th style=" font-size: smaller;">Nursing Diagnosis</th>
                                <th style=" font-size: smaller;">Method</th>
                                <th style=" font-size: smaller;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                             <?php
                                $no = 1;
                                foreach ($list_of_diagnosis as $diagnosis):
                                    ?>
                            <tr>
                                <td  style=" font-size: smaller; text-align: center;"><?php echo $no; $no++; ?></td>
                                <td  style=" font-size: smaller;"><?php echo $diagnosis['element_code']; ?></td>
                                <td  style=" font-size: smaller;"><?php echo $diagnosis['doc_name_desc']; ?></td>
                                <td  style=" font-size: smaller;"><?php echo $diagnosis['element_desc']; ?></td>
                                <td  style=" font-size: smaller;"><?php echo $diagnosis['method']; ?></td>
                                <td  style=" font-size: smaller;" class="text-center">
                                    <div class='btn-group btn-group-xs'>    
                                        <div data-docid="<?php echo $diagnosis['doc_name_id']; ?>" data-elemid="<?php echo $diagnosis['element_code']; ?>"  class='btn btn-default editMethod'>Edit</div>                                  
                                    </div>
                                </td>
                            </tr>
                             <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <a href="edit-form.php"></a>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"> </h4>
            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {

        $('[name=discipline]').change(function () {
            var disCode = $(this).val();
            $.ajax({
                url: '<?php echo SITE_ROOT; ?>/main/filter-ncp-discipline/',
                data: {dis_code: disCode},
                success: function (data) {
                    $('[name=doc_group]').html(data);
                    $('#documentFilter').submit();
                }
            });
        });

        $('[name=doc_group]').change(function () {
            $('#documentFilter').submit();
        });
    });

    $(function () {
        
<?php if ($preset_select): ?>
            $('[name=discipline]').val("<?php echo $preset_select['active_discipline']; ?>");
            $('[name=doc_group]').val("<?php echo $preset_select['active_group']; ?>");
<?php else: ?>
            $("[name=discipline]").change();
<?php endif; ?>

        $('#documentFilter').submit(function (e) {
            e.preventDefault();
            var values = $(this).serializeArray();
            $.ajax({
                url: '<?php echo SITE_ROOT; ?>/main/create-filter-diagnosis/',
                data: {documentValues: values},
                success: function (data) {
                    $('#listOfDocument').html(data);
                    $('#listDoc').DataTable(data);
                }
            });
        });
          });
</script>
<script>
    $(function () {
        $('.editMethod').click(function () {
             var docId = $(this).data('docid');
             var elementId = $(this).data('elemid');
             
            $.ajax({
                url: '<?= SITE_ROOT; ?>/formview/edit-ncp-method/',
                type: 'POST',
                data: {docId: docId, elementId: elementId},
               success: function (data) {
                    var obj = $.parseJSON(data);
                    $('.modal-dialog').addClass('modal-lg');
                    $('.modal-title').text(obj.component);
                    $('.modal-body').html(obj.html);
                }
            });
            $('#myModal').modal('show');
        });
       });
 </script>
 