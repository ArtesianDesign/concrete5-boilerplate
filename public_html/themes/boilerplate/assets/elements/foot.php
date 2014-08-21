<?php  defined('C5_EXECUTE') or die("Access Denied."); ?>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="<?php  echo $this->getThemePath(); ?>/assets/components/jquery.js"><\/script>');</script>
    <script src="<?php  echo $this->getThemePath(); ?>/assets/js/scripts.min.js"></script>

    <?php
    // Google Analytics: (do this through the CMS)
    /* ?>
    <script>
    (function(f,i,r,e,s,h,l){i['GoogleAnalyticsObject']=s;f[s]=f[s]||function(){
    (f[s].q=f[s].q||[]).push(arguments)},f[s].l=1*new Date();h=i.createElement(r),
    l=i.getElementsByTagName(r)[0];h.async=1;h.src=e;l.parentNode.insertBefore(h,l)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    ga('create', 'UA-XXXXXXXX-XX');
    ga('send', 'pageview');
    </script>
    <?php  */ ?>

<?php   Loader::element('footer_required'); ?>

  </body>
</html>
