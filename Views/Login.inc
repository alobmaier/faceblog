<?php require('_Header.inc'); ?>

<?php self::beginActionForm('Login', 'User', null, 'post'); ?>
<h2 class="form-signin-heading">Please sign in</h2>
<label for="inputEmail" class="sr-only">Email address</label>
<input type="text" name="userName" id="inputEmail" class="form-control" placeholder="Username" value="<?php self::out($model->userName); ?>"required autofocus>
<label for="inputPassword" class="sr-only">Password</label>
<input value="" type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>

<input class="btn btn-lg btn-primary btn-block" type="submit" value="Log In"/>
<?php self::endActionForm(); ?>

<?php require('_Footer.inc'); ?>
