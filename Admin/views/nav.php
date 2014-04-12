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
</style>
<div class="container">
    
    <div class="row">
        <div class="col-md-12">
            <nav class="navbar navbar-default" role="navigation">
                <div class="container-fluid without-navbar-logo">
                    
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li <?= ($current_view === "admin-submitted" ? 'class="active"' : null) ?>><a href="invoicesSubmitted.php"><i class="fa fa-file-text"></i> Invoices Submitted</a></li>
                            <li <?= ($current_view === "admin-drafts" ? 'class="active"' : null) ?>><a href="invoicesDrafts.php"><i class="fa fa-file-text"></i> Invoice Drafts</a></li>
                            <li <?= ($current_view === "admin-reports" ? 'class="active"' : null) ?>><a href="reports.php"><i class="fa fa-bar-chart-o"></i> Reports</a></li>
                        </ul>
                        
                        <form class="navbar-form navbar-left" role="search" action="studentSearch.php" method="get">
                            <div class="form-search search-only">
                                <i class="search-icon glyphicon glyphicon-search"></i>
                                <input type="text" class="form-control search-query" name="student" placeholder="Search for a student...">
                            </div>
                        </form>
                     
                        
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?= $antiXSS->escape("{$_SESSION['first_name']} {$_SESSION['last_name']}"); ?><b class="caret"></b></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="settings.php"><i class="fa fa-gears"></i> Settings</a></li>
                                    <li><a href="index.php?page=logout"><i class="fa fa-sign-out"></i> Log out</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    
                </div>
            </nav>
        </div>
    </div>
    
</div>