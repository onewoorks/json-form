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

                            <div class='prelist1'>
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
                                
                                    <div class="form-group form-group-sm input-list" id="child1" ></div> <!-- BAWAK FIRST PARENT-->
                            </div>
                            
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
    var counter;
    var color;

    $(document).ready(function(){
            counter=1;
    
    $('#predefinedList').on('click','.addPredefined', function(){
            var parent = "=========================ADD PARENT=========================";
            console.log(parent);

            var current = $(this).data('listid');                                                                                                                                                           //current=1
            console.log('current',current);     
            var index = $(this).data('listid') + 1;                                                                                                                                                         //index=2
            console.log('index',index);
            var option =$('#multi_input_type').html();
            var x = [index];                                                                                                                                                                                //x=[2]
            console.log('x',x);
            
            var $html = '<div class="prelist' + index + '" >';                                                                                                                                              //prelist2
            $html += '<div class="form-group form-group-sm input-list" >';
            $html += '<label class="control-label col-sm-4">Predefined Value</label>';
            $html += '<div class="col-sm-3 list-padding-right">';
            $html += '<input type="text" name="multi_ans_desc'+ x +'" class="form-control" placeholder="parent: label / title" />';                                                                         //multi_ans_desc[2]
            $html += '<input type="hidden" id="validation' + index + '" name="validation' + index + '" value="parentonly" />';                                                                              //validation2
            $html += '<input type="hidden" name="total" value="'+index+'" />';                                                                                                                              //TOTAL=2
            $html += '</div>';
            $html += '<div class="col-sm-3 list-padding-left" >';
            $html += '<select name="multi_input_type'+ x +'" class="form-control">' + option + '</select>';                                                                                                 //multi_input_type[2]
            $html += '</div>';
            $html += '<div class="col-sm-2 predefinedActionButton" data-listid=' + index + ' >';                                                                                                            //data-listid=2
            $html += '<div class="btn btn-default btn-sm addPredefined" data-listid=' + index + ' data-childno="1"><i class="glyphicon glyphicon-plus"></i> Parent</div>';                                  //data-listid=2, data-childno=1
            $html += '<div class="btn btn-default btn-sm addChild" data-childlistid="' + index + '" data-childno="1" style="padding:4px"><i class="fas fa-layer-group"></i></div>';          //data-childlistid=2, data-childno=1
            $html += '</div>';
            $html += '</div>';
            $html += '<div class="form-group form-group-sm input-list" id="child' + index + '"></div>';                                                                                                     //child2
            $html += '</div>';
            $($html).appendTo('#predefinedList');
            
            var $deleteButton = "<div class='btn btn-default btn-sm deletePredefined' data-delid='" + current + "' style='padding:4px'><i class='glyphicon glyphicon-trash'></i></div>";                    //data-delid=1
            $deleteButton += "<div class='btn btn-default btn-sm addChild' data-childlistid='" + current + "' data-childno='1' style='padding:4px'><i class='fas fa-layer-group'></i></div>";//data-childlistid=1, data-childno=1
            $('.predefinedActionButton[data-listid="' + current + '"]').html($deleteButton);                                                                                                                //data-listid=1
            counter=1;
            
    });

    $('#predefinedList').on('click','.addChild', function(){
            var child = "==================================================ADD CHILD==================================================";
            console.log(child);
            console.log(counter);
            if(counter<=5){

            var current = $(this).data('childlistid');                                                                                                                                              //current=1
            console.log('current =',current);
            var no = $(this).data('childno');                                                                                                                                                       //no=1
            console.log('no =',no);
            var nextno = no;                                                                                                                                                                        //nextno=1
            console.log('nextno =',nextno);
            var childnextno = no + 1;                                                                                                                                                               //childnextno=1
//            var option =$('#multi_input_type').html();
            
            $('.addChild[data-childlistid="' + current + '"]').data('childno',childnextno);                                                                                                         //data-childlistid=1 , data-childno=1

            var $html = '<div class="childno'+current+''+no+'" style="background-color:#f5f5f5;padding-top:3px">';                                                                                        //childno11
            $html += '<div class="form-group form-group-sm input-list" >';
            $html += '<label class="control-label col-sm-4">Layer</label>';  
            $html += '<div class="checkbox">';
            $html += '<div class="col-sm-3 list-padding-right">';
            $html += '<input type="checkbox" id="show_label'+current+''+nextno+'" name="show_label'+current+''+nextno+'" value="1" style="margin-top:6px;margin-left:4px;margin-right:3px" checked/>';  //show_label11
            $html += '<div id="label'+current+''+nextno+'" style="margin-left:20px;margin-right:2px">';                                                                                                 //label11
            $html += '<input type="text" id="refDesc'+current+''+nextno+'" name="refDesc'+current+''+nextno+'" class="form-control" placeholder="show label: 1 / 0"/>';                                //refdesc11
            $html += '<input type="hidden" id="totallabel" name="totallabel" value="'+current+''+nextno+'" />';                                                                                                                              //TOTAL=2
//            $html += '<input type="text" id="showvalidation'+current+''+nextno+'" name="showvalidation'+current+''+nextno+'" value="showlabelexist" />';                                                                              //validation2
            $html += '</div>';
            $html += '</div>'; 
            $html += '<div class="col-sm-2 childPredefinedActionButton" data-childlistid='+nextno+'>';                                                                                                          //data-childlistid=1
            $html += '<div class="btn btn-default btn-sm addgrandChild" data-grandchildlistid="'+current+''+no+'" data-grandchildno="1" ><i class="glyphicon glyphicon-plus"></i> Child</div>';//data-grandchildlistid=1, data-grandchildno=1
            $html += '<div class="btn btn-default btn-sm deleteChild" data-delid="'+current+''+nextno+'" data-num='+no+' data-parent='+nextno+' style="padding:4px;"><i class="glyphicon glyphicon-trash"></i></div>';       //data-delid=1, data-num=1, data-parent=1
            $html += '</div>';
            $html += '</div>';
            $html += '</div>';
            $html += '<div class="form-group form-group-sm input-list" id="grandchild'+current+''+no+'"></div>';                                                                                                //grandchild11
            $html += '</div>';
            $($html).appendTo('#child'+current);                                                                                                                                                          //child1

            $('#show_label'+current+''+nextno+'').change(function(){            
            if (!$(this).is(':checked')) {
                $('#label'+current+''+nextno+'').hide();
                document.getElementById('show_label'+current+''+nextno+'').value = '0';
//                document.getElementById('showvalidation'+current+''+nextno+'').value = '';
            }
            else{
                $('#label'+current+''+nextno+'').show();
                document.getElementById('show_label'+current+''+nextno+'').value = '1';
//                document.getElementById('showvalidation'+current+''+nextno+'').value = 'showlabelexist';
            }
            });
            counter++;
        }
    });
    
    $('#predefinedList').on('click','.addgrandChild', function(){
    
            var grandchild = "===========================================================================ADD GRANDCHILD===========================================================================";
            console.log(grandchild);
    
            var current = $(this).data('grandchildlistid');
            console.log('current',current);
            var no = $(this).data('grandchildno');
            console.log('no',no);
            var nextno = no;
            console.log('nextno',nextno);
            var grandchildnextno = no + 1;
            console.log('grandchildnextno',grandchildnextno);   //grandchildnextno=1
            var option =$('#multi_input_type').html();
        
            $('.addgrandChild[data-grandchildlistid="' + current + '"]').data('grandchildno',grandchildnextno);                                                                             //data-grandchildlistid=1, data-grandchildno=1
    
            var $html = '<div class="grandchildno'+current+''+no+'">';                                                                                                                      //grandchildno11
            $html += '<div class="form-group form-group-sm input-list">';
            $html += '<label class="control-label col-sm-4"></label>';                          
            $html += '<div class="col-sm-3 list-padding-right">';
            $html += '<input type="text" name="child_multi_ans_desc'+current+''+nextno+'" class="form-control" placeholder="child : label / title" style="margin-left:24px;width:165px"/>'; //grand_child_multi_ans_desc1
            $html += '<input type="hidden" value="childvalidation'+current+'' + nextno + '" id="childvalidation'+current+'' + nextno + '" name="childvalidation'+current+'' + nextno + '" value="childexist" />';                                   //grandchildvalidation1
            $html += '<input type="hidden" name="childsorting" class="form-control" value="'+current+'' + nextno + '" />';                                                                      //grandchildsorting1
            $html += '</div>';
            $html += '<div class="col-sm-3 list-padding-left" >';
            $html += '<select name="child_multi_input_type'+current+''+nextno+'" class="form-control" style="width:180px">'+ option +'</select>';                                                //grand_child_multi_input_type1
            $html += '</div>';
            $html += '<div class="col-sm-2 grandchildPredefinedActionButton" data-grandchildlistid='+nextno+'>';                                                                            //data-grandchildlistid=1
            $html += '<div class="btn btn-default btn-sm deletegrandChild" data-granddelid="'+current+''+no+'" data-num='+no+' data-parent='+nextno+' style="padding:4px;margin-left:-16px"><i class="glyphicon glyphicon-trash"></i></div>';//data-granddelid=1, data-num=1, data-parent=1
            $html += '</div>';
            $html += '</div>';
            $html += '</div>';
            $($html).appendTo('#grandchild'+current);
    
    });
            
    $('#predefinedList').on('click','.deletePredefined', function(){
        var deleteid = $(this).data('delid');//1
        if (deleteid > 0) {
            $('.prelist' + deleteid).remove();//prelist1
        }
    });
    
    $('#predefinedList').on('click','.deleteChild', function(){
        var deleteid = $(this).data('delid');
        console.log('deleteid =',deleteid);                   
        $('.childno' + deleteid).remove();
        counter--;
    });
    
    $('#predefinedList').on('click','.deletegrandChild', function(){
        var deleteid = $(this).data('granddelid');
        console.log('granddeleteid =',deleteid);                   
        $('.grandchildno' + deleteid).remove();
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