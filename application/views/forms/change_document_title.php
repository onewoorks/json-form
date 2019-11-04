<form id='editTitle' class='form-horizontal'>
     <div class="form-group form-group-sm" style='margin-left:-55px;margin-top: -5px'>
                <label class="control-label col-sm-4">Document Title&nbsp;<b style='color: red'>*</b></label>
                <input type='hidden' name='doc_id' value='<?= $doc_id;?>' autocomplete="off"/>
                <div class="col-sm-6" style='width:48.55%'>
                    <input name="doc_name" data-no = '1' id="doc_name1" type="text" value='<?= $title->doc_name_desc;?>' class="form-control text-uppercase" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" required/>
                       <span id='validateFN1' name='validateFN1' style="font-size:10px;color:red;text-align:left" hidden>Record Found</span>
                       <span id='validateTN1' name='validateTN1' style="font-size:10px;color:green;text-align:left" hidden>No Record Found</span>
                       <select id='list_doc' class='form-control hidden'>
                        <?php foreach ($list_of_titles as $titles): ?>
                            <option value='<?php echo $titles['doc_name_desc']; ?>'><?php echo $titles['doc_name_desc']; ?></option>
                        <?php endforeach; ?>
                    </select>  
                </div>  
                <input type='hidden' name='selected_title' value='<?= $title->doc_name_desc;?>' />
            </div>

<div class='form-group form-group-sm'>
    <label class='control-label col-sm-3'></label>
    <div class='col-sm-8 text-right'>
        <button type='button' class='btn btn-sm btn-primary editDoc' onclick='javascript:checkNew()' disabled>Update</button>
         <!--<button type='submit' class='btn btn-sm btn-primary'>Update</button>-->
    </div>
</div>    
</form>
<script>
    function checkNew(){
            var values = $('#editTitle').serializeArray();
             console.log(values);
             $.ajax({
                url : '<?= SITE_ROOT;?>/formview/edit-title/',
                data : { values: values },
                success : function(){
                    $('#title').modal('hide');
                    swal({
                      title: "Title Updated!",
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
    
    $(function(){
        $('input[name=doc_name').change(function(){
            console.log($(this).val());
            $('[name=selected_title]').val($(this).val());
        }); 
    });
</script>

<script>
    $(document).ready(function () {
        console.log(document);
        var selText;
        var array = [];

        var thisValue;

        $("#list_doc option").each(function () {
            var $this = $(this);
            selText = $this.text();
            array.push(selText);
        });

        $(document).on('focus', 'input', function () {
            console.log(document);
            thisValue = $(this).attr('data-no');

            $('#doc_name' + thisValue).keyup(function () {
                var str = $(this).val();
                console.log(str);

                if (str !== "") {
                    if (array.indexOf(str) > -1) {
                        $('#validateTN' + thisValue).attr('hidden', 'hidden');
                        $('#validateFN' + thisValue).attr('hidden', false); //show Record Found
                        $('.editDoc').attr('disabled', true);
                    } else {
                        $('#validateTN' + thisValue).attr('hidden', false); //show Record Not Found
                        $('#validateFN' + thisValue).attr('hidden', 'hidden');
                        $('.editDoc').attr('disabled', false);
                        
                    }
                  // $('.editDoc').attr('disabled', false);
                } else {
                    $('#validateTN' + thisValue).attr('hidden', 'hidden');
                    $('#validateFN' + thisValue).attr('hidden', 'hidden');
                    $('.editDoc').attr('disabled', 'disabled');
                }

            });
        });//endOfFocus
    });//endOfDocument
</script>   