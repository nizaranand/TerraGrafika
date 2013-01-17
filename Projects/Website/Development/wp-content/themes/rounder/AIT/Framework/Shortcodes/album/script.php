<?php echo is_admin(); ?>

// JavaScript Document
(function() {
    // Creates a new plugin class and a custom listbox
    tinymce.create('tinymce.plugins.ait_shortcodes_album', {
        createControl: function(n, cm) {
            switch (n) {                
                case 'ait_shortcodes_album':
                var c = cm.createSplitButton('ait_shortcodes_album', {
                    title : 'Album shortcodes',
                    image : jQuery('#editor-theme-url').text() + '/AIT/Framework/Shortcodes/album/icon.png',
                    onclick : function() {
                    	
                    	//tinyMCE.activeEditor.windowManager.alert("hello");
                    	
                    	/*
                    	tinyMCE.activeEditor.windowManager.open({
						   url : jQuery('#editor-theme-url').text() + '/AIT/Framework/Shortcodes/album/modal.html',
						   width : 320,
						   height : 240,
						   inline : 1
						}, {
						   custom_param : 1
						});
						*/
						
						/* Displays an confirm box and an alert message will be displayed depending on what you choose in the confirm
						tinyMCE.activeEditor.windowManager.confirm("Do you want to do something", function(s) {
						   if (s)
						      tinyMCE.activeEditor.windowManager.alert("Ok");
						   else
						      tinyMCE.activeEditor.windowManager.alert("Cancel");
						});
						*/
                    }
                });

                c.onRenderMenu.add(function(c, m) {
					// Album
					m.add({title : 'Album', 'class' : 'mceMenuItemTitle'}).setDisabled(1);
                    m.add({title : 'Most recent album', onclick : function() {
                        tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[get_posts number="3" excerpt="290"]' );
                    }});
                    m.add({title : 'Album by category ID', onclick : function() {
                        tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[get_posts_category number="3" category="7" excerpt="290"]' );
                    }});
					m.add({title : 'Custom album by ID', onclick : function() {
                        tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, '[get_post id="55" excerpt="290"]' );
                    }});
                });

                // Return the new splitbutton instance
                return c;
                
            }
            return null;
        }
    });
    tinymce.PluginManager.add('ait_shortcodes_album', tinymce.plugins.ait_shortcodes_album);
})();
