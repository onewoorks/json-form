<form id='addNewElement' class='form-horizontal'>

    <div class='panel panel-default'>
        <br>    
        <input type='hidden' name="doc_id" value="<?= $doc_id; ?>" />
        <input type='hidden' name="section_code" value='<?= $section_id; ?>' />
        <input type="hidden" name="section_sorting" value="<?= $section_sorting->section_sorting; ?>" />    
        
        <select id='list_section_desc' class='form-control hidden'>
            <?php foreach ($list_of_elements as $element): ?>
               <option value='<?php echo $element['parent_element_code']; ?>'><?php echo $element['element_desc']; ?></option>
            <?php endforeach; ?>
        </select>

        <div class="form-group form-group-sm">
            <label class='control-label col-sm-2'>Element Description</label>
            <div class="col-sm-8">
                <select name="element_desc" id="element_desc" class="form-control" >
                    <?php foreach ($elements as $element): ?>
                        <option value='<?php echo $element['element_code']; ?>'><?php echo $element['element_desc']; ?></option>
                    <?php endforeach; ?>
                </select>
                <span id='validateF' style="font-size:10px;color:red;text-align:left" hidden>Element already exist in this section</span>
            </div>
        </div>

        <div class="form-group form-group-sm">
            <label class="control-label col-sm-2">Element Group</label>
            <div class="col-sm-8">
                <select name="element_group" id="element_group" class="form-control" >
                    <?php foreach ($elements as $element): ?>
                        <option value='<?php echo $element['element_code']; ?>'><?php echo $element['element_desc']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="form-group form-group-sm">
            <label class="control-label col-sm-2">Element Hyperlink</label>
            <div class="col-sm-3">
                <select name="element_hyperlink" id="element_hyperlink" class="form-control" >
                     <option value='0' selected="selected">Please Select Hyperlink</option>
                    <?php foreach ($list_hyperlink as $hyperlink): ?>
                        <option value='<?php echo $hyperlink['hyperlink_code']; ?>'><?php echo $hyperlink['hyperlink_desc']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>  

        <div class='form-group form-group-sm'>
            <label class='control-label col-sm-2'>Element Level</label>
            <div class='col-sm-8 form-inline'>
                <input type='number' name='element_level' class='form-control' style="width:8%" autocomplete="off" required/>
                <span style='color: red; position: inherit'>*</span>
            </div>
        </div>


        <div class="form-group form-group-sm">
            <label class="control-label col-sm-2">Position</label>
            <div class="col-sm-8">
                <label class="radio-inline">
                    <input name="position" type="radio" value="L" checked> Left
                </label>
                <label class="radio-inline">
                    <input name="position" type="radio" value="R"> Right
                </label>
            </div>
        </div>

        <div class='form-group form-group-sm'>
            <label class='control-label col-sm-2'>Element Properties</label>
            <div class='col-sm-8'>
                <label class='radio-inline'>
                    <input type='radio' name='element_properties' value='DECORATION_NEW'/> Decoration
                </label>
                <label class='radio-inline'>
                    <input type='radio' name='element_properties' value='BASIC' checked="checked"/> Basic
                </label>
                <label class='radio-inline'>
                    <input type='radio' name='element_properties' value='SUBSECTION_NEW'/> Subsection
                </label>
            </div>
            <div id='formelement'></div>
        </div>    

        <div class='form-group form-group-sm'>
            <label class='control-label col-sm-3'></label>
            <div class='col-sm-12 text-right' style="margin-left: -80px">
                <button type='submit' class='btn btn-sm btn-primary update'>Update</button>
            </div>
        </div>      

    </div>
</form>
<script>
    $(document).ready(function () {
        $('#element_desc').on('change', function () {
            $('#element_group').val($(this).val());
        });

// init
        $('#element_desc').change();
    });

</script>
<script>
    //DISPLAY PROPERTY'S DETAIL   
    $(function () {
        var formType = $('input[name=element_properties]:checked').val();
        ElementBuilder(formType);
        $('[name=form_element').val(formType);
        $('[name=element_properties]').on('change', function () {
            var selector = $(this).val();
            //  console.log("selector",selector);
            $('#' + selector).show();
            $('[name=form_element').val(selector);
            ElementBuilder(selector);
        });
    });

    //BAWA KE PAGE->BASIC
    function ElementBuilder(formType) {
        var formValue = $('#editElement').serializeArray();

        $.ajax({
            url: '<?php echo SITE_ROOT; ?>/formbuilder/formelement/',
            data: {value: formType, params: formValue},
            success: function (data) {
                $('#formelement').html(data);
            }
        });
    }
    ;

    //UPDATE_ELEMENT
    $(function () {
        $('#addNewElement').submit(function (e) {
            e.preventDefault();
            var test = $(this).serializeArray();
            var new_desc = $('#element_desc').val();
            var elemDesc = $('#elemList [value="' + new_desc + '"]').data('id');
            test.push({name: 'new_element', value: '' + elemDesc + ''});

            var datas = JSON.stringify(test);
            var method = JSON.stringify($('#basicMethod').serializeArray());
            var multAns = JSON.stringify($('#basicMultAns').serializeArray());
            var subSec = JSON.stringify($('#basicSubSec').serializeArray());
            // console.log("datas", datas);

            $.ajax({
                url: '<?= SITE_ROOT; ?>/formview/add-new-element/',
                type: 'POST',
                data: {dummy: null, values: datas, basicMethod: method, basicMultAns: multAns, basicSubSec: subSec},
                success: function (data) {
                         //console.log(data);
                    $('#myModal').modal('hide');
                    swal({
                        title: "New Element Updated!",
                        text: "Data successfully updated into database",
                        type: "success"
                    });
                }
            });
                setTimeout(
                     function () {
                         window.location.reload(true);
                     }, 1200);
    //          
        });
        //    $('.genForm').attr('disabled', false);
    });

</script>
<script>
    //add new form
    $(document).ready(function () {

        var selText;
        var array = [];

        var thisValue;
        
        //console.log(array);

        $("#list_section_desc option").each(function () {
            var $this = $(this);
            selText = $this.val();
            array.push(selText);
        });
        
        $('#element_desc').on('change', function () {
                    var str = $(this).val();
                    //console.log("string", str);
                    
                    if (str !== "") {
                    if (array.indexOf(str) > -1) {
                        $('#validateT').attr('hidden', 'hidden');
                        $('#validateF').attr('hidden', false); //record found
                        $('.update').attr('disabled', 'disabled');
                    } else {
                        $('#validateT').attr('hidden', false); //no record found
                        $('#validateF').attr('hidden', 'hidden');
                        $('.update').attr('disabled', false);
                    }
                }
                });
    });//endOfDocument
</script> 
<script>
    $(document).ready(function (){
        $("#element_desc").select2();
    });
</script>