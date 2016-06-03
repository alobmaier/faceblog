<?php require  '_Header.inc'; ?>

<h2>Book Search</h2>
<?php self::beginActionForm('Search', 'Main'); ?>

<table>
    <tr>
        <th>Title</th>
        <td><input name="title"/></td>
    </tr>
</table>
<input type="submit" value="Search"/>
<?php self::endActionForm();?>

<?php if($model->books !== null):?>
<h3>Search result</h3>

<?php if(sizeof($model->books) >0) {?>
<?php require '_BookList.inc';?>
<?php } else {?>
<?php }?>
<?php endif; ?>
<?php require '_Footer.inc'; ?>