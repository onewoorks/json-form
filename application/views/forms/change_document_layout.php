<form id='changelayouta' class='form-horizontal'>
    <input type="hidden" name="doc_id" value="<?= $doc_id; ?>" autocomplete="off" />
<div class='form-group form-group-sm'>
    <label class='control-label col-sm-3'>Column</label>
    <div class='col-sm-8 column'>
        <div>
                     <label class="radio-inline">
                            <input name="column" type="radio" value="1"  <?php if($layout->layout==1){echo 'checked';} ?> /> 1
                     </label>
                     <label class="radio-inline">
                            <input name='column' type="radio" value="2" <?php if($layout->layout==2){echo 'checked';} ?> /> 2
                     </label>
        </div>
        <input type='hidden' name='selected_column' value='<?= $layout->layout;?>' />
    </div>
</div>
<div class='form-group form-group-sm'>
    <label class='control-label col-sm-3'></label>
    <div class='col-sm-8 text-right'>
        <button id='changelayoutab' type='button' onclick='javascript:checkNew()' class='btn btn-sm btn-primary'>Update</button>
    </div>
</div>    
</form>
<script>
    function checkNew(){
        var values = $('#changelayouta').serializeArray();
       // console.log(values)
      $.ajax({
                url : '<?= SITE_ROOT;?>/formview/edit-layout/',
                data : { values: values },
                success : function(data){
                    console.log(data);
                    $('#myModal').modal('hide');
                    location.reload();
                }
            });
    };
    $(function(){
        $('input[name=column').change(function(){
            console.log($(this).val());
            $('[name=selected_column]').val($(this).val());
        })        
    });
</script>

