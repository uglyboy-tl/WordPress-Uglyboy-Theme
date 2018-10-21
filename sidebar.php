<!-- sidebar -->
<aside class="pure-u-1 pure-u-md-1-3" role="complementary">

    <?php get_template_part('searchform'); ?>

    <div class="sidebar-widget">
        <?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('widget-area-1')) ?>
    </div>

    <div class="sidebar-widget">
        <?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('widget-area-2')) ?>
    </div>

</aside>
<!-- /sidebar -->