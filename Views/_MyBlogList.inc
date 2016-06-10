<div class="container">
    <h2>Posts</h2>
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
                <p><?php self::out($post->getContent());?></p>
                <br>
                <?php self::actionLink('<span class="glyphicon glyphicon-pencil"></span> Edit', 'EditPost','Main','btn btn-default btn-sm',
                    array('postId' => $post->getId()))?>
                <?php self::actionLink('<span class="glyphicon glyphicon-minus"></span> Delete', 'DeletePost','Main','btn btn-default btn-sm',
                    array('postId' => $post->getId()))?>
                <hr>
            <?php endforeach; ?>
        </div>
    </div>
</div>