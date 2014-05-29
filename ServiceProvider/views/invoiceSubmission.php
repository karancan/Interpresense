<style>
    @import url('includes/css/serviceProvider.css');
</style>
<div class="container">
    
    <div class="row">
        <div class="col-md-12">
            <h3 class="page-title"><i class="fa fa-check-square-o"></i> Invoice submitted</h3>
        </div>
    </div>
    
    <div class="row">
        <?php
        // @todo: distinguish between submission and update
        echo $settings['invoicing_post_submission_message_en'];
        ?>
    </div>

</div>