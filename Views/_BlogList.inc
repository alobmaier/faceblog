<div class="container">
    <h2 class="fat">Posts</h2>
    <br>
    <div class="panel panel-primary">
        <div class="panel-heading">
        </div>
        <div class="panel-body">
            <?php foreach($model->blogPosts as $post): ?>
                <?php $isLiked = in_array($model->user->getId(), $post->getLikes()); ?>
                <h2 class="title"><?php echo stripcslashes(nl2br(htmlentities(str_replace('\r\n',"\r\n",$post->getTitle())))) ?></h2>
                <p class="info"><span class="glyphicon glyphicon-time"></span> Created on: <?php self::out(self::formatTime($post->getCreatedAt()));?></p>
                <p class="info"><span class="glyphicon glyphicon-time"></span> Latest change on: <?php self::out(self::formatTime($post->getUpdatedAt()));?></p>
                <br>
                <p>
                    <?php echo stripcslashes(nl2br(htmlentities(str_replace('\r\n',"\r\n",$post->getContent()))));?>
                </p>
                <br>
                <?php if(!$isLiked): ?>
                    <?php self::beginActionForm('LikePost','Main',
                        array('postId' => $post->getId(), 'context' => $model->context),'post')?>
                        <button type="submit" class="btn btn-primary">
                            <span class="glyphicon glyphicon-thumbs-up"></span> Like
                        </button>
                    <?php self::endActionForm()?>
                <?php else: ?>
                    <?php self::beginActionForm('UnlikePost','Main',
                        array('postId' => $post->getId(), 'context' => $model->context),'post')?>
                    <button type="submit" class="btn btn-warning">
                        <span class="glyphicon glyphicon-thumbs-down"></span> Unlike
                    </button>
                    <?php self::endActionForm()?>
                <?php endif;?>
                <br>
                <?php if(sizeof($post->getLikeNames() > 0)):?>
                    <?php $names = implode(', ',$post->getLikeNames())?>
                    <span><strong>Liked by:
                            <?php self::out($names)?></strong>
                    </span>
                <?php endif;?>
                <hr>
            <?php endforeach; ?>
        </div>
    </div>
</div>