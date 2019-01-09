<!--<div class='panel-heading panel-parent'>FORM DECORATION</div>-->
<div class='panel-body'>
    <div class='form-group form-group-sm'>
            <input type="hidden" name='elementCode' value="<?= $vars['element_code'];?>" />
            <input type="hidden" name='documentId' value="<?= $vars['document_id'];?>" />
            <?php $dat = $vars['data_type'];  ?>
    </div>

    <div id="jsonData" >  
        <?php  $additional_attr = $vars['additional_attribute'];
               $json = json_decode($additional_attr,true);
               if(isset($json['deco_style'])){
               $deco =$json['deco_style'];
               if($deco==='custom-style'){
                  $cus =$json['deco_custom_style']; 
               }else{ $cus =''; }}else{$deco='';$cus ='';}       ?>
            <input type="hidden" name="custom" value="<?php echo $cus; ?>" />
            <input type="hidden" name="deco" value="<?php echo $deco; ?>" />      
    </div>

    <div class='form-group form-group-sm'>
        <label class='control-label col-sm-2'>Parent</label>
        <div class='col-sm-8'>
                     <label class="radio-inline">
                            <input name="setparent" type="radio" value="parent" <?php if($dat==='parent'){echo 'checked';} ?>> Yes
                     </label>
                     <label class="radio-inline">
                            <input name="setparent" type="radio" value="null" <?php if($dat==='null'){echo 'checked';} ?> > No
                     </label>
        </div>
    </div>
    
    <div class='form-group form-group-sm'>
        <label class='control-label col-sm-2'>Style</label>
        <div class='col-sm-8' id="decostyle">
            <div class="radio">
                <label>
                    <input type="radio" name="deco_style" value="panel-header" <?php if($deco==='panel-header'){echo 'checked';}  ?>>
                    Panel Header
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="deco_style" value="heading-h1" <?php if($deco==='heading-h1'){echo 'checked';}  ?>>
                    Heading (H1)
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="deco_style" value="heading-h2" <?php if($deco==='heading-h2'){echo 'checked';}  ?>>
                    Heading (H2)
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="deco_style" value="heading-h3" <?php if($deco==='heading-h3'){echo 'checked';}  ?>>
                    Heading (H3)
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="deco_style" value="default" <?php if($deco==='default'){echo 'checked';}  ?>>
                    Default (H4)
                </label>
            </div>
        </div>
    </div>
    <div id="customstyling">
        <div class='form-group form-group-sm'>
            <label class='control-label col-sm-4'>Custom Style (CSS)</label>
            <div class='col-sm-8'>
                <textarea rows="4" name='deco_custom_style' id="here" class='form-control'></textarea>
            </div>
        </div>
    </div>
</div>

<script>
    $(function(){
        var custom = $('[name=custom]').val();
        $('#customstyling').hide();
        $('[name=deco_style]').on('change',function(){
            $('#customstyling').hide();
            var currentselect = $(this).val();
            if(currentselect==='custom-style'){
                document.getElementById("here").value = custom;
                $('#customstyling').show();
            }else{
               document.getElementById("here").value = ''; 
            }
        });
    });
    
    $(function(){
        var customs = $('[name=custom]').val();
        var decos = $("input[name='deco_style']:checked").val();
            if(decos==='custom-style'){
                document.getElementById("here").value = customs;
                $('#customstyling').show();
            }else{
                document.getElementById("here").value = '';
            }
    });
    </script>