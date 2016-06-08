<?php require '_Header.inc'?>

<h2>Register</h2>
<?php self::beginActionForm('Register', 'User', null, 'post'); ?>
    <table>
        <tr>
            <th>User name:</th>
            <th><input name="userName" value="<?php self::out($model->userName); ?>"></th>
        </tr>
        <tr>
            <th>Display name:</th>
            <th><input name="displayName" value="<?php self::out($model->displayName); ?>"></th>
        </tr>
        <tr>
            <th>Password:</th>
            <th><input name="password" type="password" value=""></th>
        </tr>
    </table>
    <input type="submit" value="Register">
<?php self::endActionForm(); ?>
<?php require('_Footer.inc'); ?>