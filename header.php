<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php if (!is_ajax()) { ?>

<!DOCTYPE HTML>
<html class="no-js">
<head>
    <meta charset="<?php $this->options->charset(); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">

    <title><?php $this->archiveTitle(array(
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ' - '); ?><?php $this->options->title(); ?></title>

    <!-- 使用url函数转换相关路径 -->
    <link rel="stylesheet" href="//cdnjscn.b0.upaiyun.com/libs/normalize/2.1.3/normalize.min.css">
    <link rel="stylesheet" href="//at.alicdn.com/t/font_58ijpzch4ew89f6r.css">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('dist/css/grid.css'); ?>">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('dist/css/style.css'); ?>">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('dist/css/highlight.css'); ?>">
    <script src="<?php $this->options->themeUrl('dist/js/rem.js'); ?>"></script>

    <!--[if lt IE 9]>
    <script src="//cdnjscn.b0.upaiyun.com/libs/html5shiv/r29/html5.min.js"></script>
    <script src="//cdnjscn.b0.upaiyun.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <!-- 通过自有函数输出HTML头部信息 -->
    <?php $this->header(); ?>
</head>
<body>
<!--[if lt IE 8]>
    <div class="browsehappy" role="dialog"><?php _e('当前网页 <strong>不支持</strong> 你正在使用的浏览器. 为了正常的访问, 请 <a href="http://browsehappy.com/">升级你的浏览器</a>'); ?>.</div>
<![endif]-->
    <div class="wrap">
        <div id="mb-navigation">
            <a href="#" class="button-toggle-navigation">
                <span>Toggle Navigation</span>
            </a>
            <ul class="mb-nav-menu">
                <li<?php if($this->is('index')): ?> class="current"<?php endif; ?>><a href="<?php $this->options->siteUrl(); ?>"><?php _e('首页'); ?></a></li>
                  <?php $this->widget('Widget_Metas_Category_List')->to($category); ?>
                    <?php while ($category->next()): ?>
                    <li<?php if ($this->is('post')): ?><?php if ($this->category == $category->slug): ?> class="current"<?php endif; ?><?php else: ?><?php if ($this->is('category', $category->slug)): ?> class="current"<?php endif; ?><?php endif; ?>><a href="<?php $category->permalink(); ?>" title="<?php $category->name(); ?>"><?php $category->name(); ?></a></li>
                    <?php endwhile; ?>
                <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
                    <?php while($pages->next()): ?>
                        <li<?php if($this->is('page', $pages->slug)): ?> class="current"<?php endif; ?>><a href="<?php $pages->permalink(); ?>" title="<?php $pages->title(); ?>"><?php $pages->title(); ?></a></li>
                        <?php endwhile; ?>
                 <li id="search-bar"><a href="javascript:void(0)"><i class="iconfont icon-search"></i></a></li>
            </ul>
        </div>
        <div id="header">
             <div class="head container">
                   <div class="row">
                       <div id="midtone-logo" class="col-mb-6 col-3">
                         <?php if ($this->options->logoUrl): ?>
                               <a href="<?php $this->options->siteUrl(); ?>">
                                <img src="<?php $this->options->logoUrl() ?>" alt="<?php $this->options->title() ?>" />
                               </a>
                         <?php else: ?>
                               <a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title() ?></a>
                         <?php endif; ?>
                       </div>
                       <a href="#" class="menu" title="menu"><i class="menu-bar"></i></a>
                       <ul id="nav-menu" class="col-mb-6 col-9">
                       <li id="search-bar"><a href="javascript:void(0)"><i class="iconfont icon-search"></i></a></li>
                            <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
                                <?php while($pages->next()): ?>
                                    <li<?php if($this->is('page', $pages->slug)): ?> class="current"<?php endif; ?>><a href="<?php $pages->permalink(); ?>" title="<?php $pages->title(); ?>"><?php $pages->title(); ?></a></li>
                                    <?php endwhile; ?>
                                <?php $this->widget('Widget_Metas_Category_List')->to($category); ?>
                                <?php while ($category->next()): ?>
                                <li<?php if ($this->is('post')): ?><?php if ($this->category == $category->slug): ?> class="current"<?php endif; ?><?php else: ?><?php if ($this->is('category', $category->slug)): ?> class="current"<?php endif; ?><?php endif; ?>><a href="<?php $category->permalink(); ?>" title="<?php $category->name(); ?>"><?php $category->name(); ?></a></li>
                                <?php endwhile; ?>
                            <li<?php if($this->is('index')): ?> class="current"<?php endif; ?>><a href="<?php $this->options->siteUrl(); ?>"><?php _e('首页'); ?></a></li>

                        </ul>
                   </div>
             </div>
        </div>
        <div id="site-search">
            <div class="search-input">
                <form id="search" method="post" action="<?php $this->options->siteUrl(); ?>" role="search">
                    <input type="text" name="s" class="text" placeholder="请输入搜索内容并回车搜索" autoComplete="off" />
                </form>
            </div>
            <div class="search-close">
                <span class="bar1"></span>
                <span class="bar2"></span>
            </div>
        </div>
        <?php if (!empty($this->options->enableParticles)): ?>
          <div id="particles-bg"></div>
        <?php endif; ?>
<?php } ?>

