<?php require '_Header.inc'; ?>

<?php if ($model->blogPosts !== null) : ?>
    <?php if(sizeof($model->blogPosts) > 0)
            {
                //TODO: show blog
                require '_MyBlogList.inc';
            }
            else{?>
                <p>No blog entries for you, bitch</p>
           <?php } ?>
    <?php else: ?>
<?php endif; ?>

<?php require '_Footer.inc'; ?>
