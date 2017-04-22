<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
    <div id="midtone-banner">
        <div class="container">
            <div class="row">
                <div class="col-mb-12 col-12">
                     <h1>404</h1>
                     <span class="description">back to home in <span id="jumpTo"></span> ...</span>
                </div>
            </div>
        </div>
    </div>
<div class="midtone-post-wrap">
    <div id="bunnyRunner">
        <div class="bunnyrun">
            <span class="bunny-white bunnyjump bunnyrunner"></span>
        </div>
    </div>
    <div class="container post-container">
        <div class="row">
            <div class="post-inner-content" id="post-article" itemprop="articleBody">
            </div>
        </div>
    </div>
</div>
</div>
<script>
function countDown(secs,surl){
 var jumpTo = document.getElementById('jumpTo');
 jumpTo.innerHTML=secs;
 if(--secs>0){
  setTimeout("countDown("+secs+",'"+surl+"')",1000);
 }
 else
 {
  location.href=surl;
 }
}
countDown(5,'<?php $this->options->siteUrl(); ?>');
</script>
<?php $this->need('footer.php'); ?>
