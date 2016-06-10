<?php require '_Header.inc';?>
<div class="container">
    <h2>Welcome</h2>
    <h5>Welcome to FaceBlog</h5>
    <div class="panel panel-primary">
        <div class="panel-heading">
            Stats
        </div>
        <div class="panel-body">
            <p>amount of registered users: <?php self::out($model->countusers)?></p>
            <hr>
            <p>total amount of posts: <?php self::out($model->countposts)?></p>
            <hr>
            <p>amount of posts last 24h: <?php self::out($model->countPostsLastDay)?></p>
            <hr>
            <p>last entry was posted at <?php self::out($model->lastPost->getCreatedAt())?></p>
        </div>
    </div>
</div>
<?php require '_Footer.inc';?>