<div class="blog-details">

    <article class="post-details" id="post-details">

        <header role="bog-header" class="bog-header text-center">

            <h3><span><?= $this->entity->getDayInTheMonth($this->entity->getDate_created()) ?></span> <?= $this->entity->getFrenchMonthYear($this->entity->getDate_created()) ?></h3>

            <h2><?= $this->entity->getTitle() ?></h2>

        </header>



        <figure>

            <img src="<?php if ($this->entity->getImageArticle() == TRUE) { echo $this->entity->getImageArticle(0); } else { echo 'images/blog-images/blog-details-image.jpg'; } ?>" alt="" class="img-responsive"/>

        </figure>



        <div class="enter-content">

            <p><strong><?= $this->entity->getIntroduction() ?></strong></p>
            <p><?= $this->entity->getBody() ?></p>

        </div>

    </article>

    <div class="clearfix"></div>


    <div class="comments-pan">

        <!-- INSERT YOUR DISQUS SCRIPT HERE -->
        <div id="disqus_thread"></div>
        <script>

            /**
             *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
             *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/

             var disqus_config = function () {
                this.page.url = '<?= 'http://blogpro.com' . $this->getUrl($this->getController(), 'show', array(urlencode($this->entity->getTitle()), $this->entity->getId_article()), 'Article'); ?>';  // Replace PAGE_URL with your page's canonical URL variable
                this.page.identifier = '<?= $this->entity->getId_article() ?>'; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
             };
            (function() { // DON'T EDIT BELOW THIS LINE
                var d = document, s = d.createElement('script');
                s.src = 'https://blogpro-1.disqus.com/embed.js';
                s.setAttribute('data-timestamp', +new Date());
                (d.head || d.body).appendChild(s);
            })();
        </script>
        <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
        <!-- END OF DISQUS SCRIPT -->

    </div>
</div>