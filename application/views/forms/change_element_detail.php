<form id='editElement' class='form-horizontal'>
     <div class='form-group form-group-sm'>
            <label class='control-label col-sm-3'>Name&nbsp;<b style='color: red'>*</b></label>
            <input type='hidden' name='doc_id' value='<?= $doc_id;?>' autocomplete="off"/>
            <div class='col-sm-4'>
                <input type='text' data-no = '1' name='element_descs' id='element_descs1' value='<?= $element->element_desc;?>' class='form-control' autocomplete="off" required/>
               <span id='validateFN1' name='validateFN1' style="font-size:10px;color:red;text-align:left" hidden>Record Found</span>
            <span id='validateTN1' name='validateTN1' style="font-size:10px;color:green;text-align:left" hidden>No Record Found</span>
                <select id='list_elements' class='form-control hidden'>
                    <?php foreach ($list_of_elements as $elements): ?>
                        <option value='<?php echo $elements['element_code']; ?>'><?php echo $elements['element_desc']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <br> <br> <br>
            <label class='control-label col-sm-3 hidden'>Json&nbsp;<b style='color: red'>*</b></label>
            <input type='hidden' name='doc_id' value='<?= $doc_id;?>' autocomplete="off"/>
            <div class='col-sm-4 hidden'>
                <input type='text' name='json_element' data-no = '1' id='json_element1' value='<?= $element->json_element;?>' class='form-control' autocomplete="off" required/>
                <span id='validateFFN1' name='validateFFN1' style="font-size:10px;color:red;text-align:left" hidden>Record Found</span>
            <span id='validateTTN1' name='validateTTN1' style="font-size:10px;color:green;text-align:left" hidden>No Record Found</span>
                <select id='list_jsons' class='form-control hidden'>
                    <?php foreach ($list_of_elements as $elements): ?>
                        <option value='<?php echo $elements['element_desc']; ?>'><?php echo $elements['json_element']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

<div class='form-group form-group-sm'>
    <label class='control-label col-sm-3'></label>
    <div class='col-sm-8 text-right'>
        <button type='button' class='btn btn-sm btn-primary editElem' onclick='javascript:checkNew()'>Update</button>
         <!--<button type='submit' class='btn btn-sm btn-primary'>Update</button>-->
    </div>
</div>    
</form>
<script>
    function checkNew(){
        var values = $('#editElement').serializeArray();
      $.ajax({
                url : '<?= SITE_ROOT;?>/formview/edit-element/',
                data : { values: values },
                success : function(){
                    $('#title').modal('hide');
                    swal({
                      title: "Element Updated!",
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

        $("#list_elements option").each(function () {
            var $this = $(this);
            selText = $this.text();
            array.push(selText);
        });

        $("#list_jsons option").each(function () {
            var $this = $(this);
            selText2 = $this.text();
            array2.push(selText2);
        });

        $(document).on('focus', 'input', function () {
            thisValue = $(this).attr('data-no');

            $('#element_descs' + thisValue).keyup(function () {
                var str = $(this).val();

                if (str !== "") {
                    if (array.indexOf(str) > -1) {
                        $('#validateTN' + thisValue).attr('hidden', 'hidden');
                        $('#validateFN' + thisValue).attr('hidden', false);
                        $('.addElem').attr('disabled', true);
                    } else {
                        $('#validateTN' + thisValue).attr('hidden', false);
                        $('#validateFN' + thisValue).attr('hidden', 'hidden');
                         $('.addElem').attr('disabled', false);
                    }
                    
                } else {
                    $('#validateTN' + thisValue).attr('hidden', 'hidden');
                    $('#validateFN' + thisValue).attr('hidden', 'hidden');
                    $('.addElement').attr('disabled', 'disabled');
                }

                var element = $(this).val().toLowerCase().replace(/ /g, '_');
                var json = element.replace(/[^A-Z0-9]+/ig, '_');
                $('#json_element' + thisValue).val(json);

                //JSONELEMENT
                if (json !== "") {
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