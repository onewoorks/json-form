<?php echo $header; ?>
<!--DOCUMENT ID'S-->
<div id="listOfDocument">
    <div class="panel-body">
        <form id="documentFilter" class="form-horizontal">   

            <div class="form-group form-group-sm" style='margin-left:-40px;margin-top: -5px'>
                <label class="control-label col-sm-4">Document Title</label>
                <div class="col-sm-6" style='width:48.35%'>
                    <input name="doc_name_id" id="doc_name_id"  value="<?= $document_id; ?>" type="hidden"  class="form-control docList text-uppercase"  />
                    <input name="doc_name_desc" id="doc_name_desc"  value="<?= $document_title; ?>" type="text"  class="form-control docList text-uppercase" autocomplete="autocomplete" readonly/>   
                </div>  
            </div>

            <div class="form-group form-group-sm" style='margin-left:-40px;margin-top: 5px'>
                <label class="control-label col-sm-4">Diagnosis Source</label>
                <div class="col-sm-6" style='width:48.35%'>
                    <select name='doc_group' class='form-control' >
                        <option value='0' selected="selected">Please Select Diagnosis Source</option>
                        <?php foreach ($doc_group as $doc): ?>
                            <option value='<?php echo $doc['code']; ?>'><?php echo $doc['label']; ?></option>
                        <?php endforeach; ?>
                    </select>   
                </div>  
            </div>

            <div class='col-sm-10 text-right' style='margin-left:-18px'>
                <div class='btn-group btn-group-sm'>
                    <a class="btn btn-primary btn-sm backForm" href="<?php echo SITE_ROOT; ?>" >Back</a>
                </div>
                <div class='btn btn-primary btn-sm addDiagnosis' >Add Diagnosis</div>
            </div>

        </form>
    </div>

    <div class='container-fluid'>
        <div class='row'>
            <div class="col-md-offset-1 col-md-offset-1">
                <div class='panel panel-primary'>
                    <div class='panel-heading'> Result of Existing Diagnosis</div>
                    <div class='panel-body'>
                        <table id="listDoc" class='table table-bordered table-condensed'>
                            <thead>
                                <tr>
                                    <th style=" font-size: smaller;">Diagnosis Code</th>
                                    <th style=" font-size: smaller;">Diagnosis Description</th>
                                    <th style=" font-size: smaller;" hidden>Diagnosis Source</th>
                                    <th style=" font-size: smaller;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($list_of_diagnosis as $diagnosis):
                                    ?>
                                    <tr>
                                        <td  style=" font-size: smaller; text-align: center"><?php echo $diagnosis['codes']; ?></td>
                                        <td class="text-uppercase" style=" font-size: smaller;"><?php echo $diagnosis['descs']; ?></td>
                                        <td class="text-uppercase" style=" font-size: smaller;" hidden>
                                             <input type="text" name="type" value="<?php echo $diagnosis['diagno']; ?>">
                                            
                                        </td>
                                        <td  style=" font-size: smaller; text-align: center">
                                         <div>
                                            <?php if ($diagnosis['available']) : ?>
                                            <input type="checkbox" name="diagnose_id" value="<?php echo $diagnosis['codes']; ?>" checked="checked">
                                        <?php else : ?>
                                             <input type="checkbox" name="diagnose_id" value="<?php echo $diagnosis['codes']; ?>">
                                        <?php endif; ?>
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
        $('#listDoc').DataTable();
    });
    
    $(function () {
        $('[name=doc_group]').change(function () {
            $('#documentFilter').submit();
        });
    });

    $(function () {
<?php if ($preset_select): ?>
            $('[name=doc_group]').val("<?php echo $preset_select['active_group']; ?>");
<?php endif; ?>

        $('#documentFilter').submit(function (e) {
            e.preventDefault();
            var values = $(this).serializeArray();
        //    console.log(values);
            var documentId = '<?= $document_id; ?>';
            $.ajax({
                url: '<?php echo SITE_ROOT; ?>/main/filter-diagnosis/',
                data: {documentValues: values, documentId: documentId},
                success: function (data) {
                    $('#listOfDocument').html(data);
                }
            });
        });
    });
</script>
<script>
    
        $('.addDiagnosis').click( function () {
          
            var input = $("input:checkbox:checked");
            var selected = $(this).serializeArray();
            
                $(input).each(function (key, value) {
                  
                    var item = {
                        name: key, value: $(value).val()
                    };
                    selected.push(item);
                });
            
            var documentId = '<?= $document_id; ?>';
            var source = $('[name=type]').val();
            var datas = JSON.stringify(selected);
         //   console.log("selected item: ", datas);
         //   console.log("documentId: ", documentId);
        //    console.log("source: ", source);
          
            $.ajax({
                url: '<?= SITE_ROOT; ?>/formview/create-diagnosis/',
                type: 'POST',
                data: {
                    dummy: null, documentId: documentId, DiagnosisDetails: JSON.stringify(selected),source: source,
                },
                success: function (data) {
             //       console.log(data);
                    swal({
                        title: "Inserted!",
                        text: "Procedure Successfully Updated",
                        type: "success"
                    });
                }
            });
                setTimeout(
                    function() {
                        window.location.reload(true);
                    }, 1200);
        
        });
    
</script>

    

<?php
echo $footer;
