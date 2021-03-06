<?php if ($model->user == null): ?>
    <li> <?php self::actionLink('Login', 'Login', 'User'); ?></li>
    <li> <?php self::actionLink('Register', 'Register', 'User'); ?></li>
<?php else: ?>
    <a>Welcome, <?php self::out($model->user->getUserName()); ?></a>
    <li><?php self::beginActionForm('Logout', 'User', null, 'post', 'form-navbar'); ?>
        <button type="submit" class="btn btn-default btn-sm">
            <span class="glyphicon glyphicon-log-out"></span> Log out
        </button>
    <?php self::endActionForm(); ?></li>
<?php endif ?>