<?php require '_Header.inc'; ?>

<div class="container">
<h2>Users</h2>
<?php if ($model->users !== null) : ?>
    <?php if(sizeof($model->users) > 0)
    {
        //TODO: show users
        require '_UserList.inc';
    }
    else{?>
        <div class="container-fluid">
            <h4>No other users registered.</h4>
        </div>
    <?php } ?>
<?php else: ?>
<?php endif; ?>
</div>
<?php require '_Footer.inc'; ?>