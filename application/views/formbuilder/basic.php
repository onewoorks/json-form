<!--<div class="panel-heading panel-child">FORM ELEMENT</div>-->
        <div class="panel-body">
                        
                        <div class="form-group form-group-sm">
                                <input type="hidden" name='elementCode' value="<?= $vars['element_code'];?>" />
                                <input type="hidden" name='documentId' value="<?= $vars['document_id'];?>" />
                        </div>
                                                                     
                        <div class="form-group form-group-sm">
                            <label class="control-label col-sm-4">Input Type</label>
                            <div class="col-sm-8">
                                        <?php  $input_type='';
                                        if( $vars['input_type'] !=NULL){
                                            $input_type = $vars['input_type'] ;
                                        } ?>
                                <div>          
                                    <label class="radio-inline">
                                        <input type="radio" name='input_type'  value="FREETEXT" <?php if($input_type==='FREETEXT'){echo 'checked';} ?>> Freetext
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name='input_type'  value="RICHTEXT" <?php if($input_type==='RICHTEXT'){echo 'checked';} ?>> Richtext
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name='input_type'  value="TEXTBOX" <?php if($input_type==='TEXTBOX'){echo 'checked';} ?>> Textbox
                                    </label>
<!--                                    <label class="radio-inline">
                                        <input type="radio" name='input_type'  value="ROW" <?php if($input_type==='ROW'){echo 'checked';} ?>> Row
                                    </label>-->
                                </div>
                                <div>
                                    <label class="radio-inline">
                                        <input type="radio" name='input_type'  value="CALENDER" <?php if($input_type==='CALENDER'){echo 'checked';} ?>> Calendar
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name='input_type'  value="NUMERIC" <?php if($input_type==='NUMERIC'){echo 'checked';} ?>> Numeric                                       
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name='input_type'  value="MULTIPLE ANSWER" <?php if($input_type==='MULTIPLE ANSWER'){echo 'checked';} ?>> Multiple Answer                                       
                                    </label>
                                </div>
                            </div>
                        </div>

                  <div id="multiple_answer" >
                      <form id='basic'>
                        <div id='predefinedList'>
                                <?php if($input_type==='MULTIPLE ANSWER'){                         
                                $elementDetail = array(    
                                   'label' => $vars['element_desc'],
                                   'additional_attribute' => $vars['additional_attribute'],
                                   'element_code' => $vars['element_code'],
                                   'method' => $vars['method'],
                                   'json_element'=>$vars['json_element'],
                                   'doc_name_id'=>$vars['document_id']
                                       ); ?>
                    <?= UpdateInput($elementDetail);   }else{   ?>
                            <div class='prelist1'>
                                <div class="form-group form-group-sm input-list">
                                    <label class="control-label col-sm-4">Predefined Value</label>                                 
                                    <div class="col-sm-3 list-padding">
                                        <input type='text' name="multi_ans_desc0" class='form-control' placeholder='label / title' />
                                        <input type='hidden' name='sorting0' value="1" />
                                        <input type="hidden" id="validation0" name="validation0" value="parentonly" />
                                    </div>
                                    <div class="col-sm-3 list-padding">
                                        <select name="multi_input_type0" class="form-control">
                                            <option value="DROPDOWN">Dropdown</option>
                                            <option value="CHECKBOX">Checkbox</option>
                                            <!--<option value="DROPDOWN CHECKBOX">Dropdown Checkbox</option>-->
                                            <option value="RADIOBUTTON">Radiobutton</option>
                                            <option value="FREETEXT">Freetext</option>
                                            <!--<option value="LIST">List</option>-->
                                            <option value="CALENDER">Calendar</option> 
                                        </select>
                                    </div>
                                    <div class='col-sm-2 predefinedActionButton' data-listid='1'>
                                        <div class='btn btn-default btn-sm addPredefined' data-listid='1' data-childno='1'><i class='glyphicon glyphicon-plus'></i></div>
                                        <div class='btn btn-default btn-sm addChild' data-childlistid='0' data-childno='0'><i class='glyphicon glyphicon-collapse-down'></i></div>
                                    </div>
                                </div> 
                                    <div class="form-group form-group-sm input-list" id="child0">
                                    </div>
                            </div>
                             <?php }  ?>
                        </div>
                      </form>
                    </div>
            
                <div id="row">
                      <form id='rowinput' >
                          <div id='predefinedRow'>
                          <?php
                          if($input_type === 'ROW'){
                          $additional_attr = $vars['additional_attribute'];
                          $json = json_decode($additional_attr,true);
                          $max = sizeof($json);
                            $rowno = 1;
                           foreach ($json as $key => $info): 
                              $rt = ucwords(strtolower($info['row_type']));?>
                            <div class='prerow<?php echo $rowno; ?>'>
                                <div class="form-group form-group-sm input-list">
                                    <?php if($rowno==1){
                                        $rowlabel = 'Row Info';
                                    }else{ $rowlabel = ''; } ?>
                                    <label class="control-label col-sm-4"><?php echo $rowlabel; ?></label>                                 
                                    <div class="col-sm-3 list-padding">
                                        <input type='text' name="row_desc<?php echo $rowno; ?>" class='form-control' value='<?php echo $info['row_desc']; ?>' />
                                    </div>
                                    <div class="col-sm-3 list-padding">
                                        <select name="row_type<?php echo $rowno; ?>" class="form-control">
                                            <option value="<?php echo $info['row_type']; ?>"><?php echo $rt; ?></option>
                                            <option value="TEXTBOX">Textbox</option>
                                            <option value="FREETEXT">Freetext</option>
                                            <option value="NUMBER">Number</option>
                                            <option value="CALENDER">Calendar</option>                                       
                                        </select>
                                    </div>
                                    <div class='col-sm-2 rowActionButton' data-rowid='<?php echo $rowno; ?>'>
                                        <?php if($rowno === $max){   ?>
                                        <div class='btn btn-default btn-sm addrow' data-rowno='<?php echo $rowno; ?>' ><i class='glyphicon glyphicon-plus'></i></div>
                                        <div class='btn btn-default btn-sm delrow' data-rowno='<?php echo $rowno; ?>' ><i class='glyphicon glyphicon-trash'></i></div>
                                        <?php } ?>
                                    </div>
                                </div> 
                            </div>                              
                              <?php
                              $rowno++;
                              endforeach;  
                          }
                         else{  ?>
                            <div class='prerow1'>
                                <div class="form-group form-group-sm input-list">
                                    <label class="control-label col-sm-4">Row Info</label>                                 
                                    <div class="col-sm-3 list-padding">
                                        <input type='text' name="row_desc1" class='form-control' placeholder='label / description' />
                                    </div>
                                    <div class="col-sm-3 list-padding">
                                        <select name="row_type1" class="form-control">
                                            <option value="TEXTBOX">Textbox</option>
                                            <option value="FREETEXT">Freetext</option>
                                            <option value="NUMBER">Number</option>
                                            <option value="CALENDER">Calendar</option>                                                                                   
                                        </select>
                                    </div>
                                    <div class='col-sm-2 rowActionButton' data-rowid='1'>
                                        <div class='btn btn-default btn-sm addrow' data-rowno='1' ><i class='glyphicon glyphicon-plus'></i></div>
                                    </div>
                                </div> 
                            </div>  <?php                              
                         }
                          ?>
                        </div>
                      </form>
                    
                </div>
            </div>


