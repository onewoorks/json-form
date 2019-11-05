<form id='editMethod' class='form-horizontal'>
     <div class='form-group form-group-sm'>
        <label class='control-label col-sm-3'>Name&nbsp;<b style='color: red'>*</b></label>
         <input type='hidden' name='doc_id' value='<?= $doc_id;?>' autocomplete="off"/>
        <div class='col-sm-4'>
            <input type='text' data-no = '1' name='method_descs' id='method_descs1' value='<?= $methods->doc_method_desc;?>' class='form-control text-capitalize' onkeyup="this.value = this.value.toLocaleLowerCase();" autocomplete="off" required/>
            <span id='validateFN1' name='validateFN1' style="font-size:10px;color:red;text-align:left" hidden>Record Found</span>
            <span id='validateTN1' name='validateTN1' style="font-size:10px;color:green;text-align:left" hidden>No Record Found</span>
            <select id='list_method_descs' class='form-control hidden'>
                <?php foreach ($list_of_method as $method): ?>
                    <option value='<?php echo $method['doc_method_code']; ?>'><?php echo $method['doc_method_desc']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
         <br> <br> <br>
        <label class='control-label col-sm-3 hidden'>Method Info&nbsp;<b style='color: red'>*</b></label>
        <input type='hidden' name='doc_id' value='<?= $doc_id;?>' autocomplete="off"/>
        <div class='col-sm-4 hidden'>
            <input type='text' name='json_method' data-no = '1' id='json_method1' class='form-control' value='<?= $methods->method_info;?>' onkeyup="this.value" autocomplete="off" required/>
            <span id='validateFFN1' name='validateFFN1' style="font-size:10px;color:red;text-align:left" hidden>Record Found</span>
            <span id='validateTTN1' name='validateTTN1' style="font-size:10px;color:green;text-align:left" hidden>No Record Found</span>
            <select id='list_method_infos' class='form-control hidden'>
                <?php foreach ($list_of_method as $method): ?>
                    <option value='<?php echo $method['doc_method_desc']; ?>'><?php echo $method['method_info']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

<div class='form-group form-group-sm'>
    <label class='control-label col-sm-3'></label>
    <div class='col-sm-8 text-right'>
        <button type='button' class='btn btn-sm btn-primary editMeth' onclick='javascript:checkNew()'>Update</button>
         <!--<button type='submit' class='btn btn-sm btn-primary'>Update</button>-->
    </div>
</div>    
</form>
<script>
    function checkNew(){ 
        var values = $('#editMethod').serializeArray();
      $.ajax({
                url : '<?= SITE_ROOT;?>/formview/edit-method/',
                data : { values: values },
                success : function(){
                    $('#title').modal('hide');
                    swal({
                      title:"Method Updated!",
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
        var selText2;
        var array2 = [];

        var thisValue;

        $("#list_method_descs option").each(function () {
            var $this = $(this);
            selText = $this.text().toLocaleLowerCase();
            array.push(selText);
        });

        $("#list_method_lists option").each(function () {
            var $this = $(this);
            selText2 = $this.text();
            array2.push(selText2);
        });

        $(document).on('focus', 'input', function () {
            thisValue = $(this).attr('data-no');

            $('#method_descs' + thisValue).keyup(function () {
                var str = $(this).val();
                console.log(str);

                if (str !== "") {
                    if (array.indexOf(str) > -1) {
                        $('#validateTN' + thisValue).attr('hidden', 'hidden');
                        $('#validateFN' + thisValue).attr('hidden', false);
                        $('.editMeth').attr('disabled', true);
                    } else {
                        $('#validateTN' + thisValue).attr('hidden', false);
                        $('#validateFN' + thisValue).attr('hidden', 'hidden');
                         $('.editMeth').attr('disabled', false);
                    }
                   
                } else {
                    $('#validateTN' + thisValue).attr('hidden', 'hidden');
                    $('#validateFN' + thisValue).attr('hidden', 'hidden');
                    $('.editMeth').attr('disabled', 'disabled');
                }

                var method = $(this).val().toLowerCase().replace(/ /g, '');
                var INFO = method.replace(/[^A-Z0-9]+/ig, '');
                $('#json_method' + thisValue).val(INFO);

                //JSONSECTION
                if (INFO !== "") {
                    if (array.indexOf(str) > -1) {
                        $('#validateTTN' + thisValue).attr('hidden', 'hidden');
                        $('#validateFFN' + thisValue).attr('hidden', false);
                    } else {
                        $('#validateTTN' + thisValue).attr('hidden', false);
                        $('#validateFFN' + thisValue).attr('hidden', 'hidden');
                    }
                } else {
                    $('#validateTTN' + thisValue).attr('hidden', 'hidden');
                    $('#validateFFN' + thisValue).attr('hidden', 'hidden');
                }
            });
        });//endOfFocus
    });//endOfDocument
</script>   

