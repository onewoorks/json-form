<?php echo $header; ?>

<h3>FORM BUILDER (JSON Formatter)</h3>
<div class="row">
    <div class="col-sm-6">
 
       <div class="panel panel-default">
            <div class="panel-heading">FORM PROPERTIES</div>
            <div class="panel-body">
                <form id="formBuilder" class="form-horizontal">
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-4">Document Title</label>
                        <div class="col-sm-8">
                            <input name="doc_name_desc" type="text" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-4">Discipline</label>
                        <div class="col-sm-8">
                            <select name='discipline' class='form-control'>
                                <?php foreach ($main_discipline as $discipline): ?>
                                    <option value='<?php echo $discipline['value']; ?>'><?php echo $discipline['label']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class='form-group form-group-sm'>
                    <label class='control-label col-sm-4'>Document Group</label>
                    <div class='col-sm-8'>
                        <select name='doc_group' class='form-control' >
                            <?php foreach ($doc_group as $group): ?>
                                <option value='<?php echo $group['value']; ?>'><?php echo $group['label']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
<!--                <div class="form-group form-group-sm">
                        <label class="control-label col-sm-4">Sub Discipline</label>
                        <div class="col-sm-8">
                            <select name='general_discipline' class='form-control' >
                                <?php foreach ($general_discipline as $general): ?>
                                <option value='<?php echo $general['value'];?>'><?php echo $general['label']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>    -->
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-4">Document Type</label>
                        <div class="col-sm-8">
                            <select name='doc_type' class='form-control' >
                                <?php foreach ($doc_types as $doc): ?>
                                    <option value='<?php echo $doc['code']; ?>'><?php echo $doc['label']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-4">Layout</label>
                        <div class="col-sm-8">
                           <div>
                              <label class="radio-inline">
                                <input name="column" type="radio" value="1" /> 1
                              </label>
                              <label class="radio-inline">
                                <input name="column" type="radio" value="2"  /> 2
                              </label>
                           </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <form id="elementBuilder" class="form-horizontal">
            <div class='panel panel-default'>
                <div class='panel-heading'>DOCUMENT DETAILS</div>
                <div class='panel-body'>
                    <br><br>
                    <div id='docgroup' >
                    <div class='form-group form-group-sm' >
                        <label class='control-label col-sm-4'>Section Description</label>
                        <div class='col-sm-6'>
                            <input type='text' name='section_desc' id="sectionName" class='form-control' />
                        </div>
                        <div class='col-sm-2 sectionAction' data-sectionno='1'>
                            <div class='btn btn-default btn-sm addSection' data-sectionno='1'><i class='glyphicon glyphicon-plus'></i></div>
