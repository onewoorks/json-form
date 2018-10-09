<?php echo $header; ?>

<!--DOCUMENT ID'S-->
<div id="formCreator">
<div class="col-sm-12">
<div class="panel panel-default">
<div class="panel-heading">FORM TITLE</div>
<div class="panel-body">
    <form id="formBuilder" class="form-horizontal">         
        <div class="form-group form-group-sm">
            <label class="control-label col-sm-2" style="text-align:left">Document Title</label><br></br>
            <div class="col-sm-8" style="width:100%">
                <input name="doc_name_desc" id="doc_name_desc" type="text" class="form-control docList" list="docList" />
                <datalist id="docList">
                    <?php foreach ($titles as $title): ?>
                    <option value="<?php echo $title['doc_name_desc']; ?>" data-id="<?php echo $title['doc_name_id']; ?>"></option>
                    <?php endforeach; ?>
                </datalist>
            </div>
        </div>
    </form>
</div>
</div>
</div>
    
<!--SECTION ID'S-->
<div class="col-sm-6">
<form id="sectionBuilder" class="form-horizontal">
            <div class='panel panel-default'>
                <div class='panel-heading'>SECTION DETAILS</div>
                <div class='panel-body'>
                    <br><br>
                    <div id='sectionGroup'>
                        
                    <div class='form-group form-group-sm' >
                        <label class='control-label col-sm-4'>Section Description</label>
                        <div class='col-sm-6'>
                            <input type='text' name='section_desc' id="section_desc" class='form-control secList' list="secList" />
                            <datalist name="secList" id="secList">
                                <?php foreach ($sections as $section): ?>
                                        <option value="<?php echo $section['section_desc']; ?>" data-id="<?php echo $section['section_code']; ?>"></option>
                                <?php endforeach; ?>
                            </datalist>
                        </div>
                        <div class='col-sm-2 sectionAction' data-sectionno='1'>
                            <div class='btn btn-default btn-sm plusSection' data-sectionno='1'><i class='glyphicon glyphicon-plus'></i></div>
                        </div>
                    </div>
                    </div>
                    
                    <div class="col-sm-12 text-right">
                        <button type="button" class="btn btn-primary btn-sm" id="addSection" data-number='1'>Add Section</button>
                    </div>
<!--                    <div class="col-sm-12 text-right">
                        <button type="button" class="btn btn-danger btn-sm saveSection" >Save Section</button>
                    </div>-->
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
                    <!--<form id="elementBuilder" class="form-horizontal">-->         
                    <div class='row'>
                        <div class='col-sm-12 text-right'>
                            <div class='btn btn-primary btn-sm' id='createForm'>Add Element</div>
                        </div>
                    </div>
                    <!--</form>-->
                
                    <!--ELEMENT POP UP-->
                    <div id="myModal" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                             <!--MODAL CONTENT-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Modal </h4>
                                </div>
                                <div class="modal-body">
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
</div>
</div>

</div>

<!--<div class='col-sm-12 text-right'>
    <div class='btn btn-success btn-md saveForm'>Save Form</div><br><br>
</div>-->

<div class='col-sm-12 text-right'>
    <div class='btn btn-success btn-md generateForm'>Generate Form</div><br><br>
</div>

<div id="json" style="float:bottom;display:none;">
<div class="col-sm-12">
<div class="panel panel-default">
<div class="panel-heading">JSON FORMAT</div>
<div class="panel-body">
    <div id='result'></div>
        <div class='col-sm-12 text-right'>
        <div class='btn btn-warning btn-md saveForm'>Save Form</div><br><br>
        </div>
</div>
</div>
</div>
</div>


<script>
//    $('.saveForm').click(function () {
//    var values = $('#formBuilder').serializeArray();
//    console.log(values);
//    
//    var values2 = $('#sectionBuilder').serializeArray();
//    console.log(values2);
//    
//    var values3 = $('#elementBuilder').serializeArray();
//    console.log(values3);
//    
//    var values4 = $('#elementBuilder2').serializeArray();
//    console.log(values4);
//});
    
