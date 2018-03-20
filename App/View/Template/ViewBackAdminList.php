<section class="col-xs-12 col-sm-6 col-md-6 col-lg-6 ">
    <h1> </h1>
    <div class="clearfix"></div>
    <h2>Articles</h2>
    <div class="clearfix"></div>

    <!-- thead -->
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Firstname</th>
            <th scope="col">Lastname</th>
            <th scope="col">Date created</th>
            <th scope="col">Email</th>
            <th scope="col">Access Level</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>


        <!-- thead -->

        <!-- tbody -->
        <tbody>
        <?php foreach ($this->collection as $admin) : ?>
            <tr>
                <th scope="row"><?= $admin->getId_admin(); ?></th>
                <td><?= $admin->getFirstname(); ?></td>
                <td><?= $admin->getLastname(); ?></td>
                <td><?= $admin->getDate_created(); ?></td>
                <td><?= $admin->getEmail(); ?></td>
                <td>

                <form method="post" action="<?= $this->getUrl($this->getController(), 'modifyAdminLevel', array(urlencode($admin->getId_admin()))); ?>" enctype="multipart/form-data">
                    <select name="access_level" multiple>
                        <option value="0" <?php if($admin->getAccess_level() == 0) echo "selected" ?>>New User</option>
                        <option value="1" <?php if($admin->getAccess_level() == 1) echo "selected" ?>>User</option>
                        <option value="2" <?php if($admin->getAccess_level() == 2) echo "selected" ?>>Admin</option>
                    </select>
                    <input name="submit" type="submit" value="Send">

                </form></td>

                <td><a href="<?= $this->getUrl($this->getController(), 'deleteAdmin', array(urlencode($admin->getId_admin()))); ?>" onclick="return confirm('Are you sure you want to delete this article ?')"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <!-- tbody -->
</section>