(function () {
    tinymce.PluginManager.add('ig_testimonials_mce_button', function( editor, url ) {
        editor.addButton( 'ig_testimonials_mce_button' ,{
            text: 'IG Testimonials',
            icon: false,
            type: 'menubutton',
            menu: [
                // ACCORDION
                {
                    text: 'Testimonials',
                    onclick: function() {
                    editor.insertContent('[ig-testimonials image="show"]');
                    },
                },
                // BUTTONS
                {
                    text: 'Testimonials gallery',
                    onclick: function() {
                    editor.insertContent('[ig-testimonials-carousel cat=""]');
                    },
                },
            ]
        });
    });
})();
