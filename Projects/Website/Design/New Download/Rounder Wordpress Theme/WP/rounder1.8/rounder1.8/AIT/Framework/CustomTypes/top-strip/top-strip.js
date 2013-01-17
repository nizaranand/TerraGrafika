jQuery(document).ready(function() {

    		// init
    		switch(jQuery("#ait-stripItemCategory option:selected").attr("value"))
        {
          case "custom":
            jQuery("#ait-stripItemContentWidth-option").show();           
            break;
          default:
            jQuery("#ait-stripItemContentWidth-option").hide();
            break;
        }
        
        // change
    		jQuery('#ait-stripItemCategory').change(function(){
          switch(jQuery("#ait-stripItemCategory option:selected").attr("value"))
          {
            case "custom":
            jQuery("#ait-stripItemContentWidth-option").show();           
            break;
            default:
            jQuery("#ait-stripItemContentWidth-option").hide();
            break;
          }   
        });
           
});