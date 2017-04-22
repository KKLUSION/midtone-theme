<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

function themeConfig($form) {
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, NULL, _t('站点 LOGO 地址'), _t('在这里填入一个图片 URL 地址, 以在网站标题前加上一个 LOGO'));
    $form->addInput($logoUrl);

    $sidebarBlock = new Typecho_Widget_Helper_Form_Element_Checkbox('sidebarBlock',
    array('ShowRecentPosts' => _t('显示最新文章'),
    'ShowRecentComments' => _t('显示最近回复'),
    'ShowCategory' => _t('显示分类'),
    'ShowArchive' => _t('显示归档'),
    'ShowOther' => _t('显示其它杂项')),
    array('ShowRecentPosts', 'ShowRecentComments', 'ShowCategory', 'ShowArchive', 'ShowOther'), _t('侧边栏显示'));

    $form->addInput($sidebarBlock->multiMode());

    $enableParticles = new Typecho_Widget_Helper_Form_Element_Checkbox('enableParticles',
        array('enableParticle' => _t('开启')),
        array('enableParticle'), _t('是否开启背景粒子效果(默认开启)'));

    $form->addInput($enableParticles);
}


function get_post_view($archive)
{
    $cid    = $archive->cid;
    $db     = Typecho_Db::get();
    $prefix = $db->getPrefix();
    if (!array_key_exists('views', $db->fetchRow($db->select()->from('table.contents')))) {
        $db->query('ALTER TABLE `' . $prefix . 'contents` ADD `views` INT(10) DEFAULT 0;');
        echo 0;
        return;
    }
    $row = $db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $cid));
    if ($archive->is('single')) {
 $views = Typecho_Cookie::get('extend_contents_views');
        if(empty($views)){
            $views = array();
        }else{
            $views = explode(',', $views);
        }
if(!in_array($cid,$views)){
       $db->query($db->update('table.contents')->rows(array('views' => (int) $row['views'] + 1))->where('cid = ?', $cid));
array_push($views, $cid);
            $views = implode(',', $views);
            Typecho_Cookie::set('extend_contents_views', $views);
        }
    }
    echo $row['views'];
}


function theNext($widget, $default = NULL){
    $db = Typecho_Db::get();
    $sql = $db->select()->from('table.contents')
    ->where('table.contents.created > ?', $widget->created)
    ->where('table.contents.status = ?', 'publish')
    ->where('table.contents.type = ?', $widget->type)
    ->where('table.contents.password IS NULL')
    ->order('table.contents.created', Typecho_Db::SORT_ASC)
    ->limit(1);
    $content = $db->fetchRow($sql);

    if ($content) {
    $content = $widget->filter($content);
    $link = '<div class="next col-6"><a href="' . $content['permalink'] . '" title="' . $content['title'] . '"><span class="btn btn-grey">NEXT</span></a><span class="page-next-link" >' . $content['title'] . '</span></div>';
    echo $link;
    } else {
    $nomorenext = '<div class="next col-6"></div>';
    echo $nomorenext;
    }
}


function thePrev($widget, $default = NULL){
    $db = Typecho_Db::get();
    $sql = $db->select()->from('table.contents')
    ->where('table.contents.created < ?', $widget->created)
    ->where('table.contents.status = ?', 'publish')
    ->where('table.contents.type = ?', $widget->type)
    ->where('table.contents.password IS NULL')
    ->order('table.contents.created', Typecho_Db::SORT_DESC)
    ->limit(1);
    $content = $db->fetchRow($sql);

    if ($content) {
    $content = $widget->filter($content);
    $link = '<div class="prev col-6"><a href="' . $content['permalink'] . '" title="' . $content['title'] . '"><span class="btn btn-grey">PREV</span></a><span class="page-prev-link" >' . $content['title'] . '</span></div>';
    echo $link;
    } else {
    $nomoreprev = '<div class="prev col-6"></div>';
    echo $nomoreprev;
    }
}

function is_ajax()
{
    if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
        if ('xmlhttprequest' == strtolower($_SERVER['HTTP_X_REQUESTED_WITH'])) {
            return true;
        }
    }
    return false;
}

function getPermalinkFromCoid($coid) {
    $db       = Typecho_Db::get();
    $options  = Typecho_Widget::widget('Widget_Options');
    $contents = Typecho_Widget::widget('Widget_Abstract_Contents');

    $row = $db->fetchRow($db->select('cid, type, author, text')->from('table.comments')
              ->where('coid = ? AND status = ?', $coid, 'approved'));

    if (empty($row)) return 'Comment not found!';
    $cid = $row['cid'];

    $select = $db->select('coid, parent')->from('table.comments')
              ->where('cid = ? AND status = ?', $cid, 'approved')->order('coid');

    if ($options->commentsShowCommentOnly)
        $select->where('type = ?', 'comment');

    $comments = $db->fetchAll($select);

    if ($options->commentsOrder == 'DESC')
        $comments = array_reverse($comments);

    foreach ($comments as $key => $val)
        $array[$val['coid']] = $val['parent'];
    $i = $coid;
    while ($i != 0) {
        $break = $i;
        $i = $array[$i];
    }

    $count = 0;
    foreach ($array as $key => $val) {
        if ($val == 0) $count++;
        if ($key == $break) break;
    }

    $parentContent = $contents->push($db->fetchRow($contents->select()->where('table.contents.cid = ?', $cid)));
    $permalink = rtrim($parentContent['permalink'], '/');

    $page = ($options->commentsPageBreak)
          ? '/comment-page-' . ceil($count / $options->commentsPageSize)
          : ( substr($permalink, -5, 5) == '.html' ? '' : '/' );

    return array(
        "author" => $row['author'],
        "text" => $row['text'],
        "href" => "{$permalink}{$page}#{$row['type']}-{$coid}"
    );
}