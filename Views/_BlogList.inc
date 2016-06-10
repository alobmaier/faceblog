<div class="container">
    <h2>Posts</h2>
    <div class="panel panel-primary">
        <div class="panel-heading">
        </div>
        <div class="panel-body">
            <?php foreach($model->blogPosts as $post): ?>
                <h2 class="title"><?php self::out($post->getTitle()); ?></h2>
                <p class="info"><span class="glyphicon glyphicon-time"></span> Erstellt am: <?php self::out($post->getCreatedAt());?></p>
                <p class="info"><span class="glyphicon glyphicon-time"></span> Zuletzt geändert am: <?php self::out($post->getUpdatedAt());?></p>
                <br>
                <p><?php self::out($post->getContent());?></p>
                <hr>
            <?php endforeach; ?>
        </div>
    </div>
</div>