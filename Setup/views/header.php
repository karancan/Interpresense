<header>
    <div class="navbar navbar-static-top">
        <div class="navbar-inner">
            <div class="container">
                
                <div class="col-md-1">
                    
                    <div class="row">
                        <a href="//<?= URL_INTERPRESENSE ?>/">
                            <img class="org-logo" alt="Interpresense" src="../includes/img/logo_icon_379_379.png">
                        </a>
                    </div>
                    
                </div>
                
                <div class="col-md-9">
                    
                    <div class="row">
                        <h4 class="org-parent-name">University of Ottawa</h4>
                        <h2 class="org-name">Access Service</h2>
                    </div>
                    
                </div>
            
                <div class="col-md-2">
                    
                    <div class="row">
                        <div class="btn-group header-options-container pull-right">
                            <button type="button" class="btn btn-info"><i class="fa fa-gear"></i> Options</button>
                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="//<?= URL_PHP ?>/lang.php">English <i class="fa fa-check"></i></a></li>
                                <li><a href="//<?= URL_PHP ?>/lang.php">French</a></li>
                                <li class="divider"></li>
                                <li><a href="<?= empty($settings['service_provider_help_manual_uri']) ? '#' : $settings['service_provider_help_manual_uri'] ?>">Help manual</a></li>
                            </ul>
                        </div>
                    </div>
                    
                </div>
                
            </div>
        </div>
    </div>
</header>

<div class="container">

    <div class="row">
    
        <div class="col-md-8">
            <h3 class="setup-page-title"><i class="fa fa-tasks"></i> Interpresense installation</h3>
        </div>
    
    </div>
    
    <div class="row">
        
        <div class="col-md-2">
            <div class="well <?= ($setup_current_step === 1 ? 'setup-well-active' : ($setup_current_step > 1 ? 'setup-well-complete' : null) ) ?>">
                <i class="fa fa-hdd-o"></i> <strong>Database</strong><span class="setup-step-label pull-right">1 of 5</span>
            </div>
        </div>
        <div class="col-md-2">
            <div class="well <?= ($setup_current_step === 2 ? 'setup-well-active' : ($setup_current_step > 1 ? 'setup-well-complete' : null) ) ?>">
                <i class="fa fa-legal"></i> <strong>EULA</strong><span class="setup-step-label pull-right">2 of 5</span>
            </div>
        </div>
        <div class="col-md-2">
            <div class="well <?= ($setup_current_step === 3 ? 'setup-well-active' : ($setup_current_step > 2 ? 'setup-well-complete' : null) ) ?>">
                <i class="fa fa-users"></i> <strong>Users</strong><span class="setup-step-label pull-right">3 of 5</span>
            </div>
        </div>
        <div class="col-md-2">
            <div class="well <?= ($setup_current_step === 4 ? 'setup-well-active' : ($setup_current_step > 3 ? 'setup-well-complete' : null) ) ?>">
                <i class="fa fa-cog"></i> <strong>Settings</strong><span class="setup-step-label pull-right">4 of 5</span>
            </div>
        </div>
        <div class="col-md-2">
            <div class="well <?= ($setup_current_step === 5 ? 'setup-well-active' : null) ?>">
                <i class="fa fa-check-square-o"></i> <strong>Complete</strong><span class="setup-step-label pull-right">5 of 5</span>
            </div>
        </div>
        
    </div>
    
</div>