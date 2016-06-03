<table>
    <tr>
        <th>Titel</th>
        <th>Author</th>
        <th>Price</th>
    </tr>
    <?php foreach($model->books as $book): ?>
        <?php $inCart = in_array($book->getId(), $model->cart);
        ?>
        <tr<?php if($inCart) {?> class="inCart"<?php }?>>
            <td><?php self::out($book->getTitle()); ?></td>
            <td><?php self::out($book->getAuthor()); ?></td>
            <td><?php self::out($book->getPrice()); ?></td>
            <td>
                <?php if($inCart):?>
                    <?php self::beginActionForm('RemoveFromCart', 'Main',
                        array('bookId' => $book->getId(), 'context' => $model->context), 'post'); ?>
                        <input type="submit" value="Remove from cart"/>
                    <?php self::endActionForm(); ?>
                <?php else: ?>
                    <?php self::beginActionForm('AddToCart', 'Main',
                        array('bookId' => $book->getId(), 'context' => $model->context), 'post'); ?>
                        <input type="submit" value="Add to cart"/>
                    <?php self::endActionForm(); ?>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>