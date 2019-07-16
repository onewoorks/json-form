<?php echo $header; ?>

<div id='methodCreator' class="col-md-12">
    <div class="col-md-6" style="padding-left: 30px;">
        <div class="btn-group">
    <div class="btn btn-primary generate">Generate</div>
    <div class="btn btn-default copy" onclick="copyToClipboard('#json_string')" title="Copy to Clipboard" data-toggle="tooltip"><i class="glyphicon glyphicon-link"></i>Copy</div>
    </div>
    <pre id="json" name="json" style="height:460px"></pre>
    <pre id="json_string" name="json_string" class="hidden"></pre>
    </div>
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading"><b>&nbsp;DEFAULT PANEL</b></div>
            <div class="panel-body">
                <form id='formD' class='form-horizontal'>
                    <div class='form-group form-group-sm'>
                        <div id ='dPanel' class="col-md-12">
                            <ul class="col-md-12 tree" id="treeD">
                                <div class="child" id="child1">
                                    <div class="checkbox form-inline">
                                        <input name="id" type="checkbox" style="margin-top:5px" checked="checked">
                                        <p style="display: inline-block;width:150px">id</p>
                                        <input name="id" type="text" class="form-control" value="">
                                        <div class='btn btn-default btn-sm plusD'  data-no='1' style='padding:3px' ><i class='glyphicon glyphicon-plus'></i></div>
                                    </div>
                                    <div class="checkbox form-inline grandchild">
                                        <input name="showLabel" type="checkbox" style="margin-top:5px" checked="checked">
                                        <p style="display: inline-block;width:150px">showLabel</p>
                                        <input name="showLabel" type="text" value="true"class="form-control">
                                    </div>
                                    <div class="checkbox form-inline grandchild">
                                        <input name="designType" type="checkbox" style="margin-top:5px" checked="checked">
                                        <p style="display: inline-block;width:150px">designType</p>
                                        <input name="designType" type="text"class="form-control">
                                    </div>
                                    <div class="checkbox form-inline grandchild">
                                        <input name="methodName" type="checkbox" style="margin-top:5px" checked="checked">
                                        <p style="display: inline-block;width:150px">methodName</p>
                                        <input name="methodName" type="text"class="form-control">
                                    </div>
                                    <div class="checkbox form-inline grandchild">
                                        <input name="parentCode" type="checkbox" style="margin-top:5px" checked="checked">
                                        <p style="display: inline-block;width:150px">parentCode</p>
                                        <input name="parentCode" type="text"class="form-control">
                                    </div>
                                    <div class="checkbox form-inline grandchild">
                                        <input name="elementCode" type="checkbox" style="margin-top:5px" checked="checked">
                                        <p style="display: inline-block;width:150px">elementCode</p>
                                        <input name="elementCode" type="text"class="form-control">
                                    </div>
                                </div>
                            </ul>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading"><b>&nbsp;X PANEL</b></div>
            <div class="panel-body">
                <form id='formX' class='form-horizontal'>
                    <div class='form-group form-group-sm'>
                        <div id ='xPanel' class="col-md-12">
                            <ul class="col-md-12 tree" id="treeX">
                                <div class="child" id="childx1">
                                    <div class="checkbox form-inline">
                                        <input name="id" type="checkbox" style="margin-top:5px" checked="checked">
                                        <p style="display: inline-block;width:150px">id</p>
                                        <input name="id" type="text" class="form-control" value="">
                                        <div class='btn btn-default btn-sm plusX' data-no='1' style='padding:3px' title='add label'><i class='glyphicon glyphicon-plus'></i></div>
                                        <div class='btn btn-default btn-sm addX' data-no='1' style='padding:3px' title="add array"><i class='glyphicon glyphicon-plus-sign'></i></div>
                                        <div class='btn btn-default btn-sm arrayX' data-no='1' style='padding:3px' title='add ref'><i class='glyphicon glyphicon-chevron-down'></i></div>
                                    </div>
                                    <div class="checkbox form-inline grandchild">
                                        <input name="type" type="checkbox" style="margin-top:5px" checked="checked">
                                        <p style="display: inline-block;width:150px">type</p>
                                        <input name="type" type="text"class="form-control" value="LABEL">
                                    </div>
                                    <div class="checkbox form-inline grandchild">
                                        <input name="elementName" type="checkbox" style="margin-top:5px" checked="checked">
                                        <p style="display: inline-block;width:150px">elementName</p>
                                        <input name="elementName" type="text"class="form-control">
                                    </div>
                                    <div class="checkbox form-inline grandchild">
                                        <input name="isDuplicate" type="checkbox" style="margin-top:5px" checked="checked">
                                        <p style="display: inline-block;width:150px">isDuplicate</p>
                                        <input name="isDuplicate" type="text"class="form-control" value="true">
                                    </div>
                                </div>
                            </ul>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading"><b>&nbsp;Y PANEL</b></div>
            <div class="panel-body">
                <form id='formY' class='form-horizontal'>
                    <div class='form-group form-group-sm'>
                        <div id ='yPanel' class="col-md-12">
                            <ul class="col-md-12 tree" id="treeY">
                                <div class="child" id="childy1">
                                    <div class="checkbox form-inline">
                                        <input name="id" type="checkbox" style="margin-top:5px" checked="checked">
                                        <p style="display: inline-block;width:150px">id</p>
                                        <input name="id" type="text" class="form-control" value="">
                                        <div class='btn btn-default btn-sm plusY' data-no='1' style='padding:3px' title='add label'><i class='glyphicon glyphicon-plus'></i></div>
                                        <div class='btn btn-default btn-sm addY' data-no='1' style='padding:3px' title="add array"><i class='glyphicon glyphicon-plus-sign'></i></div>
                                        <div class='btn btn-default btn-sm arrayY' data-no='1' style='padding:3px' title='add ref'><i class='glyphicon glyphicon-chevron-down'></i></div>
                                    </div>
                                    <div class="checkbox form-inline grandchild">
                                        <input name="type" type="checkbox" style="margin-top:5px" checked="checked">
                                        <p style="display: inline-block;width:150px">type</p>
                                        <input name="type" type="text"class="form-control">
                                    </div>
                                    <div class="checkbox form-inline grandchild">
                                        <input name="elementName" type="checkbox" style="margin-top:5px" checked="checked">
                                        <p style="display: inline-block;width:150px">elementName</p>
                                        <input name="elementName" type="text"class="form-control">
                                    </div>
                                </div>
                            </ul>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function delay(callback, ms) {
        var timer = 0;
        return function () {
            var context = this, args = arguments;
            clearTimeout(timer);
            timer = setTimeout(function () {
                callback.apply(context, args);
            }, ms || 0);
        };
    }

    //D: ARRAY
    $(document).ready(function () {

        var no = 7;
        var str;

        $('#formD').on('click', '.addD', function () {

            var $html = "<div class='checkbox'>";
            $html += "<label>";
            $html += "<div id='groupD' class='form-inline groupingD'>";
            $html += "<input type='checkbox' style='margin-top:5px' checked>";
            $html += "<div class='inputs'>";
            $html += "<p style='display: inline-block;width:150px' class='inputD" + no + "'>renameLabel</p>";
            $html += "&nbsp<input type='text' name='renameLabel" + no + "' id='renameLabel" + no + "' class='form-control' />";
            $html += "&nbsp<div class='btn btn-default btn-sm renameD' data-no='" + no + "' style='padding:3px'><i class='glyphicon glyphicon-pencil'></i></div>";
            $html += "</div>";
            $html += "</div>";
            $html += "</label>";
            $html += "</div>";

            $($html).appendTo('#dPanel');
            no++;
        });

        $('#formD').on('click', '.renameD', function () {

            var id = $(this).data('no');
            console.log('idD', id);

            var input = $('<input name="textPaste" id="textPaste" style="width:150px;border:none" class="form-control" />');
            console.log('input', input);
            $('.inputD' + id).text('').append(input);

            $('#textPaste').keyup(delay(function (e) {
                str = $(this).val();
                $("#renameLabel" + id).attr("name", str);
                $('.inputD' + id).text(str);

            }, 1000));

        });

    });

    $(document).ready(function () {

        var no = 2;

        //D: ARRAY
        $('#formD').on('click', '.plusD', function () {

            var id = $(this).data('no');

            var $html = "<div class='checkbox form-inline grandchild'>";
            $html += "<input name='renameLabeld" + no + "' id='renameLabeld" + no + "' type='checkbox' style='margin-top:5px' checked='checked'>";
            $html += "<p style='display: inline-block;width:150px' class='inputD" + no + "'>renameLabel</p>";
            $html += "&nbsp<input type='text' class='form-control' />";
            $html += "&nbsp<div class='btn btn-default btn-sm renameD' data-no='" + no + "' style='padding:3px'><i class='glyphicon glyphicon-pencil'></i></div>";
            $html += "</div>";

            $($html).appendTo('#child' + id);
            no++;

        });

        $('#formD').on('click', '.renameD', function () {

            var id = $(this).data('no');
            console.log('renameD', id);

            var input = $('<input name="textPasteD" id="textPasteD" style="width:150px;border:none" class="form-control" />');
            console.log('input', input);
            $('.inputD' + id).text('').append(input);

            $('#textPasteD').keyup(delay(function (e) {
                str = $(this).val();
                $("#renameLabeld" + id).attr("name", str);
                $('.inputD' + id).text(str);

            }, 1000));

        });

        //X: ARRAY
        $('#formX').on('click', '.addX', function () {

            var $html = "<br><div class='child' id='childx" + no + "' style='background-color:#f8f8f8'>";
            $html += "<div class='checkbox form-inline' name='id'>";
            $html += "<input name='id' type='checkbox' style='margin-top:5px' checked='checked'>";
            $html += "<p style='display: inline-block;width:150px'>id</p>";
            $html += "&nbsp<input name='id' type='text' class='form-control' >";
            $html += "&nbsp<div class='btn btn-default btn-sm plusX' data-no='" + no + "' style='padding:3px'><i class='glyphicon glyphicon-plus'></i></div>";
            $html += "&nbsp<div class='btn btn-default btn-sm arrayX' data-no='" + no + "' style='padding:3px' title='add ref'><i class='glyphicon glyphicon-chevron-down'></i></div>";
            $html += "</div>";
            $html += "<div class='checkbox form-inline grandchild'>";
            $html += "<input name='type' type='checkbox' style='margin-top:5px' checked='checked'>";
            $html += "<p style='display: inline-block;width:150px'>type</p>";
            $html += "&nbsp<input name='type' type='text' class='form-control' value='LABEL' >";
            $html += "</div>";
            $html += "<div class='checkbox form-inline grandchild'>";
            $html += "<input name='elementName' type='checkbox' style='margin-top:5px' checked='checked'>";
            $html += "<p style='display: inline-block;width:150px'>elementName</p>";
            $html += "&nbsp<input name='elementName' type='text' class='form-control' >";
            $html += "</div>";
            $html += "<div class='checkbox form-inline grandchild'>";
            $html += "<input name='isDuplicate' type='checkbox' style='margin-top:5px' checked='checked'>";
            $html += "<p style='display: inline-block;width:150px'>isDuplicate</p>";
            $html += "&nbsp<input name='isDuplicate' type='text' class='form-control' value='true'>";
            $html += "</div>";
            $html += "</div>";

            $($html).appendTo('#treeX');
            no++;

        });

        $('#formX').on('click', '.plusX', function () {

            var id = $(this).data('no');

            var $html = "<div class='checkbox form-inline grandchild'>";
            $html += "<input name='renameLabelx" + no + "' id='renameLabelx" + no + "' type='checkbox' style='margin-top:5px' checked='checked'>";
            $html += "<p style='display: inline-block;width:150px' class='inputX" + no + "'>renameLabel</p>";
            $html += "&nbsp<input type='text' class='form-control' />";
            $html += "&nbsp<div class='btn btn-default btn-sm renameX' data-no='" + no + "' style='padding:3px'><i class='glyphicon glyphicon-pencil'></i></div>";
            $html += "</div>";

            $($html).appendTo('#childx' + id);
            no++;
        });

        $('#formX').on('click', '.renameX', function () {

            var id = $(this).data('no');
            console.log('renameX', id);

            var input = $('<input name="textPasteX" id="textPasteX" style="width:150px;border:none" class="form-control" />');
            console.log('input', input);
            $('.inputX' + id).text('').append(input);

            $('#textPasteX').keyup(delay(function (e) {
                str = $(this).val();
                $("#renameLabelx" + id).attr("name", str);
                $('.inputX' + id).text(str);

            }, 1000));

        });

        $('#formX').on('click', '.arrayX', function () {

            var id = $(this).data('no');
            console.log('idX', id);

            var $html = "<ul>";
            $html += "<div class='child' id='childx" + no + "'>";
            $html += "<div class='checkbox form-inline' name='id'>";
            $html += "<input name='id' type='checkbox' style='margin-top:5px' checked='checked'>";
            $html += "<p style='display: inline-block;width:150px'>id</p>";
            $html += "&nbsp<input name='id' type='text' class='form-control' >";
            $html += "<div class='btn btn-default btn-sm plusX' data-no='" + no + "' style='padding:3px;margin-left:3px'><i class='glyphicon glyphicon-plus'></i></div>";
            $html += "<div class='btn btn-default btn-sm addChildX' data-no='" + no + "' style='padding:3px;margin-left:3px' title='add array'><i class='glyphicon glyphicon-plus-sign'></i></div>";
            $html += "<div class='btn btn-default btn-sm arrayX' data-no='" + no + "' style='padding:3px;margin-left:3px' title='add ref'><i class='glyphicon glyphicon-chevron-down'></i></div>";
            $html += "<div class='btn btn-default btn-sm deleteX' data-no='" + no + "' style='padding:3px;margin-left:3px'><i class='glyphicon glyphicon-trash'></i></div>";
            $html += "</div>";
            $html += "</div>";
            $html += "</ul>";

            $(this).closest('.arrayX').addClass("hidden");
            $($html).appendTo('#childx' + id);
            no++;

        });
        
        $('#formX').on('click', '.addChildX', function () {
            
            var id = $(this).data('no');
            console.log('idX', id);

            var $html = "<br><div class='child' id='childx" + no + "'>";
            $html += "<div class='checkbox form-inline' name='id'>";
            $html += "<input name='id' type='checkbox' style='margin-top:5px' checked='checked'>";
            $html += "<p style='display: inline-block;width:150px'>id</p>";
            $html += "&nbsp<input name='id' type='text' class='form-control' >";
            $html += "<div class='btn btn-default btn-sm plusX' data-no='" + no + "' style='padding:3px;margin-left:3px'><i class='glyphicon glyphicon-plus'></i></div>";
            $html += "<div class='btn btn-default btn-sm arrayX' data-no='" + no + "' style='padding:3px;margin-left:3px' title='add ref'><i class='glyphicon glyphicon-chevron-down'></i></div>";
            $html += "</div>";
            $html += "</div>";

            $(this).closest('.arrayX').addClass("hidden");
            $($html).insertAfter('#childx' + id);
            no++;
            
        });
        
        $('#formX').on('click', '.deleteX', function () {
            
            var finds = $(this).closest('ul').prevAll();
            var search = finds.parent().find('.arrayX').removeClass("hidden");
            var div = $(this).closest('ul').remove();
            
        });

        //Y: ARRAY
        $('#formY').on('click', '.addY', function () {
            
            var $html ="<table id='child-box'>";
            $html += "<br><div class='child' id='childy" + no + "' style='background-color:#f8f8f8'>";
            $html += "<div class='checkbox form-inline' name='id'>";
            console.log(no);
            $html += "<input name='id' type='checkbox' style='margin-top:5px' checked='checked'>";
            $html += "<p style='display: inline-block;width:150px'>id</p>";
            $html += "&nbsp<input name='id' type='text' class='form-control' >";
            $html += "&nbsp<div class='btn btn-default btn-sm plusY' data-no='" + no + "' style='padding:3px' title='add label'><i class='glyphicon glyphicon-plus'></i></div>";
            $html += "&nbsp<div class='btn btn-default btn-sm arrayY' data-no='" + no + "' style='padding:3px' title='add ref'><i class='glyphicon glyphicon-chevron-down'></i></div>";
            $html += "&nbsp<div class='btn btn-default btn-sm deleteYarr' data-no='" + no + "' style='padding:3px;margin-left:3px'><i class='glyphicon glyphicon-trash'></i></div>";       
            $html += "</div>";
            $html += "<div class='checkbox form-inline grandchild'>";
            $html += "<input name='type' type='checkbox' style='margin-top:5px' checked='checked'>";
            $html += "<p style='display: inline-block;width:150px'>type</p>";
            $html += "&nbsp<input name='type' type='text' class='form-control' >";
            $html += "</div>";
            $html += "<div class='checkbox form-inline grandchild'>";
            $html += "<input name='elementName' type='checkbox' style='margin-top:5px' checked='checked'>";
            $html += "<p style='display: inline-block;width:150px'>elementName</p>";
            $html += "&nbsp<input name='elementName' type='text' class='form-control' >";
            $html += "</div>";
            $html += "</table>";
                       
            $($html).appendTo('#treeY');
            no++;

        });

        $('#formY').on('click', '.plusY', function () {

            var id = $(this).data('no');

            var $html = "<div class='checkbox form-inline grandchild'>";
            $html += "<input name='renameLabely" + no + "' id='renameLabely" + no + "' type='checkbox' style='margin-top:5px' checked='checked'>";
            $html += "<p style='display: inline-block;width:150px' class='inputY" + no + "'>renameLabel</p>";
            $html += "<input type='text' class='form-control' />";
            $html += "&nbsp<div class='btn btn-default btn-sm renameY' data-no='" + no + "' style='padding:3px'><i class='glyphicon glyphicon-pencil'></i></div>";
            $html += "</div>";

            $($html).appendTo('#childy' + id);
            no++;
        });

        $('#formY').on('click', '.arrayY', function () {

            var id = $(this).data('no');
            console.log('idY', id);

            var $html = "<ul>";
            $html += "<div class='child' id='childy" + no + "'>";
            $html += "<div class='checkbox form-inline' name='id'>";
            $html += "<input name='id" + no + "' id='id" + no + "' type='checkbox' style='margin-top:5px' checked='checked'>";
            $html += "<p style='display: inline-block;width:150px' class='inputY" + no + "'>id</p>";
            $html += "<input name='id' type='text' class='form-control' >";
            $html += "&nbsp<div class='btn btn-default btn-sm renameYid' data-no='" + no + "' style='padding:3px'><i class='glyphicon glyphicon-pencil'></i></div>";
            $html += "<div class='btn btn-default btn-sm plusY' data-no='" + no + "' style='padding:3px;margin-left:3px' title='add label'><i class='glyphicon glyphicon-plus'></i></div>";
            $html += "<div class='btn btn-default btn-sm addChildY' data-no='" + no + "' style='padding:3px;margin-left:3px' title='add array'><i class='glyphicon glyphicon-plus-sign'></i></div>";
            $html += "<div class='btn btn-default btn-sm arrayY' data-no='" + no + "' style='padding:3px;margin-left:3px' title='add ref'><i class='glyphicon glyphicon-chevron-down'></i></div>";
            $html += "<div class='btn btn-default btn-sm deleteY' data-no='" + no + "' style='padding:3px;margin-left:3px'><i class='glyphicon glyphicon-trash'></i></div>";
            $html += "</div>";
            $html += "</div>";
            $html += "</ul>";

            $(this).closest('.arrayY').addClass("hidden");
            $($html).appendTo('#childy' + id);
            no++;

        });
        
        $('#formY').on('click', '.addChildY', function () {
            
            var id = $(this).data('no');
            console.log('idY', id);

            var $html = "<br><div class='child' id='childy" + no + "'>";
            $html += "<div class='checkbox form-inline' name='id'>";
            $html += "<input name='id' type='checkbox' style='margin-top:5px' checked='checked'>";
            $html += "<p style='display: inline-block;width:150px'>id</p>";
            $html += "<input name='id' type='text' class='form-control' >";
            $html += "<div class='btn btn-default btn-sm plusY' data-no='" + no + "' style='padding:3px;margin-left:3px' title='add label2'><i class='glyphicon glyphicon-plus'></i></div>";
            $html += "<div class='btn btn-default btn-sm arrayY' data-no='" + no + "' style='padding:3px;margin-left:3px' title='add ref2'><i class='glyphicon glyphicon-chevron-down'></i></div>";
            $html += "</div>";
            $html += "</div>";

            $(this).closest('.arrayY').addClass("hidden");
            $($html).insertAfter('#childy' + id);
            no++;
            
        });
        
        //rename Y Label
        $('#formY').on('click', '.renameY', function () {

            var id = $(this).data('no');
            console.log('renameY', id);

            var input = $('<input name="textPasteY" id="textPasteY" style="width:150px;border:none" class="form-control" />');
            console.log('input', input);
            $('.inputY' + id).text('').append(input);

            $('#textPasteY').keyup(delay(function (e) {
                str = $(this).val();
                $("#renameLabelId" + id).attr("name", str);
                $('.inputY' + id).text(str);

            }, 1000));

        });
        
        //rename Y add Child id
        $('#formY').on('click', '.renameYid', function () {

            var id = $(this).data('no');
            console.log('renameYid', id);

            var input = $('<input name="textPasteY" id="textPasteY" style="width:150px;border:none" class="form-control" />');
            console.log('input', input);
            $('.inputY' + id).text('').append(input);

            $('#textPasteY').keyup(delay(function (e) {
                str = $(this).val();
                $("#id" + id).attr("name", str);
                $('.inputY' + id).text(str);

            }, 1000));

        });
        
        //Delete Y array
        $('#formY').on('click', '.deleteY', function () {
            
            var finds = $(this).closest('ul').prevAll();
            var search = finds.parent().find('.arrayY').removeClass("hidden");
            var div = $(this).closest('ul').remove();
            
        });
       
        $('#formY').on('click', '.deleteYarr', function () {
            var cari = $(this).closest('[class^="child"]').first().attr("data", 'no');
            $(cari).remove();
        });
    });
