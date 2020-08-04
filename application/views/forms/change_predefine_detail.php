<form id='editPredefine' class='form-horizontal'>
     <div class='form-group form-group-sm'>
        <label class='control-label col-sm-3'>Name&nbsp;<b style='color: red'>*</b></label>
        <input type='hidden' name='doc_id' value='<?= $doc_id;?>' autocomplete="off"/>
        <div class='col-sm-6'>
            <input type='text' data-no = '1' name='predefine_descs' id='predefine_descs1' value='<?= $predefine->multiple_desc;?>' class='form-control text-uppercase' onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" required/>
            <span id='validateFN1' name='validateFN1' style="font-size:10px;color:red;text-align:left" hidden>Record Found</span>
            <span id='validateTN1' name='validateTN1' style="font-size:10px;color:green;text-align:left" hidden>No Record Found</span>
            <select id='list_predefines' class='form-control hidden'>
                <?php foreach ($list_of_predefines as $predefines): ?>
                    <option value='<?php echo $predefines['multiple_desc_code']; ?>'><?php echo $predefines['multiple_desc']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

<div class='form-group form-group-sm'>
    <label class='control-label col-sm-3'></label>
    <div class='col-sm-8 text-right'>
        <button type='button' class='btn btn-sm btn-primary addPre' onclick='javascript:checkNew()'>Update</button>
         <!--<button type='submit' class='btn btn-sm btn-primary'>Update</button>-->
    </div>
</div>    
</form>
<script>
    function checkNew(){
        var values = $('#editPredefine').serializeArray(); 
        console.log(values);
        $.ajax({
                url : '<?= SITE_ROOT;?>/formview/edit-predefine/',
                data : { values: values },
                success : function(data){
                    console.log(data);
                    $('#title').modal('hide');
                    swal({
                      title: "Multiple Answer Updated!",
                      text: "Data successfully updated into database",
                      type: "success"
                    });
                }
            });
             setTimeout(
                    function () {
                        window.location.reload(true);
                    }, 1200);
    };
</script>
<script>
    $(document).ready(function () {

        var selText;
        var array = [];
       
        var thisValue;

        $("#list_predefines option").each(function () {
            var $this = $(this);
            selText = $this.text();
            array.push(selText);
        });

        $(document).on('focus', 'input', function () {
            thisValue = $(this).attr('data-no');

            $('#predefine_descs' + thisValue).keyup(function () {
                var str = $(this).val();

                if (str !== "") {
                    if (array.indexOf(str) > -1) {
                        $('#validateTN' + thisValue).attr('hidden', 'hidden');
                        $('#validateFN' + thisValue).attr('hidden', false);
                        $('.addPre').attr('disabled', true);
                    } else {
                        $('#validateTN' + thisValue).attr('hidden', false);
                        $('#validateFN' + thisValue).attr('hidden', 'hidden');
                        $('.addPre').attr('disabled', false);
                    }
                   
                } else {
                    $('#validateTN' + thisValue).attr('hidden', 'hidden');
                    $('#validateFN' + thisValue).attr('hidden', 'hidden');
                    $('.addPre').attr('disabled', 'disabled');
                }
            });
        });//endOfFocus
    });//endOfDocument
</script>   
