<style>
    @import url('includes/css/login.css');
</style>

<div class="container">

    <div class="row">

        <?php if ($state === 'pending') { ?>
        
        <p>An email has been sent containing a link to set up your new password.</p>
        
        <?php } elseif ($state === 'success') { ?>
        
        <p>Your new password is now in effect.</p>
        
        <p>
            <a href="index.php" class="btn btn-warning"><i class="fa fa-angle-double-left"></i> Return to log in</a>
        </p>
        
        <?php } elseif ($state === 'fail') { ?>
        
        <p>Fail.</p>
        
        <?php } ?>

    </div>

</div>