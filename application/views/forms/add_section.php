<form id='addNewSection' class='form-horizontal'>

    <div class="form-group form-group-sm">
        <label class="control-label col-sm-3">Section Name</label>
        <div class='col-sm-6'>               
            <input type='text' name='section_descs' onchange="getComboA(this)"  id="section_descs" class='form-control text-uppercaseupper secList' onkeyup="this.value = this.value.toUpperCase();" list="secList" autocomplete="off"/>
            <datalist id="secList" >
                <?php foreach ($sections as $section): ?>
                    <option value="<?php echo $section['section_desc']; ?>" data-code="<?php echo $section['section_code']; ?>" data-id="<?php echo $section['json_section']; ?>"><?php echo $section['section_desc']; ?></option>
                <?php endforeach; ?>
            </datalist>
        </div>
        &nbsp;<span style='color: red'>*</span>
    </div>
    <input type='hidden' name="doc_id" value="<?= $doc_id; ?>" />

    <div class='form-group form-group-sm'>
        <label class='control-label col-sm-3'></label>
        <div class='col-sm-8 text-right'>
           <div class='btn btn-sm btn-primary updateDoc'>Update</div>
        </div>
    </div>  
</form>

<script>
    function getComboA(datalistObject) {
        var vals = datalistObject.value;
        console.log(vals);
       
        $('.updateDoc').click(function () {
            
            var doc_Id = '<?= $doc_id; ?>';
            var section_desc = vals;
            
            console.log(section_desc);
            
             $.ajax({
                url: '<?= SITE_ROOT; ?>/formview/update-new-section/',
               type: 'POST',
               data: {documentId: doc_Id, secDetail: section_desc },
               success: function (data) {
                   console.log(data);
                   $('#myModal').modal('hide');
                   swal({                       title: "Section Inserted !",
                       text: "Data successfully inserted into database",
                       type: "success"
                   });                }
           });
             setTimeout(
                    function () {
                        window.location.reload(true);
                    }, 1200);
            return false;
        });
   }    
    
</script>
