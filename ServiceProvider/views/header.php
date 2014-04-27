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
                                <li><a href="//<?= URL_PHP ?>/lang.php?lang=en-CA">English <?= ($_SESSION['lang'] === 'en-CA' ? '<i class="fa fa-check"></i>' : null)?></a></li>
                                <li><a href="//<?= URL_PHP ?>/lang.php?lang=fr-CA">Français <?= ($_SESSION['lang'] === 'fr-CA' ? '<i class="fa fa-check"></i>' : null)?></a></li>
                                <li class="divider"></li>
                                <li><a href="<?= empty($settings['service_provider_help_manual_uri']) ? '#' : $settings['service_provider_help_manual_uri'] ?>">Get help</a></li>
                            </ul>
                        </div>
                    </div>
                    
                </div>
                
            </div>
        </div>
    </div>
</header>