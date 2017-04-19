<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php if (!is_ajax()) { ?>

<footer id="footer" role="contentinfo">
    <div class="autuor-maininfo"></div>
    <div class="copyrights">
	    <span>&copy; <?php echo date('Y'); ?> <a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a>.</span>
	    <span><?php _e('由 <a href="http://www.typecho.org">Typecho</a> 强力驱动'); ?>.</span>
	    <span><?php _e('Theme by <a href="https://blog.mizodo.com">mizodo</a>'); ?></span>
    </div>
    <?php if($this->allow('comment')): ?>
    <script type="text/javascript">
    (function() {
        window.TypechoComment = {
            dom: function(id) {
                return document.getElementById(id);
            },
            create: function(tag, attr) {
                var el = document.createElement(tag);
                for (var key in attr) {
                    el.setAttribute(key, attr[key]);
                }
                return el;
            },
            reply: function(cid, coid) {
                var comment = this.dom(cid),
                    parent = comment.parentNode,
                    response = this.dom('<?php echo $this->respondId(); ?>'),
                    input = this.dom('comment-parent'),
                    form = 'form' == response.tagName ? response : response.getElementsByTagName('form')[0],
                    textarea = response.getElementsByTagName('textarea')[0];
                if (null == input) {
                    input = this.create('input', {
                        'type': 'hidden',
                        'name': 'parent',
                        'id': 'comment-parent'
                    });
                    form.appendChild(input);
                }
                input.setAttribute('value', coid);
                if (null == this.dom('comment-form-place-holder')) {
                    var holder = this.create('div', {
                        'id': 'comment-form-place-holder'
                    });
                    response.parentNode.insertBefore(holder, response);
                }
                comment.appendChild(response);
                this.dom('cancel-comment-reply-link').style.display = '';
                if (null != textarea && 'text' == textarea.name) {
                    textarea.focus();
                }
                return false;
            },
            cancelReply: function() {
                var response = this.dom('<?php echo $this->respondId(); ?>'),
                    holder = this.dom('comment-form-place-holder'),
                    input = this.dom('comment-parent');
                if (null != input) {
                    input.parentNode.removeChild(input);
                }
                if (null == holder) {
                    return true;
                }
                this.dom('cancel-comment-reply-link').style.display = 'none';
                holder.parentNode.insertBefore(response, holder);
                return false;
            }
        };
    })();
    </script>
    <?php endif; ?>
	<script src="<?php $this->options->themeUrl('js/jquery.min.js'); ?>"></script>
	<script src="<?php $this->options->themeUrl('js/instantclick.min.js'); ?>" data-no-instant></script>
    <script src="<?php $this->options->themeUrl('js/lazyload.js'); ?>"></script>
    <script src="<?php $this->options->themeUrl('js/particles.min.js'); ?>"></script>
    <script src="<?php $this->options->themeUrl('js/highlight.js'); ?>"></script>
    <script src="<?php $this->options->themeUrl('js/midtone-theme.js'); ?>"></script>
    <script data-no-instant>InstantClick.init();if (typeof ga !== 'undefined'){
        ga('send', 'pageview', location.pathname + location.search);
} </script>
</footer><!-- end #footer -->

<?php $this->footer(); ?>
</body>
</html>
<?php } ?>

