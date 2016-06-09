<?php require '_Header.inc'; ?>

<h2>Party people</h2>
<?php if ($model->users !== null) : ?>
    <?php if(sizeof($model->users) > 0)
    {
        //TODO: show users
        require '_UserList.inc';
    }
    else{?>
        <p>No other users registered.</p>
    <?php } ?>
<?php else: ?>
<?php endif; ?>

<?php require '_Footer.inc'; ?>