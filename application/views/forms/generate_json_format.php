<?php echo $header;?>

<div id='generateJson'>
            <form id='documentFilter' class='form-horizontal'>

                <div class='form-group form-group-sm'>
                    <table class='listcolumn' style='font-size: 12px; margin-left: 250px;  text-align: right; ' >
                <tbody>
                    <tr>
                        <td><b>Discipline</b></td>
                        <td>
                        <select name='discipline' class='form-control col-md-10'>
                            <?php foreach ($main_discipline as $discipline): ?>
                                <option value='<?php echo $discipline['code']; ?>'><?php echo $discipline['label']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        </td>
                        <td><b>Document Group</b></td>
                        <td><select name='doc_group' class='form-control'>
                            <option value='0' selected="selected">Please Select Document Group</option>
                            <?php foreach ($doc_group as $doc): ?>
                                <option value='<?php echo $doc['code']; ?>'><?php echo $doc['label']; ?></option>
                            <?php endforeach; ?>
                        </select></td>
                    </tr>
                    <tr>
                        <td><b>Sub Discipline</b></td>
                        <td><select name='general_discipline' class='form-control'>
                           <?php if (!$preset_select): ?>
                           <option value='0'>Please Select Discipline</option>
                           <?php else: ?>
                           <option value='0' selected="selected" >Please Select Sub Discipline</option>
                             <?php foreach ($general_discipline as $general): ?>
                                 <option value='<?php echo $general['code']; ?>'><?php echo $general['label']; ?></option>
                             <?php endforeach; ?>
                                 <?php endif; ?>
                         </select></td>
                         <td><b>Document Type</b></td>
                        <td><select name='doc_type' class='form-control'>
                            <?php if (!$preset_select): ?>
                                <option value='0' selected="selected">Please Select Document Group</option>
                            <?php else: ?>
                                <option value='0' >Please Select Document Type</option>
                                <?php foreach ($doc_types as $doc): ?>
                                    <option value='<?php echo $doc['code']; ?>'><?php echo $doc['label']; ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select></td>
                    </tr>
                </tbody>
                </table>
                </div>

            </form>
        <!--</div>-->
    <!--</div>-->
<div class='panel panel-primary' style='margin-left:15px'>
    <div class='panel-heading'>List of Template Documents With Data</div>
    <div class='panel-body'>
        <div class='pull-left' style=" font-size: 12px; "><b>Total Document = <?= count($available_documents);?></b></div>
        <div class='pull-right'>
            <!--<div class='btn btn-xs btn-primary syncButton'>Synchronize</div>-->
            <div class='btn btn-xs btn-primary generateButton'>Select Generate</div>
            <div class='btn btn-xs btn-warning regenerateButton'>Select Re-generate</div>
            <div class='btn btn-xs btn-default executeAction'>Execute</div>
        </div>
        <div class='clearfix'></div>
        <br>

        <table class='table table-condensed table-bordered'>
            <thead>
                <tr>
                    <th style=" font-size: smaller;">No</th>
                    <th style=" font-size: smaller;">Discipline</th>
                    <th style=" font-size: smaller;">Sub Discipline</th>
                    <th style=" font-size: smaller;">Document Type</th>
                    <th style=" font-size: smaller;">Document Title</th>
                    <th style=" font-size: smaller;">Status</th>
                    <th style=" font-size: smaller;">Action</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                 <?php if(!$available_documents):?>
                    <tr>
                        <td colspan="7"><i>No Record Found</i></td>
                    </tr>
                    <?php endif;?>
                <?php $no=1; foreach ($available_documents as $document): ?> 
                    <tr>            
                        <td class='text-uppercase' style=" font-size: smaller; text-align: center;"><?php echo $no; $no++;  ?></td>
                        <td class='text-uppercase' style=" font-size: smaller;"><?= $document['main_discipline_name']; ?></td>
                        <td class='text-uppercase' style=" font-size: smaller;"><?= $document['discipline_name']; ?></td>
                        <td class='text-uppercase' style=" font-size: smaller;"><?= $document['dc_type_desc']; ?></td>
                        <td class='text-uppercase' style=" font-size: smaller;"><?= $document['doc_name_desc']; ?></td>
                        <td class='text-uppercase text-center'>
                            <?php if ($document['available']): ?>
                                <i class="text-success glyphicon glyphicon-ok-sign"></i>
                            <?php else: ?>
                                <i class='text-warning glyphicon glyphicon-exclamation-sign'></i>
                            <?php endif; ?>
                        </td>
                        <td class='text-center'>
                            <?php if (!$document['available']): ?>
                                <div class='label label-primary'>Generate</div>
                            <?php else: ?>
                                <div class='label label-warning'>Re-generate</div>
                            <?php endif; ?>
                        </td>
                        <td class='text-center'>
                            <input type='checkbox' class='<?= ($document['available']) ? 'checkAda' : 'checkTiada'; ?>' 
                                   value='<?= $document['doc_name_id']; ?>' 
                                   templateId='<?= (isset($document['template_id'])) ? $document['template_id'] : '0'; ?>'/></td>
                    </tr>
                <?php endforeach; ?>
                    
            </tbody>
        </table>        
    </div>
