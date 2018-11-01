<aside class="pure-u-1">
    <div class="sidebar-widget">
        <?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('widget-area-2')) ?>
    </div>
</aside>
<!-- footer -->
<footer class="pure-u-1 center bg-color" role="contentinfo">

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
<script>
    window.Zepto || document.write('<script src="js/vendor/zepto.min.js"><\/script>')
</script>
</body>

</html>