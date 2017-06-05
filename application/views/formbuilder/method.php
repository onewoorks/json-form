<!--<div class='panel-heading panel-child'>FORM WITH DEFINE METHOD</div>-->
<div class='panel-body'>
    <div class='form-group form-group-sm'>
            <input type="hidden" name='elementCode' value="<?= $vars['element_code'];?>" />
            <input type="hidden" name='documentId' value="<?= $vars['document_id'];?>" />
    </div>
    <div class='form-group form-group-sm'>
        <label class='control-label col-sm-4'>Method</label>
                <div class="col-sm-8">                      
                    <select name='method_name' class='form-control'> 
                        <?php if($vars['method']!=NULL){
                           echo '<option value="'.$vars['method'].'">'.$vars['method'].'</option>'; 
                        } else{
                           echo '<option value="no">Please select method name</option>' ;
                        }   ?>
                        
                        <option value='AlertAndAllergies'>Alert and Allergies</option> 
                        <option value='VitalSign'>Vital Sign</option>
                        <option value='Signature'>Signature</option> 
                        <option value='MethodInProgress'>Method in Progress</option>
<!--                        <option value='no'>----------Obstetric Note----------</option>
                        <option value='OtherInfectiveScreenSpecify'>Other Infective Screen Specify</option> 
                        <option value='PastObstetricsHistory'>Past Obstetric History</option>
                        <option value='BreastTable'>Breast Table</option>-->
                    </select>
                </div>
<!--        <div class='col-sm-8'>
            <input type='text' name='method_name' class='form-control' value="<?= $vars['method'];?>"/>
        </div>-->
    </div>
           
                <?php   if($vars['method']!=NULL){
                   $additional_attr = $vars['additional_attribute'];
//                   $json = json_decode($additional_attr,true);
//                       if($json!=NULL){
//                          $method =$json['method']; 
//                }else{ $method =''; }                 
                }else{$additional_attr='';}      
                ?>   
         
<!--    <div class='form-group form-group-sm'>
        <label class='control-label col-sm-4'>Parameter <i>(string)</i></label>
        <div class='col-sm-8'>-->
            <?php if($vars['method']!=NULL){    ?>
            <input type='hidden' name='method_params' class='form-control' value='<?php echo $additional_attr; ?>'/>
            <?php  }else{ ?>
            <input type='hidden' name='method_params' class='form-control' value='{"method": {"page": "Common_Form"}}'/>
            <?php } ?>
<!--        </div>
    </div>-->
</div>
