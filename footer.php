<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php if (!is_ajax()) { ?>

<footer id="footer" role="contentinfo">
<div class="container footerwrap">
<div class="row">
    <div class="autuor-maininfo"></div>
    <div class="footer-info"><span><a class="midtone-link" href="<?php $this->options->themeUrl('sitemap.xml'); ?>">Sitemap</a></span><span><a class="midtone-link" href="<?php $this->options->feedUrl(); ?>">RSS</a></span></div>
    <div class="copyrights">
	    <span>&copy; <?php echo date('Y'); ?> <a class="midtone-link" href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a>.</span>
	    <span><?php _e('Powered by <a class="midtone-link" href="http://www.typecho.org">Typecho</a>'); ?>.</span>
	    <span><?php _e('Theme by <a class="midtone-link" href="https://blog.mizodo.com">mizodo</a>'); ?>.</span>
    </div>
	<script src="<?php $this->options->themeUrl('dist/js/jquery.min.js'); ?>"></script>
	<script src="<?php $this->options->themeUrl('dist/js/instantclick.min.js'); ?>" data-no-instant></script>
    <script src="<?php $this->options->themeUrl('dist/js/lazyload.js'); ?>"></script>
    <script src="<?php $this->options->themeUrl('dist/js/particles.min.js'); ?>"></script>
    <script src="<?php $this->options->themeUrl('dist/js/highlight.min.js'); ?>"></script>
    <script src="<?php $this->options->themeUrl('dist/js/midtone-theme.js'); ?>"></script>
    <script data-no-instant>InstantClick.init();if (typeof ga !== 'undefined'){
        ga('send', 'pageview', location.pathname + location.search);
}
</script>
</div>
</div>
</footer><!-- end #footer -->

<?php $this->footer(); ?>
</body>
</html>
<?php } ?>

