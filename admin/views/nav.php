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
                            <li <?= ($current_view === "admin-expected" ? 'class="active"' : null) ?>><a href="invoicesExpected.php"><i class="fa fa-folder-open"></i> Invoices Expected</a></li>
                            <li <?= ($current_view === "admin-submitted" ? 'class="active"' : null) ?>><a href="invoicesSubmitted.php"><i class="fa fa-folder-open"></i> Invoices Submitted</a></li>
                            <li <?= ($current_view === "admin-drafts" ? 'class="active"' : null) ?>><a href="invoicesDrafts.php"><i class="fa fa-folder-open"></i> Invoice Drafts</a></li>
                            <li <?= ($current_view === "admin-reports" ? 'class="active"' : null) ?>><a href="reports.php"><i class="fa fa-bar-chart-o"></i> Reports</a></li>
                            <li <?= ($current_view === "admin-settings" ? 'class="active"' : null) ?>><a href="settings.php"><i class="fa fa-gears"></i> Settings</a></li>
                        </ul>
                        
                        <form class="navbar-form navbar-left" role="search" action="studentSearch.php" method="get">
                            <div class="form-search search-only">
                                <i class="search-icon glyphicon glyphicon-search"></i>
                                <input type="text" class="form-control search-query" name="student" placeholder="Search for a student...">
                            </div>
                        </form>
                     
                        
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> [Insert username]<b class="caret"></b></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li class="dropdown-header">Language</li>
                                    <li><a href="#">English <i class="fa fa-check"></i></a></li>
                                    <li><a href="#">French</a></li>
                                    <li class="divider"></li>
                                    <li class="dropdown-header">Other</li>
                                    <li><a href="#">Profile</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    
                </div>
            </nav>
        </div>
    </div>
    
</div>