<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/main.css" type="text/css"/>

</head>
<body>
<div class="header">
    <h1>SCR4Bookshop</h1>

    <?php require '_User.inc'; ?>
    <hr>
    <div class="navigation">
        <p>
            <?php self::actionLink('Home', 'Index', 'Main')?> |
            <?php self::actionLink('List', 'List', 'Main')?> |
            <?php self::actionLink('Search', 'Search', 'Main')?> |
            <?php self::actionLink('Checkout', 'Checkout', 'Main')?>
        </p>
    </div>
</div>