<?php if ($model->user == null): ?>
    <p>Not logged in. [<?php self::actionLink('Login', 'Login', 'User'); ?>]</p>
<?php else: ?>
    <p>Welcome, <?php self::out($model->user->getUserName()); ?></p>
    <?php self::beginActionForm('Logout', 'User', null, 'post'); ?>
    <input type="submit" value="Log out">
    <?php self::endActionForm(); ?>
<?php endif ?>