<div class='form-group form-group-sm'>
    <label class='control-label col-sm-3'>Other Infective Screen Specify</label>
    <div class='col-sm-8'>
        <table id='oissTable' class='table table-bordered table-condensed small'>
            <thead>
            <tr>
                <th style='vertical-align: middle;'>No</th>
                <th>Name</th>
                <th>Status</th>
                <th class='text-center'><i class='addOISS glyphicon glyphicon-plus-sign'></i></th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td class='text-center'>1</td>
                    <td class='text-center'>Effective Screen 1</td>
                    <td class='text-center'>Positive</td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
    $(function(){
        $('.addOISS').click(function(){
            var rowCount = $('#oissTable tr').length;
            var $newRow = '<tr>';
            $newRow += '<td class="text-center" style="vertical-align:middle">'+rowCount+'</td>';
            $newRow += '<td><input type="text" class="form-control input-sm" /></td>';
            $newRow += '<td><select class="form-control input-sm"><option>Positive</option><option>Negative</option></select> </td>';
            $newRow += '<td class="text-center text-x2 text-danger" style="vertical-align:middle"><i class="glyphicon glyphicon-minus-sign"></i></td>';
            $newRow += '</tr>';
            $('#oissTable tbody').append($newRow);
        });
    })
    </script>