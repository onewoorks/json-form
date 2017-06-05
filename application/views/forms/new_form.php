<?php echo $header; ?>
<h2>FORM BUILDER (JSON Formatter)</h2>
<div class="row">
    <div class="col-sm-6">

        <div class="panel panel-default">
            <div class="panel-heading">FORM PROPERTIES</div>
            <div class="panel-body">
                <form id="formBuilder" class="form-horizontal">
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-4">Document Name</label>
                        <div class="col-sm-8">
                            <input name="doc_name_desc" type="text" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-4">Discipline</label>
                        <div class="col-sm-8">
                            <select name='discipline' class='form-control' >
                                <?php foreach ($main_discipline as $discipline): ?>
                                    <option value='<?php echo $discipline['value']; ?>'><?php echo $discipline['label']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
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
                        <label class="control-label col-sm-4">Column</label>
                        <div class="col-sm-8">
                           <div>
                              <label class="radio-inline">
                                <input name="column" type="radio" value="1" /> 1
                              </label>
                              <label class="radio-inline">
                                <input name='column' type="radio" value="2"  /> 2
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
                            <div class='btn btn-default btn-sm addElement' data-elementcount='0' data-sectionno='1'><i class='glyphicon glyphicon-collapse-down'></i></div>
                        </div>
                    </div>
                    </div>
                    <br>
                    <div class="col-sm-12 text-right">
                            <button class="btn btn-primary" id="addSection" data-number='1'>Submit</button>
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
                                                                                       
<!--                      <div class='row'>
                            <div class='col-sm-12 text-right'>
                               <div class='btn btn-primary btn-sm' id='createForm'>Create Form</div>
                            </div>
                      </div>-->
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
    
    $('#addSection').click(function () {
         var name = document.getElementById("sectionName").value;
         var no = $(this).data('number');
         var index = no + 1;
         var $html = '<div class="presection'+no+'"><div class="row" ><div class="form-group form-group-sm input-list"><label class="control-label col-sm-2"></label>';
         $html += '<div class="col-sm-4 list-padding"><input type="text" name="section_desc" class="form-control" value='+name+' disabled /></div>';
         $html += '<div class="col-sm-4 sectionActionButton" data-listid='+no+'>';
         $html += '<div class="btn btn-default btn-sm delSection" data-secid='+no+'><i class="glyphicon glyphicon-trash"></i></div>';
         $html += '<div class="btn btn-default btn-sm addElement" data-addid='+no+' data-desc='+name+'><i class="glyphicon glyphicon-plus"></i></div>';
         $html += '<div class="btn btn-default btn-sm expandButton" data-sectionni='+no+' data-current="expand"><i class="glyphicon glyphicon-chevron-up"></i></div></div></div></div><br>';
                  // start element div
         $html += '<div class="panel-body" data-sectionni='+no+' id="tambahelement'+no+'">';
         $html += '</div></div><br>';
         
         $($html).appendTo('#tambahsection');
         document.getElementById("sectionName").value = '';
         $('#addSection').data('number',index);
         console.log(index);
        });
        
//    $('#addelement').click(function () {
//         var elementname = document.getElementById("elementdesc").value;
//         var eletype = document.getElementById("eletype").value;
//         var bil = $(this).data('count');
//         var tam = bil+1;
//         console.log(tam);
//         var to = $(this).data('pointer');        
//         var $html = '<div class="row" id="element'+bil+'"><div class="form-group form-group-sm input-list" ><label class="control-label col-sm-2"></label><label class="control-label col-sm-1"></label>'; 
//         $html += '<div class="col-sm-3 list-padding">';
//         $html += '<input type="text" name="element_desc" class="form-control" value='+elementname+' disabled /></div>';
//         $html += '<div class="col-sm-2 list-padding">';
//         $html += '<input type="text" name="element_type" class="form-control" value='+eletype+' disabled /></div>';
//         $html += '<div class="col-sm-3 predefinedActionButton" data-listid="'+bil+'">';
//         $html += '<div class="btn btn-default btn-sm delelement" data-element="'+bil+'"><i class="glyphicon glyphicon-trash"></i></div></div></div></div>';
//         $($html).appendTo('#tambahelement'+to);        
//         var a = $('#elementform').toggleClass('hidden');
//         $('#addelement').data('count',tam);
//         document.getElementById("elementdesc").value = '';
//         
//        });
        
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
            $.ajax({
                url: '<?php echo SITE_ROOT;?>/formbuilder/insertelement/',
                data: {values: $elements, 'element_properties': $formType},
                success: function (data) {
//                    var json_parse = JSON.parse(data);
//                    $('#json_view').text(JSON.stringify(json_parse, null, 4));
                }
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
            
            var $button = "<div class='btn btn-default btn-sm addElement' data-sectionno='"+sectionNo+"' data-elementcount='0'><i class='glyphicon glyphicon-collapse-down'></i></div>";
            $('.sectionAction[data-sectionno="' + sectionNo + '"]').html($button);
            
            var $html = "<div class='form-group form-group-sm'>";
            $html += "<label class='control-label col-sm-4'></label>";
            $html += "<div class='col-sm-6'>";
            $html += "<input type='text' name='section_desc' id='sectionName' class='form-control' />";
            $html += "</div>";
            $html += "<div class='col-sm-2 sectionAction' data-sectionno='"+next+"'>";
            $html += "<div class='btn btn-default btn-sm addSection' data-sectionno='"+next+"'><i class='glyphicon glyphicon-plus'></i></div>";
            $html += "<div class='btn btn-default btn-sm addElement' data-sectionno='"+next+"' data-elementcount='0'><i class='glyphicon glyphicon-collapse-down'></i></div>";
            $html += "</div>";
            $html += "</div>";
            $($html).appendTo('#docgroup');
        });
                
        $('#tambahsection').on('click','.expandButton',function () {
            var b = $(this).data('sectionni');
            var a = $('#tambahsection').find(".panel-body[data-sectionni='" + $(this).data('sectionni') + "']").toggleClass('hidden');
            var current = $(this).data('current');
            if(current=='expand'){
                $(this).data('current','hide');
                $(this).html('<i class="glyphicon glyphicon-chevron-down"></i>');
            } else {
                $(this).data('current','expand');
                $(this).html('<i class="glyphicon glyphicon-chevron-up"></i>');
            }
        });
        
        $('#tambahsection').on('click','.delSection',function () {
            var delid = $(this).data('secid');
            $('.presection' + delid).remove();
        });
        
        $('#tambahsection').on('click','.delelement',function () {
            var delelement = $(this).data('element');
            $('#element' + delelement).remove();
        });
        
        $('#elementBuilder').on('click','.addElement',function () {
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
        
    });
</script>
<?php echo $footer; ?>