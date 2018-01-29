<div class="blog-details">

    <article class="post-details" id="post-details">

        <header role="bog-header" class="bog-header text-center">

            <h3><span><?= $this->entity->getDayInTheMonth($this->entity->getDate_created()) ?></span> <?= $this->entity->getFrenchMonthYear($this->entity->getDate_created()) ?></h3>

            <h2><?= $this->entity->getTitle() ?></h2>

        </header>



        <figure>

            <img src="images/blog-images/<?php if (!empty($this->entity->getImage())) { echo $this->entity->getImage(); } else { echo 'blog-details-image'; } ?>.jpg" alt="" class="img-responsive"/>

        </figure>



        <div class="enter-content">

            <p><strong><?= $this->entity->getIntroduction() ?></strong></p>
            <p><?= $this->entity->getBody() ?></p>

        </div>

    </article>
</div>