<?= $header; ?>
<div class='row'>
    <div id="setsini" class='col-md-9'>
        <div class='panel panel-default' >
            <div class='panel-heading text-uppercase'>
                <div class='row'>
                    <div class='col-xs-2'>Discipline </div>
                    <div class='col-xs-10'>: <strong><?= $main_discipline; ?></strong></div>
                    <div class='col-xs-2'>Sub Discipline </div>
                    <div class='col-xs-10'>: <strong><?= $sub_discipline; ?></strong></div>
                    <div class='col-xs-2'>Document Title </div>
                    <div class='col-xs-10'>: <strong><?= $document_title; ?></strong></div>
                </div></div>
            <div class='panel-body'>
                <form class='form-horizontal '>
                    <?= MethodCaller('Common_Form', 'SeenDiscussedRecord'); ?>
                    <div class='hidden'>
                        <br>
                        <?= MethodCaller('Common_Form', 'Orders'); ?>
                        <br>
                        <?= MethodCaller('Common_Form', 'VitalSign'); ?>
                    </div>
                </form>
            </div>
        </div>
        <form id='notesForm' class='form-horizontal'>
            <div class='panel panel-default'>
                <?php foreach ($json_elements as $key => $section): ?>
                <div class='panel-heading' style="background-color: #0088cc; color: white; " data-section='<?= $key; ?>'><b><?= $section->section_desc; ?></b></div>
                    <div class='panel-body' data-section='<?= $key; ?>'>
                        <?php $column = $section->layout;  
                               switch ($column):
                                   case '1': $set=12;                                
                                 foreach ($section->elements as $elem => $element): ?>
                                   <div style='color:grey; font-size: 0.7em' class='hidden' ><i><?= $element->input_type . ' | ' . $element->element_code; ?></i></div>
                                   <div class="col-md-<?php echo $set;  ?>">
                                   <?= InputTypeCaller($element, $element->json_element, $document_title, $document_id, $column); ?>
                                   </div><?php 
                                 endforeach; 
                                   break;
                                   
                                   case '2': $set=6; 
                                       for($x=1;$x<=2;$x++){
                                           if($x==1){
                                               $position ='L';
                                           }elseif($x==2){
                                               $position ='R';
                                           }
                                  ?><div class="col-md-6"><?php
                                 foreach ($section->elements as $elem => $element): if($element->element_position=== $position){ 
                                     $thecode=$element->element_code;
                                     if($element->element_code===$element->child_element_code){
                                     ?>                                      
                                   <div style='color:grey; font-size: 0.7em' class='hidden' ><i><?= $element->input_type . ' | ' . $element->element_code; ?></i></div><?php
                                   ?>
                                   <?=  InputTypeCaller($element, $element->json_element, $document_title, $document_id, $column);
                                   
                                   foreach ($section->elements as $elem => $element):
                                        if($element->child_element_code === $thecode && $element->element_code != $element->child_element_code){
                                         ?>
                                   <?=  InputTypeCaller($element, $element->json_element, $document_title, $document_id, $column);   
                                        }
                                   endforeach;                                                                         
                                     }}
                                 endforeach;
                                 ?></div>
                                       <?php }                                  
                                   break;                                  
                                   //case '3': $set=4; break;
                                   default : $set=12; break;
                               endswitch;
                        ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </form>
    </div>
    <div class='col-md-1-right' style="position: fixed; z-index: 7; right: 0; top: 5;">
        <div class='panel-heading'>
            <div class="panel-body">
                <button class="btn btn-default expandComponent" data-current='expand'><i class="glyphicon glyphicon-chevron-up"></i></button>
            </div>
        </div>
    </div>
    <div class="col-md-3 " id="sidebar" style="position: fixed; z-index: 6; right: 0; top: 10;">
        <div class='panel panel-default' id='notecomponent'>
            <div class='panel-heading'>Notes Component</div>
            <div class='panel-body'>
                <ul class='list-unstyled'>
                    <?php foreach ($json_elements as $key => $section): ?>
                        <li><input type='checkbox' class='selectedsection'  name='<?= $key; ?>' value='<?= $key; ?>' checked /> <?= $section->section_desc; ?></li>
                    <?php endforeach; ?>
                </ul>

                <div class='text-right'>
                    <div class='btn-group btn-group-sm'>
                        <a href='<?= SITE_ROOT; ?>/formview/edit-form/<?= $template_id; ?>' class='btn btn-default'>Edit Form</a>
                        <a href='<?= SITE_ROOT; ?>/formview/json-format/<?= $document_id; ?>' target="_blank" class='btn btn-default'>View JSON</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body">
            </div>
        </div>

    </div>