</div>
<script>
    $(function () {
        $('[name=doc_group]').change(function () {
            var groupCode = $(this).val();
            $.ajax({
                url: '<?php echo SITE_ROOT; ?>/main/filter/',
                data: {group_code: groupCode},
                success: function (data) {
                    $('[name=doc_type]').html(data);
                    $('#documentFilter').submit();
                }
            });
        });
   
        $('[name=discipline]').change(function () {
            var disCode = $(this).val();
            $.ajax({
                url: '<?php echo SITE_ROOT; ?>/main/filter-discipline/',
                data: {dis_code: disCode},
                success: function (data) { 
                    $('[name=general_discipline]').html(data);
                    $('[name=doc_group]').html('<option value="0">Please Select</option>');
                    $('[name=doc_type]').html('<option value="0">Please Select</option>');  
                    $('#documentFilter').submit();
                }
            });
        });
        
        $('[name=general_discipline]').change(function () {
            $('[name=doc_group]').html('<option value="0">Please Select</option>');
            $('[name=doc_type]').html('<option value="0">Please Select</option>');
            $('#documentFilter').submit();
        });  
        
        $('[name=doc_type]').change(function () {
            $('#documentFilter').submit();
        });

        $('.syncButton').click(function(){
            $.ajax({
                url : '<?php echo SITE_ROOT;?>/main/sync/',
                success : function(data){
//                    console.log(data);
                }
            });
        });

<?php if ($preset_select): ?>
            $('[name=discipline]').val("<?php echo $preset_select['active_discipline']; ?>");
            $('[name=general_discipline]').val("<?php echo $preset_select['active_general']; ?>");
            $('[name=doc_group]').val("<?php echo $preset_select['active_group']; ?>");
            $('[name=doc_type]').val("<?php echo $preset_select['active_type']; ?>");
<?php else: ?>
            $("[name=discipline]").change();
            $("[name=doc_group]").change();
<?php endif; ?>


        $('#documentFilter').submit(function (e) {
            e.preventDefault();
            var values = $(this).serializeArray();
            $.ajax({
                url: '<?php echo SITE_ROOT; ?>/main/generate-json-table/',
                data: {documentValues: values},
                success: function (data) {
                    $('#generateJson').html(data);
                }
            });

        });
    });
    
    $(function () {
        $('.generateButton').on('click', function () {
            $('.checkAda').prop({
//                checked: false,
                disabled: true
            });
            $('.checkTiada').prop({
                checked: false,
                disabled: false
            });
        });
        $('.regenerateButton').on('click', function () {
            $('.checkAda').prop({
//                checked: true,
                disabled: false
            });
            $('.checkTiada').prop({
                checked: false,
                disabled: true
            });
        });
        $('.generateButton').trigger('click');
        
        $('.executeAction').on('click', function () {
            var input = $("input:checkbox:checked");
            var selected = [];
            var type = '';
            
            $(input).each(function (key, value) {
                $(input).each(function (key, templateId) {
               
                    if($(this).attr('class')==='checkAda'){
                        type = 'regenerate';
                    } else {
                        type = 'add';
                    }
                    var item = { doc_name_id: $(value).val(), template_id: $(templateId).val()};
                    selected.push(item);
              });
           });
          
            $(this).text('Executing selected action...');
            $.ajax({
                url: '<?php echo SITE_ROOT; ?>/formbuilder/generate-json/',
                data : { type: type, documents : selected },
                success : function(data){
                    swal({
                        title: "Generated!",
                        text: "System successfully created form template for selected data,",
                        type: "success",
                        showCancelButton: true,
                        confirmButtonColor: "#80bf07",
                        confirmButtonText: "Go To Document List!",
                        closeOnConfirm: false
                    },
                    function (isConfirm) {
                        if(isConfirm){
                            window.location.href = '<?php echo SITE_ROOT; ?>';
                        } else {
                            window.location.reload;
                        }
                        
                    });                   
                }
            });
//            
        });
    });
</script>
<?php echo $footer; ?>
