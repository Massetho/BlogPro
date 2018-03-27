<div class="comments-pan">

    <h3><?= count($this->collection); ?> comments</h3>

    <ul class="comments-reply">
        <?php foreach ($this->collection as $comment) : ?>

        <li>

            <section>

                <h4><?= $comment->getAuthor(); ?></h4>

                <div class="date-pan"><?= $comment->getDate_created(); ?></div>

                <?= $comment->getContent(); ?>

            </section>

        </li>
        <?php endforeach; ?>

    </ul>

    <?= $this->getMessage(); ?>

</div>