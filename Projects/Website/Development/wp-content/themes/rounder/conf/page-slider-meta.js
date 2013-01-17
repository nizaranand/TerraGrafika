jQuery(document).ready(function() {
    chooseDisplay(jQuery("select.ait-sliderType-option").val());

    jQuery("select.ait-sliderType-option").click(function(){
        chooseDisplay(jQuery("select.ait-sliderType-option").val());
    });
});

function chooseDisplay(value){
    switch(value){
        case "anything":
            hideMetabox('#ait-_ait_slider_options-sliderAliases-option');
            hideMetabox('#ait-_ait_slider_options-sliderAlternative-option');
            showMetabox('#ait-_ait_slider_options-sliderCategory-option');
            showMetabox('#ait-_ait_slider_options-sliderHeight-option');
        break;
        case "revolution":
            showMetabox('#ait-_ait_slider_options-sliderAliases-option');
            showMetabox('#ait-_ait_slider_options-sliderAlternative-option');
            hideMetabox('#ait-_ait_slider_options-sliderCategory-option');
            hideMetabox('#ait-_ait_slider_options-sliderHeight-option');
        break;
    }
} 

function hideMetabox(id){
    jQuery(id).hide();
}

function showMetabox(id){
    jQuery(id).show();
}