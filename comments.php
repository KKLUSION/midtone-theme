<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php function threadedComments($comments, $options) {

    if ($comments->url) {
        $author = '<a class="author-link" href="' . $comments->url . '" target="_blank"' . ' rel="external nofollow">' . $comments->author . '</a>';
        } else {
        $author = $comments->author;
    }

    if ($comments->url){
       $authorurl = '<a href="' . $comments->url . '" target="_blank"' . ' rel="external nofollow">' . $comments->url . '</a>';
      } else {
           $authorurl = $comments->url;
     }

    $commentClass = '';
    if ($comments->authorId) {
        if ($comments->authorId == $comments->ownerId) {
            $commentClass .= ' comment-by-author';
        } else {
            $commentClass .= ' comment-by-user';
        }
    }

    $commentLevelClass = $comments->levels > 0 ? ' comment-child' : ' comment-parent';


?>


<li id="li-<?php $comments->theId(); ?>" class="comment-body<?php
if ($comments->levels > 0) {
    echo ' comment-child';
    $comments->levelsAlt(' comment-level-odd', ' comment-level-even');
} else {
    echo ' comment-parent';
}
$comments->alt(' comment-odd', ' comment-even');
?>">
    <div id="<?php $comments->theId(); ?>" class="clearfix comment-ctrl">
        <div class="comment-right">
            <div class="comment-meta">
                <span class="fn <?php echo $commentClass; ?>"><?php echo $author; ?></span>
            </div>
        <div class="comment-replyface">
            <div class="comment-content">
                    <?php
                        if($comments->parent){
                            $p_comment = getPermalinkFromCoid($comments->parent);
                            $p_author = $p_comment['author'];
                            $p_text = mb_strimwidth(strip_tags($p_comment['text']), 0, 100,"...");
                            $p_href = $p_comment['href'];
                            echo "<span class='comment-at'><a href='$p_href' title='$p_text'>@ $p_author</a></span>";
                        }
                    ?>
                <?php $comments->content(); ?>
            </div>
            <div class="comment-replybody"><span class="comment-date" alt="<?php $comments->permalink(); ?>"><?php $comments->date('M d, Y'); ?></span><span class="comment-reply"  data-no-instant><?php $comments->reply(); ?></span></div>
        </div>
        </div>
        <div class="comment-avatar <?php echo $commentClass; ?>">
         <?php
            $host = 'https://secure.gravatar.com';
            $url = '/avatar/';
            $size = '';
            $rating = Helper::options()->commentsAvatarRating;
            $hash = md5(strtolower($comments->mail));
            $avatar = $host . $url . $hash . '?s=' . $size . '&r=' . $rating . '&d=mm';
            ?>
            <div class="comment-avaimg">
                <img class="avatar" src="<?php echo $avatar ?>" alt="<?php echo $comments->author; ?>" width="<?php echo $size ?>" height="<?php echo $size ?>" />
            </div><i></i>
        </div>
    </div>
<?php if ($comments->children) { ?>
    <div class="comment-children">
        <?php $comments->threadedComments($options); ?>
    </div>
<?php } ?>
</li>
<?php } ?>

<div id="comments" class="col-12">
    <?php $this->comments()->to($comments); ?>
    <?php if($this->allow('comment')): ?>
        <div class="comment-title">
            <h3><?php $this->commentsNum(_t('No Comment'), _t('1 Comment'), _t('%d Comments')); ?></h3>
        </div>
    <div id="<?php $this->respondId(); ?>" class="respond">
        <div id="loading"><div id="loader"><span class="loader_letter dark">L</span><span class="loader_letter dark">O</span><span class="loader_letter dark">A</span> <span class="loader_letter dark">D</span><span class="loader_letter dark">I</span><span class="loader_letter dark">N</span><span class="loader_letter dark">G</span><span class="loader_letter dark">.</span><span class="loader_letter dark">.</span><span class="loader_letter dark">.</span></div>
        </div>
        <div id="toosoon"><h5>您的发言过快...</h5>
        <span class="btn btn-grey toosoon-close">休息一会儿</span>
        </div>
        <div class="cancel-comment-reply"  data-no-instant>
            <?php $comments->cancelReply(); ?>
        </div>
        <form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form"  data-no-instant>
            <?php if($this->user->hasLogin()): ?>
            <div class="comment-inputcontent input-text">
               <textarea rows="8" cols="50" name="text" id="textarea" class="textarea" required ><?php $this->remember('text'); ?></textarea>
            </div>
            <div class="comment-login" data-no-instant>
            <?php _e('登录身份: '); ?><a class="midtone-link" href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a><a class="comment-logout" href="<?php $this->options->logoutUrl(); ?>" title="Logout"><?php _e('退出'); ?></a>
            </div>
            <?php else: ?>
            <div class="comment-inputcontent input-text">
               <div class="comment-cover"><i class="iconfont icon-comment"></i><span>LEAVE A COMMENT</span></div>
               <textarea rows="8" cols="50" name="text" id="textarea" class="textarea" required ><?php $this->remember('text'); ?></textarea>
            </div>
            <div id="comment-input-secondary">
                <div class="comment-name input-text">
                    <input type="text" name="author" id="author" class="text" placeholder="Name" value="<?php $this->remember('author'); ?>" required />
                </div>
                <div class="comment-mail input-text">
                    <input type="email" name="mail" id="mail" class="text" placeholder="E-mail" value="<?php $this->remember('mail'); ?>"<?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?> />
                </div>
                <div class="comment-url input-text">
                    <input type="url" name="url" id="url" class="text" placeholder="Website" placeholder="<?php _e('http://'); ?>" value="<?php $this->remember('url'); ?>"<?php if ($this->options->commentsRequireURL): ?> required<?php endif; ?> />
                </div>
                <?php endif; ?>
                <div class="comment-submit"><button type="submit" class="submit btn btn-grey submit-btn"><?php _e('SUBMIT'); ?></button></div>
            </div>
        </form>
    </div>
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
    <?php else: ?>
    <div class="comment-title">
        <h3><?php _e('评论已关闭'); ?></h3>
    </div>
    <?php endif; ?>
    <?php if ($comments->have()): ?>
    <div id="comment-main" class="col-12">
        <?php $comments->listComments(); ?>
        <?php $comments->pageNav('<', '>','1', '...'); ?>
    </div>
</div>

    <?php endif; ?>
