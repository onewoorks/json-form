<?php echo $header; ?>

<div id="predefineGroup">

    <form id="predefineBuilder" class="form-horizontal col-md-offset-16 col-md-offset-1">
        <div class='panel panel-default' style='margin:0px -20px 10px 0px'>
            <div class="panel-heading">MULTIPLE ANSWER ADDITION</div>
            <div class='panel-body'>
                <div id='predefineGrouping'>   
                    <div class="predefineNew1">
                        <div class='form-group form-group-sm'>
                            <label class='control-label col-sm-1'>Name</label>
                            <div class='col-sm-3'>
                                <input type='text' data-no = '1' name='predefine_desc1' id='predefine_desc1' class='form-control text-uppercase desc' onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" required/>
                                <span id='validateF1' name='validateF1' style="font-size:10px;color:red;text-align:left" hidden>Record Found</span>
                                <span id='validateT1' name='validateT1' style="font-size:10px;color:green;text-align:left" hidden>No Record Found</span>
                                <span id='validateTF1' name='validateTF' style="font-size:10px;color:red;text-align:left" hidden>Duplicate Record Found</span>
                                <select id='list_predefine_desc' class='form-control hidden'>
                                    <?php foreach ($list_of_predefines as $predefines): ?>
                                        <option value='<?php echo $predefines['multiple_desc_code']; ?>'><?php echo $predefines['multiple_desc']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <label class="control-label col-sm-1" style="width:1%;padding-left:2px;text-align: left"><b style="color: red">*</b></label>
                            <div class='col-sm-1 predefineAction' data-predefineno='1'>
                                <div class='btn btn-default btn-sm pluspredefine' data-predefineno='1' style='padding:3.5px'><i class='glyphicon glyphicon-plus'></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 text-right">
                    <button type="button" class="btn btn-primary btn-sm pull-right addpredefine" disabled>Add Multiple Answer</button>
                </div>
            </div>
        </div>
    </form>
    <div class='container-fluid'>
        <div class='row'>
            <div class="col-md-offset-1 col-md-offset-1">
                <div class='panel panel-primary'>
                    <div class='panel-heading'>

                        Result of Existing Multiple Answer</div>
                    <div class='panel-body'>
                        <table id="tableForm" class='table table-bordered table-condensed'>
                            <thead>
                                <tr>
                                    <th style=" font-size: smaller;">Multiple Answer Code</th>
                                    <th style=" font-size: smaller;">Multiple Answer Name</th>
                                    <th style=" font-size: smaller;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!$list_of_predefines): ?>
                                    <tr>
                                        <td colspan="4"><i>No Record Found</i></td>
                                    </tr>
                                <?php endif; ?>
                                <?php
                                $no = 1;
                                foreach ($list_of_predefines as $predefines):
                                    ?>
                                    <tr>
                                        <td  style=" font-size: smaller; text-align: center"><?php echo $predefines['multiple_desc_code']; ?></td>
                                        <td class="text-uppercase" style=" font-size: smaller;"><?php echo $predefines['multiple_desc']; ?></td>
                                        <td  style=" font-size: smaller; text-align: center">
                                            <div>
                                                <a class='btn btn-default btn-sm editpredefine' id='<?php echo $predefines['multiple_desc_code']; ?>' style='padding:2px' title="Rename predefine"><i class='glyphicon glyphicon-pencil'></i></a>
                                                <a class='btn btn-default btn-sm deletepredefine' id='<?php echo $predefines['multiple_desc_code']; ?>'  style='padding:2px' title="Delete predefine"><i class='glyphicon glyphicon-trash'></i></a>
                                            </div>
                                        </td>
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

<div id="title" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!--Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Change Multiple Answer</h4>
            </div>
            <div class="modal-body"></div>
        </div>
    </div>
</div>

<div id="deleteModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!--Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Delete Multiple Answer</h4>
            </div>
            <div class="modal-body"></div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#tableForm').DataTable();
    });


    $(function () {

        //ADDpredefine
        $('.addpredefine').click(function () {
            $(this).text('Executing selected action...');
            $.ajax({
                url: '<?= SITE_ROOT; ?>/formview/create-predefine/',
                type: 'POST',
                data: {values: JSON.stringify($('#predefineBuilder').serializeArray())},
                success: function (data) {
                  //  console.log(data);
                    swal({
                        title: "Multiple Answer Created!",
                        text: "Data successfully inserted into database",
                        type: "success"
                    });
                }
            });
            setTimeout(
                    function () {
                        window.location.reload(true);
                    }, 1200);
            return false;
        });
    });
</script>


<script>
    $(document).ready(function () {

        $('#predefineBuilder input').keyup(function () {

            var empty = false;
            $('#predefineBuilder input').each(function () {
                if ($(this).val().length === 0) {
                    empty = true;
                }
            });

            if (empty) {
                $('.addpredefine').attr('disabled', 'disabled');
            } else {
                $('.addpredefine').attr('disabled', false);
            }
        });

    });

</script>

