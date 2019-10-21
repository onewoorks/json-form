<?php echo $header; ?>

<div id="sectionGroup">

    <form id="sectionBuilder" class="form-horizontal col-md-offset-16 col-md-offset-1">
        <div class='panel panel-default' style='margin:0px -20px 10px 0px'>
            <div class="panel-heading">SECTION ADDITION</div>
            <div class='panel-body'>
                <div id='sectionGrouping'>   
                    <div class="sectionNew1">
                        <div class='form-group form-group-sm'>
                            <label class='control-label col-sm-1'>Name&nbsp;<b style='color: red'>*</b></label>
                            <div class='col-sm-3'>
                                <input type='text' data-no = '1' name='section_desc1' id='section_desc1' class='form-control text-uppercase' autocomplete="off" required/>
                                <span id='validateF1' name='validateF1' style="font-size:10px;color:red;text-align:left" hidden>Record Found</span>
                                <span id='validateT1' name='validateT1' style="font-size:10px;color:green;text-align:left" hidden>No Record Found</span>
                                <select id='list_section_desc' class='form-control hidden'>
                                    <?php foreach ($list_of_sections as $sections): ?>
                                        <option value='<?php echo $sections['section_code']; ?>'><?php echo $sections['section_desc']; ?></option>
                                    <?php endforeach; ?>
                                </select>

                            </div>

                            <label class='control-label col-sm-1'>Json&nbsp;<b style='color: red'>*</b></label>
                            <div class='col-sm-3'>
                                <input type='text' name='json_desc1' data-no = '1' id='json_desc1' class='form-control' autocomplete="off" required disabled/>
                                <span id='validateFF1' name='validateFF1' style="font-size:10px;color:red;text-align:left" hidden>Record Found</span>
                                <span id='validateTT1' name='validateTT1' style="font-size:10px;color:green;text-align:left" hidden>No Record Found</span>
                                <select id='list_json_desc' class='form-control hidden'>
                                    <?php foreach ($list_of_sections as $sections): ?>
                                        <option value='<?php echo $sections['section_desc']; ?>'><?php echo $sections['json_section']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>


                            <label class="control-label col-sm-1 hidden">Layout&nbsp;<b style='color: red'>*</b></label>
                            <div class="col-sm-2 hidden">
                                <label class="radio-inline ">
                                    <input name="layout" id="layout" type="radio" value="1" /> 1
                                </label>
                                <label class="radio-inline">
                                    <input name="layout" id="layout" type="radio" value="2" checked/> 2
                                </label>
                            </div>
                            <div class='col-sm-1 sectionAction' data-sectionno='1'>
                                <div class='btn btn-default btn-sm renameSection1' data-sectionno='1' style='padding:3.5px' title="Rename JSON"><i class='glyphicon glyphicon-pencil'></i></div>
                                <div class='btn btn-default btn-sm plusSection' data-sectionno='1' style='padding:3.5px'><i class='glyphicon glyphicon-plus'></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 text-right">
                    <button type="button" class="btn btn-primary btn-sm pull-right addSection" disabled>Add Section</button>
                </div>
            </div>
        </div>
    </form>
    <div class='container-fluid'>
        <div class='row'>
            <div class="col-md-offset-1 col-md-offset-1">
                <div class='panel panel-primary'>
                    <div class='panel-heading'>

                        Result of Existing Section</div>
                    <div class='panel-body'>
                        <table id="tableForm" class='table table-bordered table-condensed'>
                            <thead>
                                <tr>
                                    <th style=" font-size: smaller;">Section Code</th>
                                    <th style=" font-size: smaller;">Section Desc</th>
                                    <th style=" font-size: smaller;">JSON Section</th>
                                    <th style=" font-size: smaller;">Layout</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!$list_of_sections): ?>
                                    <tr>
                                        <td colspan="4"><i>No Record Found</i></td>
                                    </tr>
                                <?php endif; ?>
                                <?php
                                $no = 1;
                                foreach ($list_of_sections as $sections):
                                    ?>
                                    <tr>
                                        <td  style=" font-size: smaller; text-align: center"><?php echo $sections['section_code']; ?></td>
                                        <td class="text-uppercase" style=" font-size: smaller;"><?php echo $sections['section_desc']; ?></td>
                                        <td  style=" font-size: smaller;"><?php echo $sections['json_section']; ?></td>
                                        <td  style=" font-size: smaller;"><?php echo $sections['layout']; ?></td>
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

        //ADDSECTION
        $('.addSection').click(function () {
            $("input[id^='json_desc']").removeAttr('disabled');
            $.ajax({
                url: '<?= SITE_ROOT; ?>/formview/create-section/',
                type: 'POST',
                data: {values: JSON.stringify($('#sectionBuilder').serializeArray())},
                success: function (data) {
                    console.log(data);
                    swal({
                        title: "Section Created!",
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

        $('#sectionBuilder input').keyup(function () {

            var empty = false;
            $('#sectionBuilder input').each(function () {
                if ($(this).val().length === 0) {
                    empty = true;
                }
            });

            if (empty) {
                $('.addSection').attr('disabled', 'disabled');
            } else {
                $('.addSection').attr('disabled', false);
            }
        });

    });

</script>

<script>
    $(document).ready(function () {
        var no = 2;
        var optionS = $("#list_section_desc").html();
        var optionJ = $("#list_json_desc").html();


        var selText;
        var array = [];
        var selText2;
        var array2 = [];


        $("#list_section_desc option").each(function () {
            var $this = $(this);
            selText = $this.text();
            array.push(selText);
        });

        $("#list_json_desc option").each(function () {
            var $this = $(this);
            selText2 = $this.text();
            array2.push(selText2);
        });

        $('#sectionGrouping').on('click', '.plusSection', function () {
            $('.addSection').attr('disabled', 'disabled');
            var $sections = '<div class="sectionNew' + no + '">';
            $sections += '<div class="form-group form-group-sm">';
            $sections += '<label class="control-label col-sm-1">Name&nbsp;<b style="color: red">*</b></label>';
            $sections += '<div class="col-sm-3">';
            $sections += '<input type="text" data-no = "' + no + '" name="section_desc' + no + '" id="section_desc' + no + '" class="form-control" autocomplete="off" required/>';
            $sections += '<span id="validateF' + no + '" name="validateF' + no + '" style="font-size:10px;color:red;text-align:left" hidden>Record Found</span>';
            $sections += '<span id="validateT' + no + '" name="validateT' + no + '" style="font-size:10px;color:green;text-align:left" hidden>No Record Found</span>';
            $sections += '<select id="list_section_desc" class="form-control hidden">' + optionS + '</select>';
            $sections += '</div>';
            $sections += '<label class="control-label col-sm-1">Json&nbsp;<b style="color: red">*</b></label>';
            $sections += '<div class="col-sm-3">';
            $sections += '<input type="text" data-no = "' + no + '" name="json_desc' + no + '" id="json_desc' + no + '" class="form-control" autocomplete="off" required disabled>';
            $sections += '<span id="validateFF' + no + '" name="validateFF' + no + '" style="font-size:10px;color:red;text-align:left" hidden>Record Found</span>';
            $sections += '<span id="validateTT' + no + '" name="validateTT' + no + '" style="font-size:10px;color:green;text-align:left" hidden>No Record Found</span>';
            $sections += '<select id="list_json_desc" class="form-control hidden">' + optionJ + '</select>';
            $sections += '</div>';
            $sections += '<label class="control-label col-sm-1">Layout&nbsp;<b style="color: red">*</b></label>';
            $sections += '<div class="col-sm-2">';
            $sections += '<label class="radio-inline">';
            $sections += '<input name="layout' + no + '" id="layout' + no + '"type="radio" value="1" > 1';
            $sections += '</label>';
            $sections += '<label class="radio-inline">';
            $sections += '<input name="layout' + no + '" id="layout' + no + '" type="radio" value="2" > 2';
            $sections += '</label>';
            $sections += '</div>';
            $sections += '<div class="col-sm-1 sectionAction" data-sectionno="' + no + '">';
            $sections += '<div class="btn btn-default btn-sm renameSection' + no + '" data-sectionno="' + no + '" style="padding:3.5px" title="Rename JSON"><i class="glyphicon glyphicon-pencil"></i></div>&nbsp;';
            $sections += '<div class="btn btn-default btn-sm minusSection" data-sectionno="' + no + '" style="padding:3.5px"><i class="glyphicon glyphicon-minus"></i></div>';
            $sections += '</div>';
            $sections += '</div>';
            $sections += '</div>';
            $($sections).appendTo('#sectionGrouping');
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

        $("#list_section_desc option").each(function () {
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

            $('#section_desc' + thisValue).keyup(function () {
                var str = $(this).val();

                if (str !== "") {
                    if (array.indexOf(str) > -1) {
                        $('#validateT' + thisValue).attr('hidden', 'hidden');
                        $('#validateF' + thisValue).attr('hidden', false);
                    } else {
                        $('#validateT' + thisValue).attr('hidden', false);
                        $('#validateF' + thisValue).attr('hidden', 'hidden');
                    }
                    $('.addSection').attr('disabled', false);
                } else {
                    $('#validateT' + thisValue).attr('hidden', 'hidden');
                    $('#validateF' + thisValue).attr('hidden', 'hidden');
                    $('.addSection').attr('disabled', 'disabled');
                }

                var sections = $(this).val().toLowerCase().replace(/ /g, '_');
                var json = sections.replace(/[^A-Z0-9]+/ig, '_');
                $('#json_desc' + thisValue).val(json);

                //JSONSECTION
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

        });//endOfFocus

        $('#sectionGrouping').on('click', '.minusSection', function () {
            var dropid = $(this).data('sectionno');
            console.log('dropid', dropid);
            $('.sectionNew' + dropid).remove();
        });

    });//endOfDocument
</script>   

<?php
echo $footer;
