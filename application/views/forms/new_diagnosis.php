<?php echo $header; ?>
<br><br>

<!--DOCUMENT ID'S-->
<div id="DiagnosisCreator">
     <div class="panel-body">
        <form id="formBuilder" class="form-horizontal">  
           
            <div class="form-group form-group-sm" style='margin-left:-40px;margin-top: -5px'>
                <label class="control-label col-sm-4">Document Title</label>
                <div class="col-sm-6" style='width:48.10%'>
                    <input name="doc_template" id="doc_template"  value="" type="hidden"  class="form-control docList text-uppercase" />
                            <input name="doc_name_id" id="doc_name_id"  value="<?= $document_id; ?>" type="hidden"  class="form-control docList text-uppercase"  />
                            <input name="doc_name_desc" id="doc_name_desc"  value="<?= $document_title; ?>" type="text"  class="form-control docList text-uppercase" autocomplete="autocomplete" disabled="disabled"/>   
                </div>  
            </div>

            <div class='col-sm-10 text-right' style='margin-left:-18px'>
                 <div class='btn-group btn-group-sm'>
                    <a class="btn btn-primary btn-sm backForm" href="<?php echo SITE_ROOT; ?>" >Back</a>
                </div>
                <div class='btn btn-primary btn-sm addForm' disabled>Add Diagnosis</div>
            </div>

        </form>
    </div>

    <div class='container-fluid'>
        <div class='row'>
            <div class="col-md-offset-1 col-md-offset-1">
                <div class='panel panel-primary'>
                    <div class='panel-heading'> Result of Existing Diagnosis</div>
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
                                                <input type="checkbox" name="icd10_id" value="<?php echo $diagnosis['icd10_id']; ?>">
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
<script>
    $(document).ready(function () {
        $('#tableForm').DataTable();
    });
</script>  
<script>
 $(document).ready(function () {
     
     $('#DiagnosisCreator').on('click', '.addDiagnosis', function(){
                var input = $("input:checkbox:checked");
                var selected = [];
                var documentId= '<?= $document_id; ?>';

                $(input).each(function(key, value) {
//                    console.log('execute: ', key, value);

                    var item = {
                        icd10_id: $(value).val()
                    };
                     console.log("item: ", item);
                     selected.push(item);
                });

                 console.log("selected item: ", selected);
                 console.log("documentId: ", documentId);   
               
                $.ajax({
                    url: '<?php echo SITE_ROOT; ?>/formbuilder/create-diagnosis',
                    data: {
                        documentId: documentId,
                        diagnosis: selected
                    },
                    success: function(data) {
                        swal({
                            title: "Inserted!",
                            text: "Diagnosis Successfully Updated",
                            type: "success"
                        });                
                    }
                });
//                setTimeout(
//                    function() {
//                        window.location.reload(true);
//                    }, 1200);
            });
            return false;
        });
</script>
<?php
echo $footer;
