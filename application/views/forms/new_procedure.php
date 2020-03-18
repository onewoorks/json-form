<?php echo $header; ?>

<!--DOCUMENT ID'S-->
<div id="formCreator">
    <div class="panel-body">
        <form id="formBuilder" class="form-horizontal">  

            <div class='form-group form-group-sm'>
                <table class='listcolumn' style='font-size:12px;margin-left:250px;text-align:right;' >
                    <tbody>
                        <tr>
                            <td><b>Product Category</td>
                            <td>
                                 <select name='doc_group' id='doc_group' class='form-control' >
                                    <option value='0' selected="selected">Please Select Document Group</option>
                                  
                                        <option value=''</option>
                                   
                                </select>
                                 
                            </td>
                            <td><b>Product Sub Group</td>
                            <td>
                                <select name='doc_group' id='doc_group' class='form-control' >
                                    <option value='0' selected="selected">Please Select Document Group</option>
                                  
                                        <option value=''</option>
                                   
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="form-group form-group-sm" style='margin-left:-40px;margin-top: -5px'>
                <label class="control-label col-sm-4">Document Title</label>
                <div class="col-sm-6" style='width:48.10%'>
                    <input name="doc_template" id="doc_template"  value="" type="hidden"  class="form-control docList text-uppercase" />
                            <input name="doc_name_id" id="doc_name_id"  value="<?= $document_id; ?>" type="hidden"  class="form-control docList text-uppercase"  />
                            <input name="doc_name_desc" id="doc_name_desc"  value="<?= $document_title; ?>" type="text"  class="form-control docList text-uppercase" autocomplete="autocomplete"/>   
                </div>  
            </div>

            <div class='col-sm-10 text-right' style='margin-left:-18px'>
                 <div class='btn-group btn-group-sm'>
                    <a class="btn btn-primary btn-sm backForm" href="<?php echo SITE_ROOT; ?>" >Back</a>
                </div>
                <div class='btn btn-primary btn-sm addForm' disabled>Add Procedure  </div>
            </div>

        </form>
    </div>

    <div class='container-fluid col-md-12' style='margin-left: 40px;'>
        <div class='panel panel-primary'>
            <div class='panel-heading'>
                <div class="btn-group pull-right">
                </div>

                Result of Existing Product</div>
            <div class='panel-body'>

                <table id="tableForm" class='table table-bordered table-condensed'>
                    <thead>
                        <tr>
                            <th style=" font-size: smaller;">Product Id</th>
                            <th style=" font-size: smaller;">Product Name</th>
                            <th style=" font-size: smaller;">Product Category</th>
                            <th style=" font-size: smaller;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!$list_of_procedure): ?>
                            <tr>
                                <td colspan="4"><i>No Record Found</i></td>
                            </tr>
                        <?php endif; ?>
                        <?php $no = 1;
                        foreach ($list_of_procedure as $procedure): ?>
                            <tr>
                                <td  style=" font-size: smaller; text-align: center"><?php echo $procedure['category_code']; ?></td>
                                <td  class="text-uppercase" style=" font-size: smaller;"><?php echo $procedure['category_name']; ?></td>
                                <td  class="text-uppercase" style=" font-size: smaller;"></td>
                                <td  style=" font-size: smaller; text-align: center">
                                    <div>
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

    <div id="title" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!--Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Change Title</h4>
                </div>
                <div class="modal-body"></div>
            </div>
        </div>
    </div>

    <div id="deleteModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!--Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Delete Document</h4>
                </div>
                <div class="modal-body"></div>
            </div>
        </div>
    </div>

<script>
    $(document).ready(function () {
        $('#tableForm').DataTable();
    });
</script>   

<?php
echo $footer;
