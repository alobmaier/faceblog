<?php require '_Header.inc'?>
<div class="container">
<?php self::beginActionForm('EditPost', 'Main', null, 'post')?>
    <div class="panel panel-primary">
        <div class="panel-heading">Edit post</div>
        <div class="panel-body">
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Title</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="title" placeholder="Titel"
                           value="<?php self::out($model->blogPost->getTitle())?>">
                </div>
            </div>

            <div class="form-group">
                <label for="message" class="col-sm-2 control-label">Content</label>
                <div class="col-sm-10">
                    <textarea class="form-control" rows="4" name="content">
<?php echo str_replace('\r\n',"\n",$model->blogPost->getContent());?>
                    </textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-10 col-sm-offset-2">
                    <input id="submit" name="submit" type="submit" value="Save" class="btn btn-primary">
                    <input type="hidden" name="postId" value="<?php self::out($model->blogPost->getId())?>">
                </div>
            </div>
        </div>
    </div>
<?php self::endActionForm()?>
</div>
<?php require '_Footer.inc'?>