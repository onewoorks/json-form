<?php echo $header; ?>
<div class='panel panel-default'>
    <div class='panel-heading'>Testing page</div>
    <div class='panel-body'>
        <form id='sqltest' class='form'>
Add text data to test table :<br><br>
<input type="text" name="name" id="name" placeholder="insert text" required="required"/><br><br>
Insert value (text):<br><br>
<input type="text" name="value" id="value" placeholder="value" required="required" /><br><br>
            
                <div class='col-sm-12'>
                    <button type='submit' class='btn btn-primary'>Insert test data</button>
                </div>
            
        </form>
    </div>
</div>

    <div class='panel panel-primary'>
        <div class='panel-heading'>
            <div class="btn-group pull-right">
            </div>
            List of Testing Data</div>
        <div class='panel-body'>

            <table class='table table-bordered table-condensed'>
                <thead>
                    <tr>
                        <th>Data ID</th>
                        <th>Data Name</th>
                        <th>Data Value</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!$testing_data):?>
                    <tr>
                        <td colspan="4"><i>No Record Found</i></td>
                    </tr>
                    <?php endif;?>
                    <?php foreach ($testing_data as $dat): ?>
                        <tr>
                            <td><?php echo $dat['id']; ?></td>
                            <td><?php echo $dat['name']; ?></td>
                            <td><?php echo $dat['value']; ?></td>
                            <td class='text-center'>
                                <div class='btn-group btn-group-xs'>
                                    <div class='btn btn-default editData' data-dataid='<?php echo $dat['id']; ?>'>UPDATE</div>
                                    <div class='btn btn-default deleteData' data-dataid='<?php echo $dat['id']; ?>'>DELETE</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

   <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Update Testing Data</h4>
            </div>
            <div class="modal-body">
                
              <?php //  foreach ($update_data as $ud): $uname = $ud['name']; $uval['value'];endforeach;   ?>  
        <form id='updateData' class='form'>
Name :<br><br>
<input type="text" name="name" id="name" value='<?= $values->name;?>' required="required"/><br><br>
Value:<br><br>
<input type="text" name="value" id="value" value='<?= $values->value;?>' required="required" /><br><br>

                    <button type='submit' class='btn btn-primary'>Update Data</button>                         
        </form>
                
    </div>
            </div>
        </div>

    </div>
    

<script>
        $(function(){
        $('#sqltest').submit(function(e){
            e.preventDefault();
            var name = $('#name').val();
            var value = $('#value').val();
            $.ajax({
                url : '<?= SITE_ROOT;?>/formview/insert-testing-data/',
                data : { name: name, value:value },
                success: function () {
                    alert('success !!');
                    location.reload();
                }
            });
        });
    });
    
      
        $('.deleteData').click(function () {
            var key = $(this).data('dataid');
            $.ajax({
                url: '<?= SITE_ROOT; ?>/formview/delete-testing/',
                data: {key: key },
                success: function () {
                    alert('deleted !!');
                    location.reload();
                }
            });
        });
    
            $('.editData').click(function () {
            var key = $(this).data('dataid');
            $.ajax({
                url: '<?= SITE_ROOT; ?>/formview/get-selected-data/',
                data: {key: key },
                success: function (data) {
                    var obj = $.parseJSON(data);
                    $('.modal-dialog').addClass('modal-lg');
                    $('.modal-title').text(obj.component);
                    $('.modal-body').html(obj.html);
                }
            });
            $('#myModal').modal('show');
            return false;
        });
        
</script>
<?php echo $footer; ?>