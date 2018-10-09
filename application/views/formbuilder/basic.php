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
                                        <input type="radio" name='input_type'  value="METHOD" <?php if($input_type==='METHOD'){echo 'checked';} ?>> Method
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name='input_type'  value="TIME" <?php if($input_type==='TIME'){echo 'checked';} ?>> Time
                                    </label>
                                </div>
                                <div>
                                    <label class="radio-inline">
                                        <input type="radio" name='input_type'  value="CALENDER" <?php if($input_type==='CALENDER'){echo 'checked';} ?>> Calendar
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name='input_type'  value="NUMERIC" <?php if($input_type==='NUMERIC'){echo 'checked';} ?>> Numeric                                       
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name='input_type'  value="ALPHANUMERIC" <?php if($input_type==='ALPHANUMERIC'){echo 'checked';} ?>> Alphanumeric                                       
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name='input_type'  value="MULTIPLE ANSWER" <?php if($input_type==='MULTIPLE ANSWER'){echo 'checked';} ?>> Multiple Answer                                       
                                    </label>
                                </div>
                            </div>
                        </div>

                  <div id="multiple_answer" >
                      <form id='basicMultAns'>
                        <div id='predefinedList'>
                                <?php if($input_type==='MULTIPLE ANSWER'){                         
                                $elementDetail = array(    
                                   'label' => $vars['element_desc'],
                                   'additional_attribute' => $vars['additional_attribute'],
                                   'element_code' => $vars['element_code'],
                                   'method' => $vars['method'],
                                   'json_element'=>$vars['json_element'],
                                   'doc_name_id'=>$vars['document_id'],
                                   'doc_method_code' =>$vars['method_code']
                                       ); ?>
                                <?= UpdateInput($elementDetail);   }
                            else{   ?>
                            
                                    <div class="my-form">
                                            <div class="form-group form-group-sm input-list text-box">
                                                <label class="control-label col-sm-4" for="box1">Box <span class="box-number">1</span></label>
                                                <input class="form-control" type="text" name="boxes[]" value="" id="box1" />
                                                <a class="add-box" href="#">Add</a>&nbsp
                                            </div>
                                    </div>		 

<!--                            <div class='prelist1'>
                                <div class="form-group form-group-sm input-list">
                                    <label class="control-label col-sm-4">Predefined Value</label>
                                    
                                    <div class="col-sm-3 list-padding">
                                        <input type='text' id="multi_ans_desc1" name="multi_ans_desc1" class='form-control' placeholder='parent: label / title' />
                                        <input type='hidden' id="total" name='total' value="1" />
                                        <input type="hidden" id="validation1" name="validation1" value="parentonly" />
                                    </div>
                                    
                                    <div class="col-sm-3 list-padding">
                                        <select id="multi_input_type" name="multi_input_type1" class="form-control">
                                            <?=  ListMultipleAnswer();?>
                                        </select>
                                    </div>
                                    
                                    <div class='col-sm-2 predefinedActionButton' data-listid='1'>
                                        <div class='btn btn-default btn-sm addPredefined' data-listid='1' data-childno='0' style="margin-right:-4px"><i class='glyphicon glyphicon-plus'></i> Parent</div>
                                        <div class="btn btn-default btn-sm addChild" data-childlistid='1' data-childno='1' data-grandchildlist='1' style="padding:4px"><i class="fas fa-layer-group"></i></div>
                                    </div>
                                    
                                </div>
                                
                                    <div class="form-group form-group-sm input-list" id="child1" ></div>  BAWAK FIRST PARENT
                            </div>-->
                            
                            <?php }  ?>
                        </div>
                      </form>
                    </div>
            
                <div id="method">
                      <form id='basicMethod' >
                           <div id='predefinedListMethod'>
                                <?php if($input_type==='METHOD'){                         
                                $elementDetail = array(    
                                   'label' => $vars['element_desc'],
                                   'additional_attribute' => $vars['additional_attribute'],
                                   'element_code' => $vars['element_code'],
                                   'method' => $vars['method'],
                                   'json_element'=>$vars['json_element'],
                                   'doc_name_id'=>$vars['document_id'],
                                   'doc_method_code' =>$vars['method_code']
                                       ); ?>
                            <?= UpdateMethod($elementDetail);   }else{   ?>
                            <?=  ListMethod();?>
                             <?php }  ?>
                        </div>
                      </form>
                </div>
            </div>

<script>
$(document).ready(function(){

$('.my-form .add-box').click(function(){
		var n = $('div.text-box').length + 1;
		  console.log('n',n);
		  var $box_html = '<div class="my-form"><div class="form-group form-group-sm input-list text-box">';
		  $box_html += '<label class="control-label col-sm-4" for="box' + n + '">Box <span class="box-number">' + n + '</span></label>';
		  $box_html += '<input class="form-control" type="text" name="boxes[]" value="" id="box' + n + '"  /> <a href="#" class="remove-box">Remove</a>&nbsp';
		  $box_html += '</div></div>';
		  
		  $($box_html).hide();
		  $('.my-form div.text-box:last').after($box_html);
                  $($box_html).fadeIn('slow');


		  return false;		 
		  
		  
});

 $('.my-form').on('click', '.remove-box', function(){
	        $(this).parent().css( 'background-color', '#FF6C6C' );
	        $(this).parent().fadeOut("slow", function() {
	            $(this).remove();
	            $('.box-number').each(function(index){
	               $(this).text( index + 1 );
	           });
	        });
	        return false;
	    });
		 
});
</script>

<script>       
    $(function(){
        $('#multiple_answer').hide();
        $('#method').hide();
        $('[name=input_type]').on('change',function(){
            $('#multiple_answer').hide();
            $('#method').hide();
            var isselect = $(this).val();
            if(isselect==='MULTIPLE ANSWER'){
                $('#multiple_answer').show();}
            if(isselect==='METHOD'){
                $('#method').show();}
        });
    });
    
    $(function(){
        var $define = $("input[name='input_type']:checked").val();
        if( $define ==='MULTIPLE ANSWER'){
        $("#multiple_answer").show();
        }
        if( $define ==='METHOD'){
        $("#method").show();
        }
    });
</script>