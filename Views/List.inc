<?php require '_Header.inc'; ?>

<h2>List of Books</h2>
<h3>Categories</h3>
<?php foreach($model->categories as $cat){ ?>
<span class="category">
    <?php self::actionLink($cat->getName(), 'List', 'Main', array('categoryId' => $cat->getId()))?>
</span>
<?php } ?>

<?php if ($model->books !== null) : ?>

<h3>Books in selected category</h3>
<?php if(sizeof($model->books) > 0)
        {
            //TODO: show books
            require '_BookList.inc';
        }
        else{?>
            <p>No books for you, bitch</p>
       <?php } ?>
<?php else: ?>
<p>Please select a category</p>
<?php endif; ?>

<?php require '_Footer.inc'; ?>