<!--                            <div class='btn btn-default btn-sm addElement' data-elementcount='0' data-sectionno='1'><i class='glyphicon glyphicon-collapse-down'></i></div>-->
                           
                        </div>
                    </div>
                    </div>
                    <br>
                    <div class="col-sm-12 text-right">
                        <button type="button" class="btn btn-primary" id="addSectionSubmit" data-number='1'>Add</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    
    <div class="col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading">DOCUMENT'S JSON</div>
            <div class="panel-body">
                <div id="tambahsection" >
                    
                    <!--                            <div class='presection1'>
                                <div class="row" >
                                <div class="form-group form-group-sm input-list">
                                    <label class="control-label col-sm-2"></label>                                 
                                    <div class="col-sm-4 list-padding">
                                        <input type='text' name="section_desc" class='form-control' placeholder='label / title' disabled />
                                    </div>
                                    <div class='col-sm-4 predefinedActionButton' data-listid='1'>
                                        <div class='btn btn-default btn-sm delSection' data-secId='1'><i class='glyphicon glyphicon-trash'></i></div>
                                        <div class='btn btn-default btn-sm addElement' data-addId='1'><i class='glyphicon glyphicon-plus'></i></div>
                                        <div class="btn btn-default btn-sm expandButton" data-sectionni='1' data-current='expend'><i class='glyphicon glyphicon-chevron-up'></i></div>
                                    </div>
                                </div> 
                                </div><br>
                            <div class="panel-body" data-sectionni='1' id="tambahelement">
                                <div class="row" id="child1">
                                    <div class="form-group form-group-sm input-list" >
                                        <label class="control-label col-sm-2"></label>
                                        <label class="control-label col-sm-1"></label>
                                             <div class="col-sm-3 list-padding">
                                             <input type='text' name="element_desc" class='form-control' placeholder='label / title' disabled />
                                             </div>
                                             <div class="col-sm-2 list-padding">
                                             <input type='text' name="element_type" class='form-control' placeholder='label / title' disabled />
                                             </div>
                                             <div class='col-sm-3 predefinedActionButton' data-listid='1'>
                                             <div class='btn btn-default btn-sm addPredefined' data-listid='1'><i class='glyphicon glyphicon-trash'></i></div>                              
                                             </div>
                                    </div>
                                </div>
                                                                <div class="row" id="child1">
                                    <div class="form-group form-group-sm input-list" >
                                        <label class="control-label col-sm-2"></label>
                                        <label class="control-label col-sm-1"></label>
                                             <div class="col-sm-3 list-padding">
                                             <input type='text' name="element_desc" class='form-control' placeholder='label / title' disabled />
                                             </div>
                                             <div class="col-sm-2 list-padding">
                                             <input type='text' name="element_type" class='form-control' placeholder='label / title' disabled />
                                             </div>
                                             <div class='col-sm-3 predefinedActionButton' data-listid='1'>
                                             <div class='btn btn-default btn-sm addPredefined' data-listid='1'><i class='glyphicon glyphicon-trash'></i></div>                              
                                             </div>
                                    </div>
                                </div>
                                
                            </div>   
                            </div>-->
                </div><br>
                                                                                       
                      <div class='row'>
                            <div class='col-sm-12 text-right'>
                               <div class='btn btn-primary btn-sm' id='createForm'>Create Form</div>
                            </div>
                      </div>
                </div>
            </div>
        </div>
    </div>

