<form id='change' class='form-horizontal'>
    <input type="hidden" name="doc_id" value="<?= $doc_id; ?>" autocomplete="off" />
    <div class='form-group form-group-sm'>
        <label class='control-label col-sm-3'>Update Column:</label>

        <div class='col-sm-8 column'>       
            <div>
                <label class="radio">
                    <input name="column" type="radio" value="default"  <?php if ($layout->layout == 1) {echo 'checked';} ?> />Default
                </label>
                <label class="radio">
                    <input name='column' type="radio" value="top-down" <?php if ($layout->layout == 2) {echo 'checked';} ?> /> Top-Down
                </label>
                <label class="radio">
                    <input name="column" type="radio" value="left-right"  <?php if ($layout->layout == 1) {echo 'checked';} ?> /> Left-Right
                </label>
                <label class="radio">
                    <input name='column' type="radio" value="multiple" <?php if ($layout->layout == 2) {echo 'checked';} ?> /> Multiple Columns
                </label>
                <input type="text" name="multiplecols" value="2" >
              
            </div>
            <input type='hidden' name='selected_pattern' value='<?= ($layout->layout == 2) ? 'multiple' : 'default'; ?>' />
        </div>
    </div>
    <div class='form-group form-group-sm'>
        <label class='control-label col-sm-3'></label>
        <div class='col-sm-8 text-right'>
        <button id='changelayout' type='button' onclick='javascript:Update()' class='btn btn-sm btn-primary'>Update</button>
        </div>
    </div>    
</form>
<script>
    function Update() {
         var values = $('#change').serializeArray();
        console.log(values);
      $.ajax({
                url : '<?= SITE_ROOT;?>/formview/add-attributes/',
                data : { values: values },
                success : function(data){
                    console.log(data);
                    $('#Modal').modal('hide');
//                    location.reload();
                }
            });
    };
    $(function(){
        $('input[name=column').change(function(){
            console.log($(this).val());
            $('[name=selected_pattern]').val($(this).val());
        });        
    });
</script>