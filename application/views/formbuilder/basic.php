<!--<div class="panel-heading panel-child">FORM ELEMENT</div>-->
<div>AA</div>
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
                                    <label class="radio-inline">
                                        <input type="radio" name='input_type'  value="ROW" <?php if($input_type==='ROW'){echo 'checked';} ?>> Row
                                    </label>
                                </div>
                                <div>
                                    <label class="radio-inline">
                                        <input type="radio" name='input_type'  value="CALENDER" <?php if($input_type==='CALENDER'){echo 'checked';} ?>> Calendar
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name='input_type'  value="MULTIPLE ANSWER" <?php if($input_type==='MULTIPLE ANSWER'){echo 'checked';} ?>> Multiple Answer                                       
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name='input_type'  value="NUMBER" <?php if($input_type==='NUMBER'){echo 'checked';} ?>> Number                                       
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
                                            <option value="DROPDOWN CHECKBOX">Dropdown Checkbox</option>
                                            <option value="RADIOBUTTON">Radiobutton</option>
                                            <option value="FREETEXT">Freetext</option>
                                            <option value="LIST">List</option>
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


