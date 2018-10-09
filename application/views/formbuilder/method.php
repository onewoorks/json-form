<!--<div class='panel-heading panel-child'>FORM WITH DEFINE METHOD</div>-->
<div class='panel-body'>
    <div class='form-group form-group-sm'>
            <input type="hidden" name='elementCode' value="<?= $vars['element_code'];?>" />
            <input type="hidden" name='documentId' value="<?= $vars['document_id'];?>" />
            <input type="hidden" name='docmethodcode' value="<?= $vars['doc_method_code'];?>" />
    </div>
    <div class='form-group form-group-sm'>
        <label class='control-label col-sm-4'>Method</label>
                <div class="col-sm-8">                      
                    <select name='method_name' class='form-control'> 
                        <?php if ($vars['doc_method_code']!= null):
                            echo "<option id='".$vars['doc_method_code']."' value='".$vars['method']."' selected>".$vars['doc_method_desc']."</option>";
                            echo "<option value='1'>Signature</option>";
                            echo "<option value='2'>Alert And Allergies</option>";
                            echo "<option value='3'>Medical Alert</option>";
                            echo "<option value='4'>Isolation Precaution</option>";
                            echo "<option value='5'>Vital Sign ETD</option>";
                            echo "<option value='6'>Vital Sign General</option>";
                            echo "<option value='7'>Vital Sign ORL</option>";
                            echo "<option value='8'>Vital Sign Peadiatric</option>";
                            echo "<option value='9'>Vital Sign Obstetrics</option>";
                            echo "<option value='10'>Diagnosis</option>";
                            echo "<option value='11'>Problem List</option>";
                            echo "<option value='12'>Performing Staff</option>";
                            echo "<option value='13'>Performing Staff Surgery</option>";
                            echo "<option value='14'>Outgoing Referrals</option>";
                            echo "<option value='15'>Procedure Ordered</option>";
                        else:
                            echo "<option value='0' selected>Please Select Method</option>";
                            echo "<option value='1'>Signature</option>";
                            echo "<option value='2'>Alert And Allergies</option>";
                            echo "<option value='3'>Medical Alert</option>";
                            echo "<option value='4'>Isolation Precaution</option>";
                            echo "<option value='5'>Vital Sign ETD</option>";
                            echo "<option value='6'>Vital Sign General</option>";
                            echo "<option value='7'>Vital Sign ORL</option>";
                            echo "<option value='8'>Vital Sign Peadiatric</option>";
                            echo "<option value='9'>Vital Sign Obstetrics</option>";
                            echo "<option value='10'>Diagnosis</option>";
                            echo "<option value='11'>Problem List</option>";
                            echo "<option value='12'>Performing Staff</option>";
                            echo "<option value='13'>Performing Staff Surgery</option>";
                            echo "<option value='14'>Outgoing Referrals</option>";
                            echo "<option value='15'>Procedure Ordered</option>";
                        endif;
                        ?>
                        
                    </select>
                </div>
    </div>
</div>
