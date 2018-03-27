<section class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
    <h1> </h1>
    <div class="clearfix"></div>
    <h2>Comments</h2>
    <div class="clearfix"></div>

    <!-- thead -->
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Author</th>
            <th scope="col">Date created</th>
            <th scope="col">Content</th>
            <th scope="col">Validate</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>


        <!-- thead -->

        <!-- tbody -->
        <tbody>
        <?php foreach ($this->collection as $comment) : ?>
            <tr>
                <th scope="row"><?= $comment->getId_comment(); ?></th>
                <td><?= $comment->getAuthor(); ?></td>
                <td><?= $comment->getDate_created(); ?></td>
                <td>
                    <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#content-<?= $comment->getId_comment(); ?>">Show Content</button>
                    <div id="content-<?= $comment->getId_comment(); ?>" class="collapse">
                        <?= $comment->getContent(); ?>
                    </div>
                </td>
                <td>

                    <form method="post" action="<?= $this->getUrl($this->getController(), 'modifyValidateComment', array(urlencode($comment->getId_comment()))); ?>" enctype="multipart/form-data">
                        <select name="validate">
                            <option value="0" <?php if($comment->getValidate() == 0) echo "selected" ?>>Not Published</option>
                            <option value="1" <?php if($comment->getValidate() == 1) echo "selected" ?>>Published</option>
                        </select>
                        <input type="hidden" name="authForm" value="<?= $this->uniqid; ?>">
                        <input class ="btn btn-secondary" name="submit" type="submit" value="Send">

                    </form></td>

                <td><a href="<?= $this->getUrl($this->getController(), 'deleteComment', array(urlencode($comment->getId_comment()))); ?>" onclick="return confirm('Are you sure you want to delete this comment ?')"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <!-- tbody -->
</section>