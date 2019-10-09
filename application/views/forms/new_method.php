<?php echo $header; ?>

<div id="methodGroup">

    <form id="methodBuilder" class="form-horizontal col-md-offset-16 col-md-offset-1">
        <div class='panel panel-default' style='margin:0px -20px 10px 0px'>
            <div class="panel-heading">METHOD ADDITION</div>
            <div class='panel-body'>
                <div id='methodGrouping'>   
                    <div class="methodNew1">
                        <div class='form-group form-group-sm'>
                            <label class='control-label col-sm-1'>Name&nbsp;<b style='color: red'>*</b></label>
                            <div class='col-sm-4'>
                                <input type='text' data-no = '1' name='method_desc1' id='method_desc1' class='form-control' autocomplete="off" required/>
                                <span id='validateF1' name='validateF1' style="font-size:10px;color:red;text-align:left" hidden>Record Found</span>
                                <span id='validateT1' name='validateT1' style="font-size:10px;color:green;text-align:left" hidden>No Record Found</span>
                                <select id='list_method_desc' class='form-control hidden'>
                                    <?php foreach ($list_of_method as $method): ?>
                                        <option value='<?php echo $method['doc_method_code']; ?>'><?php echo $method['doc_method_desc']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <label class='control-label col-sm-2'>Method Info&nbsp;<b style='color: red'>*</b></label>
                            <div class='col-sm-4'>
                                <input type='text' name='method_info1' data-no = '1' id='method_info1' class='form-control' autocomplete="off" required disabled/>
                                <span id='validateFF1' name='validateFF1' style="font-size:10px;color:red;text-align:left" hidden>Record Found</span>
                                <span id='validateTT1' name='validateTT1' style="font-size:10px;color:green;text-align:left" hidden>No Record Found</span>
                                <select id='list_method_info' class='form-control hidden'>
                                    <?php foreach ($list_of_method as $method): ?>
                                        <option value='<?php echo $method['doc_method_desc']; ?>'><?php echo $method['method_info']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class='col-sm-1 sectionAction' data-sectionno='1'>
                                <div class='btn btn-default btn-sm renameSection1' data-sectionno='1' style='padding:3.5px' title="Rename INFO"><i class='glyphicon glyphicon-pencil'></i></div>
                                <div class='btn btn-default btn-sm plusSection' data-sectionno='1' style='padding:3.5px'><i class='glyphicon glyphicon-plus'></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 text-right">
                    <button type="button" class="btn btn-primary btn-sm pull-right addMethod" disabled>Add Method</button>
                </div>
            </div>
        </div>
    </form>
    
    <div class='container-fluid'>
        <div class='row'>
            <div class="col-md-offset-1 col-md-offset-1">
                <div class='panel panel-primary'>
                    <div class='panel-heading'>
                        
                        Result of Existing Method</div>
                    <div class='panel-body'>
                        <table id="tableForm" class='table table-bordered table-condensed'>
                            <thead>
                                <tr>
                                    <th style=" font-size: smaller;">Method Code</th>
                                    <th style=" font-size: smaller;">Method Desc</th>
                                    <th style=" font-size: smaller;">Method Info</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!$list_of_method): ?>
                                    <tr>
                                        <td colspan="7"><i>No Record Found</i></td>
                                    </tr>
                                <?php endif; ?>
                                <?php
                                $no = 1;
                                foreach ($list_of_method as $method):
                                    ?>
                                    <tr>
                                        <td  style=" font-size: smaller; text-align: center"><?php echo $method['doc_method_code']; ?></td>
                                        <td  style=" font-size: smaller;"><?php echo $method['doc_method_desc']; ?></td>
                                        <td  style=" font-size: smaller;"><?php echo $method['method_info']; ?></td>
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
        $('.addMethod').click(function () {
            $("input[id^='method_info']").removeAttr('disabled');
            $.ajax({
                url: '<?= SITE_ROOT; ?>/formview/create-method/',
                type: 'POST',
                data: {values: JSON.stringify($('#methodBuilder').serializeArray())},
                success: function (data) {
                 console.log(data);
                    swal({                        
                        title: "Method Created!",
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

        $('#methodBuilder input').keyup(function () {

            var empty = false;
            $('#methodBuilder input').each(function () {
                if ($(this).val().length === 0) {
                    empty = true;
                }
            });

            if (empty) {
                $('.addMethod').attr('disabled', 'disabled');
            } else {
                $('.addMethod').attr('disabled', false);
            }
        });

    });

</script>

<script>
    $(document).ready(function () {
        var no = 2;
        var optionS = $("#list_method_desc").html();
        var optionI = $("#list_method_info").html();


        var selText;
        var array = [];
        var selText2;
        var array2 = [];


        $("#list_method_desc option").each(function () {
            var $this = $(this);
            selText = $this.text();
            array.push(selText);
        });

        $("#list_method_info option").each(function () {
            var $this = $(this);
            selText2 = $this.text();
            array2.push(selText2);
        });

        $('#methodGrouping').on('click', '.plusSection', function () {
            $('.addMethod').attr('disabled', 'disabled');
            var $method = '<div class="methodNew' + no + '">';
            $method += '<div class="form-group form-group-sm">';
            $method += '<label class="control-label col-sm-1">Name&nbsp;<b style="color: red">*</b></label>';
            $method += '<div class="col-sm-4">';
            $method += '<input type="text" data-no = "' + no + '" name="method_desc' + no + '" id="method_desc' + no + '" class="form-control" autocomplete="off" required/>';
            $method += '<span id="validateF' + no + '" name="validateF' + no + '" style="font-size:10px;color:red;text-align:left" hidden>Record Found</span>';
            $method += '<span id="validateT' + no + '" name="validateT' + no + '" style="font-size:10px;color:green;text-align:left" hidden>No Record Found</span>';
            $method += '<select id="list_method_desc" class="form-control hidden">' + optionS + '</select>';
            $method += '</div>';
            $method += '<label class="control-label col-sm-2">Method Info&nbsp;<b style="color: red">*</b></label>';
            $method += '<div class="col-sm-4">';
            $method += '<input type="text" data-no = "' + no + '" name="method_info' + no + '" id="method_info' + no + '" class="form-control" autocomplete="off" required disabled>';
            $method += '<span id="validateFF' + no + '" name="validateFF' + no + '" style="font-size:10px;color:red;text-align:left" hidden>Record Found</span>';
            $method += '<span id="validateTT' + no + '" name="validateTT' + no + '" style="font-size:10px;color:green;text-align:left" hidden>No Record Found</span>';
            $method += '<select id="list_method_info" class="form-control hidden">' + optionI + '</select>';
            $method += '</div>';
            $method += '<div class="col-sm-1 sectionAction" data-sectionno="' + no + '">';
            $method += '<div class="btn btn-default btn-sm renameSection' + no + '" data-sectionno="' + no + '" style="padding:3.5px" title="Rename INFO"><i class="glyphicon glyphicon-pencil"></i></div>&nbsp;';
            $method += '<div class="btn btn-default btn-sm minusSection" data-sectionno="' + no + '" style="padding:3.5px"><i class="glyphicon glyphicon-minus"></i></div>';
            $method += '</div>';
            $method += '</div>';
            $method += '</div>';
            $($method).appendTo('#methodGrouping');
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

        $("#list_method_desc option").each(function () {
            var $this = $(this);
            selText = $this.text();
            array.push(selText);
        });

        $("#list_method_list option").each(function () {
            var $this = $(this);
            selText2 = $this.text();
            array2.push(selText2);
        });

        $(document).on('focus', 'input', function () {
            thisValue = $(this).attr('data-no');

            $('#method_desc' + thisValue).keyup(function () {
                var str = $(this).val();

                if (str !== "") {
                    if (array.indexOf(str) > -1) {
                        $('#validateT' + thisValue).attr('hidden', 'hidden');
                        $('#validateF' + thisValue).attr('hidden', false);
                    } else {
                        $('#validateT' + thisValue).attr('hidden', false);
                        $('#validateF' + thisValue).attr('hidden', 'hidden');
                    }
                    $('.addMethod').attr('disabled', false);
                } else {
                    $('#validateT' + thisValue).attr('hidden', 'hidden');
                    $('#validateF' + thisValue).attr('hidden', 'hidden');
                    $('.addMethod').attr('disabled', 'disabled');
                }

                var method = $(this).val().toLowerCase().replace(/ /g, '');
                var INFO = method.replace(/[^A-Z0-9]+/ig, '');
                $('#method_info' + thisValue).val(INFO);

                //JSONSECTION
                if (INFO !== "") {
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
                $('#method_info' + renameid).removeAttr('disabled');
                $('#method_info' + renameid).keyup(function () {
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

            $('#methodGrouping').on('click', '.minusSection', function () {
                var dropid = $(this).data('sectionno');
                console.log('dropid', dropid);
                $('.methodNew' + dropid).remove();
            });

    });//endOfDocument
</script>   

<?php
echo $footer;