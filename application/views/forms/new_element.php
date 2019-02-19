<?php echo $header; ?>

<div id='elementGroup'>

    <form id='elementBuilder' class='form-horizontal col-md-offset-1 col-md-offset-1'>
        <div class='panel panel-default' style='margin:0px -20px 10px 0px'>
            <div class="panel-heading">ELEMENT ADDITION</div>
            <div class='panel-body'>
                <div id='elementGrouping'>   
                    <div class="elementNew1">
                        <div class='form-group form-group-sm'>
                            <label class='control-label col-sm-1'>Name&nbsp;<b style='color: red'>*</b></label>
                            <div class='col-sm-4'>
                                <input type='text' data-no = '1' name='element_desc1' id='element_desc1' class='form-control' autocomplete="off" required/>
                                <span id='validateF1' name='validateF1' style="font-size:10px;color:red;text-align:left" hidden>Record Found</span>
                                <span id='validateT1' name='validateT1' style="font-size:10px;color:green;text-align:left" hidden>No Record Found</span>
                                <select id='list_element_desc' class='form-control hidden'>
                                    <?php foreach ($list_of_elements as $elements): ?>
                                        <option value='<?php echo $elements['element_code']; ?>'><?php echo $elements['element_desc']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <label class='control-label col-sm-1'>Json&nbsp;<b style='color: red'>*</b></label>
                            <div class='col-sm-4'>
                                <input type='text' name='json_desc1' data-no = '1' id='json_desc1' class='form-control' autocomplete="off" required disabled/>
                                <span id='validateFF1' name='validateFF1' style="font-size:10px;color:red;text-align:left" hidden>Record Found</span>
                                <span id='validateTT1' name='validateTT1' style="font-size:10px;color:green;text-align:left" hidden>No Record Found</span>
                                <select id='list_json_desc' class='form-control hidden'>
                                    <?php foreach ($list_of_elements as $elements): ?>
                                        <option value='<?php echo $elements['element_desc']; ?>'><?php echo $elements['json_element']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class='col-sm-2 sectionAction' data-sectionno='1'>
                                <div class='btn btn-default btn-sm renameSection1' data-sectionno='1' style='padding:3.5px' title="Rename JSON"><i class='glyphicon glyphicon-pencil'></i></div>
                                <div class='btn btn-default btn-sm plusSection' data-sectionno='1' style='padding:3.5px'><i class='glyphicon glyphicon-plus'></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 text-right">
                    <button type="button" class="btn btn-primary btn-sm addElement" disabled>Add Element</button>
                </div>
            </div>
        </div>
    </form> 

    <div class='container-fluid'>
        <div class='row'>
            <div class="col-md-offset-1 col-md-offset-1">
                <div class='panel panel-primary'>
                    <div class='panel-heading'>
                        Result of Existing Element</div>
                    <div class='panel-body'>
                        <table id="tableForm" class='table table-bordered table-condensed'>
                            <thead>
                                <tr>
                                    <th style=" font-size: smaller; text-align: center">Element Code</th>
                                    <th style=" font-size: smaller; text-align: center">Element Description</th>
                                    <th style=" font-size: smaller; text-align: center">JSON Element</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!$list_of_elements): ?>
                                    <tr>
                                        <td colspan="3"><i>No Record Found</i></td>
                                    </tr>
                                <?php endif; ?>
                                <?php
                                $no = 1;
                                foreach ($list_of_elements as $elements):
                                    ?>
                                    <tr>
                                        <td  style=" font-size: smaller; text-align: center"><?php echo $elements['element_code']; ?></td>
                                        <td  style=" font-size: smaller;"><?php echo $elements['element_desc']; ?></td>
                                        <td  style=" font-size: smaller;"><?php echo $elements['json_element']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    $(document).ready(function () {
        $('#tableForm').DataTable();
    });

    $(function () {

        //ADDELEMENT
        $('.addElement').click(function () {
            $("input[id^='json_desc']").removeAttr('disabled');
            $.ajax({
                url: '<?= SITE_ROOT; ?>/formview/create-element/',
                type: 'POST',
//                data: {values: values, elemDesc: elemDesc},
                data: {values: JSON.stringify($('#elementBuilder').serializeArray())},
                success: function (data) {
                    console.log(data);
                    swal({
                        title: "Element Created!",
                        text: "Data successfully inserted into database",
                        type: "success"
                    });
                }
            });
            setTimeout(
                    function () {
                        window.location.reload(true);
                    }, 1200);
        });
    });
</script>

<script>
    $(document).ready(function () {

        $('#elementBuilder input').keyup(function () {

            var empty = false;
            $('#elementBuilder input').each(function () {
                if ($(this).val().length === 0) {
                    empty = true;
                }
            });

            if (empty) {
                $('.addElement').attr('disabled', 'disabled');
            } else {
                $('.addElement').attr('disabled', false);
            }
        });

    });

</script>