<!--    <div class="col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading">JSON OUTPUT FORMAT</div>
            <div class="panel-body">
                <div id='json_view' class='row'></div>
                <div class='row'>
                    <div class='col-sm-12 text-right'>
                        <div class='btn btn-primary btn-sm' id='createForm'>Create Form</div>
                    </div>
                </div>
            </div>
        </div>
    </div>-->

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
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
<script>
//    $('#docgroup').on('click','.addPanel',function () {
    function addElement(test){
        console.log (test)
        var sectionNo = test ;
//         var sectionNo = $(this).data('target');
            var next = sectionNo + 1 ;
            var addPanel = ' ';
                
                addPanel += '<div id="element_add_'+next+'" class="form-group form-group-sm">';
                addPanel += '<label class="control-label col-sm-4">Element Name</label>';
                addPanel += '<div  class="col-sm-4">';
                addPanel += '<input type="text" name="section_desc" id="sectionName" class="form-control"/>';
                addPanel += '</div>';
                addPanel += '<div class="col-sm-4 sectionAction" data-target='+next+'>';
                addPanel += '<button type="button" class="btn btn-info addElement" data-sectionno='+next+' data-elementcount="0" >Details</button>';
                addPanel += '<div class="btn btn-default btn-sm addPanel" data-target='+next+' onclick="addElement('+next+')"><i class="glyphicon glyphicon-plus"></i></div>';
                addPanel += '<div class="btn btn-default btn-sm elementDel" data-target='+next+'><i class="glyphicon glyphicon-minus"></i></div><br><br>';
//                addPanel += '<div class="btn btn-default btn-sm addElement" data-sectionno='+next+' data-elementcount="0"><i class="glyphicon glyphicon-collapse-down"></i></div>';
                addPanel += '</div>';
                addPanel += '</div>';            
//                $('#section_body').html(addPanel);
                $(addPanel).appendTo('#section_body'+test);
                $(addPanel).appendTo('#element_add_'+test);
    }
    $('#addSectionSubmit').click(function () {
        var input = $('#elementBuilder').serializeArray();
         var sectionPanel = ' ';
        
        
        $(input).each(function(key,value){
            
             sectionPanel += '<div id="section_panel'+key+'"class="panel panel-default">';
             sectionPanel += '<div class="panel-heading">'+input[key].value+'';
             sectionPanel += '<div class="btn btn-default btn-sm delSection pull-right" data-secid='+key+'><i class="glyphicon glyphicon-trash"></i></div>';
             sectionPanel += '<div class="btn btn-default btn-sm expandButton pull-right" data-toggle="collapse" data-target="#demo'+key+'" ><i class="glyphicon glyphicon-chevron-down"></i></div>';
//             sectionPanel += '<button type="button" class="btn btn-info pull-right" data-toggle="collapse" data-target="#demo'+key+'" id="addNewElement">Add Element</button>';
             sectionPanel += '</div>'; 
             sectionPanel += '<div id="demo'+key+'" class="collapse">';
//             sectionPanel += '<div id="element_panel'+key+'" class="form-group form-group-sm">';
             sectionPanel += '<div class="col-sm-4 list-padding"><input type="hidden" name="section_desc" class="form-control" value="' +input[key].value+'" disabled /></div> ';
             sectionPanel += '<div id="section_body'+key+'" class="panel-body">';
//                sectionPanel += '<div id="section_body'+key+'" class="form-group form-group-sm">';
                sectionPanel += '<label class="control-label col-sm-4">Element Name</label>';
                sectionPanel += '<div  class="col-sm-4">';
                sectionPanel += '<input type="text" name="section_desc" id="sectionName" class="form-control"/>';
                sectionPanel += '</div>';
                sectionPanel += '<div class="col-sm-4 sectionAction" data-target='+key+'>';
                sectionPanel += '<button type="button" class="btn btn-info addElement" data-sectionno='+key+' data-elementcount="0" >Details</button>';
                sectionPanel += '<div class="btn btn-default btn-sm addPanel" data-target='+key+' onclick="addElement('+key+')"><i class="glyphicon glyphicon-plus"></i></div>';
//                sectionPanel += '<div class="btn btn-default btn-sm dropElement" data-target='+key+'><i class="glyphicon glyphicon-minus"></i></div><br><br>';
//                sectionPanel += '<div class="btn btn-default btn-sm addElement" data-sectionno='+key+' data-elementcount="0"><i class="glyphicon glyphicon-collapse-down"></i></div>';
//                sectionPanel += '</div>';
                sectionPanel += '<br><br>';
                sectionPanel += '</div>';
                sectionPanel += '</div>';
             sectionPanel += '</div>';
             sectionPanel += '</div>';
             sectionPanel += '</div>';
//                        
            
//            var $html = "<div id='section_add_"+next+"' class='form-group form-group-sm'>";
//            $html += "<label class='control-label col-sm-4'></label>";
//            $html += "<div class='col-sm-6'>";
//            $html += "<input type='text' name='section_desc' id='sectionName' class='form-control' />";
//            $html += "</div>";
//            $html += "<div class='col-sm-2 sectionAction' data-sectionno='"+next+"'>";
//            $html += "<div class='btn btn-default btn-sm addSection' data-sectionno='"+next+"'><i class='glyphicon glyphicon-plus'></i></div>";
//            $html +="<div class='btn btn-default btn-sm dropSection' data-sectionno='"+next+"'><i class='glyphicon glyphicon-minus'></i><div>";
//            $html += "<div class='btn btn-default btn-sm addElement' data-sectionno='"+next+"' data-elementcount='0'><i class='glyphicon glyphicon-collapse-down'></i></div>";
//            $html += "</div>";
//            $html += "</div>";
               });

         $('#tambahsection').html(sectionPanel);
        
      });
      
