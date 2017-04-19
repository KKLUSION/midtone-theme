<?php
/**
* 全部文章归档
*
* @package custom
*/
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>
    <div id="midtone-banner">
        <div class="container">
            <div class="row">
                <div class="col-mb-12 col-12">
                     <h1><?php $this->title() ?></h1>
                     <span class="description">本博客共有 <?php $stat = Typecho_Widget::widget('Widget_Stat') ;echo "$stat->PublishedPostsNum"; ?> 篇文章</span>
                </div>
            </div>
        </div>
    </div>
<div class="midtone-post-wrap">
    <div class="container post-container">
        <div class="row">
        <div class="post-inner-content" id="post-article" itemprop="articleBody">
        <div id="toc"></div>
            <?php
                $stat = Typecho_Widget::widget('Widget_Stat');
                Typecho_Widget::widget('Widget_Contents_Post_Recent', 'pageSize='.$stat->publishedPostsNum)->to($archives);
                $year=0; $mon=0; $i=0; $j=0;
                $output = '<ul class="timeline">';
			    while($archives->next()):
			        $year_tmp = date('Y',$archives->created);
			        $mon_tmp = date('m',$archives->created);
			        $y=$year; $m=$mon;
			        if ($mon != $mon_tmp && $mon > 0) $output .= '</ul></li>';
			        if ($year != $year_tmp && $year > 0) $output .= '</ul>';
			        if ($year != $year_tmp) {
			            $year = $year_tmp;
			            $output .= '<h1>'. $year .' 年</h1><ul class="timeline-year">';
			        }
			        if ($mon != $mon_tmp) {
			            $mon = $mon_tmp;
			            $output .= '<li><h2>'. $year .' 年'. $mon .' 月</h2><ul class="timeline-month">';
			        }
			        $output .= '<li><a href="'.$archives->permalink .'">'. $archives->title .'</a></li>';
			    endwhile;
			    $output .= '</ul></li></ul><h1>开始</h1></ul>';
			    echo $output;
			?>
            </div>
        </div>
    </div>
</div>
</div>
<?php $this->need('footer.php'); ?>
