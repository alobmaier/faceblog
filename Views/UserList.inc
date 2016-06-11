<?php require '_Header.inc'; ?>

<div class="container">
<h2>Users</h2>
<?php if ($model->users !== null) : ?>
    <?php self::beginActionForm('SearchUser','Main',null,'post')?>
        <label for="inputDisplayName">Nickname: </label>
        <input type="text" name="displayName" id="inputDisplayName" class="form-control search" value=""/>
        <input type="submit" class="btn btn-primary" value="Search"/>
    <?php self::endActionForm() ?>
    <?php if(sizeof($model->users) > 0)
    {
        //TODO: show users
        require '_UserList.inc';
    }
    else{?>
        <h4>No users found.</h4>
    <?php } ?>
<?php else: ?>
<?php endif; ?>
</div>
<?php require '_Footer.inc'; ?>