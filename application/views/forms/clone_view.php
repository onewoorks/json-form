<?php echo $header;?>


<div id="formCreator">
<div class="col-sm-12">
            <form id='formFilter' class='form-horizontal'>
                <div class='form-group form-group-sm' style="padding-top: 20px">
                    <table class='listcolumn' style='font-size:12px;margin-left:250px;text-align:right;' >
                <tbody>
                    <tr>
                        <td><b>Discipline</b></td>
                        <td>
                        <select name='discipline' id='discipline' class='form-control col-md-10'>
                            <option value='0' selected="selected">Please Select Discipline</option>
                            <?php foreach ($main_discipline as $discipline): ?>
                                <option value='<?php echo $discipline['code']; ?>'><?php echo $discipline['label']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        </td>
                        <td><b>Document Group</b></td>
                        <td><select name='doc_group' id='doc_group' class='form-control'>
                            <option value='0' selected="selected">Please Select Document Group</option>
                            <?php foreach ($doc_group as $doc): ?>
                                <option value='<?php echo $doc['code']; ?>'><?php echo $doc['label']; ?></option>
                            <?php endforeach; ?>
                        </select></td>
                    </tr>
                    <tr>
                        <td><b>Sub Discipline</b></td>
                        <td><select name='general_discipline' id='general_discipline' class='form-control'>
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
                        <td><select name='doc_type' id='doc_type' class='form-control'>
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
                    <div class="col-sm-12 form-inline">
                        <label style="margin-left:262px">Document Title</label>
                        <input style="margin-left:26px;width:48.2%" name="doc_name_desc" id="doc_name_desc" type="text" class="form-control" value=""/>
                        <input style="margin-left:26px;width:48.2%" name="doc_name_id" id="doc_name_id" type="hidden" class="form-control" value=""/>
                    </div>
                    <div class="col-sm-2 pull-right">
                        <div class="btn btn-success btn-sm saveTitle">Save</div>
                        <div class="btn btn-danger btn-sm delTitle">Cancel</div>
                    </div>
                </div>
            </form>    
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
                    $('#formFilter').submit();
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
                    $('#formFilter').submit();
                }
            });
        });
        
        $('[name=general_discipline]').change(function () {
            $('[name=doc_group]').html('<option value="0">Please Select</option>');
            $('[name=doc_type]').html('<option value="0">Please Select</option>');
            $('#formFilter').submit();
        });  
        
        $('[name=doc_type]').change(function () {
            $('#formFilter').submit();
        });
        });
    
 $(function () {
 
<?php if ($preset_select): ?>
            $('[name=discipline]').val("<?php echo $preset_select['active_discipline']; ?>");
            $('[name=general_discipline]').val("<?php echo $preset_select['active_general']; ?>");
            $('[name=doc_group]').val("<?php echo $preset_select['active_group']; ?>");
            $('[name=doc_type]').val("<?php echo $preset_select['active_type']; ?>");
<?php else: ?>
            $("[name=discipline]").change();
            $("[name=doc_group]").change();
<?php endif; ?>

        $('#formFilter').submit(function (e) {
            e.preventDefault();
            var values = $(this).serializeArray();
            $.ajax({
                url: '<?php echo SITE_ROOT; ?>/main/filter-form-clone/',
                data: {documentValues: values},
                success: function (data) {
                    $('#formCreator').html(data);
                }
            });
        });
        
    });
</script>
<script>
$(document).ready(function() {

    var dis;
    var subdis;
    var group;
    var type;
    var docId;
    var url = $(location).attr('href'),
    parts = url.split("/"),
    last_part = parts[parts.length-1];
    var last_id = parts[parts.length-2];
    var replace = last_part.replace(/\%20/g,' ');
    $("#doc_name_desc").val(replace);
    $("#doc_name_id").val(last_id);
    
    $('.saveTitle').click(function () {
        docId = $('#doc_name_id').val();
        console.log(docId);
        dis = $('#discipline').val();
        subdis = $('#general_discipline').val();
        group = $('#doc_group').val();
        type = $('#doc_type').val();
        console.log(dis,subdis,group,type);
        var values = $("#formFilter").serializeArray();
        console.log(values);
        
        $.ajax({
                url: '<?= SITE_ROOT; ?>/formview/copy-form/',
                data: {values:values,docId:docId},
                success: function (data) {
                swal({
                title: "Form Created!",
                text: "Data successfully inserted into database",
                type: "success"
                });
                $('#myPopup').modal('hide');
                }
        });
        setTimeout(function() {
        window.location.href = '<?= SITE_ROOT; ?>';
        }, 1200);
        
    });
    
    $('.delTitle').click(function () {
        window.location.href = '<?= SITE_ROOT; ?>';
    });

    
}); 


</script>

<?php echo $footer;