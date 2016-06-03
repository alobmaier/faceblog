<?php if($model->errors !== null): ?>
    <div class="errors">
        <ul>
            <?php foreach ($model->errors as $errMsg): ?>
                <li><?php self::out($errMsg); ?></li>
            <?php endforeach;?>
        </ul>
    </div>
<?php endif; ?>
