<h2>Username: <?php echo $_SESSION['username']; ?></h2>
<?php if (isset($_SESSION['isAdmin'])) :?>
    <h4>This is an administrator account.</h4>
<?php endif?>
<p class="bs-component">
    <a href="/accounts/changeUsername" class="btn btn-default">Change username</a>
    <a href="/accounts/changePassword" class="btn btn-default">Change password</a>
</p>