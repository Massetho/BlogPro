            	<section class="col-xs-12 col-sm-6 col-md-6 col-lg-6 ">
                	<article role="pge-title-content">
                    	<header>
                        	<h2><span>avana</span> A Brand new Agency.</h2>
                        </header>
                        <p>This is the story of Avana, a minimal Bootstrap template for creative agency.</p>
                    </article>
                </section>
                <section class="col-xs-12 col-sm-6 col-md-6 col-lg-6 grid">
                    <ul class="grid-lod effect-2" id="grid">
                <?php foreach ($this->getCollection() as $article) : ?>
                <li>
                    <figure class="effect-oscar">

                        <img src="<?= $article->getThumbnailArticle(); ?>" alt="" class="img-responsive"/>

                        <figcaption>

                            <h2><?= $article->getTitle(); ?></h2>

                            <p><?= $article->getExcerpt(); ?></p>

                            <a href="<?= $this->getUrl($this->getController(), 'show', array(urlencode($article->getTitle()), $article->getId_article()), 'Article'); ?>">View more</a>

                        </figcaption>

                    </figure>
                </li>
                <?php endforeach; ?>
                </ul>
                </section>
