<div class="sidebar-widget pure-u-1">
    <?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('widget-area-2')) ?>
</div>

<!-- footer -->
<footer class="pure-u-1" role="contentinfo">

    <!-- copyright -->
    <span class="">
        <?php _e( 'Copyright', 'uglyboy' ); ?> &copy;
        <?php echo date('Y'); ?> <a href="<?php echo home_url(); ?>" title="UglyBoy">
            <?php bloginfo('name'); ?></a>.
    </span>
    <!-- /copyright -->

</footer>
<!-- /footer -->

<?php wp_footer(); ?>
</body>

</html>