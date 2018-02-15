<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">BlogPro</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="<?= $this->getUrl($this->getController(), 'listArticle', array(), 'Backend'); ?>">Dashboard</a></li>
                <li><a href="/admin-create-article">New Article</a></li>
                <li><a href="<?= $this->getUrl($this->getController(), 'listCategory', array(), 'Category'); ?>">Categories</a></li>
                <li><a href="/admin-create-category">New Category</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?= $this->getUrl($this->getController(), 'sessionDestroy', array(), 'Backend'); ?>">Logout</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