<script>
    $(function(){
        $('#multiple_answer').hide();
        $('#row').hide();
        $('[name=input_type]').on('change',function(){
            $('#multiple_answer').hide();
            $('#row').hide();
            var isselect = $(this).val();
            if(isselect==='MULTIPLE ANSWER'){
                $('#multiple_answer').show();
            }
            if(isselect==='ROW'){
                $('#row').show();
            }
        });
    });
    
    $(function(){
        var $define = $("input[name='input_type']:checked").val();
        if( $define ==='MULTIPLE ANSWER'){
        $("#multiple_answer").show();
        }
        if( $define ==='ROW'){
        $("#row").show();
        }
    });
        
    $('#predefinedList').on('click', '.addPredefined', function () {
            var index = $(this).data('listid') + 1;
            var current = $(this).data('listid');
            
            var $deleteButton = "<div class='btn btn-default btn-sm deletePredefined' data-delid='" + current + "'><i class='glyphicon glyphicon-trash'></i></div>";
            $deleteButton += "<div class='btn btn-default btn-sm addChild' data-childlistid='" + current + "' data-childno='1'><i class='glyphicon glyphicon-collapse-down'></i></div>";            
            $('.predefinedActionButton[data-listid="' + current + '"]').html($deleteButton);
            
            var x = [index];
            var $html = '<div class="prelist' + index + '">';            
            $html += '<div class="form-group form-group-sm input-list">';
            $html += '<label class="control-label col-sm-4"></label>';
            $html += '<div class="col-sm-3 list-padding-right">';
            $html += '<input type="text" name="multi_ans_desc'+ x +'" class="form-control" placeholder="label / title" />';
            $html += '<input type="hidden" id="validation' + index + '" name="validation' + index + '" value="parentonly" />';
            $html += '<input type="hidden" name="total" value="'+index+'" />';
            $html += '</div>';
            $html += '<div class="col-sm-3 list-padding-left" >';
            $html += '<select name="multi_input_type'+ x +'" class="form-control">';
            $html += '<option value="DROPDOWN">Dropdown</option>';
            $html += '<option value="CHECKBOX">Checkbox</option>';
            $html += '<option value="DROPDOWN CHECKBOX">Dropdown Checkbox</option>';
            $html += '<option value="RADIOBUTTON">Radiobutton</option>';
            $html += '<option value="FREETEXT">Freetext</option>';
            $html += '<option value="LIST">List</option>';
            $html += '<option value="CALENDER">Calendar</option>';             
            $html += '</select>';
            $html += '</div>';
            $html += '<div class="col-sm-2 predefinedActionButton" data-listid=' + index + ' >';
            $html += '<div class="btn btn-default btn-sm addPredefined" data-listid=' + index + ' data-childno="1"><i class="glyphicon glyphicon-plus"></i></div>';
            $html += '<div class="btn btn-default btn-sm addChild" data-childlistid="' + index + '" data-childno="1" ><i class="glyphicon glyphicon-collapse-down"></i></div>';
            $html += '</div>';
            $html += '</div>';
            $html += '<div class="form-group form-group-sm input-list" id="child' + index + '"></div>';
            $html += '</div>';
            $($html).appendTo('#predefinedList');
        });

    $('#predefinedList').on('click', '.deletePredefined', function () {
            var deleteid = $(this).data('delid');
            if (deleteid > 0) {
                $('.prelist' + deleteid).remove();
            }
        });
    
    $('#predefinedList').on('click', '.addChild', function () {
            var current = $(this).data('childlistid');
            var no = $(this).data('childno');
            var nextno = no+1;
            $('.addChild[data-childlistid="' + current + '"]').data('childno',nextno);
            document.getElementById('validation'+current).value = 'childexist';

            var $html = '<div class="childno'+current+'' + no + '">';            
            $html += '<div class="form-group form-group-sm input-list">';
            $html += '<label class="control-label col-sm-5"></label>';
            $html += '<div class="col-sm-3 list-padding-right">';
            $html += '<input type="hidden" name="childtotal'+current+'" class="form-control" value="'+no+'" />';
            $html += '<input type="text" name="child_multi_ans_desc'+current+''+no+'" class="form-control" placeholder="child : label / title" />';
            $html += '</div>';
            $html += '<div class="col-sm-3 list-padding-left" >';
            $html += '<select name="child_multi_input_type'+current+''+no+'" class="form-control">';
            $html += '<option value="DROPDOWN">Dropdown</option>';
            $html += '<option value="DROPDOWN CHECKBOX">Dropdown Checkbox</option>';
            $html += '<option value="CHECKBOX">Checkbox</option>';
            $html += '<option value="RADIOBUTTON">Radiobutton</option>';
            $html += '<option value="FREETEXT">Freetext</option>';
            $html += '<option value="TEXTBOX">Textbox</option>';
            $html += '<option value="CALENDER">Calendar</option>';
            $html += '</select>';
            $html += '</div>';
            $html += '<div class="col-sm-1 childPredefinedActionButton" data-childlistid='+current+'' + no + ' >';
            $html += '<div class="btn btn-default btn-sm childDeletePredefined" data-delid='+current+'' + no + ' data-num='+no+' data-parent='+current+' ><i class="glyphicon glyphicon-trash"></i></div>';
            $html += '</div>';
            $html += '</div>';
            $html += '</div>';
            $($html).appendTo('#child'+current); 
        });
        
    $('#predefinedList').on('click', '.childDeletePredefined', function () {
            var deleteid = $(this).data('delid');
            var num = $(this).data('num');
            var parent = $(this).data('parent');
//            console.log(parent);
            if (num === 1) {
               document.getElementById('validation'+parent).value = 'parentonly';
            }                       
             $('.childno' + deleteid).remove();
        });
        
    $('#row').on('click','.addrow',function(){
        var rowno = $(this).data('rowno');
        var nextno = rowno + 1 ;        
        if (nextno < 5){             
        var $deleteButton = "<div></div>";          
        $('.rowActionButton[data-rowid="' + rowno + '"]').html($deleteButton);
            
        var $html = '<div class=prerow'+nextno+'>';
        $html += '<div class="form-group form-group-sm input-list">';
        $html += '<label class="control-label col-sm-4"></label>';
        $html += '<div class="col-sm-3 list-padding">';
        $html += '<input type="text" name="row_desc'+nextno+'" class="form-control" placeholder="label / description" />';
        $html += '</div>';
        $html += '<div class="col-sm-3 list-padding">';
        $html += '<select name="row_type'+nextno+'" class="form-control">';
        $html += '<option value="TEXTBOX">Textbox</option>';
        $html += '<option value="FREETEXT">Freetext</option>';
        $html += '<option value="NUMBER">Number</option>';
        $html += '<option value="CALENDER">Calendar</option>';       
        $html += '</select>';
        $html += '</div>';
        $html += '<div class="col-sm-2 rowActionButton" data-rowid='+nextno+'>';
        $html += '<div class="btn btn-default btn-sm addrow" data-rowno='+nextno+' ><i class="glyphicon glyphicon-plus"></i></div>';
        $html += '<div class="btn btn-default btn-sm delrow" data-rowno='+nextno+' ><i class="glyphicon glyphicon-trash"></i></div>';
        $html += '</div>';
        $html += '</div>';
        $html += '</div>';
        $($html).appendTo('#predefinedRow');
    }
    });
    
        $('#row').on('click', '.delrow', function () {
            var deleteid = $(this).data('rowno');
            var idbefore = deleteid - 1;
            if (deleteid> 1) {
            $('.prerow' + deleteid).remove();
            
        var $deleteButton = '<div class="btn btn-default btn-sm addrow" data-rowno='+idbefore+' ><i class="glyphicon glyphicon-plus"></i></div>';
        $deleteButton +='<div class="btn btn-default btn-sm delrow" data-rowno='+idbefore+' ><i class="glyphicon glyphicon-trash"></i></div>';
        $('.rowActionButton[data-rowid="' + idbefore + '"]').html($deleteButton);
        
        }                       
        });
</script>
