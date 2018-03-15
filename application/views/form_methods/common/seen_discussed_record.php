<div class='form-group form-group-sm'>
    <label class='control-label col-sm-3 upperCase'>seen date and time</label>
    <div class='col-sm-3'>
        <div class='input-group'>
            <input class='form-control datepicker' name='seen_date_and_time' />
            <span class='input-group-addon'><i class='glyphicon glyphicon-calendar'></i></span>
        </div>
    </div>
</div>

<div class='form-group form-group-sm'>
    <label class='control-label col-sm-3 upperCase'>Seen By</label>
    <div class='col-sm-3' style='padding-bottom:5px;'>
        <select name='seen_by' class='form-control'>
            <option value='' >Dr Adam Malik</option>
            <option value='' >Dr John Doe</option>
            <option value='' >Dr Lisa Ashley</option>
        </select>
    </div>
    <div class='col-sm-4' >
        <div class='btn btn-default btn-sm' style='padding:4px 6px;'><i class='glyphicon glyphicon-plus'></i></div>
    </div>
    <div class='clearfix'></div>
    <!--<br>-->
    <div class='col-sm-9 col-sm-push-3' >
        <table class='table table-bordered table-condensed table-striped small'>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Designation</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($seenByRecords as $key => $seenBy): ?>
                    <tr>
                        <td style='text-align: center;'><?php echo ($key + 1); ?></td>
                        <td style='padding-left: 10px;'><?php echo $seenBy['name']; ?></td>
                        <td style='text-align: center;'><?php echo $seenBy['designation']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class='form-group form-group-sm'>
    <label class='control-label col-sm-3 upperCase'>Discussed Date And Time</label>
    <div class='col-sm-3'>
        <div class='input-group'>
            <input name='discussed_date_and_time' class='form-control datepicker'  />
            <span class='input-group-addon'><i class='glyphicon glyphicon-calendar'></i></span>
        </div>
    </div>
</div>

<div class='form-group form-group-sm'>
    <label class='control-label col-sm-3 upperCase'>Discussed By</label>
    <div class='col-sm-3' style='padding-bottom:5px;'>
        <select name='seen_by' class='form-control'>
            <option value='' >Dr Adam Malik</option>
            <option value='' >Dr John Doe</option>
            <option value='' >Dr Lisa Ashley</option>
        </select>
    </div>
    <div class='col-sm-1'>
        <div class='btn btn-default btn-sm' style='padding:4px 6px;'><i class='glyphicon glyphicon-plus'></i></div>
    </div>
    <div class='clearfix'></div>
    <!--<br>-->
    <div class='col-sm-9 col-sm-push-3'>
        <table class='table table-bordered table-condensed table-striped small'>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Designation</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($discussedWith as $key => $discussed): ?>
                    <tr>
                        <td style='text-align: center;'><?php echo ($key + 1); ?></td>
                        <td style='padding-left: 10px;'><?php echo $discussed['name']; ?></td>
                        <td style='text-align: center;'><?php echo $discussed['designation']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>