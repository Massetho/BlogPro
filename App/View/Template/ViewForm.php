<div class="contat-from-wrapper">

    <div id="message"> <?php if($this->getMessage()) echo $this->getMessage(); ?></div>
    <form method="post" action="" name="cform" id="cform" enctype="multipart/form-data">

        <?= $this->createView(); ?>
        <input name="submit" type="submit" value="Save">

        <div id="simple-msg"></div>

    </form>

</div>