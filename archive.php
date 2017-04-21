<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

    <div id="midtone-banner">
        <div class="container">
            <div class="row">
                <div class="col-mb-12 col-12">
                     <h1><?php $this->archiveTitle(array(
            'category'  =>  _t('%s'),
            'search'    =>  _t('# %s'),
            'tag'       =>  _t('# %s'),
            'author'    =>  _t('%s')
        ), '', ''); ?></h1>
                     <span class="description"><?php echo $this->getDescription(); ?></span>
                </div>
            </div>
        </div>
    </div>
    <div class="midtone-post-wrap">
    <div class="container midtone-postlist">
        <div class="row">
        <?php if ($this->have()): ?>
        <div id="post-style"><span class="post-style-cubes currentstyle"><i class="iconfont icon-card"></i></span><span class="post-style-lines"><i class="iconfont icon-liebiao"></i></span></div>
        <?php while($this->next()): ?>
            <div class="midtone-post col-12 col-md-12">
                <div class="post-article">
                    <h2 class="post-title" itemprop="name headline"><a itemtype="url" href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h2>
                    <div class="post-meta">
                        <span class="post-meta-dash"><?php _e(''); ?><time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date(); ?></time></span>
                        <span class="post-meta-dash"><?php _e('In&nbsp;&nbsp;'); ?><?php $this->category(','); ?></span>
                        <span><?php get_post_view($this) ?><?php _e('&nbsp;&nbsp;views'); ?></span>
                    </div>
                    <?php if(isset($this->fields->post_cover)){  ?>
                    <div class="post-cover">
                            <img src="<?php echo $this->fields->post_cover;?>"/>
                    </div>
                    <?php };?>
                    <div class="post-content" itemprop="articleBody">
                        <a itemtype="url" href="<?php $this->permalink() ?>"><?php $this->excerpt(300, '...'); ?></a>
                    </div>
                    <a href="<?php $this->permalink() ?>"><button class="btn btn-primary">Read On</button></a>
                    <span class="post-comments" itemprop="interactionCount"><a itemprop="discussionUrl" href="<?php $this->permalink() ?>#comments"><?php $this->commentsNum('<i class="iconfont icon-comment"></i>-', '<i class="iconfont icon-comment"></i>1', '<i class="iconfont icon-comment"></i>%d'); ?></a></span>
                </div>
            </div>
        <?php endwhile; ?>
            <div class="page-parameter col-mb-12">
                <span><?php if($this->_currentPage>1) echo $this->_currentPage;  else echo 1;?><?php echo ' / ';?><?php echo ceil($this->getTotal() / $this->parameter->pageSize); ?></span>
                <?php $this->pageLink('<span class="btn btn-grey">next</span>', 'next') ?>
                <?php $this->pageLink('<span class="btn btn-grey">prev</span>', 'prev') ?>
            </div>
            <?php else: ?>
                <h5>no thing</h5>
         <?php endif; ?>
        </div>
        </div>
    </div>

    </div>

	<?php $this->need('footer.php'); ?>
