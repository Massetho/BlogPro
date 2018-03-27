<div class="commentys-form">

    <h4>Leave a comment</h4>



    <div class="row">
        <div id="message"><h5><i><?php if($this->getMessage()) echo $this->getMessage(); ?></i></h5></div>

        <form action="<?= $this->getUrl($this->getController(), 'registerComment', array($this->entity->getId_article()), 'Article'); ?>" method="post">


            <div class="col-xs-12 col-sm-12 col-md-12">
                <?= $this->createView(); ?>

            </div>

            <div class="text-center">

                <input class ="btn btn-secondary" name="" type="submit" value="Post Comment">

            </div>

        </form>

    </div>



</div>