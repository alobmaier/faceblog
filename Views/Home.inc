<?php require '_Header.inc';?>
<div class="container">
    <h2>Welcome</h2>
    <h5>Welcome to FaceBlog</h5>
    <br>
    <div class="panel panel-primary">
        <div class="panel-heading">
            Stats
        </div>
        <div class="panel-body">
            <p>amount of registered users: <strong><?php self::out($model->countusers)?></strong></p>
            <hr>
            <p>total amount of posts: <strong><?php self::out($model->countposts)?></strong></p>
            <hr>
            <p>amount of posts in last 24h: <strong><?php self::out($model->countPostsLastDay)?></strong></p>
            <hr>
            <?php if($model->lastPost !== null):?>
                <p>last entry was posted at: <strong><?php self::out(self::formatTime($model->lastPost->getCreatedAt()))?></strong></p>
            <?php else:?>
                <p>No entry has been posted yet.</p>
            <?php endif;?>
        </div>
    </div>
</div>
<?php require '_Footer.inc';?>