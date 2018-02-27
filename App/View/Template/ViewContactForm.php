<div class="contat-from-wrapper">


    <header>

        <h2>Please, leave me a message ;)</h2>

    </header>
    <div id="message"></div>
    <form method="post" action="<?= $this->getUrl($this->getController(), 'contact', array()); ?>" name="cform" id="cform" enctype="multipart/form-data" onsubmit="return verifForm(this)">

        <?= $this->createView(); ?>
        <input name="submit" type="submit" value="Send">

        <div id="simple-msg"></div>

    </form>

</div>