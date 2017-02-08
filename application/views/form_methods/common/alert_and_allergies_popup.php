
<form id='formAlertAndAllergies' class="form">
    <div class="row">
        <div class="col-sm-12">
            <h5>Allergies</h5>
        </div> 
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group form-group-sm">
                <div class="radio-inline">
                    <input type="radio"  name="allergy_option" value="not_recorded" checked /> Not Recorded
                </div>
                <div class="radio-inline">
                    <input type="radio"  name="allergy_option" value="no_allergy" /> No Allergy
                </div>
                <div class="radio-inline">
                    <input type="radio"  name="allergy_option" value="allergy"/> Allergies
                </div>
            </div>
            <div class="form-group form-group-sm">
                <table id='allergyTable' class="table table-condensed table-bordered small">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Substance</th>
                            <th>Subcategory</th>
                            <th>Reaction</th>
                            <th>Severity</th>
                            <th>Source Of Information</th>
                            <th>Estimated Onset</th>
                            <th class='text-center'><i class='addAlergyRow glyphicon glyphicon-plus-sign'></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <select class="form-control input-sm" name="aa_category">
                                    <option value="">Option 1</option>
                                </select>
                            </td>
                            <td>
                                <input type="text" class="form-control input-sm" name="aa_substance" />
                            </td>
                            <td>
                                <select class="form-control input-sm" name="aa_subcategory">
                                    <option value="">Option 1</option>
                                </select>
                            </td>
                            <td>
                                <input type="text" class="form-control input-sm" name="aa_reaction" />
                            </td>
                            <td>
                                <select class="form-control input-sm" name="aa_reaction_status">
                                    <option value="">option 1</option>
                                </select>
                            </td>
                            <td>
                                <input type="text" class="form-control input-sm" name="aa_source_information" />
                            </td>
                            <td>
                                <input type="text" class="form-control input-sm" name="aa_estimated_onset" />
                            </td>
                            <td class='text-center' style='vertical-align: middle;'><div class='removeAlergyRow text-danger text-x2'><i class='glyphicon glyphicon-minus-sign'></i></div></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class='form-group form-group-sm'>
                <label class='checkbox-inline'>
                    <input type='checkbox' name='report_madrac'/> Report for MADRAC
                </label>
                <label class='checkbox-inline'>
                    <input type='checkbox' name='alergy_card'/> Alergy Card
                </label>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-7">
            <h5>Medical Alert</h5>
            <table id='medicalAlertTable' class='table table-condensed table-bordered small'>
                <thead>
                    <tr>
                        <th>Medical Alert</th>
                        <th>Status</th>
                        <th>Action</th>
                        <th class='text-center'><i class='addMaRow glyphicon glyphicon-plus-sign'></i></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <select class='form-control input-sm' name='md_medical_alert' >
                                <option value=''>Option 1</option>
                            </select>
                        </td>
                        <td>
                            <select class='form-control input-sm' name='md_status'>
                                <option value='active'>Active</option>
                                <option value='non-active'>Not Active</option>
                            </select>
                        </td>
                        <td class='text-center' style='vertical-align: middle;'>
                            <div class='removeMaRow text-danger text-x2'><i class='glyphicon glyphicon-minus-sign'></i></div>
                        </td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class='row'>
        <div class='col-sm-7'>
            <h5>Isolation Precautions</h5>
            <table id='isolationTable' class='table table-bordered table-condensed small'>
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Subcategory</th>
                        <th>Status</th>
                        <th class='text-center'><i class='ipAddRow glyphicon glyphicon-plus-sign'></i></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <select name='ip_category' class='form-control input-sm'>
                                <option value='1'>Category 1</option>
                                <option value='2'>Category 2</option>
                            </select>
                        </td>
                        <td>
                            <input type='text' name='ip_subcategory' class='form-control input-sm' />
                        </td>
                        <td>
                            <select name='ip_status' class='form-control input-sm'>
                                <option value='active'>Active</option>
                                <option value='non_active'>Non Active</option>
                            </select>
                        </td>
                        <td class='text-center' style='vertical-align: middle;'>
                            <div class='ipRemoveRow text-danger text-x2'><i class='glyphicon glyphicon-minus-sign'></i></div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class='row'>
        <div class='col-sm-12 text-right'>
            <button type='submit' class='btn btn-primary btn-sm'><i class='glyphicon glyphicon-plus'></i> Add To Note</button>
        </div>
    </div>
