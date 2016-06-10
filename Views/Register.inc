<?php require '_Header.inc'?>

<?php self::beginActionForm('Register', 'User', null, 'post', 'form-signin'); ?>
    <h2 class="form-signin-heading">Register</h2>
    <label for="inputUserName">Username</label>
    <input type="text" name="userName" id="inputUserName" class="form-control" placeholder="Username" value="<?php self::out($model->userName); ?>"required autofocus>
    <label for="inputDisplayName">Display name</label>
    <input type="text" name="displayName" id="inputDisplayName" class="form-control" placeholder="Display name" value="<?php self::out($model->displayName); ?>"required>
    <label for="inputPassword">Password</label>
    <input value="" type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>

    <input class="btn btn-lg btn-primary btn-block" type="submit" value="Register"/>
<?php self::endActionForm(); ?>
<?php require('_Footer.inc'); ?>