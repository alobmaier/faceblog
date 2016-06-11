<div class="container">
    <h2 class="fat">My Posts</h2>
    <br>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <?php self::actionLink('<span class="glyphicon glyphicon-plus"></span> New Post', 'AddPost','Main','btn btn-default btn-sm')?>
        </div>
        <div class="panel-body">
            <?php foreach($model->blogPosts as $post): ?>
                <h2 class="title"><?php self::out($post->getTitle()); ?></h2>
                <p class="info"><span class="glyphicon glyphicon-time"></span> Created on: <?php self::out($post->getCreatedAt());?></p>
                <p class="info"><span class="glyphicon glyphicon-time"></span> Latest change on: <?php self::out($post->getUpdatedAt());?></p>
                <br>
                <p>
                    <?php echo nl2br(str_replace('\r\n',"\r\n",$post->getContent()));?>
                </p>
                <br>
                <?php self::actionLink('<span class="glyphicon glyphicon-pencil"></span> Edit', 'EditPost','Main','btn btn-default btn-sm',
                    array('postId' => $post->getId()))?>
                <?php self::actionLink('<span class="glyphicon glyphicon-minus"></span> Delete', 'DeletePost','Main','btn btn-default btn-sm',
                    array('postId' => $post->getId()))?>
                <br>
                <br>
                <?php if(sizeof($post->getLikeNames()) > 0):?>
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