</div>
<script src='<?= SITE_ROOT; ?>/assets/library/datepicker/js/bootstrap-datepicker.js'></script>
<!--<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>-->
<script src='http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.2.0/js/bootstrap.min.js'></script>
<script src="<?php echo SITE_ROOT; ?>/assets/library/summernote/summernote.js"></script>
<script src="<?php echo SITE_ROOT; ?>/assets/js/dropdown.js"></script>
<script>
                                function HideAndShowOtherSpecify(object) {
                                    var $selected = $(object).val();
                                    if ($selected.toLowerCase() == 'others, specify') {
                                        var $name = 'other_specify_' + $(object).attr('name');
                                        $("[name='" + $name + "']").show();
                                        if ($(object).is(':checked')) {
                                            $("[name='" + $name + "']").removeClass('hidden');
                                        } else {
                                            $("[name='" + $name + "']").addClass('hidden');
                                        }
                                    }
                                }
                                
</script>
<script>
    $(function () {
        $('.summernote').summernote({
            height: 100
        });
        $('.selectedsection').change(function () {
            var section = $(this).val();
            $('#notesForm').find("[data-section='" + section + "']").fadeToggle("fast", "linear");
        });

        $('.datepicker').datepicker({
            'format': 'dd/mm/yyyy'
        });
        $("input[name^=other_specify_]").hide();

        $('input[type="checkbox"]').change(function () {
            HideAndShowOtherSpecify(this);
            var $parentcode = $(this).data('parentcode');
            console.log($parentcode);
            if ($(this).is(':checked')) {
                $('.multicheckbox_' + $parentcode).removeClass('hidden');
                $('textarea[data-parentcode="'+$parentcode+'"]').removeAttr('disabled');
            } else {
                $('.multicheckbox_' + $parentcode).addClass('hidden');
                $('textarea[data-parentcode="'+$parentcode+'"]').attr('disabled','disabled');
            }
        });
        
//        $('input[type="radio"]').change(function () {
//            var $parentcode = $(this).data('parentcodes');
//            console.log($parentcode);
//             $('#'+$parentcode).addClass('hidden');
//            if ($(this).is(':checked')) {
//                $('#'+$parentcode).removeClass('hidden');
//            }
//        });
 
    });
    
    $(function(){
        $('input[id^=rdio_]').hide();
        $('input[type=radio]').on('change',function(){
            $('input[id^=rdio_]').hide();
           var $parentcode = $(this).data('parentcodes');
            console.log($parentcode);
             $('#rdio_'+$parentcode).show();
            if ($(this).is(':checked')) {
                $('#rdio_'+$parentcode).show();
            }
        });
    });

       $('.expandComponent').click(function () {
            var a = $('#sidebar').toggleClass('hidden');
            var current = $(this).data('current');
            console.log(current);
            if(current=='expand'){
                $(this).data('current','hide');
                $(this).html('<i class="glyphicon glyphicon-chevron-down"></i>');
                document.getElementById("setsini").className = "col-md-12";
            } else {
                $(this).data('current','expand');
                $(this).html('<i class="glyphicon glyphicon-chevron-up"></i>');
                document.getElementById("setsini").className = "col-md-9";
            }
        });

</script>

<?= $footer; ?>
