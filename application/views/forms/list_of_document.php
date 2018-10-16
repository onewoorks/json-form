<?php echo $header; ?>

<div id='listOfDocument'>
            <form id='documentFilter' class='form-horizontal'>
                <div class='form-group form-group-sm'>
                    <table class='listcolumn' style='font-size:12px;margin-left:250px;text-align:right;' >
                <tbody>
                    <tr>
                        <td><b>Discipline</b></td>
                        <td>
                        <select name='discipline' class='form-control col-md-10'>
                            <option value='0' selected="selected">Please Select Discipline</option>
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
                                <?php if(isset($doc_types)):?>
                                <?php foreach ($doc_types as $doc): ?>
                                    <option value='<?php echo $doc['code']; ?>'><?php echo $doc['label']; ?></option>
                                <?php endforeach; ?>
                                <?php endif;?>
                            <?php endif; ?>
                        </select></td>
                    </tr>
                </tbody>
                    </table>
                </div>
            </form>

<div class='container-fluid'>
    <div class='panel panel-primary'>
        <div class='panel-heading'>
            <div class="btn-group pull-right">
                <a href="#" class="btn btn-default btn-xs syncButton"><i class='glyphicon glyphicon-refresh'></i> Synchronize</a>
            </div>

            List of Template Documents</div>
        <div class='panel-body'>
            <div class ='pull-left' style=" font-size: smaller; padding-bottom: 3px;"><b>Total Document = <?= count($list_of_documents);?></b></div>
            <div class='clearfix'></div>

            <table class='table table-bordered table-condensed'>
                <thead>
                    <tr>
                        <th style=" font-size: smaller;">No</th>
                        <th style=" font-size: smaller;">Discipline</th>
                        <th style=" font-size: smaller;">Sub Discipline</th>
                        <th style=" font-size: smaller;">Document Group</th>
                        <th style=" font-size: smaller;">Document Type</th>
                        <th style=" font-size: smaller;">Document Title</th>
                        <th style=" font-size: smaller;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!$list_of_documents):?>
                    <tr>
                        <td colspan="7"><i style="font-size: 12px;">No Record Found</i></td>
                    </tr>
                    <?php endif;?>
                    <?php $no=1; foreach ($list_of_documents as $document): ?>
                        <tr>
                            <td  style=" font-size: smaller; text-align: center;"><?php echo $no; $no++; ?></td>
                            <td  style=" font-size: smaller;"><?php echo $document['main_discipline_name']; ?></td>
                            <td  style=" font-size: smaller;"><?php echo $document['discipline_name']; ?></td>
                            <td  style=" font-size: smaller;"><?php echo $document['doc_group_desc']; ?></td>
                            <td  style=" font-size: smaller;"><?php echo $document['dc_type_desc']; ?></td>
                            <td class='text-uppercase'  style=" font-size: smaller;"><a href='<?php echo SITE_ROOT; ?>/formview/form-template/<?php echo $document['template_id']; ?>'><?php echo $document['doc_name_desc']; ?></a></td>
                            <td class='text-center'>
                                <div class='btn-group btn-group-xs'>
                                    <a href='<?php echo SITE_ROOT; ?>/formview/form-template/<?php echo $document['template_id']; ?>' class='btn btn-default' target="_blank">VIEW</a>
                                    <a href='<?php echo SITE_ROOT; ?>/formview/edit-form/<?php echo $document['template_id']; ?>' class='btn btn-default' target="_blank">UPDATE</a>
                                    <a href='<?php echo SITE_ROOT; ?>/formview/clone-form/<?php echo $document['template_id']; ?>' class='btn btn-default'>CLONE</a>                                    
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
<script>
//    $(document).ready(function() {
//        $('#listForm').DataTable();
//    } );
    
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
        });
    
 $(function () {
 $('.syncButton').click(function(){
            $.ajax({
                url : '<?php echo SITE_ROOT;?>/main/sync/',
                success : function(data){
                    console.log(data);
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
                url: '<?php echo SITE_ROOT; ?>/main/search-by-filter/',
                data: {documentValues: values},
                success: function (data) {
                    $('#listOfDocument').html(data);
                }
            });

        });
    });
</script>
<?php echo $footer; ?>