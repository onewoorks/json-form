<div class='panel-heading panel-parent'>FORM DECORATION</div>
<div class='panel-body'>
    <div class='form-group form-group-sm'>
        <label class='control-label col-sm-4'>Label Name</label>
        <div class='col-sm-8'>
            <input type='text' name='deco_label_name' class='form-control' />
        </div>
    </div>

    <div class='form-group form-group-sm'>
        <label class='control-label col-sm-4'>Style</label>
        <div class='col-sm-8'>
            <div class="radio">
                <label>
                    <input type="radio" name="deco_style" value="panel-header" checked>
                    Panel Header
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="deco_style" value="heading-h1">
                    Heading (H1)
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="deco_style" value="heading-h2">
                    Heading (H2)
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="deco_style" value="heading-h3">
                    Heading (H3)
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="deco_style" value="custom-style">
                    Custom Style (CSS)
                </label>
            </div>
        </div>
    </div>
    <div id="customstyling">
        <div class='form-group form-group-sm'>
            <label class='control-label col-sm-4'>Custom Style (CSS)</label>
            <div class='col-sm-8'>
                <textarea rows="4" name='deco_custom_style' class='form-control'></textarea>
            </div>
        </div>
    </div>
</div>

<script>
    $(function(){
        $('#customstyling').hide();
        $('[name=deco_style]').on('change',function(){
            $('#customstyling').hide();
            var currentselect = $(this).val();
            if(currentselect==='custom-style'){
                $('#customstyling').show();
            }
        });
    });
    </script>