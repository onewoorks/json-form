<?php echo $config; ?>
<br><br>

<!--DOCUMENT ID'S-->
<div id="formCreator">
    <form id="sectionBuilder" class="form-horizontal col-md-offset-16 col-md-offset-1">
        <div class='panel panel-default' style='margin:0px -20px 10px 0px'>
            <div class="panel-heading">DIAGNOSIS</div>
            <div class='panel-body'>
               
                    <div class='form-group form-group-sm' >
                        <label class='control-label col-sm-3'>Document Title</label>
                        <div class='col-sm-4'>
                            <input name="doc_template" id="doc_template"  value="" type="hidden"  class="form-control docList text-uppercase" />
                            <input name="doc_name_id" id="doc_name_id"  value="" type="hidden"  class="form-control docList text-uppercase" />
                            <input name="doc_name_desc" id="doc_name_desc"  value="" type="text"  class="form-control docList text-uppercase" />
                        </div>
                    </div>
               
                <div class="col-sm-12 text-right">
                    <button type="button" class="btn btn-primary btn-sm pull-right addSection" disabled>Add Diagnosis</button>
                </div>
            </div>
        </div>
    </form>

    <div class='container-fluid'>
        <div class='row'>
            <div class="col-md-offset-1 col-md-offset-1">
                <div class='panel panel-primary'>
                    <div class='panel-heading'>

                        Result of Existing Diagnosis</div>
                    <div class='panel-body'>
                        <table id="tableForm" class='table table-bordered table-condensed'>
                            <thead>
                                <tr>
                                    <th style=" font-size: smaller;">ICD10 Code</th>
                                    <th style=" font-size: smaller;">ICD10 Description</th>
                                    <th style=" font-size: smaller;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!$list_of_diagnosis): ?>
                                    <tr>
                                        <td colspan="4"><i>No Record Found</i></td>
                                    </tr>
                                <?php endif; ?>
                                <?php
                                $no = 1;
                                foreach ($list_of_diagnosis as $diagnosis):
                                    ?>
                                    <tr>
                                        <td  style=" font-size: smaller; text-align: center"><?php echo $diagnosis['icd10_id']; ?></td>
                                        <td class="text-uppercase" style=" font-size: smaller;"><?php echo $diagnosis['description']; ?></td>
                                        <td  style=" font-size: smaller; text-align: center">
                                            <div>
                                                <input type="checkbox" id="<?php echo $diagnosis['icd10_id']; ?>">
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
<?php
echo $footer;
