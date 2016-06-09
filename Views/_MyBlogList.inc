<div class="container">
    <h2>Posts</h2>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <button type="button" class="btn btn-default btn-sm">
                <span class="glyphicon glyphicon-plus"></span> Plus
            </button>
        </div>
        <div class="panel-body">
            <?php foreach($model->blogPosts as $post): ?>
                <h2 class="title"><?php self::out($post->getTitle()); ?></h2>
                <p class="info"><span class="glyphicon glyphicon-time"></span> Erstellt am: <?php self::out($post->getCreatedAt());?></p>
                <br>
                <p><?php self::out($post->getContent());?></p>
                <br>

                <button class="btn btn-sm">
                    <span class="glyphicon glyphicon-pencil"></span> Editieren
                </button>
                <button class="btn btn-sm">
                    <span class="glyphicon glyphicon-minus"></span> Löschen
                </button>
                <hr>
            <?php endforeach; ?>
        </div>
    </div>
</div>