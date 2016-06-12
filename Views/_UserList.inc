<link rel="stylesheet" href="css/userlist.css" type="text/css"/>
<div class="bootstrap snippet">
    <div class="row">
        <div class="col-lg-12">
            <div class="main-box no-header clearfix">
                <div class="main-box-body clearfix">
                    <div class="table-responsive">
                        <table class="table user-list">
                            <thead>
                            <tr>
                                <th><span>User</span></th>
                                <th><span>on faceblog since</span></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($model->users as $user): ?>
                                <tr>
                                    <td>
                                        <img src="assets/img/user_icon.png" alt="">
                                        <?php self::actionLink($user->getDisplayName(), 'Blog','Main','user-link',
                                            array('userId' => $user->getId()))?>
                                        <span class="user-subhead">Member</span>
                                    </td>
                                    <td><?php self::out(self::formatTime($user->getStartTime()))?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>