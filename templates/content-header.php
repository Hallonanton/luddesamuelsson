
<div id="menu-btn" class="menu-btn">
    <div class="menu-row top"></div>
    <div class="menu-row mid"></div>
    <div class="menu-row bot"></div>                        
</div>

<?php if (has_nav_menu('primary_navigation')) : ?>
    <div id="main-nav" class="main-navigation">
        
        <?php wp_nav_menu([
            'theme_location' => 'primary_navigation',
            'container'      => false,
            'menu_class'     => 'menu-list link-list'
        ]); ?>

        <?php output_socialmedia(); ?>

    </div>
<?php endif; ?>