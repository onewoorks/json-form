<div class='row'>
    <div class='col-sm-12'>
        <div class='btn btn-default btn-sm'>LABORATORY</div>
        <div class='btn btn-default btn-sm'>RADIOLOGY</div>
        <div class='btn btn-default btn-sm'>MEDICATION</div>
        <div class='btn btn-default btn-sm'>TREATMENT / PROCEDURE</div>
        <div class='btn btn-default btn-sm'>GENERAL ORDER</div>
        <div class='btn btn-default btn-sm'>DIET</div>
        <div class='btn btn-default btn-sm'>ORDER SET</div>
        <div class='btn btn-default btn-sm'>NEXT OF KIN ORDER</div>
    </div>
</div>
<h5>Order Information</h5>
<table class='table table-condensed table-bordered small'>
    <thead>
        <tr>
            <th>Order No</th>
            <th>Order Date & Time</th>
            <th>Order Description</th>
            <th>Order Category</th>
            <th>Relationship</th>
            <th>Order By</th>
            <th>Order Location</th>
            <th>Priority</th>
            <th>Status</th>
            <th>Option</th>
        </tr>
    </thead>
    <tbody>
        <?php for ($i = 0; $i < 10; $i++): ?>
            <tr>
                <td>Order No</td>
                <td>Order Date & Time</td>
                <td>Order Description</td>
                <td>Order Category</td>
                <td>Relationship</td>
                <td>Order By</td>
                <td>Order Location</td>
                <td>Priority</td>
                <td>Status</td>
                <td>Option</td>
            </tr>
        <?php endfor; ?>
    </tbody>
</table>