</form>

<script>
    $(function () {
        $('.addAlergyRow').click(function () {
            var $row = '<tr>';
            $row += "<td>";
            $row += '<select class="form-control input-sm" name="aa_category">';
            $row += '<option value="">Option 1</option>';
            $row += '</select>';
            $row += '</td>';
            $row += '<td>';
            $row += '<input type="text" class="form-control input-sm" name="aa_substance" />';
            $row += '</td>';
            $row += '<td>';
            $row += '<select class="form-control input-sm" name="aa_subcategory">';
            $row += '<option value="">Option 1</option>';
            $row += '</select>';
            $row += '</td>';
            $row += '<td>';
            $row += '<input type="text" class="form-control input-sm" name="aa_reaction" />';
            $row += '</td>';
            $row += '<td>';
            $row += '<select class="form-control input-sm" name="aa_reaction_status">';
            $row += '<option value="">option 1</option>';
            $row += '</select>';
            $row += '</td>';
            $row += '<td>';
            $row += '<input type="text" class="form-control input-sm" name="aa_source_information" />';
            $row += '</td>';
            $row += '<td>';
            $row += '<input type="text" class="form-control input-sm" name="aa_estimated_onset" />';
            $row += '</td>';
            $row += "<td class='text-center' style='vertical-align: middle;'>";
            $row += "<div class='removeAlergyRow text-danger text-x2'><i class='glyphicon glyphicon-minus-sign'></i></div>";
            $row += '</td>';
            $row += '</tr>';
            
            $('#allergyTable tbody').append($row);
        });
        $('#allergyTable tbody').on('click','.removeAlergyRow',function(){
            $(this).closest('tr').remove();
        });
        

        $('.addMaRow').click(function () {
            var $row = '<tr>';
            $row += '<td>';
            $row += "<select class='form-control input-sm' name='md_medical_alert' >";
            $row += "<option value=''>Option 1</option>";
            $row += "</select>";
            $row += '</td>';
            $row += "<td>";
            $row += "<select class='form-control input-sm' name='md_status'>";
            $row += "<option value='active'>Active</option>";
            $row += "<option value='non-active'>Not Active</option>";
            $row += "</select>";
            $row += "</td>";
            $row += '<td class="text-center" style="vertical-align : middle;">';
            $row += "<div class='removeMaRow text-danger text-x2'><i class='glyphicon glyphicon-minus-sign'></i></div>";
            $row += '</td>';
            $row += '<td></td>';
            $row += '</tr>';
            $('#medicalAlertTable tbody').append($row);
        });

        $('#medicalAlertTable tbody').on('click', '.removeMaRow', function () {
            $(this).closest('tr').remove();
        });

        $('.ipAddRow').click(function () {
            var $row = '<tr>';
            $row += '<td>';
            $row += "<select class='form-control input-sm' name='md_medical_alert' >";
            $row += "<option value=''>Category</option>";
            $row += "</select>";
            $row += '</td>';
            $row += '<td>';
            $row += '<input type="text" class="form-control input-sm" />'
            $row += '</td>';
            $row += "<td>";
            $row += "<select class='form-control input-sm' name='md_status'>";
            $row += "<option value='active'>Active</option>";
            $row += "<option value='non-active'>Not Active</option>";
            $row += "</select>";
            $row += "</td>";
            $row += '<td class="text-center" style="vertical-align : middle;">';
            $row += "<div class='removeMaRow text-danger text-x2'><i class='glyphicon glyphicon-minus-sign'></i></div>";
            $row += '</td>';
            $row += '</tr>';
            $('#isolationTable tbody').append($row);
        });

        $('#isolationTable tbody').on('click', '.ipRemoveRow', function () {
            $(this).closest('tr').remove();
        });
        
        $('#formAlertAndAllergies').submit(function(e){
            e.preventDefault();
            $('#myModal').modal('hide');
        })
    });
</script>