<?php echo $header; ?>

<div id='listOfDocument'>
    <div class='panel panel-default'>
        <div class='panel-heading'>Search Panel</div>
        <div class='panel-body'>
            <form id='documentFilter' class='form-horizontal'>

                <div class='form-group form-group-sm'>
                    <label class='control-label col-sm-4'>Discipline</label>
                    <div class='col-sm-5'>
                        <select name='discipline' class='form-control'>
                            <?php foreach ($main_discipline as $discipline): ?>
                                <option value='<?php echo $discipline['value']; ?>'><?php echo $discipline['label']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                
                <div class='form-group form-group-sm'>
                    <label class='control-label col-sm-4'>Sub Discipline</label>
                    <div class='col-sm-5'>
                       <select name='general_discipline' class='form-control' >
                           <?php if (!$preset_select): ?>
                           <option value='0'>Please Select Discipline</option>
                           <?php else: ?>
                             <?php foreach ($general_discipline as $general): ?>
                                 <option value='<?php echo $general['value']; ?>'><?php echo $general['label']; ?></option>
                             <?php endforeach; ?>
                                 <?php endif; ?>
                         </select>
                    </div>
                </div>
                
                
                <div class='form-group form-group-sm'>
                    <label class='control-label col-sm-4'>Sub Discipline</label>
                    <div class='col-sm-5'>
                        <select name='general_discipline' class='form-control' >
                            <?php foreach ($general_discipline as $general): ?>
                                <option value='<?php echo $general['value']; ?>'><?php echo $general['label']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class='form-group form-group-sm'>
                    <label class='control-label col-sm-4'>Document Group</label>
                    <div class='col-sm-5'>
                        <select name='doc_group' class='form-control' >
                            <?php foreach ($doc_group as $doc): ?>
                                <option value='<?php echo $doc['code']; ?>'><?php echo $doc['label']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class='form-group form-group-sm'>
                    <label class='control-label col-sm-4'>Document Type</label>
                    <div class='col-sm-5'>
                        <select name='doc_type' class='form-control' >
                            <?php if (!$preset_select): ?>
                                <option value='0'>Please Select Document Group</option>
                            <?php else: ?>
                                <?php foreach ($doc_types as $doc): ?>
                                    <option value='<?php echo $doc['code']; ?>'><?php echo $doc['label']; ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
                <div class='form-group form-group-sm'>
                    <div class='col-sm-9 text-right'>
                        <button type='submit' class='btn btn-sm btn-primary'><i class='glyphicon glyphicon-search'></i> Filter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class='panel panel-primary'>
        <div class='panel-heading'>
            <div class="btn-group pull-right">
                <a href="#" class="btn btn-default btn-xs syncButton"><i class='glyphicon glyphicon-refresh'></i> Synchronize</a>
            </div>
            List of Template Documents</div>
        <div class='panel-body'>

            <table class='table table-bordered table-condensed'>
                <thead>
                    <tr>
                        <th>Discipline</th>
                        <th>Document Type</th>
                        <th>Document Title</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!$list_of_documents):?>
                    <tr>
                        <td colspan="4"><i>No Record Found</i></td>
                    </tr>
                    <?php endif;?>
                    <?php foreach ($list_of_documents as $document): ?>
                        <tr>
                            <td><?php echo $document['discipline_name']; ?></td>
                            <td><?php echo $document['dc_type_desc']; ?></td>
                            <td class='text-uppercase'><a href='<?php echo SITE_ROOT; ?>/formview/form-template/<?php echo $document['template_id']; ?>'><?php echo $document['doc_name_desc']; ?></a></td>
                            <td class='text-center'>
                                <div class='btn-group btn-group-xs'>
                                    <a href='<?php echo SITE_ROOT; ?>/formview/form-template/<?php echo $document['template_id']; ?>' class='btn btn-default'>VIEW</a>
                                    <a href='<?php echo SITE_ROOT; ?>/formview/edit-form/<?php echo $document['template_id']; ?>' class='btn btn-default'>UPDATE</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
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
                }
            });
        });

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