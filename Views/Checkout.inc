<?php require  '_Header.inc'; ?>

<h2>Checkout</h2>

<p>You have <?php self::out($model->cartSize);?> item(s) in your fucking cart.</p>

<p>Please provide your credit card details for payment mothafucka:</p>
<?php self::beginActionForm('Checkout', 'Main', null, 'post');?>
<table>
    <tr>
        <th>Name on card:</th>
        <td><input name="nameOnCard" /></td>
    </tr>
    <tr>
        <th>Card number:</th>
        <td><input name="cardNumber"></td>
    </tr>
</table>
<input type="submit" value="Place Order"/>
<?php self::endActionForm();?>

<?php require '_Footer.inc'; ?>
