<section class="col-xs-12 col-sm-6 col-md-6 col-lg-6 ">
<h1> </h1>
<div class="clearfix"></div>
<h2>Articles</h2>
<div class="clearfix"></div>

<!-- thead -->
<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">Date created</th>
        <th scope="col">Category</th>
        <th scope="col">Edit</th>
        <th scope="col">Delete</th>
    </tr>
    </thead>


<!-- thead -->

<!-- tbody -->
    <tbody>
    <?php foreach ($this->getCollection('id_article', 'DESC', 0) as $article) : ?>
    <tr>
        <th scope="row"><?= $article->getId_article(); ?></th>
        <td><?= $article->getTitle(); ?></td>
        <td><?= $article->getDate_created(); ?></td>
        <td><?= $article->getCategory(); ?></td>
        <td><a href="<?= $this->getUrl($this->getController(), 'index', array(urlencode($article->getId_article())), 'EditArticle'); ?>"><i class="fa fa-edit"></i></a></td>
        <td><a href="<?= $this->getUrl($this->getController(), 'deleteArticle', array(urlencode($article->getId_article()))); ?>" onclick="return confirm('Are you sure you want to delete this article ?')"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<!-- tbody -->
</section>