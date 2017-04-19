<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
    <div id="midtone-banner">
        <div class="container">
            <div class="row">
                <div class="col-mb-12 col-12">
                     <h1>404</h1>
                     <span class="description"><?php _e('你想查看的页面已被转移或删除了, 要不要搜索看看: '); ?></span>
                </div>
            </div>
        </div>
    </div>
<div class="midtone-post-wrap">
    <div class="container post-container">
        <div class="row">
            <div class="post-inner-content" id="post-article" itemprop="articleBody">
                <form method="post">
                    <p><input type="text" name="s" class="text" autofocus /></p>
                    <p><button type="submit" class="submit">search</button></p>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<?php $this->need('footer.php'); ?>
