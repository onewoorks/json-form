<?= $header; ?>
<div class='row'>
    <div class='col-md-9'>
        <h4><?= $document_title; ?></h4>

        <form id='notesForm' class='form-horizontal'>
            <div class='panel panel-default'>
                <ol class='nested_with_switch list-unstyled'>
                    <?php foreach ($json_elements as $key => $section): ?>
                        <li style='margin-bottom:10px;'>
                            <div class='panel-heading' 
                                 data-section='<?= $key; ?>' 

                                 style="background: #f5f5f5; "><?= $section->section_desc; ?>
                                <div class="btn-group pull-right">
                                    <a href="#" class="btn btn-default btn-xs editSection" data-section='<?= $key; ?>'
                                       data-sectioncode='<?= $section->section_code; ?>' 
                                       ></i> Edit Section</a>
                                    <a href="#" class="btn btn-default btn-xs expandButton" data-section='<?= $key; ?>' data-current='expend'><i class='glyphicon glyphicon-chevron-down'></i> Expand</a>
                                </div>
                            </div>
                            <div class='panel-body hidden' data-section='<?= $key; ?>'>
                                <div class='row' style='margin-bottom: 5px;'>
                                    <div class='col-sm-12 text-right'>
                                        <div class='btn btn-sm btn-default'><i class='glyphicon glyphicon-plus'></i> Add Element</div>
                                    </div>
                                </div>
                                <?php foreach ($section->elements as $elem => $element): ?>
                                    <div class='row'>
                                        <div class='col-sm-12'>
                                            <div class='form-group form-group-sm' style='border:1px solid #ccc;; margin:4px;'>
                                                <label class='control-label col-md-4'><?= $element->element_desc; ?></label>
                                                <div class='col-md-4'>
                                                    <div class='btn btn-link editElement' data-elementid='<?= $element->element_code;?>'>Edit</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ol>
            </div>
        </form>
    </div>

    <div class='col-sm-3' style="position: fixed; right: 0;">
        <div class='panel panel-default'>
            <div class='panel-heading'>Notes Component</div>
            <div class='panel-body'>
                <ul class='list-unstyled'>
                    <?php foreach ($json_elements as $key => $section): ?>
                        <li><input type='checkbox' class='selectedsection'  name='<?= $key; ?>' value='<?= $key; ?>' checked /> <?= $section->section_desc; ?></li>
                    <?php endforeach; ?>
                </ul>

                <div class='text-right'>
                    <div class='btn-group btn-group-sm'>
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
                <h4 class="modal-title">Modal </h4>
            </div>
            <div class="modal-body">
            </div>
        </div>

    </div>
</div>

<script src='<?= SITE_ROOT; ?>/assets/js/jquery-sortable.js'></script>
<script>
    $(function () {

        var oldContainer;

        $("ol.nested_with_switch").sortable({
            group: 'nested',
            afterMove: function (placeholder, container) {
                if (oldContainer != container) {
                    if (oldContainer)
                        oldContainer.el.removeClass("active");
                    container.el.addClass("active");

                    oldContainer = container;
                }
            },
            onDrop: function ($item, container, _super) {
                container.el.removeClass("active");
                _super($item, container);
            }
        });

        $('.expandButton').click(function () {
            var a = $('#notesForm').find(".panel-body[data-section='" + $(this).data('section') + "']").toggleClass('hidden');
            var current = $(this).data('current');
            if(current=='expend'){
                $(this).data('current','hide');
                $(this).html('<i class="glyphicon glyphicon-chevron-up"></i> Hide');
            } else {
                $(this).data('current','expend');
                $(this).html('<i class="glyphicon glyphicon-chevron-down"></i> Expend');
            }
        });
        $('.summernote').summernote({
            height: 100
        });

        $('.selectedsection').change(function () {
            var section = $(this).val();
            $('#notesForm').find("[data-section='" + section + "']").fadeToggle("fast", "linear");
        });
        
        $('.editElement').click(function () {
            var key = $(this).data('elementid');
            var documentId = '<?= $document_id;?>';
            var templateId = '<?= $template_id;?>';
            $.ajax({
                url: '<?= SITE_ROOT; ?>/formview/load-selected-json/',
                data: {key: key,component:'element', documentId : documentId, templateId: templateId },
                success: function (data) {
                    var obj = $.parseJSON(data);
                    $('.modal-dialog').addClass('modal-lg');
                    $('.modal-title').text(obj.component);
                    $('.modal-body').html(obj.html);
                }
            });
            $('#myModal').modal('show');
            return false;
        });

        $('.editSection').click(function () {
            var key = $(this).data('sectioncode');
            var documentId = '<?= $document_id;?>';
            var templateId = '<?= $template_id;?>';
            $.ajax({
                url: '<?= SITE_ROOT; ?>/formview/load-selected-json/',
                data: {key: key,component:'section', documentId : documentId, templateId: templateId },
                success: function (data) {
                    var obj = $.parseJSON(data);
                    $('.modal-dialog').removeClass('modal-lg');
                    $('.modal-title').text(obj.component);
                    $('.modal-body').html(obj.html);
                }
            });
            $('#myModal').modal('show');
            return false;
        });
    });
</script>

<?= $footer; ?>