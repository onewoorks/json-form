<div class='form-group form-group-sm'>
    <label class='control-label col-sm-3' >Type Of Conception</label>
    <div class='col-sm-3'>
        <?php foreach($options as $option):?>
        <label class='radio-inline'>
            <input type='radio' value='<?php echo $option;?>' name='type_of_conception_option' />
            <?php echo ucfirst($option);?></label>
        <?php endforeach;?>
    </div>
    <div class='col-sm-3 toco'>
        <select class='form-control input-sm'>
            <?php foreach($drugUsed as $du):?>
            <option value='<?php echo $du;?>'><?php echo $du;?></option>
            <?php endforeach;?>
        </select>
    </div>
    <div class='col-sm-3 toco'>
        <select class='form-control input-sm'>
            <?php foreach($drugUsedChild as $duc):?>
            <option value='<?php echo $duc;?>'><?php echo $duc;?></option>
            <?php endforeach;?>
        </select>
    </div>
</div>
<script>
    $(function(){
        $('.toco').hide();
        $('[name=type_of_conception_option]').change(function(){
           if($(this).val()=='assisted'){
               $('.toco').show();
           } else {
               $('.toco').hide();
           }
        });
    });
    </script>