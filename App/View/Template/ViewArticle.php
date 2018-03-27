<div class="blog-details">

    <article class="post-details" id="post-details">

        <header role="bog-header" class="bog-header text-center">

            <h3><span><?= $this->entity->getDayInTheMonth($this->entity->getDate_created()) ?></span> <?= $this->entity->getFrenchMonthYear($this->entity->getDate_created()) ?></h3>

            <h2><?= $this->entity->getTitle() ?></h2>

        </header>



        <figure>

            <img src="<?php if ($this->entity->getImageArticle() == true) {
    echo $this->entity->getImageArticle(0);
} else {
    echo 'images/blog-images/blog-details-image.jpg';
} ?>" alt="" class="img-responsive"/>

        </figure>



        <div class="enter-content">

            <p><strong><?= $this->entity->getIntroduction() ?></strong></p>
            <p><?= $this->entity->getBody() ?></p>

        </div>

    </article>

</div>
<div class="clearfix"></div>