//    $(function (){
//       $('#addSectionSubmit').click(function(){
//            var section = $('#doc')
//        });
//    });  
//      
    function ElementBuilder($elementName) {
        $.ajax({
            url: '<?php echo SITE_ROOT;?>/formbuilder/formelement/',
            data: {value: $elementName},
            success: function (data) {
                $('#formelement').html(data);
            }
        });
    }
    ;
  
     $(function () {
        var $formType = 'decoration';
        ElementBuilder($formType);
        $('[name=form_element').val($formType);
        $('[name=element_properties]').on('change', function () {
            var selector = $(this).val();
            $('#' + selector).show();
            $('[name=form_element').val(selector);
            ElementBuilder(selector);
        });
        $('#elementBuilder').submit(function (e) {
            e.preventDefault();
            var $elements = $(this).serializeArray();
            console.log($elements);
            
        });
            
     });
        
        $('#createForm').click(function () {
            $.ajax({
                url: '<?php echo SITE_ROOT;?>/formbuilder/createform/',
                success: function () {
                    alert('form created');
                    $('#json_view').text('');
                }
            });
        });
        
        $('#docgroup').on('click','.addSection',function () {
            var sectionNo = $(this).data('sectionno');
            var next = sectionNo + 1 ;
          
            var $html = "<div id='section_add_"+next+"' class='form-group form-group-sm'>";
            $html += "<label class='control-label col-sm-4'></label>";
            $html += "<div class='col-sm-6'>";
            $html += "<input type='text' name='section_desc' id='sectionName' class='form-control' />";
            $html += "</div>";
            $html += "<div class='col-sm-2 sectionAction' data-sectionno='"+next+"'>";
            $html += "<div class='btn btn-default btn-sm addSection' data-sectionno='"+next+"'><i class='glyphicon glyphicon-plus'></i></div>";
            $html +="<div class='btn btn-default btn-sm dropSection' data-sectionno='"+next+"'><i class='glyphicon glyphicon-minus'></i><div>";
//            $html += "<div class='btn btn-default btn-sm addElement' data-sectionno='"+next+"' data-elementcount='0'><i class='glyphicon glyphicon-collapse-down'></i></div>";
            $html += "</div>";
            $html += "</div>";
            $($html).appendTo('#docgroup');
        });
        
        $('#tambahsection').on('click','.delSection',function () {
            
        }
                )
                
         $('#docgroup').on('click','.dropSection',function () {
         
        }
                )
        
        $('#tambahsection').on('click','.newElement',function(){
            
        });
        
        
//        $('#tambahsection').on('click','.expandButton',function () {
//            var b = $(this).data('sectionni');
//            var a = $('#tambahsection').find(".panel-body[data-sectionni='" + $(this).data('sectionni') + "']").toggleClass('hidden');
//            var current = $(this).data('current');
//            if(current=='expand'){
//                $(this).data('current','hide');
//                $(this).html('<i class="glyphicon glyphicon-chevron-down"></i>');
//            } else {
//                $(this).data('current','expand');
//                $(this).html('<i class="glyphicon glyphicon-chevron-up"></i>');
//            }
//        });
         $('#tambahsection').on('click','.elementDel',function () {
            var del = $(this).data('target');
            $('#element_add_' + del).remove();
        });
        
        $('#tambahsection').on('click','.dropElement',function () {
            var drop = $(this).data('target');
            $('#section_body' + drop).remove();
        });
        
        $('#tambahsection').on('click','.delSection',function () {
            var delid = $(this).data('secid');
            $('#section_panel' + delid).remove();
        });
        
        $('#tambahsection').on('click','.delelement',function () {
            var delelement = $(this).data('element');
            $('#element' + delelement).remove();
        });
        
        $('#docgroup').on('click','.dropSection',function () {
            var dropid = $(this).data('sectionno');
            $('#section_add_'+dropid).remove();
//            console.log('drop '+ $(this).data('sectionno'));
        });
//        
//        $('#tambahsection').on('click','.addElement',function () {
//            var dropelement = $(this).data('sectionno');
//            $('#element_add_'+dropelement).remove();
//            console.log('drop '+ $(this).data('sectionno'));
//        });
        
        $('#tambahsection').on('click','.addElement',function () {
            var sectionNo = $(this).data('sectionno');
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
        
    $(function(){
        $('#sectioncode').click(function(){
            var aa = $('#sectionname').val();
            $.ajax({
                url:'<?php echo SITE_ROOT;?>/formbuilder/checksection/',
                data: {namasection:aa},
                success: function(data){
                    $('#nosect').val(data);
                }
            })
        })
         
        $('#test').submit(function(e){
            e.preventDefault();
            var input = $(this).serializeArray();
            $.ajax({
                url:'<?php echo SITE_ROOT;?>/formbuilder/checksection/',
                data: {values: input},
                success: function (data){
                    console.log(data);
                    var json = JSON.parse(data);
                    $('#jsonoutput').text(JSON.stringify(json, data, null));
                }
            })
        }) 
    })
   
</script>
<?php echo $footer; ?>