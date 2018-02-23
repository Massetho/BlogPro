                    <section class="col-xs-12 col-sm-6 col-md-6 col-lg-6 ">
                        <article role="pge-title-content">
                            <header>
                                <h2><span>blog</span></h2>
                            </header>
                            <p>Follow me on my journey to make better apps, one (small) step at a time.</p>
                        </article>
                    </section>

                            <?php foreach ($this->getCollection() as $article) : ?>
                    <section class="col-xs-12 col-sm-6 col-md-6 col-lg-6 grid">
                        <ul class="grid-lod effect-2" id="grid">
                                <li>
                                    <section class="blog-content">
                                    <figure class="effect-oscar">
                                        <div class="post-date">
                                            <span><?= $article->getDayInTheMonth($article->getDate_created()) ?></span> <?= $article->getFrenchMonthYear($article->getDate_created()) ?>

                                        </div>

                                        <img src="<?= $article->getThumbnailArticle(0); ?>" alt="" class="img-responsive"/>

                                        <figcaption>

                                            <h2><?= $article->getTitle(); ?></h2>

                                            <p><?= $article->getExcerpt(); ?></p>

                                            <a href="<?= $this->getUrl($this->getController(), 'show', array(urlencode($article->getTitle()), $article->getId_article()), 'Article'); ?>">View more</a>

                                        </figcaption>

                                    </figure>
                                    </section>
                                </li>

                        </ul>
                    </section>
                            <?php endforeach; ?>
