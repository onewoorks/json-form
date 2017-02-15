<form id='updateData' class='form-horizontal'>
<div class='form-group form-group-sm'>
    <label class='control-label col-sm-3'>Name</label>
    <div class='col-sm-8'>
        <input type="hidden" name="id" value='<?= $values->id;?>' />
        <input type='text' name='name' value='<?= $values->name;?>' class='form-control' autocomplete="off"/>
    </div>
    <label class='control-label col-sm-3'>Value</label><br><br>
    <div class='col-sm-8'>       
        <input type='text' name='value' value='<?= $values->value;?>'  class='form-control' autocomplete="off" />
    </div>
</div>
<div class='form-group form-group-sm'>
    <label class='control-label col-sm-3'></label>
    <div class='col-sm-8 text-right'>
        <button type='submit' class='btn btn-sm btn-primary'>Update</button>
    </div>
</div>    
</form>

<script>
    $(function(){
        $('#updateData').submit(function(e){
            e.preventDefault();
            $.ajax({
                url : '<?= SITE_ROOT;?>/formview/update-testing-data/',
                data : { values: $(this).serializeArray()},
                success : function(){
                    $('#myModal').modal('hide');
                    location.reload();
                }
            });
        });
        
    });
    </script>


<!--            <div class="modal-body">
                
              <?php //  foreach ($update_data as $ud): $uname = $ud['name']; $uval['value'];endforeach;   ?>  
        <form id='updateData' class='form'>
Name :<br><br>
<input type="text" name="name" id="name" value='<?= $values->name;?>' required="required"/><br><br>
Value:<br><br>
<input type="text" name="value" id="value" value='<?= $values->value;?>' required="required" /><br><br>

                    <button type='submit' class='btn btn-primary'>Update Data</button>                         
        </form>
                
    </div>-->
          