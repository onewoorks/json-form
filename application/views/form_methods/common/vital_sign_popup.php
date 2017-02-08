<form >
    <div class='form-group form-group-sm'>
        <table id='vitalSignTable' class='table table-bordered table-condensed small'>
            <thead>
                <tr>
                    <th>Date & Time</th>
                    <th>BP (mmg) Systolic</th>
                    <th>BP (mmg) Diastolic</th>
                    <th>Heart Rate</th>
                    <th>RR (permin)</th>
                    <th>Temp (c)</th>
                    <th>Pain Score</th>
                    <th class='text-center'><i class='addVitalSignRow glyphicon glyphicon-plus-sign'></i></th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</form>

<script>
    $(function(){
        $('.addVitalSignRow').click(function(){
            var $row = '<tr>';
            $row += '<td></td>';
            $row += '<td><input type="text" name="" class="form-control input-sm" /></td>';
            $row += '<td><input type="text" name="" class="form-control input-sm" /></td>';
            $row += '<td><input type="text" name="" class="form-control input-sm" /></td>';
            $row += '<td><input type="text" name="" class="form-control input-sm" /></td>';
            $row += '<td><input type="text" name="" class="form-control input-sm" /></td>';
            $row += '<td><input type="text" name="" class="form-control input-sm" /></td>';
            $row += '<td class="text-center text-danger text-x2" style="vertical-align:middle"><i class="glyphicon glyphicon-minus-sign"></i></td>'
            $row += '</tr>';
            
            $('#vitalSignTable tbody').append($row);
        });
    });
    </script>