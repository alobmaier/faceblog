<?php require '_Header.inc';?>
<div class="container">
    <h2>Welcome</h2>
    <h5>Welcome to FaceBlog</h5>
    <div class="panel panel-primary">
        <div class="panel-heading">
            Stats
        </div>
        <div class="panel-body">
            <p>amount of registered users: <strong><?php self::out($model->countusers)?></strong></p>
            <hr>
            <p>total amount of posts: <strong><?php self::out($model->countposts)?></strong></p>
            <hr>
            <p>amount of posts last 24h: <strong><?php self::out($model->countPostsLastDay)?></strong></p>
            <hr>
            <p>last entry was posted at <strong><?php self::out($model->lastPost->getCreatedAt())?></strong></p>
        </div>
    </div>
</div>
<?php require '_Footer.inc';?>