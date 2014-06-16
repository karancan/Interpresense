<style>
    @import url('includes/css/login.css');
</style>

<div class="container">

    <div class="row">

        <?php if ($state === 'pending') { ?>
        
        <p><?php $translate->_e('pendingMsg'); ?></p>
        
        <?php } elseif ($state === 'success') { ?>
        
        <p><?php $translate->_e('successMsg'); ?></p>
        
        <p>
            <a href="index.php" class="btn btn-warning"><i class="fa fa-angle-double-left"></i> <?php $translate->_e('returnToLogin'); ?></a>
        </p>
        
        <?php } elseif ($state === 'fail') { ?>
        
        <p><?php $translate->_e('failMsg'); ?></p>
        
        <?php } ?>

    </div>

</div>