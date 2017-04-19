<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php if (!is_ajax()) { ?>

<footer id="footer" role="contentinfo">
    <div class="autuor-maininfo"></div>
    <div class="copyrights">
	    <span>&copy; <?php echo date('Y'); ?> <a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a>.</span>
	    <span><?php _e('由 <a href="http://www.typecho.org">Typecho</a> 强力驱动'); ?>.</span>
	    <span><?php _e('Theme by <a href="https://blog.mizodo.com">mizodo</a>'); ?></span>
    </div>
	<script src="<?php $this->options->themeUrl('js/jquery.min.js'); ?>"></script>
	<script src="<?php $this->options->themeUrl('js/instantclick.min.js'); ?>" data-no-instant></script>
    <script src="<?php $this->options->themeUrl('js/lazyload.js'); ?>"></script>
    <script src="<?php $this->options->themeUrl('js/particles.min.js'); ?>"></script>
    <script src="<?php $this->options->themeUrl('js/highlight.js'); ?>"></script>
    <script src="<?php $this->options->themeUrl('js/midtone-theme.js'); ?>"></script>
    <script data-no-instant>InstantClick.init();if (typeof ga !== 'undefined'){
        ga('send', 'pageview', location.pathname + location.search);
}
</script>
</footer><!-- end #footer -->

<?php $this->footer(); ?>
</body>
</html>
<?php } ?>

