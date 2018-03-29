<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

<div id="login-overlay" class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="myModalLabel">Login to BlogPro</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-xs-12">
                    <div class="well">
                        <form id="loginForm" method="POST" action="" novalidate="novalidate">
                            <div class="form-group">
                                <label for="username" class="control-label">Mail</label>
                                <input type="text" class="form-control" id="username" name="username" value="" required="" title="Please enter you username" placeholder="example@gmail.com">
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <label for="password" class="control-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" value="" required="" title="Please enter your password">
                                <span class="help-block"></span>
                            </div>
                            <div id="loginErrorMsg" class="alert alert-error hide">Wrong mail or password</div>

                            <button type="submit" class="btn btn-success btn-block">Login</button>
                            <a href="<?= $this->getUrl($this->getController(), 'forgotPassword', array()); ?>" class="btn btn-default btn-block">Forgot password ?</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>