<form id='editSection' class='form-horizontal'>
     <div class='form-group form-group-sm'>
        <label class='control-label col-sm-3'>Name&nbsp;<b style='color: red'>*</b></label>
        <input type='hidden' name='doc_id' value='<?= $doc_id;?>' autocomplete="off"/>
        <div class='col-sm-3'>
            <input type='text' data-no = '1' name='section_descs' id='section_descs1' value='<?= $section->section_desc;?>' class='form-control text-uppercase' onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" required/>
            <span id='validateFN1' name='validateFN1' style="font-size:10px;color:red;text-align:left" hidden>Record Found</span>
            <span id='validateTN1' name='validateTN1' style="font-size:10px;color:green;text-align:left" hidden>No Record Found</span>
            <select id='list_sections' class='form-control hidden'>
                <?php foreach ($list_of_sections as $sections): ?>
                    <option value='<?php echo $sections['section_code']; ?>'><?php echo $sections['section_desc']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <br><br><br>
        <label class='control-label col-sm-3 hidden '>Json&nbsp;<b style='color: red'>*</b></label>
        <input type='hidden' name='doc_id' value='<?= $doc_id;?>' autocomplete="off"/>
        <div class='col-sm-3 hidden'>
            <input type='text' name='json_section' data-no = '1' id='json_section1' value='<?= $section->json_section;?>' class='form-control' onkeyup="this.value" autocomplete="off" required/>
            <span id='validateFFN1' name='validateFFN1' style="font-size:10px;color:red;text-align:left" hidden>Record Found</span>
            <span id='validateTTN1' name='validateTTN1' style="font-size:10px;color:green;text-align:left" hidden>No Record Found</span>
            <select id='list_jsons' class='form-control hidden'>
                <?php foreach ($list_of_sections as $sections): ?>
                    <option value='<?php echo $sections['section_desc']; ?>'><?php echo $sections['json_section']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
       
    </div>

<div class='form-group form-group-sm'>
    <label class='control-label col-sm-3'></label>
    <div class='col-sm-8 text-right'>
        <button type='button' class='btn btn-sm btn-primary addSec' onclick='javascript:checkNew()'>Update</button>
         <!--<button type='submit' class='btn btn-sm btn-primary'>Update</button>-->
    </div>
</div>    
</form>
<script>
    function checkNew(){
        var values = $('#editSection').serializeArray(); 
        console.log(values);
        $.ajax({
                url : '<?= SITE_ROOT;?>/formview/edit-section/',
                data : { values: values },
                success : function(){
                    $('#title').modal('hide');
                    swal({
                      title: "Section Updated!",
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

        $("#list_sections option").each(function () {
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

            $('#section_descs' + thisValue).keyup(function () {
                var str = $(this).val();

                if (str !== "") {
                    if (array.indexOf(str) > -1) {
                        $('#validateTN' + thisValue).attr('hidden', 'hidden');
                        $('#validateFN' + thisValue).attr('hidden', false);
                        $('.addSec').attr('disabled', true);
                    } else {
                        $('#validateTN' + thisValue).attr('hidden', false);
                        $('#validateFN' + thisValue).attr('hidden', 'hidden');
                        $('.addSec').attr('disabled', false);
                    }
                   
                } else {
                    $('#validateTN' + thisValue).attr('hidden', 'hidden');
                    $('#validateFN' + thisValue).attr('hidden', 'hidden');
                    $('.addSec').attr('disabled', 'disabled');
                }

                var sections = $(this).val().toLowerCase().replace(/ /g, '_');
                var json = sections.replace(/[^A-Z0-9]+/ig, '_');
                $('#json_section' + thisValue).val(json);

                //JSONSECTION
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
