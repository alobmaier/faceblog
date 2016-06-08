<?php if ($model->user == null): ?>
    <li> <?php self::actionLink('Login', 'Login', 'User'); ?></li>
    <li> <?php self::actionLink('Register', 'Register', 'User'); ?></li>
<?php else: ?>
    <a>Welcome, <?php self::out($model->user->getUserName()); ?></a>
    <li><?php self::beginActionForm('Logout', 'User', null, 'post'); ?>
    <input class="btn navbar-btn" type="submit" value="Log out">
    <?php self::endActionForm(); ?></li>
<?php endif ?>