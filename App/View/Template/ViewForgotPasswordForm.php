<div class="contat-from-wrapper">
    <h2>Forgot password</h2>
    <div class="clearfix"></div>
    <p>Please write down your email address. We will send you a link to change your password.</p>
    <div class="clearfix"></div>

    <div id="message"><h5><i><?php if ($this->getMessage()) {
                    echo $this->getMessage();
                } ?></i></h5></div>
    <form method="post" action="" name="cform" id="cform" enctype="multipart/form-data">

        <?= $this->createView(); ?>
        <input name="submit" type="submit" value="Send">

        <div id="simple-msg"></div>

    </form>

</div>