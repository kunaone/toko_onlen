<aside class="sidebar navbar-default" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
           <li class="visible-xs-block" style="height: 55px;"></li>
            <li class="hidden-xs" style="padding: 10px 15px;">
                <table>
                    <tr>
                        <td style="position: relative; width: 1px; padding: 0;">
                            <img src="./assets/img/placeholder.jpeg" class="img-circle" style="border: solid 3px #ddd; width: 80px; height: 80px;" alt="photo-profile">
                            <span style="background-color: #00b300; position: absolute; right: 2px; bottom: 2px; height: 18px; width: 18px; border-radius: 50%;"></span>
                        </td>
                        <td style="vertical-align: middle; padding-left: 12px;">
                            <p style="margin: 0;"><strong><?= isset($_SESSION['user_id']) ? htmlspecialchars($firstname) : 'Gunawan'; ?></strong></p>
                            <small class="text-capitalize text-muted"><?= isset($role) ? htmlspecialchars($role) : 'admin'; ?></small>
                        </td>
                    </tr>
                </table>
            </li>
            <li>
                <a href="?page=home" class="<?= isset($page) && empty($page) ? 'active' : '' ; ?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            <li>
                <a class="btn btn-link text-muted disabled text-uppercase" style="background-color: #fff; font-size: 11px; letter-spacing: 1px; text-align: left !important;"><strong>Master</strong></a>
            </li>
            <!-- second lvl dropdown -->
            <li>
                <a href="#" class="<?= isset($page) && empty($page) ? 'active' : '' ; ?>"><i class="fa fa-th-large fa-fw"></i>&nbsp;&nbsp;Produk <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a class="text-capitalize <?= isset($page) && empty($page) ? 'active' : '' ; ?>" href="?page=products"><i class="fa fa-th-list fa-fw"></i>&nbsp;&nbsp;list product</a></li>
                    <li><a class="text-capitalize <?= isset($page) && empty($page) ? 'active' : '' ; ?>" href="?page=categories"><i class="fa fa-tags fa-fw"></i>&nbsp;kategori</a></li>
                </ul>
            </li>
            <li>
                <a href="?page=suppliers" class="<?= isset($page) && empty($page) ? 'active' : '' ; ?>"><i class="fa fa-truck fa-fw"></i>&nbsp;Supplier</a>
            </li>
            <li>
                <a class="btn btn-link text-muted disabled text-uppercase" style="background-color: #fff; font-size: 11px; letter-spacing: 1px; text-align: left !important;"><strong>Transaction</strong></a>
            </li>
            <li>
                <a href="?page=penjualan" class="<?= isset($page) && empty($page) ? 'active' : '' ; ?>"><i class="fa fa-line-chart fa-fw"></i>&nbsp;Penjualan</a>
            </li>
            <li>
                <a href="?page=pembelian" class="<?= isset($page) && empty($page) ? 'active' : '' ; ?>"><i class="fa fa-shopping-cart fa-fw"></i>&nbsp;Pembelian</a>
            </li>
            <li>
                <a class="btn btn-link text-muted disabled text-uppercase" style="background-color: #fff; font-size: 11px; letter-spacing: 1px; text-align: left !important;"><strong>Employee</strong></a>
            </li>
            <li>
                <a href="?page=list-users" class="<?= isset($page) && empty($page) ? 'active' : '' ; ?>"><i class="fa fa-users fa-fw"></i>&nbsp;Karyawan</a>
            </li>
            <li>
                <a href="?page=list-users" class="<?= isset($page) && empty($page) ? 'active' : '' ; ?>"><i class="fa fa-unlock-alt fa-fw"></i>&nbsp;Akun</a>
            </li>
        </ul>
    </div>
</aside>
<!-- /.sidebar -->