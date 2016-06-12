<?php require('_Header.inc'); ?>
<div class="container">
    <?php self::beginActionForm('Login', 'User', null, 'post', 'form-signin'); ?>
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputUserName">Username</label>
        <input type="text" name="userName" id="inputUserName" class="form-control" placeholder="Username" value="<?php self::out($model->userName); ?>"required autofocus>
        <br>
        <label for="inputPassword">Password</label>
        <input value="" type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>

        <input class="btn btn-lg btn-primary btn-block" type="submit" value="Login"/>
    <?php self::endActionForm(); ?>
</div>
<?php require('_Footer.inc'); ?>
