<header>
    <div class="navbar navbar-static-top">
        <div class="navbar-inner">
            <div class="container">
                
                <div class="col-md-1">
                    
                    <div class="row">
                        <img class="org-logo" alt="University of Ottawa" src="../includes/img/logo_icon_379_379.png">
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
                                <li class="dropdown-header">Language</li>
                                <li><a href="#">English <i class="fa fa-check"></i></a></li>
                                <li><a href="#">French</a></li>
                                <li class="divider"></li>
                                <li class="dropdown-header">Other</li>
                                <li><a href="#">Help manual</a></li>
                                <li><a href="#">Contact department</a></li>
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
        
        <div class="col-md-3">
            <div class="well <?= ($setup_current_step === 1 ? 'setup-well-active' : ($setup_current_step > 1 ? 'setup-well-complete' : null) ) ?>">
                <i class="fa fa-hdd-o"></i> <strong>Set up databases</strong><span class="setup-step-label pull-right">Step 1 of 4</span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="well <?= ($setup_current_step === 2 ? 'setup-well-active' : ($setup_current_step > 2 ? 'setup-well-complete' : null) ) ?>">
                <i class="fa fa-users"></i> <strong>Add users</strong><span class="setup-step-label pull-right">Step 2 of 4</span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="well <?= ($setup_current_step === 3 ? 'setup-well-active' : ($setup_current_step > 3 ? 'setup-well-complete' : null) ) ?>">
                <i class="fa fa-cog"></i> <strong>Configure the app</strong><span class="setup-step-label pull-right">Step 3 of 4</span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="well <?= ($setup_current_step === 4 ? 'setup-well-active' : null) ?>">
                <i class="fa fa-check-square-o"></i> <strong>Installation complete</strong><span class="setup-step-label pull-right">Step 4 of 4</span>
            </div>
        </div>
        
    </div>
    
</div>