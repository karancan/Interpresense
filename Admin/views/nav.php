<style>
    .without-navbar-logo{
        padding-left: 0;
    }
    .navbar-default .navbar-nav>li>a, .navbar-default .navbar-text{
        color: white;
    }
    .navbar-default .navbar-nav>li>a:hover, .navbar-default .navbar-text:hover{
        color: black;
    }
    #search-input{
        width: 130%;
    }
</style>
<div class="container">
    
    <div class="row">
        <div class="col-md-12">
            <nav class="navbar navbar-default" role="navigation">
                <div class="container-fluid without-navbar-logo">
                    
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li <?= ($current_view === "admin-submitted" ? 'class="active"' : null) ?>>
                                <a id="admin-nav-link-invoices-submitted" href="invoicesSubmitted.php" <?= (!empty($unreadInvoiceCount) ? 'data-popover="true" data-content="You have ' . $numFmt->format($unreadInvoiceCount, 'decimal') . ' unread invoice(s)…"' : null) ?>>
                                    <i class="fa fa-file-text"></i> Invoices Submitted <?= (empty($unreadInvoiceCount) ? null : '<strong>(' . $numFmt->format($unreadInvoiceCount, 'decimal') . ')</strong>') ?>
                                </a>
                            </li>
                            <li <?= ($current_view === "admin-drafts" ? 'class="active"' : null) ?>>
                                <a id="admin-nav-link-invoices-drafts" href="invoicesDrafts.php">
                                    <i class="fa fa-file-text"></i> Invoice Drafts
                                </a>
                            </li>
                            <li <?= ($current_view === "admin-reports" ? 'class="active"' : null) ?>>
                                <a id="admin-nav-link-reports" href="reports.php">
                                    <i class="fa fa-bar-chart-o"></i> Reports
                                </a>
                            </li>
                        </ul>
                        
                        <form class="navbar-form navbar-left" role="search" action="search.php" method="get">
                            <div class="form-search search-only">
                                <i class="search-icon glyphicon glyphicon-search"></i>
                                <input id="search-input" type="text" class="form-control search-query" name="q" placeholder="Search for a client or service provider…" rel="popover" data-content="To search for a client, enter a client ID. To search for a service provider, enter a name, HST number, phone number or email">
                            </div>
                        </form>
                        
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?= $antiXSS->escape("{$_SESSION['admin']['first_name']} {$_SESSION['admin']['last_name']}"); ?><b class="caret"></b></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Last log in <?= $dateFmt->format($_SESSION['admin']['last_log_in'], 'date_time') ?></a></li>
                                    <li class="divider"></li>
                                    <li><a href="settings.php"><i class="fa fa-gears fa-fw"></i> Settings</a></li>
                                    <li><a href="emails.php"><i class="fa fa-envelope fa-fw"></i> Emails</a></li>
                                    <li><a href="users.php"><i class="fa fa-users fa-fw"></i> Users</a></li>
                                    <li><a href="index.php?page=logout"><i class="fa fa-sign-out fa-fw"></i> Log out</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    
                </div>
            </nav>
        </div>
    </div>
    
</div>
<script>
    
    //If we have localStorage values for draft invoices, we inject them in to `href` attribute
    if (localStorage.getItem('interpresense_admin_invoices_drafts_start_date') !== null && localStorage.getItem('interpresense_admin_invoices_drafts_end_date') != null) {
        $('#admin-nav-link-invoices-drafts').prop('href', $('#admin-nav-link-invoices-drafts').prop('href') + '?start=' + localStorage.getItem('interpresense_admin_invoices_drafts_start_date') + '&end=' + localStorage.getItem('interpresense_admin_invoices_drafts_end_date'));
    }
    
    //If we have localStorage values for finalized invoices, we inject them in to `href` attribute
    if (localStorage.getItem('interpresense_admin_invoices_submitted_start_date') !== null && localStorage.getItem('interpresense_admin_invoices_submitted_end_date') != null) {
        $('#admin-nav-link-invoices-submitted').prop('href', $('#admin-nav-link-invoices-submitted').prop('href') + '?start=' + localStorage.getItem('interpresense_admin_invoices_submitted_start_date') + '&end=' + localStorage.getItem('interpresense_admin_invoices_submitted_end_date'));
    }
    
    //Initialize a popover on the search input box
    $("#search-input").popover({
        placement: 'right',
        container: 'body',
        trigger: 'focus'
    });
    
    //Initialize a popover on the invoicesSubmitted menu option only if the count is > 0
    $("[data-popover='true']").popover({
        placement: 'bottom',
        container: 'body',
        trigger: 'hover'
    });
    
</script>