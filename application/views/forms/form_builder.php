<?php echo $header; ?>

<div id="formCreator">
<div class="col-sm-12">
<div class="panel panel-default">
<div class="panel-heading">TITLE DETAILS</div>
<div class="panel-body">
            <form id='formFilter' class='form-horizontal'>
                <div class='form-group form-group-sm'>
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
                    <tr>
                        <td><b>Document Title</b></td>
                        <td>
                            <input name="doc_name_desc" id="doc_name_desc" type="text" class="form-control docList" list="docList" />
                            <datalist id="docList">
                                <?php foreach ($list_of_documents as $document): ?>
                                <option value="<?php echo $document['doc_name_desc']; ?>" data-id="<?php echo $document['doc_name_id']; ?>"></option>
                                <?php endforeach; ?>
                            </datalist>
                            <?php if(!$list_of_documents):?>
                            <span style="font-size:10px;color:red">No Record Found</span>
                            <?php endif;?>
                        </td>
                    </tr>
                </tbody>
                    </table>
                </div>
            </form>    
</div>
</div> 
</div>
    
<select id="section_desc_list" name="section_desc_list" class="form-control hidden">
<?php foreach ($sections as $section): ?>
    <option value="<?php echo $section['section_desc']; ?>" data-code="<?php echo $section['section_code']; ?>" data-id="<?php echo $section['json_section']; ?>"></option>
<?php endforeach; ?>    
</select>

<select id="element_desc_list" name="element_desc_list" class="form-control hidden">
<?php foreach ($elements as $element): ?>
    <option value='<?php echo $element['element_desc']; ?>'><?php echo $element['element_code']; ?></option>
<?php endforeach; ?>    
</select>
    
<!--SECTION ID'S-->
<div class="col-sm-6">
<form id="sectionBuilder" class="form-horizontal">
            <div class='panel panel-default'>
                <div class='panel-heading'>SECTION DETAILS</div>
                <div class='panel-body'>
                    <div id='sectionGroup'>
                    <div class='form-group form-group-sm' >
                        <label class='control-label col-sm-4'>Section Description</label>
                        <div class='col-sm-6'>
                            <input type='text' name='section_desc' id="section_desc" class='form-control secList' list="secList" />
                            <datalist name="secList" id="secList">
                                <?php foreach ($sections as $section): ?>
                                        <option value="<?php echo $section['section_desc']; ?>" data-code="<?php echo $section['section_code']; ?>" data-id="<?php echo $section['json_section']; ?>"></option>
                                <?php endforeach; ?>
                            </datalist>
                        </div>
                        <div class='col-sm-2 sectionAction' data-sectionno='1'>
                            <div class='btn btn-default btn-sm plusSection' data-sectionno='1' style='padding:4px'><i class='glyphicon glyphicon-plus'></i></div>
                        </div>
                    </div>
                    </div>
                    <div class="col-sm-2 pull-right">
                        <div class="btn btn-primary btn-sm" id="addSection" data-number='1'>Add Section</div>
                    </div>
                </div>
            </div>
</form>
</div>

<!--ELEMENT'S ID-->
<div class="col-sm-6">
<div class="panel panel-default">
    <div class="panel-heading">ELEMENT DETAILS</div>
    <div class="panel-body">
        <div id="tambahsection" ></div>
        <!--tmpt display section dlm element (DARI SCRIPT)-->
        <div class='row'>
        <div class='col-sm-12 text-right'>
            <div class='btn btn-primary btn-sm' id='createForm'>Add Element</div>
        </div>
        </div>
    </div>
</div>
</div>

<!--ELEMENT POP UP-->
<div id="myModal" class="modal fade" role="dialog">
    <div class='col-md-12'>
        <div class="modal-dialog modal-lg">
        <!--MODAL CONTENT-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
            </div>
        </div>
        </div>
    </div>
</div>
    
    <!--DISPLAY JSON-->
    <div class="col-sm-12 pull-right">
        <div class="btn btn-default pull-right addTitle">Display JSON</div>
    </div>

