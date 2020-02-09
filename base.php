
<?php

use Roots\Sage\Setup;
use Roots\Sage\Wrapper;

?>

<!doctype html>
<html <?php language_attributes(); ?>>

<?php get_template_part('templates/head'); ?>

<body <?php body_class(); ?>>
    <!--[if IE]>
        <div class="alert alert-warning">
        Du använder en <strong>utdaterad</strong> webbläsare som inte längre stöds. För bästa upplevelse <a href="http://browsehappy.com/" target="_blank">uppdatera din webbläsare</a>.
        </div>
    <![endif]-->
    <?php
        do_action('get_header');
        get_template_part('templates/content','header');
    ?>

    <main class="wrap" role="document">

        <?php include Wrapper\template_path(); ?>

    </main><!-- /.wrap -->

    <?php
        get_template_part('templates/includes/part','cookie-consent');

        do_action('get_footer');
        get_template_part('templates/content','footer');
        wp_footer();
    ?>

    <!-- Conditional Lazyload -->
    <script type="text/javascript">
    (function(w, d){
    var b = d.getElementsByTagName('body')[0];
    var s = d.createElement("script"); s.async = true;
    var v = !("IntersectionObserver" in w) ? "8.6.0" : "10.4.1";
    s.src = "<?= get_template_directory_uri(); ?>/assets/scripts/lazyload."+v+".min.js";
    w.lazyLoadOptions = {
        threshold: 500,
        elements_selector: ".lazyload"
    }; // Your options here. See "recipes" for more information about async.
    b.appendChild(s);
    }(window, document));
    </script>
    <!-- End Conditional Lazyload -->
    
</body>
</html>