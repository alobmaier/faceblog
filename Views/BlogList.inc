<?php require '_Header.inc'; ?>

<?php if ($model->blogPosts !== null) : ?>
    <?php if(sizeof($model->blogPosts) > 0)
    {
        //TODO: show blog
        require '_BlogList.inc';
    }
    else{?>
        <div class="container-fluid">
            <h4>No blog entries found.</h4>
        </div>
    <?php } ?>
<?php else: ?>
<?php endif; ?>

<?php require '_Footer.inc'; ?>