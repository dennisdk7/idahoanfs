// Add button to TinyMCE editor for adding product listing to a page
(function() {
   tinymce.create('tinymce.plugins.productlist', {
      init : function(ed, url) {
         ed.addButton('productlist', {
            title : 'List Products From Category',
            image : url+'/idahoan_button.png',
            onclick : function() {
               var pcategory = prompt("Which category? (Options: premium, real, signature, value-advantage, casseroles, hashbrowns, canada, fortified, gluten-free, halal, kosher, kosher-d, low-sodium, zero-trans-fat-grams, no-bha-bht)", "");

              if (pcategory != null && pcategory != '')
                 ed.execCommand('mceInsertContent', false, '[listproducts category="'+pcategory+'"]');
              else
                 ed.execCommand('mceInsertContent', false, '[listproducts]');
            }
         });
      },
      createControl : function(n, cm) {
         return null;
      },
      getInfo : function() {
         return {
            longname : "List Products From Category",
            author : 'Foerstel creative + results',
            authorurl : 'http://www.foerstel.com',
            infourl : 'http://www.foerstel.com',
            version : "1.0"
         };
      }
   });
   tinymce.PluginManager.add('productlist', tinymce.plugins.productlist);
})();