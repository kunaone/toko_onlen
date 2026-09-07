<!-- Navigation -->
<nav class="navbar mynavbar navbar-fixed-top" role="navigation">
    <div class="navbar-header">
        <a class="navbar-brand" href="?page=home"><strong>Toko</strong> Onlen</a>
    </div>

    <button type="button" class="navbar-toggle burger-menu" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>

    <ul class="nav navbar-right navbar-top-links custom-right-dropdown">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-bell fa-fw"></i> <b class="caret"></b>
            </a>
            <ul class="dropdown-menu dropdown-alerts">
                <li>
                    <a href="#">
                        <div>
                            <i class="fa fa-comment fa-fw"></i> New Comment
                            <span class="pull-right text-muted small">4 minutes ago</span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div>
                            <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                            <span class="pull-right text-muted small">12 minutes ago</span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div>
                            <i class="fa fa-envelope fa-fw"></i> Message Sent
                            <span class="pull-right text-muted small">4 minutes ago</span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div>
                            <i class="fa fa-tasks fa-fw"></i> New Task
                            <span class="pull-right text-muted small">4 minutes ago</span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div>
                            <i class="fa fa-upload fa-fw"></i> Server Rebooted
                            <span class="pull-right text-muted small">4 minutes ago</span>
                        </div>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a class="text-center" href="#">
                        <strong>See All Alerts</strong>
                        <i class="fa fa-angle-right"></i>
                    </a>
                </li>
            </ul>
        </li>
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> <?= isset($username) ? htmlspecialchars($username) : 'gunawnjs'; ?> <b class="caret"></b>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li>
                    <a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="#" data-toggle="modal" data-target="#logoutModal"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
            </ul>
        </li>
    </ul>
    <!-- /.navbar-top-links -->
</nav>

<!-- logout modal -->

<div class="modal fade" id="logoutModal">
    <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header bg-danger text-danger" style="border-top-left-radius: 6px; border-top-right-radius: 6px;">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><strong><span></span>Peringatan</strong></h4>
          </div>

          <div class="modal-body">
            <table style="width: 100%;">
                <p style="font-size: 15px;">Apakah anda yakin ingin keluar?</p>
            </table>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            <a href="?page=logout" class="btn btn-danger">Keluar</a>
          </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>