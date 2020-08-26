<div class="panel-body">

    <div class="form-group form-group-sm">
        <input type="hidden" name='elementCode' value="<?= $vars['element_code']; ?>" />
        <input type="hidden" name='documentId' value="<?= $vars['document_id']; ?>" />
        <select name="list_element_desc" id="list_element_desc" hidden>
            <?= ListElementDesc(); ?>
        </select>
        <select id="list_multi_ans_desc" name="list_multi_ans_desc" hidden>
            <?= ListMultiElementDesc(); ?>
        </select>
        <select id="list_multi_input_type" name="list_multi_input_type" hidden>
            <?= ListMultipleAnswer(); ?>
        </select>
    </div>

    <div class="form-group form-group-sm">
        <label class="control-label col-sm-2" style="text-align: right" >Input Type</label>
        <div class="col-sm-8">
            <?php
            $input_type = '';
            if ($vars['input_type'] != NULL) {
                $input_type = $vars['input_type'];
            }
            ?>
            <div>          
                <label class="radio-inline">
                    <input type="radio" name='input_type'  value="FREETEXT" <?php if($input_type==='FREETEXT'){echo 'checked';} ?>> Freetext
                </label>
                <label class="radio-inline">
                    <input type="radio" name='input_type'  value="RICHTEXT" <?php if($input_type==='RICHTEXT'){echo 'checked';} ?>> Richtext
                </label>
                <label class="radio-inline">
                    <input type="radio" name='input_type'  value="TEXTBOX" <?php if($input_type==='TEXTBOX'){echo 'checked';} ?>> Textbox
                </label>
                <label class="radio-inline">
                    <input type="radio" name='input_type'  value="METHOD" <?php if($input_type==='METHOD'){echo 'checked';} ?>> Method
                </label>
                <label class="radio-inline">
                    <input type="radio" name='input_type'  value="TIME" <?php if($input_type==='TIME'){echo 'checked';} ?>> Time
                </label>
                <label class="radio-inline">
                    <input type="radio" name='input_type'  value="DATE" <?php if($input_type==='DATE'){echo 'checked';} ?>> Date
                </label>
            </div>
            <div>
                <label class="radio-inline">
                    <input type="radio" name='input_type'  value="CALENDER" <?php if($input_type==='CALENDER'){echo 'checked';} ?>> Calendar
                </label>
                <label class="radio-inline">
                    <input type="radio" name='input_type'  value="NUMERIC" <?php if($input_type==='NUMERIC'){echo 'checked';} ?>> Numeric                                       
                </label>
                <label class="radio-inline">
                    <input type="radio" name='input_type'  value="ALPHANUMERIC" <?php if($input_type==='ALPHANUMERIC'){echo 'checked';} ?>> Alphanumeric                                       
                </label>
                <label class="radio-inline">
                    <input type="radio" name='input_type'  value="NUMBER" <?php if($input_type==='NUMBER'){echo 'checked';} ?>> Number                                       
                </label>
                <label class="radio-inline">
                    <input type="radio" name='input_type'  value="MULTIPLE ANSWER" <?php if($input_type==='MULTIPLE ANSWER'){echo 'checked';} ?>> Multiple Answer                                       
                </label>
            </div>
        </div>
    </div>

    <div id="multiple_answer" >
        <form id='basicMultAns'>
            <div id='predefinedList'>
    <?php
    if ($input_type === 'MULTIPLE ANSWER') {
        $elementDetail = array(
            'label' => $vars['element_desc'],
            'additional_attribute' => $vars['additional_attribute'],
            'element_code' => $vars['element_code'],
            'method' => $vars['method'],
            'json_element' => $vars['json_element'],
            'doc_name_id' => $vars['document_id'],
            'doc_method_code' => $vars['method_code']
        );
        ?>
        <?= UpdateInput($elementDetail);
    } else {
        ?>

                    <div class='prelist1' style="background-color: #f5f5f5">
                        <p class="text-box" value="1">
                        <div class="form-group form-group-sm input-list">
                            <label class="control-label col-sm-2">Predefined Value<span class="box-number">1</span></label>
                            <div class="col-sm-4 list-padding">
                                <div class="checkbox" style="margin-left:20px">
                                    <input type="hidden" id="show_label" name="show_label1" value="0" style="margin-top:6px"/>
                                    <input type="checkbox" id="show_label" name="show_label1" value="1" style="margin-top:6px"/>
                                    <input type="hidden" value="1" id="sorting" class="sorting" name="SortParent" />
                                    <input class="form-control" type="text" id="multi_ans_desc" name="multi_ans_desc1" list="multiList">
                                        <datalist id="multiList">
                                            <?=  ListMultiElementDesc();?>    
                                        </datalist>
                                </div>
                            </div>
                            <div class="col-sm-3 list-padding">
                                <select id="multi_input_type" name="multi_input_type1" class="form-control">
                                    <?= ListMultipleAnswer(); ?>
                                </select>
                            </div>
                            <div class="col-sm-2 predefinedActionButton" data-action="prelist1">
                                <div class='btn btn-default btn-sm addPredefined'style="padding:3px"><i class="glyphicon glyphicon-plus"></i> Parent</div>
                                <div class='btn btn-default btn-sm addLayer' data-layer="prelist1" style="padding:5px"><i class="fas fa-layer-group"></i></div>
                            </div>
                        </div>
                        </p>
                    </div>

<?php } ?>
            </div>
        </form>
    </div>

    <div id="method">
        <form id='basicMethod' >
            <div id='predefinedListMethod'>
            <?php
            if ($input_type === 'METHOD') {
                $elementDetail = array(
                    'label' => $vars['element_desc'],
                    'additional_attribute' => $vars['additional_attribute'],
                    'element_code' => $vars['element_code'],
                    'method' => $vars['method'],
                    'json_element' => $vars['json_element'],
                    'doc_name_id' => $vars['document_id'],
                    'doc_method_code' => $vars['method_code']
                );
                ?>
                <?= UpdateMethod($elementDetail);
            } else { ?>
                <?= ListMethod(); ?>
            <?php } ?>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function () {
        var count = 2;
        var next = 1;
        var option = $('#list_multi_input_type').html();
        var list = $('#list_multi_ans_desc').html();
        var element = $('#list_element_desc').html();

        //ADD DIV PARENT
        $('#predefinedList').on('click', '.addPredefined', function () {
            var n = $('.text-box').length + 1;

            var $html = '<div class="prelist' + count + '" style="background-color: #f5f5f5">';
            $html += '<p class="text-box" value="'+ n +'">';
            $html += '<div class="form-group form-group-sm input-list">';
            $html += '<label class="control-label col-sm-2">Predefined Value<span class="box-number">' + n + '</span></label>';
            $html += '<div class="col-sm-4 list-padding">';
            $html += '<div class="checkbox" style="margin-left:20px">';
            $html += '<input type="hidden" id="show_label" name="show_label' + n + '" value="0" style="margin-top:6px"/>';
            $html += '<input type="checkbox" id="show_label" name="show_label' + n + '" value="1" style="margin-top:6px"/>';
            $html += '<input type="hidden" id="sorting" class="sorting" name="SortParent" />';
            $html += '<input class="form-control" type="text" name="multi_ans_desc'+n+'" id="multi_ans_desc" list="multiList">';
            $html += '<datalist id="multiList">'+list+'</datalist>';
            $html += '</div>';
            $html += '</div>';
            $html += '<div class="col-sm-3 list-padding">';
            $html += '<select id="multi_input_type" name="multi_input_type' + n + '" class="form-control">' + option + '</select>';
            $html += '</div>';
            $html += '<div class="col-sm-2 predefinedActionButton" data-action="prelist' + n + '">';
            $html += '<div class="btn btn-default btn-sm addLayer" data-layer="prelist' + n + '" style="padding:5px"><i class="fas fa-layer-group"></i></div>&nbsp';
            $html += '<div class="btn btn-default btn-sm deletePredefined" style="padding:5px"><i class="glyphicon glyphicon-trash"></i></div>';
            $html += '</div>';
            $html += '</div>';
            $html += '</p>';

            $($html).appendTo('#predefinedList').find('.sorting').val(n + 1);
            ResetParentNumbers();
            count++;
        });

        //ADD DIV CHILD
        $('#predefinedList').on('click', '.addLayer', function () {
            next = 1;
            var div = $(this).parents("div").eq(2).attr("class");
            var replace = div.replace('prelist', '');

            var $html = '<div class="' + div + '-' + next + '">';
            $html += ' <div class="form-group form-group-sm input-list">';
            $html += '<label class="control-label col-sm-3"></label>';
            $html += '<div class="checkbox">';
            $html += '<div class="col-sm-4 list-padding">';
            $html += '<input type="hidden" id="show_label_child" name="show_label_child' + replace + '-' + next + '" value="0" style="margin-top:6px" />';
            $html += '<input type="checkbox" id="show_label_child" name="show_label_child' + replace + '-' + next + '" value="1" style="margin-top:6px" />';
            $html += '<input class="form-control" name="ref_desc' + replace + '-' + next + '" id="ref_desc" list="refList"/>';
            $html += '<datalist id="refList">' + element + '</datalist>';
            $html += '</div>';
            $html += '<div class="col-sm-2 predefinedActionButton" data-action="' + div + '-' + next + '">';
            $html += '<div class="btn btn-default btn-sm deleteLabel" style="padding:5px"><i class="glyphicon glyphicon-trash"></i></div>&nbsp';
            $html += '<div class="btn btn-default btn-sm addDivChild" data-child="' + div + '-' + next + '" style="padding:3px"><i class="glyphicon glyphicon-chevron-down"></i> Child</div>';
            $html += '</div>';
            $html += '</div>';
            $html += '</div>';

            $(this).closest('.addLayer').addClass("hidden");
            $($html).appendTo('.' + div + '');

        });

        //ADD INTO DIV CHILD
        $('#predefinedList').on('click', '.addDivChild', function () {
            var div = $(this).parents("div").eq(3).attr("class");
            var replace = div.replace('prelist', '');
            var n = $('.text-box' + replace + '').length + 1;

            var $html = '<div class="text-box' + replace + '" style="margin-left: 50px">';
            $html += '<input type="hidden" id="sorting_child' + replace + '" class="sorting_child' + replace + '" name="SortChild' + replace + '" />';
            $html += '<div class="' + div + '-' + n + '">';
            $html += ' <div class="form-group form-group-sm input-list" >';
            $html += '<label class="control-label col-sm-3">Child<span class="box-number' + replace + '">' + n + '</span></label>';
            $html += '<div class="col-sm-4 list-padding">';
            $html += '<div class="checkbox">';
            $html += '<input type="hidden" style="margin-top:6px" name="show_label' + replace + '-' + n + '" id="show_label" value="0"/>';
            $html += '<input type="checkbox" style="margin-top:6px" name="show_label' + replace + '-' + n + '" id="show_label" value="1"/>';
            $html += '<input class="form-control" type="text" name="multi_child_ans_desc' + replace + '-' + n + '" id="multi_child_ans_desc" list="multiList" >';
            $html += '<datalist id="multiList">'+list+'</datalist>';
            $html += '</div>';
            $html += '</div>';
            $html += '<div class="col-sm-3 list-padding">';
            $html += '<select id="multi_child_input_type" name="multi_child_input_type' + replace + '-' + n + '" class="form-control">' + option + '</select>';
            $html += '</div>';
            $html += '<div class="col-sm-2 predefinedActionButton" data-action="' + div + '-' + n + '">';
            $html += '<div class="btn btn-default btn-sm deletePredefinedChild" style="padding:5px"><i class="glyphicon glyphicon-trash"></i></div>&nbsp';
            $html += '<div class="btn btn-default btn-sm addLayer" data-layer="' + div + '-' + n + '" style="padding:5px"><i class="fas fa-layer-group"></i></div>';
            $html += '</div>';
            $html += '</div>';
            $html += '</div>';
            $html += '</div>';
            $html += '</div>';
            $html += '</div>';
            $($html).appendTo('.' + div + '').find('.sorting_child').val(n + 1);

            ResetChildNumbers(replace);
            next++;
        });

        //DELETE DIV
        $('#predefinedList').on('click', '.deletePredefined', function () {
            var div = $(this).parents("div").eq(2).attr("class");
            $(this).closest('.' + div + '').remove();
            var docId = '<?= $vars['document_id']; ?>';
            var sparent = '<?= $vars['element_code']; ?>';
            var parent = $(this).attr('id');
            var label = $(this).closest('.' + div + '').find("input[id^='ref_desc']").first().attr("name", 'ref_desc').val();
    
            //console.log("DocId: ", docId, "|| Parent: ", parent, "|| Label: ", label, "|| Sparent: ", sparent);

            $('.box-number').each(function (index) {
                $(this).text(index + 1);
            });
            ResetParentNumbers();
                
             $.ajax({
                    url: '<?= SITE_ROOT; ?>/formview/delete-current-parent/',
                    type: 'POST',
                    data: {docId: docId,parent: parent, label: label, sparent: sparent}
//                    success: function(data){
//                                console.log(data);
//                            }
                });
        });

        $('#predefinedList').on('click', '.deleteLabel', function () {
            var div  = $(this).parents("div").eq(3).attr("class");
            var div2 = $(this).parents("div").eq(4).attr("class"); 
            var div3 = $(this).parents("div").eq(7).attr("class");

            $(this).closest('.' + div + '').remove();
            var docId = '<?= $vars['document_id']; ?>';
            var label = $(this).attr('id');
            var parent = $('.' + div2 + '').find("input[id^='multi_ans_desc']").first().attr("name", 'multi_ans_desc').val();
            var child = $('.' + div2 + '').find("input[id^='multi_child_ans_desc']").first().attr("name", 'multi_child_ans_desc').val();
            var sparent = $('.' + div3 + '').find("input[id^='ref_desc']").first().attr("name", 'ref_desc').val();
            //console.log("DocId: ", docId, "|| Parent: ", parent, "|| Label: ", label, "|| Child: ", child, "|| Sparent: ", sparent);
            
            var result = div.substr(0, div.lastIndexOf("-"));
            if (result === 'prelist1') {
                var $deleteButton = '<div class="btn btn-default btn-sm addPredefined"style="padding:3px"><i class="glyphicon glyphicon-plus"></i> Parent</div>&nbsp';
                $deleteButton += '<div class="btn btn-default btn-sm addLayer" data-layer="' + result + '" style="padding:5px"><i class="fas fa-layer-group"></i></div>';
                $('.predefinedActionButton[data-action="' + result + '"]').html($deleteButton);
            } else {
                var $deleteButton = '<div class="btn btn-default btn-sm deleteLabel" style="padding:5px"><i class="glyphicon glyphicon-trash"></i></div>&nbsp';
                $deleteButton += '<div class="btn btn-default btn-sm addLayer" data-layer="' + result + '" style="padding:5px"><i class="fas fa-layer-group"></i></div>';
                $('.predefinedActionButton[data-action="' + result + '"]').html($deleteButton);
            }

            ResetLabelNumbers();
            
                $.ajax({
                    url: '<?= SITE_ROOT; ?>/formview/delete-current-label/',
                    type: 'POST',
                    data: {docId: docId, label: label, parent: parent, child: child, sparent: sparent}
//                    success: function(data){
//                                console.log(data);
//                            }
                });
        });

        $('#predefinedList').on('click', '.deletePredefinedChild', function () {
            var cari = $(this).parents("div").eq(4).attr("class");
            var replace = cari.replace('prelist', '');
            var del = $(this).parents("div").eq(3).attr("class");
            $(this).closest('.' + del + '').remove();
            var docId = '<?= $vars['document_id']; ?>';
            var child = $(this).attr('id');
            var parent = $('.' + cari + '').find("input[id^='ref_desc']").first().attr("name", 'ref_desc').val();
            var label = $(this).closest('.' + del + '').find("input[id^='ref_desc']").first().attr("name", 'ref_desc').val();
            //console.log("DocId: ", docId, "|| Parent: ", parent, "|| Child: ", child, "|| Label: ", label);
            
            //REARRANGED SORTING
            $('.box-number' + replace + '').each(function (index) {
                $(this).text(index + 1);
            });
            ResetChildNumbers(replace);
            $.ajax({
                url: '<?= SITE_ROOT; ?>/formview/delete-current-child/',
                type: 'POST',
                data: {docId: docId, child: child,parent:parent, label: label}
//                success: function(data){
//                    console.log(data);
//                }
            });
        });
    });

    function ResetParentNumbers() {

        $('.sorting').each(function (i) {
            var val = i + 1;
            this.value = val;
            $(this).closest('[class^="prelist"]').find("input[id^='multi_ans_desc']").first().attr("name", 'multi_ans_desc' + val);
            $(this).closest('[class^="prelist"]').find("select[id^='multi_input_type']").first().attr("name", 'multi_input_type' + val);
            $(this).closest('[class^="prelist"]').first().attr("class", 'prelist' + val);
        });
    }

    function ResetLabelNumbers() {

        $('.sorting').each(function (i) {
            var val = i + 1;
            this.value = val;
            $(this).closest('[class^="prelist"]').find("input[id^='multi_ans_desc']").first().attr("name", 'multi_ans_desc' + val);
            $(this).closest('[class^="prelist"]').find("select[id^='multi_input_type']").first().attr("name", 'multi_input_type' + val);
            $(this).closest('[class^="prelist"]').find("input[id^='ref_desc']").first().attr("name", 'ref_desc' + val);
            $(this).closest('[class^="prelist"]').first().attr("class", 'prelist' + val);
        });
    }

    function ResetChildNumbers(replace) {

        $('.sorting_child' + replace + '').each(function (i) {

            var val = i + 1;
            var div = $(this).next('[class^="prelist"]').attr('class');
            var result = div.substr(0, div.lastIndexOf("-") + 1);
            var replace = result.replace('prelist', '');
            this.value = val;
            var no = replace.concat(val);

            $('.' + div + '').find("input[id^='multi_child_ans_desc']").first().attr("name", 'multi_child_ans_desc' + no);
            $('.' + div + '').find("select[id^='multi_child_input_type']").first().attr("name", 'multi_child_input_type' + no);
            $('.' + div + '').first().attr("class", 'prelist' + no);

        });
    }

</script>

<script>
    $(function () {
        $('#multiple_answer').hide();
        $('#method').hide();
        $('[name=input_type]').on('change', function () {
            $('#multiple_answer').hide();
            $('#method').hide();
            var isselect = $(this).val();
            if (isselect === 'MULTIPLE ANSWER') {
                $('#multiple_answer').show();
            }
            if (isselect === 'METHOD') {
                $('#method').show();
            }
        });
    });

    $(function () {
        var $define = $("input[name='input_type']:checked").val();
        if ($define === 'MULTIPLE ANSWER') {
            $("#multiple_answer").show();
        }
        if ($define === 'METHOD') {
            $("#method").show();
        }
    });
</script>
