<?php echo $header; ?>

<div id='elementGroup'>

    <form id='elementBuilder' class='form-horizontal col-md-offset-1 col-md-offset-1'>
        <div class='panel panel-default' style='margin:0px -20px 10px 0px'>
            <div class="panel-heading">ELEMENT ADDITION</div>
            <div class='panel-body'>
                <div id='elementGrouping'>   
                    <div class="elementNew1">
                        <div class='form-group form-group-sm'>
                            <label class='control-label col-sm-1'>Name</label>
                            <div class='col-sm-4'>
                                <input type='text' data-no = '1' name='element_desc1' id='element_desc1' class='form-control elem' autocomplete="off" required/>
                                <span id='validateF1' name='validateF1' style="font-size:10px;color:red;text-align:left" hidden>Record Found</span>
                                <span id='validateT1' name='validateT1' style="font-size:10px;color:green;text-align:left" hidden>No Record Found</span>
                                <span id='validateTF1' name='validateTF' style="font-size:10px;color:red;text-align:left" hidden>Duplicate Record Found</span>
                                <select id='list_element_desc' class='form-control hidden'>
                                    <?php foreach ($list_of_elements as $elements): ?>
                                        <option value='<?php echo $elements['element_code']; ?>'><?php echo $elements['element_desc']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                              <label class="control-label col-sm-1" style="width:1%;padding-left:2px;text-align: left"><b style="color: red">*</b></label>
                            <div class='col-sm-4 hidden'>
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
                    <div class='panel-heading'>Result of Existing Element</div>
                    <div class='panel-body'>
                        <table id="tableForm" class='table table-bordered table-condensed'>
                            <thead>
                                <tr>
                                    <th style=" font-size: smaller; text-align: center">Element Code</th>
                                    <th style=" font-size: smaller; text-align: center">Element Name</th>
                                    <th style=" font-size: smaller; text-align: center">Action</th>
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
                                        <td  style=" font-size: smaller; text-align: center">
                                        <div>
                                            <a class='btn btn-default btn-sm editElement' id='<?php  echo $elements['element_code'];  ?>' style='padding:2px' title="Rename Element"><i class='glyphicon glyphicon-pencil'></i></a>
                                            <a class='btn btn-default btn-sm deleteElement' id='<?php echo $elements['element_code'];  ?>'  style='padding:2px' title="Delete Element"><i class='glyphicon glyphicon-trash'></i></a>
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
                    <h4 class="modal-title">Change Element</h4>
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
                    <h4 class="modal-title">Delete Element</h4>
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

        //ADDELEMENT
        $('.addElement').click(function () {
            $("input[id^='json_desc']").removeAttr('disabled');
            $.ajax({
                url: '<?= SITE_ROOT; ?>/formview/create-element/',
                type: 'POST',
                data: {values: JSON.stringify($('#elementBuilder').serializeArray())},
                success: function (data) {
                    //console.log(data);
                    swal({
                        title: "Element Created!",
                        text: "Data successfully inserted into database",
                        type: "success"
                    });
                }
            });
//            setTimeout(
//                    function () {
//                        window.location.reload(true);
//                    }, 1200);
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
            $('.addElement').attr('disabled', false);
            var $element = '<div class="elementNew' + no + '">';
            $element += '<div class="form-group form-group-sm">';
            $element += '<label class="control-label col-sm-1">Name</label>';
            $element += '<div class="col-sm-4">';
            $element += '<input type="text" data-no = "' + no + '" name="element_desc' + no + '" id="element_desc' + no + '" class="form-control elem" autocomplete="off" required/>';
            $element += '<span id="validateF' + no + '" name="validateF' + no + '" style="font-size:10px;color:red;text-align:left" hidden></span>';
            $element += '<span id="validateT' + no + '" name="validateT' + no + '" style="font-size:10px;color:green;text-align:left" hidden></span>';
            $element += '<span id="validateTF' + no + '" name="validateTF' + no + '" style="font-size:10px;color:red;text-align:left" hidden>Duplicate Record Found</span>';
            $element += '<select id="list_element_desc" class="form-control hidden">' + optionE + '</select>';
            $element += '</div>';
            $element += '  <label class="control-label col-sm-1" style="width:1%;padding-left:2px;text-align: left"><b style="color: red">*</b></label>';
            $element += '<div class="col-sm-4 hidden">';
            $element += '<input type="text" data-no = "' + no + '" name="json_desc' + no + '" id="json_desc' + no + '" class="form-control" autocomplete="off" required disabled>';
            $element += '<span id="validateFF' + no + '" name="validateFF' + no + '" style="font-size:10px;color:red;text-align:left" hidden></span>';
            $element += '<span id="validateTT' + no + '" name="validateTT' + no + '" style="font-size:10px;color:green;text-align:left" hidden></span>';
            $element += '<select id="list_json_desc" class="form-control hidden">' + optionJ + '</select>';
            $element += '</div>';
            $element += '<div class="col-sm-2 sectionAction" data-sectionno="' + no + '">';
            $element += '<div class="btn btn-default btn-sm minusSection" data-sectionno="' + no + '" style="padding:3.5px"><i class="glyphicon glyphicon-minus"></i></div>';
            $element += '</div>';
            $element += '</div>';
            $element += '</div>';
            $($element).appendTo('#elementGrouping');
            no++;
        });
        
        $('#tableForm').on('click', '.editElement', function(){
                var documentId = $(this).attr('id');
                //console.log(documentId);
                $.ajax({
                    url: '<?= SITE_ROOT; ?>/formview/change-element/',
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
            
        $('#tableForm').on('click', '.deleteElement', function(){
              var documentId = $(this).attr('id');
              //console.log(documentId);
              $.ajax({
                  url: '<?= SITE_ROOT; ?>/formview/delete-elements/',
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
            
            var arr3 = [];
            $(".elem").each(function(){
                var value = $(this).val();
//                console.log('val',value);
                    arr3.push(value);
            });
//             console.log(arr3);

            $('#element_desc' + thisValue).keyup(function () {
                var str = $(this).val();

                    if (str !== "") {
                    if (array.indexOf(str) > -1) {
                        $('#validateT' + thisValue).attr('hidden', 'hidden');
                        $('#validateTF' + thisValue).attr('hidden', 'hidden');
                        $('#validateF' + thisValue).attr('hidden', false);
                        $('.addElement').attr('disabled', true);
                    } else if (arr3.indexOf(str) > -1) {
                       $('#validateTF' + thisValue).attr('hidden', false);
                        $('#validateT' + thisValue).attr('hidden', 'hidden');
                        $('#validateF' + thisValue).attr('hidden', 'hidden');
                        $('.addElement').attr('disabled', true);
                    } else  {
                        $('#validateT' + thisValue).attr('hidden', false);
                        $('#validateF' + thisValue).attr('hidden', 'hidden');
                        $('#validateTF' + thisValue).attr('hidden', 'hidden');
                        $('.addElement').attr('disabled', false);
                    } 

                    } else {
                        $('#validateT' + thisValue).attr('hidden', 'hidden');
                        $('#validateF' + thisValue).attr('hidden', 'hidden');
                        $('#validateTF' + thisValue).attr('hidden', 'hidden');
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
                //console.log('renameid', renameid);
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

        $('#elementGrouping').on('click', '.minusSection', function () {
            var dropid = $(this).data('sectionno');
            //console.log('dropid', dropid);
            $('.elementNew' + dropid).remove();
        });

    });//endOfDocument
</script>

<?php
echo $footer;
