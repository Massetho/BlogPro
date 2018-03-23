<section class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
    <h3>Categories</h3>
    <div class="clearfix"></div>

    <!-- thead -->
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Edit</th>
        </tr>
        </thead>


        <!-- thead -->

        <!-- tbody -->
        <tbody>
        <?php foreach ($this->collection as $article) : ?>
            <tr>
                <th scope="row"><?= $article->getId_category(); ?></th>
                <td><?= $article->getName(); ?></td>
                <td><a href="<?= $this->getUrl($this->getController(), 'index', array(urlencode($article->getId_category())), 'EditCategory'); ?>"><i class="fa fa-edit"></i></a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <!-- tbody -->
    <div class="clearfix"></div>

    <p><a href="/admin-create-category"><button type="button" class="btn btn-info">New Category</button></a></p>
</section>