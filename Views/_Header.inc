<!DOCTYPE html>
<html>
<head>

    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" type="text/css"/>
    <link rel="stylesheet" href="css/main.css" type="text/css"/>
    <link rel="stylesheet" href="css/userlist.css" type="text/css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SCR4 FaceBlog</title>

</head>
<body>
<header>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <?php self::actionLink('Home', 'Index', 'Main', 'navbar-brand')?>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><?php self::actionLink('People', 'UserList', 'Main')?> </li>
                    <li><?php self::actionLink('My Blog', 'MyBlog', 'Main')?></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><?php require '_User.inc'; ?></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</header>
<div class="header">
    <h1>FaceBlog</h1>
    <p>Create posts, view posts from other users and share your thoughts!</p>
</div>