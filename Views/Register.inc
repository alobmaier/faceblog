<?php require '_Header.inc'?>
<div class="container">
    <?php self::beginActionForm('Register', 'User', null, 'post', 'form-signin'); ?>
        <h2 class="form-signin-heading">Register</h2>
        <label for="inputUserName">Username</label>
        <input type="text" name="userName" id="inputUserName" class="form-control" placeholder="Username" value="<?php self::out($model->userName); ?>"required autofocus>
        <br>
        <label for="inputDisplayName">Display name</label>
        <input type="text" name="displayName" id="inputDisplayName" class="form-control" placeholder="Display name" value="<?php self::out($model->displayName); ?>"required>
        <br>
        <label for="inputPassword">Password</label>
        <input value="" type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <br>
        <label for="confirmPassword">Confirm Password</label>
        <input value="" type="password" name="confirmedPassword" id="confirmPassword" class="form-control" placeholder="Confirm Password" required>

        <input class="btn btn-lg btn-primary btn-block" type="submit" value="Register"/>
    <?php self::endActionForm(); ?>
</div>
<?php require('_Footer.inc'); ?>