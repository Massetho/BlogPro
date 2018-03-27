<div class="contat-from-wrapper">

    <div id="message"><h5><i><?php if($this->getMessage()) echo $this->getMessage(); ?></i></h5></div>
    <form method="post" action="" name="cform" id="cform" enctype="multipart/form-data" onsubmit="return verifRegisterForm(this)">

        <?= $this->createView(); ?>
        <input name="submit" type="submit" value="Save">

        <div id="simple-msg"></div>

    </form>

</div>