</div>

<div id="json">
    <div class="col-sm-12">
    <br>
    <div class="panel panel-default">
    <div class="panel-heading">JSON FORMAT</div>
    <div class="panel-body">
        <div class="text-uppercase">
            <div class='jsonTitle'></div>
        </div>
        <br><br>
        <br><br>
        <br><br>
        <div class='jsonSection'></div>
    </div>
    </div>
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
                url: '<?php echo SITE_ROOT; ?>/main/filter-form-builder/',
                data: {documentValues: values},
                success: function (data) {
                    $('#formCreator').html(data);
                }
            });
        });
        
    });
</script>

<script>
$(document).ready(function(){
    $("#json").hide();
    var option =$('#section_desc_list').html();
    var option2 =$('#element_desc_list').html();
    
    //DISPLAY JSON
    $(".addTitle").click(function(){
    $("#json").toggle();
    
    var doc_name_desc = $('#doc_name_desc').val();
    var input = $('#docList [value="' + doc_name_desc + '"]').data('id');
    console.log('doc_name_id',input);
    var discipline = $('#discipline :selected').text();
    var gen_discipline = $('#general_discipline :selected').text();
    var doc_group = $('#doc_group :selected').text();
    var doc_type = $('#doc_type :selected').text();
    console.log(discipline,gen_discipline,doc_group,doc_type);

    
    var $html = '<div class="col-xs-2">Discipline </div>';
    $html += '<div class="col-xs-10">: <strong>'+discipline+'</strong></div>';
    $html += '<div class="col-xs-2">Sub Discipline </div>';
    $html += '<div class="col-xs-10">: <strong>'+gen_discipline+'</strong></div>';
    $html += '<div class="col-xs-2">Document Group </div>';
    $html += '<div class="col-xs-10">: <strong>'+doc_group+'</strong></div>';
    $html += '<div class="col-xs-2">Document Type </div>';
    $html += '<div class="col-xs-10">: <strong>'+doc_type+'</strong></div>';
    $html += '<div class="col-xs-2">Document Title </div>';
    $html += '<div class="col-xs-10">: <strong>'+doc_name_desc+'</strong></div>';
    
    $($html).appendTo('.jsonTitle');

    });
    
    //PLUS SECTION
    $('#sectionGroup').on('click','.plusSection',function () {
            var sectionNo = $(this).data('sectionno');
            console.log('sectionNo ' + sectionNo);
            var next = sectionNo + 1 ;
            console.log('next ' + next);
            var $html = "<div id='section_add_"+next+"' class='form-group form-group-sm'>";
            $html += "<label class='control-label col-sm-4'></label>";
            $html += "<div class='col-sm-6'>";
            $html += "<input type='text' name='section_desc' id='section_desc' class='form-control secList' list='secList'/>";
            $html += "<datalist name='secList' id='secList'>"+option+"</datalist>";    
            $html += "</div>";
            $html += "<div class='col-sm-2 sectionAction' data-sectionno='"+next+"'>";
            $html +="<div class='btn btn-default btn-sm minusSection' style='padding:4px' data-sectionno='"+next+"'><i class='glyphicon glyphicon-minus'></i><div>";
            $html += "</div>";
            $html += "</div>";
            $($html).appendTo('#sectionGroup');//add a text or html content after the content of the matched elements (so die msuk blik kt panel section)
    });
    
    //MINUS SECTION
    $('#sectionGroup').on('click','.minusSection',function () {
            var dropid = $(this).data('sectionno');
            $('#section_add_'+dropid).remove();
    });
    
    //DELETE SECTION (PANEL ELEMENT)
    $('#tambahsection').on('click','.delSection',function () {
            var delid = $(this).data('secid');
            $('#section_panel' + delid).remove();
    });
        
    //REMOVE ELEMENT TEXTFIELD
    $('#tambahsection').on('click','.elementDel',function () {
            var del = $(this).data('target');
            console.log('delete element: '+ del);
            $('#element_add_' + del).remove();
    });
    
    //ADD SECTION
    $('#addSection').click(function () {
        var input = $('#sectionBuilder').serializeArray();
        var $sectionPanel = ' ';
        $(input).each(function(key,value){
            console.log('key',key);
            console.log('value',value);
            
            //DISPLAY SECTION DLM ELEMENT PANEL
            if (input[key].value==="") {
             $sectionPanel += '<div id="section_panel'+key+'"class="panel panel-primary">';//1
             $sectionPanel += '<div class="panel-heading" style="height:30px">'+input[key].value+'';//none
             $sectionPanel += '<div class="btn btn-default btn-xs delSection pull-right" data-secid='+key+'><i class="glyphicon glyphicon-trash"></i></div>';//trash kt header
             $sectionPanel += '<div class="btn btn-default btn-xs expandButton pull-right" data-toggle="collapse" data-target="#demo'+key+'" ><i class="glyphicon glyphicon-chevron-down"></i></div>';//expand kt header
             $sectionPanel += '</div>'; 
             $sectionPanel += '<div id="demo'+key+'" class="collapse">';//buka expand
             $sectionPanel += '<div class="col-sm-4 list-padding"><input type="hidden" name="section_desc" class="form-control" value="' +input[key].value+'" disabled /></div> ';
             $sectionPanel += '<div id="section_body'+key+'" class="panel-body">';//display panel body
             $sectionPanel += '<form id="elementBuilder" class="form-horizontal">';        
                $sectionPanel += '<label class="control-label col-sm-3">Element Name</label>';
                $sectionPanel += '<div  class="col-sm-6">';
                $sectionPanel += '<input type="text" name="element_desc" id="elementName" class="form-control" style="height:25px;font-size:12px" list="elemList"/>';
                $sectionPanel += '<datalist id="elemList">'+option2+'</datalist>';
                $sectionPanel += '</div>';
            $sectionPanel += '</form>';        
            $sectionPanel += '<div class="col-sm-3 sectionAction" data-target='+key+'>';
                $sectionPanel += '<div class="btn btn-info btn-sm addDetail" data-sectionno='+key+' data-elementcount="1"><i></i>Details</div>';
                $sectionPanel += '<div class="btn btn-default btn-xs plusElement" data-target='+key+' onclick="addElement('+key+')" style="padding-top:3px;padding-bottom:3px"><i class="glyphicon glyphicon-plus"></i></div>';//tambah element
                $sectionPanel += '<br><br>';
                $sectionPanel += '</div>';
                $sectionPanel += '</div>';
             $sectionPanel += '</div>';
             $sectionPanel += '</div>';
             $sectionPanel += '</div>';
            } 
             else {
             $sectionPanel += '<div id="section_panel'+key+'"class="panel panel-primary">';
             $sectionPanel += '<div class="panel-heading">'+input[key].value+'';
             $sectionPanel += '<div class="btn btn-default btn-xs delSection pull-right" data-secid='+key+'><i class="glyphicon glyphicon-trash"></i></div>';
             $sectionPanel += '<div class="btn btn-default btn-xs expandButton pull-right" data-toggle="collapse" data-target="#demo'+key+'" ><i class="glyphicon glyphicon-chevron-down"></i></div>';
             $sectionPanel += '</div>'; 
             $sectionPanel += '<div id="demo'+key+'" class="collapse">';
             $sectionPanel += '<div class="col-sm-4 list-padding"><input type="hidden" name="section_desc" class="form-control" value="' +input[key].value+'" disabled /></div> ';
             $sectionPanel += '<div id="section_body'+key+'" class="panel-body">';
             $sectionPanel += '<form id="elementBuilder" class="form-horizontal">';        
                $sectionPanel += '<label class="control-label col-sm-3">Element Name</label>';
                $sectionPanel += '<div  class="col-sm-6">';
                $sectionPanel += '<input type="text" name="element_desc" id="elementName" class="form-control elemList" style="height:25px;font-size:12px" list="elemList"/>';
                $sectionPanel += '<datalist id="elemList">'+option2+'</datalist>';
                $sectionPanel += '</div>';
            $sectionPanel += '</form>';        
                $sectionPanel += '<div class="col-sm-3 sectionAction" data-target='+key+'>';
                $sectionPanel += '<div class="btn btn-info btn-sm addDetail" data-sectionno='+key+' data-elementcount="1"><i></i>Details</div>';
                $sectionPanel += '<div class="btn btn-default btn-xs plusElement" data-target='+key+' onclick="addElement('+key+')" style="padding-top:3px;padding-bottom:3px"><i class="glyphicon glyphicon-plus"></i></div>';//tambah element
                $sectionPanel += '<br><br>';
                $sectionPanel += '</div>';
                $sectionPanel += '</div>';
             $sectionPanel += '</div>';
             $sectionPanel += '</div>';
             $sectionPanel += '</div>';
         }
         var sortSection = key + 1;
         var json_section = $('#secList [value="' + input[key].value + '"]').data('id');
         var section_code = $('#secList [value="' + input[key].value + '"]').data('code');
         var $html = '<div class="col-sm-12">';
         $html += '<div>"json_section": "'+json_section+'"</div>';
         $html += '<div>"section_code": "'+section_code+'"</div>';
         $html += '<div>"section_desc": "'+input[key].value+'"</div>';
         $html += '<div>"section_sorting": "'+sortSection+'"</div>';
         $html += '</div><br><br><br><br><br>';

         $($html).appendTo('.jsonSection');
        
         });

         $('#tambahsection').html($sectionPanel);//lps tekan add section, ni utk display kt div element

      });
    
});           

    function addElement(test){
//        console.log ('TEST '+ test);//0
        var option2 =$('#element_desc_list').html();
        var sectionNo = test + 1 ;
        console.log ('sectionNo '+ sectionNo);//0
        
        var next = sectionNo + 1;
        console.log('next ' + next);//1
        
            var $addPanel = '<div id="element_add_'+next+'" class="form-group form-group-sm">';
                $addPanel += '<form id="elementBuilder" class="form-horizontal">';        
                $addPanel += '<label class="control-label col-sm-3">Element Name</label>';
                $addPanel += '<div class="col-sm-6">';
                    $addPanel += '<input type="text" name="element_desc" id="elementName" class="form-control elemList" style="height:25px;font-size:12px" list="elemList"/>';  
                    $addPanel += '<datalist id="elemList">'+option2+'</datalist>';
                $addPanel += '</div>'; 
                $addPanel += '</form>'; 
                $addPanel += '<div class="col-sm-3 sectionAction" data-target='+next+'>';
                $addPanel += '<div class="btn btn-info btn-sm addDetail" data-sectionno='+next+' data-elementcount="0" ><i></i>Details</div>';
                $addPanel += '<div class="btn btn-default btn-xs elementDel" data-target='+next+' style="padding-top:3px;padding-bottom:3px"><i class="glyphicon glyphicon-minus"></i></div><br><br>';//remove element
                $addPanel += '</div>';
                $addPanel += '</div>';            
                $($addPanel).appendTo('#section_body'+test);//DLM PANEL ELEMENT (FUNCTION SCRIPT)
                $($addPanel).appendTo('#element_add_'+test);//DLM PANEL ELEMENT (FUNCTION NI)
    }
    
$(function () {
   
    //BUTTON DETAILS  
    $('#tambahsection').on('click','.addDetail',function () {
        var div = $(this).closest('div[class^="col-sm-6"]').find('input[id^="elementName"]').val();
        console.log('div',div);
        
            $.ajax({
                url: '<?= SITE_ROOT; ?>/formview/new-doc-element/',
                data: {div : div},
                success: function (data) {
                    var obj = $.parseJSON(data);
//                    $('.modal-dialog').removeClass('modal-lg');
                    $('.modal-title').text(obj.component);
                    $('.modal-body').html(obj.html);
                }
            });
            $('#myModal').modal('show');
            return false;
    });
    
});
</script>

<?php echo $footer; ?>