<script>
    $(document).ready(function () {
        var no = 2;
        var optionE = $("#list_element_desc").html();
        var optionJ = $("#list_json_desc").html();

        var selText;
        var array = [];
        var selText2;
        var array2 = [];

        $("#list_element_desc option").each(function () {
            var $this = $(this);
            selText = $this.text();
            array.push(selText);
        });

        $("#list_json_desc option").each(function () {
            var $this = $(this);
            selText2 = $this.text();
            array2.push(selText2);
        });

        $('#elementGrouping').on('click', '.plusSection', function () {
            $('.addElement').attr('disabled', 'disabled');
            var $element = '<div class="elementNew' + no + '">';
            $element += '<div class="form-group form-group-sm">';
            $element += '<label class="control-label col-sm-1">Name&nbsp;<b style="color: red">*</b></label>';
            $element += '<div class="col-sm-4">';
            $element += '<input type="text" data-no = "' + no + '" name="element_desc' + no + '" id="element_desc' + no + '" class="form-control" autocomplete="off" required/>';
            $element += '<span id="validateF' + no + '" name="validateF' + no + '" style="font-size:10px;color:red;text-align:left" hidden>Record Found</span>';
            $element += '<span id="validateT' + no + '" name="validateT' + no + '" style="font-size:10px;color:green;text-align:left" hidden>No Record Found</span>';
            $element += '<select id="list_element_desc" class="form-control hidden">' + optionE + '</select>';
            $element += '</div>';
            $element += '<label class="control-label col-sm-1">Json&nbsp;<b style="color: red">*</b></label>';
            $element += '<div class="col-sm-4">';
            $element += '<input type="text" data-no = "' + no + '" name="json_desc' + no + '" id="json_desc' + no + '" class="form-control" autocomplete="off" required disabled>';
            $element += '<span id="validateFF' + no + '" name="validateFF' + no + '" style="font-size:10px;color:red;text-align:left" hidden>Record Found</span>';
            $element += '<span id="validateTT' + no + '" name="validateTT' + no + '" style="font-size:10px;color:green;text-align:left" hidden>No Record Found</span>';
            $element += '<select id="list_json_desc" class="form-control hidden">' + optionJ + '</select>';
            $element += '</div>';
            $element += '<div class="col-sm-2 sectionAction" data-sectionno="' + no + '">';
            $element += '<div class="btn btn-default btn-sm renameSection' + no + '" data-sectionno="' + no + '" style="padding:3.5px" title="Rename JSON"><i class="glyphicon glyphicon-pencil"></i></div>&nbsp;';
            $element += '<div class="btn btn-default btn-sm minusSection' + no + '" data-sectionno="' + no + '" style="padding:3.5px"><i class="glyphicon glyphicon-minus"></i></div>';
            $element += '</div>';
            $element += '</div>';
            $element += '</div>';
            $($element).appendTo('#elementGrouping');
            no++;
        });

    });
</script>

<script>
    $(document).ready(function () {

        var selText;
        var array = [];
        var selText2;
        var array2 = [];

        var thisValue;

        $("#list_element_desc option").each(function () {
            var $this = $(this);
            selText = $this.text();
            array.push(selText);
        });

        $("#list_json_desc option").each(function () {
            var $this = $(this);
            selText2 = $this.text();
            array2.push(selText2);
        });

        $(document).on('focus', 'input', function () {
            thisValue = $(this).attr('data-no');

            $('#element_desc' + thisValue).keyup(function () {
                var str = $(this).val();

                if (str !== "") {
                    if (array.indexOf(str) > -1) {
                        $('#validateT' + thisValue).attr('hidden', 'hidden');
                        $('#validateF' + thisValue).attr('hidden', false);
                    } else {
                        $('#validateT' + thisValue).attr('hidden', false);
                        $('#validateF' + thisValue).attr('hidden', 'hidden');
                    }
                    $('.addElement').attr('disabled', false);
                } else {
                    $('#validateT' + thisValue).attr('hidden', 'hidden');
                    $('#validateF' + thisValue).attr('hidden', 'hidden');
                    $('.addElement').attr('disabled', 'disabled');
                }

                var element = $(this).val().toLowerCase().replace(/ /g, '_');
                var json = element.replace(/[^A-Z0-9]+/ig, '_');
                $('#json_desc' + thisValue).val(json);

                //JSONELEMENT
                if (json !== "") {
                    if (array.indexOf(str) > -1) {
                        $('#validateTT' + thisValue).attr('hidden', 'hidden');
                        $('#validateFF' + thisValue).attr('hidden', false);
                    } else {
                        $('#validateTT' + thisValue).attr('hidden', false);
                        $('#validateFF' + thisValue).attr('hidden', 'hidden');
                    }
                } else {
                    $('#validateTT' + thisValue).attr('hidden', 'hidden');
                    $('#validateFF' + thisValue).attr('hidden', 'hidden');
                }
            });

            $(".renameSection" + thisValue).click(function () {
                var renameid = $(this).data('sectionno');
                console.log('renameid', renameid);
                $('#json_desc' + renameid).removeAttr('disabled');
                $('#json_desc' + renameid).keyup(function () {
                    var str = $(this).val();

                    if (str !== "") {
                        if (array2.indexOf(str) > -1) {
                            $('#validateTT' + renameid).attr('hidden', 'hidden');
                            $('#validateFF' + renameid).attr('hidden', false);
                        } else {
                            $('#validateTT' + renameid).attr('hidden', false);
                            $('#validateFF' + renameid).attr('hidden', 'hidden');
                        }
                    } else {
                        $('#validateTT' + renameid).attr('hidden', 'hidden');
                        $('#validateFF' + renameid).attr('hidden', 'hidden');
                    }

                });
            });

            $('#elementGrouping').on('click', '.minusSection' + thisValue, function () {
                var dropid = $(this).data('sectionno');
                console.log('dropid', dropid);
                $('.elementNew' + dropid).remove();
            });

        });//endOfFocus

    });//endOfDocument
</script>

<?php
echo $footer;
