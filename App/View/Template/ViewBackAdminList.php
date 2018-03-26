<section class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
    <h1> </h1>
    <div class="clearfix"></div>
    <h2>Users</h2>
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
                    <select name="access_level">
                        <option value="0" <?php if($admin->getAccess_level() == 0) echo "selected" ?>>New User</option>
                        <option value="1" <?php if($admin->getAccess_level() == 1) echo "selected" ?>>User</option>
                        <option value="2" <?php if($admin->getAccess_level() == 2) echo "selected" ?>>Admin</option>
                    </select>
                    <input type="hidden" name="authForm" value="<?= $this->uniqid; ?>">
                    <input class ="btn btn-secondary" name="submit" type="submit" value="Send">

                </form></td>

                <td><a href="<?= $this->getUrl($this->getController(), 'deleteUser', array(urlencode($admin->getId_admin())), 'EditAdmin'); ?>" onclick="return confirm('Are you sure you want to delete this user ?')"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <!-- tbody -->
</section>