</script>

<script>
    function createJSON($ul) {

        var nameC;
        var find_valueC;
        var obj1;

        return $ul
                .children('.child')
                .filter(function () {
                    return $(this).children('.checkbox').find(':checkbox:checked');
                })
                .map(function () {
                    obj1 = {};
            
                    var name = $(this).children('.checkbox').find(':checkbox:checked').attr('name');
                    console.log('name', name);
                    var find_value = $(this).children('.checkbox').find(':text').val();
                    console.log('find_value', find_value);
                    if(name !== undefined){
                        obj1[name] = find_value;    
                    }

                    $(this).children('.grandchild').map(function () {

                        nameC = $(this).children(':checkbox:checked').attr('name');
                        find_valueC = $(this).children(':text').val();
                        if(nameC !== undefined){
                            obj1[nameC] = find_valueC;
                        }

                    }).get();
                    var $ulc = $(this).children('ul');
                    if ($ulc.length > 0) {
                        obj1.ref = createJSON($ulc);
                    }

                    return obj1;
                }).get();
    }

    $(document).ready(function () {

        var obj;

        $('#methodCreator').on('click', '.generate', function () {

            $('#textPaste').remove();

            var d = createJSON($('#treeD'));
            obj = d[0];

            var x = createJSON($('#treeX'));

            $.extend(obj, {
                x
            });

            var y = createJSON($('#treeY'));

            $.extend(obj, {
                y
            });

            $('#json').html(JSON.stringify(obj, null, 3));
            $('#json_string').html(JSON.stringify(obj));


        });

    });
</script>

<script>
    
function copyToClipboard(element) {
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val($(element).text()).select();
  document.execCommand("copy");
  $temp.remove();
}

$(document).ready(function(){
   $(".copy").tooltip(); 
   $('#methodCreator').on('click', '.copy', function () {
   $(".copy").attr('data-original-title', 'Copied');
   $(".copy").tooltip('show');
});
});

</script>

<?php
echo $footer;
