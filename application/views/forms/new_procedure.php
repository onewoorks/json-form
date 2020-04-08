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
                <label class="control-label col-sm-4">Product Category</label>
                <div class="col-sm-6" style='width:48.35%'>
                    <select name='doc_group' class='form-control' >
                        <option value='0' selected="selected">Please Select Product Category</option>
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
                <div class='btn btn-primary btn-sm addProcedure' >Add Procedure</div>
            </div>

        </form>
    </div>

    <div class='container-fluid col-sm-12' style='margin-left: 45px;'>
        <div class='row'>
            <div class='panel panel-primary'>
                <div class='panel-heading'>Result of Existing Product</div>
                <div class='panel-body'>
                     <div class="form-inline">
                        <div class ='pull-left' style=" font-size: smaller; padding-bottom: 3px;"><b>Total Document = <?= count($list_of_procedure); ?></b></div>
                        <input type="text" class="pull-right col-sm-2 text-uppercase" style="margin-bottom: 5px; font-size:12px;padding:3px 10px;height:25px;line-height: 1.5;border:1px solid #cccccc;border-radius:4px" id="search" placeholder="Search" hidden/>
                    </div>
                    <div class='clearfix'></div>

                    <table id="listDoc" class='table table-bordered table-condensed'>
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
                            <?php
                            $no = 1;
                            foreach ($list_of_procedure as $procedure):
                                ?>
                                <tr>
                                    <td  style=" font-size: smaller; text-align: center"><?php echo $procedure['product_code']; ?></td>
                                    <td  class="text-uppercase" style=" font-size: smaller;"><?php echo $procedure['product_name']; ?></td>
                                    <td  class="text-uppercase" style=" font-size: smaller; text-align: center"><?php echo $procedure['form_name']; ?></td>
                                    <td  style=" font-size: smaller; text-align: center">
                                        <div>
                                            <?php if ($procedure['available']) : ?>
                                            <input type="checkbox" name="product_id" value="<?php echo $procedure['product_code']; ?>" checked="checked">
                                        <?php else : ?>
                                             <input type="checkbox" name="product_id" value="<?php echo $procedure['product_code']; ?>">
                                        <?php endif; ?>
                                           
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!--            </div>-->
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
            var documentId = '<?= $document_id; ?>';
            $.ajax({
                url: '<?php echo SITE_ROOT; ?>/main/filter-procedure/',
                data: {documentValues: values, documentId: documentId},
                success: function (data) {
                    $('#listOfDocument').html(data);
                }
            });
        });
    });
</script>
<script>
    $(function () {

        $('.addProcedure').click( function () {
          
            var input = $("input:checkbox:checked");
            var selected = $(this).serializeArray();
            
                $(input).each(function (key, value) {
                  
                    var item = {
                        name: key, value: $(value).val()
                    };
                    selected.push(item);
                });
            
            var documentId = '<?= $document_id; ?>';
            var datas = JSON.stringify(selected);
            console.log("selected item: ", datas);
            console.log("documentId: ", documentId);
          
            $.ajax({
                url: '<?= SITE_ROOT; ?>/formview/create-procedure/',
                type: 'POST',
                data: {
                    dummy: null, documentId: documentId, proDetails: JSON.stringify(selected)
                },
                success: function (data) {
                    console.log(data);
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
        return false;
    });
</script>
<script>
    $(document).ready(function () {
        var selected = $('#doc_group').val();
        if (selected !== '0') {
            $('#search').removeAttr('hidden');
        } else {
            $('#search').addClass('hidden');
        }
    });
    </script>


<?php
echo $footer;