<script>
    $(document).ready(function () {
        var no = 2;
        var optionS = $("#list_predefine_desc").html();
        var optionJ = $("#list_json_desc").html();


        var selText;
        var array = [];
        var selText2;
        var array2 = [];


        $("#list_predefine_desc option").each(function () {
            var $this = $(this);
            selText = $this.text();
            array.push(selText);
        });

        $("#list_json_desc option").each(function () {
            var $this = $(this);
            selText2 = $this.text();
            array2.push(selText2);
        });

        $('#predefineGrouping').on('click', '.pluspredefine', function () {
            $('.addpredefine').attr('disabled', false);
            var $predefines = '<div class="predefineNew' + no + '">';
            $predefines += '<div class="form-group form-group-sm">';
            $predefines += '<label class="control-label col-sm-1">Name</label>';
            $predefines += '<div class="col-sm-3">';
            $predefines += '<input type="text" data-no = "' + no + '" name="predefine_desc' + no + '" id="predefine_desc' + no + '" class="form-control text-uppercase desc" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" required/>';
            $predefines += '<span id="validateF' + no + '" name="validateF' + no + '" style="font-size:10px;color:red;text-align:left" hidden>Record Found</span>';
            $predefines += '<span id="validateT' + no + '" name="validateT' + no + '" style="font-size:10px;color:green;text-align:left" hidden>No Record Found</span>';
            $predefines += '<span id="validateTF' + no + '" name="validateTF' + no + '" style="font-size:10px;color:red;text-align:left" hidden>Duplicate Record Found</span>';
            $predefines += '<select id="list_predefine_desc" class="form-control hidden">' + optionS + '</select>';
            $predefines += '</div>';
            $predefines += '<label class="control-label col-sm-1" style="width:1%;padding-left:2px;text-align: left"><b style="color: red">*</b></label>';
            $predefines += '<div class="col-sm-1 predefineAction" data-predefineno="' + no + '">';
            $predefines += '<div class="btn btn-default btn-sm minuspredefine" data-predefineno="' + no + '" style="padding:3.5px"><i class="glyphicon glyphicon-minus"></i></div>';
            $predefines += '</div>';
            $predefines += '</div>';
            $predefines += '</div>';
            $($predefines).appendTo('#predefineGrouping');
            no++;
        });

        $('#tableForm').on('click', '.editpredefine', function () {
            var documentId = $(this).attr('id');
            console.log(documentId);
            $.ajax({
                url: '<?= SITE_ROOT; ?>/formview/change-predefine/',
                data: {documentId: documentId},
                success: function (data) {
                    var obj = $.parseJSON(data);
                    $('.modal-dialog').removeClass('modal-lg');
                    $('.modal-title').text(obj.component);
                    $('.modal-body').html(obj.html);
                }
            });
            $('#title').modal('show');
            return false;
        });

        $('#tableForm').on('click', '.deletepredefine', function () {
            var documentId = $(this).attr('id');
           // console.log(documentId);
            $.ajax({
                url: '<?= SITE_ROOT; ?>/formview/delete-predefine/',
                data: {documentId: documentId},
                success: function (data) {
                    var obj = $.parseJSON(data);
                    $('.modal-dialog').removeClass('modal-sm');
                    $('.modal-title').text(obj.component);
                    $('.modal-body').html(obj.html);
                }
            });
            $('#deleteModal').modal('show');
            return false;
        });

    });
</script>


<script>
    $(document).ready(function () {

        var selText;
        var array = [];
        
        var thisValue;

        $("#list_predefine_desc option").each(function () {
            var $this = $(this);
            selText = $this.text();
            array.push(selText);
        });
        
        $(document).on('focus', 'input', function () {
            thisValue = $(this).attr('data-no');

            var arr3 = [];
            $(".desc").each(function(){
                var value = $(this).val();
//                console.log('val',value);
                    arr3.push(value);
            });
//             console.log(arr3);
             
            $('#predefine_desc' + thisValue).keyup(function () {
                var str = $(this).val();

                if (str !== "") {
                    if (array.indexOf(str) > -1) {
                        $('#validateT' + thisValue).attr('hidden', 'hidden');
                        $('#validateTF' + thisValue).attr('hidden', 'hidden');
                        $('#validateF' + thisValue).attr('hidden', false);
                        $('.addpredefine').attr('disabled', true);
                    } else if (arr3.indexOf(str) > -1) {
                       $('#validateTF' + thisValue).attr('hidden', false);
                        $('#validateT' + thisValue).attr('hidden', 'hidden');
                        $('#validateF' + thisValue).attr('hidden', 'hidden');
                        $('.addpredefine').attr('disabled', true);
                    } else  {
                        $('#validateT' + thisValue).attr('hidden', false);
                        $('#validateF' + thisValue).attr('hidden', 'hidden');
                        $('#validateTF' + thisValue).attr('hidden', 'hidden');
                        $('.addpredefine').attr('disabled', false);
                    } 

                } else {
                    $('#validateT' + thisValue).attr('hidden', 'hidden');
                    $('#validateF' + thisValue).attr('hidden', 'hidden');
                    $('#validateTF' + thisValue).attr('hidden', 'hidden');
                    $('.addpredefine').attr('disabled', 'disabled');
                }
               
            });
        });//endOfFocus

        $('#predefineGrouping').on('click', '.minuspredefine', function () {
            var dropid = $(this).data('predefineno');
            //console.log('dropid', dropid);
            $('.predefineNew' + dropid).remove();
        });

    });//endOfDocument
</script>   

<?php
echo $footer;