$(document).ready(function(){
    
    $('.generateForm').click(function(){
        $('#json').show(500);
        $('#formCreator').toggle(1000);
        var values = $('#formBuilder').serializeArray();
        var doc_name_desc = $('#doc_name_desc').val();
        var input = $('#docList [value="' + doc_name_desc + '"]').data('id');
        console.log(values);
        console.log(doc_name_desc, input);
        $('#result').append('<div>Title of Document :'+$('#doc_name_desc').val()+'</div>');
        var data = JSON.stringify(input);
        $('#result').append(data);
    });
});

//$('.saveTitle').click(function () {
//    var values = $('#formBuilder').serializeArray();
//    var doc_name_desc = $('#doc_name_desc').val();
//    var input = $('#docList [value="' + doc_name_desc + '"]').data('id');
//    console.log(values);
//    console.log(doc_name_desc, input);
//    $('#result').append('<div>Title of Document :'+$('#doc_name_desc').val()+'</div>');
//});
</script>

<script>    
 $(function () {
    //BTN ADD SECTION -> ELEMENT DETAIL
    $('#addSection').click(function () {
        var input = $('#sectionBuilder').serializeArray();
        var $sectionPanel = ' ';
        $(input).each(function(key,value){
            console.log(key,value);
            //key: sorting
            //value: title
            
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
                $sectionPanel += '<input type="text" name="element_desc" id="elementName" class="form-control" style="height:25px" list="elemList"/>';
                $sectionPanel += '<datalist id="elemList">';
                                  <?php foreach ($elements as $element): ?>
                $sectionPanel += '<option value="<?php echo preg_replace( '/\r|\n/', '', addslashes($element['element_desc'])); ?>" data-id=""<?php echo $element['element_code']; ?>""></option>'; 
                                 <?php endforeach; ?>
                $sectionPanel += '</datalist>';
                $sectionPanel += '</div>';
                                                                $sectionPanel += '</form>';        
        

                $sectionPanel += '<div class="col-sm-3 sectionAction" data-target='+key+'>';
                $sectionPanel += '<button type="button" class="btn btn-info btn-sm addElement" data-sectionno='+key+' data-elementcount="1" style="padding-top:3px;padding-bottom:3px">Details</button>';
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
                $sectionPanel += '<input type="text" name="element_desc" id="elementName" class="form-control elemList" style="height:25px" list="elemList"/>';
                $sectionPanel += '<datalist id="elemList">';
                                  <?php foreach ($elements as $element): ?>
                $sectionPanel += '<option value="<?php echo preg_replace( '/\r|\n/', '', addslashes($element['element_desc'])); ?>" data-id=""<?php echo $element['element_code']; ?>""></option>';  
                                  <?php endforeach; ?>
                $sectionPanel += '</datalist>';
                $sectionPanel += '</div>';
                                              $sectionPanel += '</form>';        
        

                $sectionPanel += '<div class="col-sm-3 sectionAction" data-target='+key+'>';
                $sectionPanel += '<button type="button" class="btn btn-info btn-sm addElement" data-sectionno='+key+' data-elementcount="1" >Details</button>';
                $sectionPanel += '<div class="btn btn-default btn-xs plusElement" data-target='+key+' onclick="addElement('+key+')" style="padding-top:3px;padding-bottom:3px"><i class="glyphicon glyphicon-plus"></i></div>';//tambah element
                $sectionPanel += '<br><br>';
                $sectionPanel += '</div>';
                $sectionPanel += '</div>';
             $sectionPanel += '</div>';
             $sectionPanel += '</div>';
             $sectionPanel += '</div>';
         } 
         });

         $('#tambahsection').html($sectionPanel);//lps tekan add section, ni utk display kt div element
        
      });
      
      //PLUS SECTION TEXTFIELD
      $('#sectionGroup').on('click','.plusSection',function () {
            var sectionNo = $(this).data('sectionno');
            console.log('sectionNo ' + sectionNo);
            var next = sectionNo + 1 ;
            console.log('next ' + next);
            var $html = "<div id='section_add_"+next+"' class='form-group form-group-sm'>";
            $html += "<label class='control-label col-sm-4'></label>";
            $html += "<div class='col-sm-6'>";
            $html += "<input type='text' name='section_desc' id='section_desc' class='form-control secList' list='secList'/>";
            $html += "<datalist name='secList' id='secList'>";
                    <?php foreach ($sections as $section): ?>
            $html += "<option value='<?php echo $section['section_desc']; ?>' data-id='<?php echo $section['section_code']; ?>'></option>";               
                    <?php endforeach; ?>
            $html += "</datalist>";    
            $html += "</div>";
            $html += "<div class='col-sm-2 sectionAction' data-sectionno='"+next+"'>";
            $html += "<div class='btn btn-default btn-sm plusSection' data-sectionno='"+next+"'><i class='glyphicon glyphicon-plus'></i></div>";
            $html +="<div class='btn btn-default btn-sm dropSection' data-sectionno='"+next+"'><i class='glyphicon glyphicon-minus'></i><div>";
            $html += "</div>";
            $html += "</div>";
            $($html).appendTo('#sectionGroup');//add a text or html content after the content of the matched elements (so die msuk blik kt panel section)
        });
        
        //REMOVE SECTION TEXTFIELD
        $('#sectionGroup').on('click','.dropSection',function () {
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

});

//BTN DETAILS (onclick)
function addElement(test){
//        console.log ('TEST '+ test);//0
        
        var sectionNo = test + 1 ;
        console.log ('sectionNo '+ sectionNo);//0
        
        var next = sectionNo + 1;
        console.log('next ' + next);//1
        
            var $addPanel = ' ';
                $addPanel += '<div id="element_add_'+next+'" class="form-group form-group-sm">';
                $addPanel += '<form id="elementBuilder2" class="form-horizontal">';        
                $addPanel += '<label class="control-label col-sm-3">Element Name</label>';
                $addPanel += '<div  class="col-sm-6">';
                    $addPanel += '<input type="text" name="element_desc" id="elementName" class="form-control elemList" style="height:25px" list="elemList"/>';  
                    $addPanel += '<datalist id="elemList">';
                                <?php foreach ($elements as $element): ?>
                    $addPanel += '<option value="<?php echo preg_replace( '/\r|\n/', '', addslashes($element['element_desc'])); ?>" data-id=""<?php echo $element['element_code']; ?>""></option>';  
                                <?php endforeach; ?>
                    $addPanel += '</datalist>';
                $addPanel += '</div>'; 
                $addPanel += '</form>'; 
                $addPanel += '<div class="col-sm-3 sectionAction" data-target='+next+'>';
                $addPanel += '<button type="button" class="btn btn-info btn-sm addElement" data-sectionno='+next+' data-elementcount="0" >Details</button>';
                $addPanel += '<div class="btn btn-default btn-xs plusElement" data-target='+next+' onclick="addElement('+next+')" style="padding-top:3px;padding-bottom:3px"><i class="glyphicon glyphicon-plus"></i></div>';
                $addPanel += '<div class="btn btn-default btn-xs elementDel" data-target='+next+' style="padding-top:3px;padding-bottom:3px"><i class="glyphicon glyphicon-minus"></i></div><br><br>';//remove element
                $addPanel += '</div>';
                $addPanel += '</div>';            
                $($addPanel).appendTo('#section_body'+test);//DLM PANEL ELEMENT (FUNCTION SCRIPT)
                $($addPanel).appendTo('#element_add_'+test);//DLM PANEL ELEMENT (FUNCTION NI)
    }
    
//ELEMENT DETAILED
function ElementBuilder($elementName) {
        $.ajax({
            url: '<?php echo SITE_ROOT;?>/formbuilder/formelement/',
            data: {value: $elementName},
            success: function (data) {
                $('#formelement').html(data);
            }
        });
    }

//CLICK BUTTON DETAIL
$('#tambahsection').on('click','.addElement',function () {
            var sectionNo = $(this).data('sectionno');
//            var elementNo = $('#elementName').val();
            $.ajax({
                url: '<?= SITE_ROOT; ?>/formview/new-doc-element/',
                data: {sectionNo : sectionNo},
                success: function (data) {
                    var obj = $.parseJSON(data);
                    $('.modal-dialog').removeClass('modal-lg');
                    $('.modal-title').text(obj.component);
                    $('.modal-body').html(obj.html);
                }
            });
            $('#myModal').modal('show');
            return false;
        });
</script>


<?php echo $footer;