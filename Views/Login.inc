<?php require('_Header.inc'); ?>

<h2>Login</h2>

<?php self::beginActionForm('Login', 'User', null, 'post'); ?>
<table>
    <tr>
        <th>User name:</th>
        <th><input name="userName" value="<?php self::out($model->userName); ?>"></th>
    </tr>
    <tr>
        <th>Password:</th>
        <th><input name="password" type="password" value=""></th>
    </tr>
</table>
<input type="submit" value="Log in">
<?php self::endActionForm(); ?>

<?php require('_Footer.inc'); ?>
