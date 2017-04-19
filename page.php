<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
    <div id="midtone-banner">
        <div class="container">
            <div class="row">
                <div class="col-mb-12 col-12">
                     <h1><?php $this->title() ?></h1>
                     <span class="description"><?php echo $this->getDescription(); ?></span>
                </div>
            </div>
        </div>
    </div>
<div class="midtone-post-wrap">
    <div class="container post-container">
        <div class="row">
            <div class="post-inner-content" id="post-article" itemprop="articleBody">
                 <div id="toc"></div>
                <?php $this->content(); ?>
            </div>
            <div class="post-inner-footer">
                <div class="post-inner-tags"><?php _e(''); ?><?php $this->tags('', true, ''); ?></div>
            </div>
            <?php $this->need('comments.php'); ?>
        </div>
    </div>
</div>
</div>

<?php $this->need('footer.php'); ?>
