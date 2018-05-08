<?php
require_once ("Controllers/ManageAccountsController.php");
?>


<?php include ('layouts/header.php'); ?>
<?php include ('layouts/top-navigation.php'); ?>

<section class="section main">
    <div class="row">

        <div class="twelve columns main-content">
            <?php include('layouts/absolute-nav.php'); ?>
            <h5 class="header">Manage Accounts</h5>
            <hr>
            <div class="">
                <table class="u-full-width accounts">
                    <thead>
                    <tr>
                        <th width="10%">#</th>
                        <th width="25%">Full Name</th>
                        <th width="30%">Username</th>
                        <th width="20%">Module</th>
                        <th width="15%">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($accounts as $account) { ?>
                    <tr>
                        <td><?php echo ++$tableNumber; ?></td>
                        <td><?php echo Accounts::accountOwner($account->employee_id); ?></td>
                        <td><?php echo $account->username; ?></td>
                        <td><?php echo $accountType[$account->account_type_id]; ?></td>
                        <td>
                            <a href="edit-account.php?id=<?php echo $account->id; ?>" class="button button-primary button-sm">Edit</a>
                        </td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <div class="pagination">
                    <?php if($page > 1) {?>
                    <a href="<?php echo '?page=' . ($page - 1); ?>" class="button button-primary button-sm"> << </a>
                    <?php } ?>
                    <?php for($roll=1; $roll <= $pagesCount; $roll++){ ?>
                        <a href="<?php echo "?page=" . $roll; ?>" class="button button-primary button-sm <?php echo $page==$roll? 'active' : ''; ?>"> <?php echo $roll; ?> </a>
                    <?php } ?>

                    <?php if($page < $pagesCount) { ?>
                    <a href="<?php echo '?page=' . ($page + 1); ?>" class="button button-primary button-sm"> >> </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>


</section>
<script>
    document.title = "Leave Application | Manage Accounts";
    document.getElementById('manage-accounts').className = 'active';
</script>
<?php include ('layouts/footer.php');?>
