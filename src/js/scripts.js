
// Specify Google web fonts to load
WebFontConfig = {
  google: { families: [ 'Source+Sans+Pro:400,700,400italic:latin', 'Montserrat:700:latin' ] }
};

(function ($, window, document, undefined) {

  'use strict';

  $(function () {

    // Local app code goes here!
    // Remember, if adding global variables, add them to jshistrc file

    // Load Google Web Fonts:
    var wf = document.createElement('script');
    wf.src = ('https:' === document.location.protocol ? 'https' : 'http') +
      '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
    wf.type = 'text/javascript';
    wf.async = 'true';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(wf, s);

  });

})(jQuery, window, document);
