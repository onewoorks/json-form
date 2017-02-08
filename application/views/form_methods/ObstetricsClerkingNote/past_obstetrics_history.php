<div class='row'>
    <div class='col-sm-12 text-center'><div id='pohAdd' class='btn btn-primary btn-sm'><i class='glyphicon glyphicon-plus'></i> ADD</div></div>
</div>
<br>

<div class='row'>
    <div class='col-sm-12'>
        <table  id='poh' class='table table-condensed table-bordered small'>
            <thead>
                <tr>
                    <th>Pregnancy No</th>
                    <th>Year Of Delivery</th>
                    <th>Gest At Delivery</th>
                    <th>Type of Delivery</th>
                    <th>Complication</th>
                    <th>Place of Delivery</th>
                    <th>Birthweight(g)</th>
                    <th>Pregnancy Outcome</th>
                    <th>Sex of Baby</th>
                    <th>Feeding</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

<script>
    $(function(){
        $('#pohAdd').click(function(){
           var rowCount = $('#poh tr').length;
           var $addRow = "<tr>";
           $addRow += "<td>"+rowCount+"</td>";
           $addRow += "<td></td>";
           $addRow += "<td></td>";
           $addRow += "<td></td>";
           $addRow += "<td></td>";
           $addRow += "<td></td>";
           $addRow += "<td></td>";
           $addRow += "<td></td>";
           $addRow += "<td></td>";
           $addRow += "<td></td>";
           $addRow += "</tr>";
           $('#poh tbody').append($addRow);
        });
    });
    </script>