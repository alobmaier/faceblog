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
    <div class="header">
        <h1>FaceBlog</h1>
        <p>Create posts, view posts from other users and share your thoughts!</p>
    </div>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <?php self::actionLink('Home', 'Index', 'Main', 'navbar-brand')?>
            </div>


            <ul class="nav navbar-nav">
                <li><?php self::actionLink('People', 'UserList', 'Main')?> </li>
                <li><?php self::actionLink('My Blog', 'MyBlog', 'Main')?></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><?php require '_User.inc'; ?></li>
            </ul>
        </div><!-- /.container-fluid -->
    </nav>
</header>