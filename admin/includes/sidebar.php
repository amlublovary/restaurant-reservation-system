<?php
/**
 * sidebar.php
 *
 * Admin sidebar navigation
 *
 * @package    restaurant-reservation-system
 * @author     Ana-Maria Lublovary <anamaria.lublovary@gmail.com>
 * @copyright  2026 datikothechef.com
 * @license    https://opensource.org/license/GPL-3.0 GNU General Public License v3.0
 * @version    1.0
 * @link       https://github.com/amlublovary/restaurant-reservation-system
 */

?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="dashboard.php" class="brand-link">
    <span class="brand-text font-weight-light"><strong>Admin</strong> | RRS</span>
  </a>
  <div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="../dist/img/manager.png" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="profile.php" class="d-block"><?php echo $_SESSION['name']; ?></a>
      </div>
    </div>
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item">
          <a href="dashboard.php" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>

<?php 
// Show user count only to the admin.
if( $_SESSION['utype']==1 ):
?>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>Users<i class="right fas fa-angle-left"></i></p>
          </a>
          <ul class="nav nav-treeview" style="display: none;">
            <li class="nav-item">
              <a href="add-subadmin.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Add</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="manage-subadmins.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Manage</p>
              </a>
            </li>
          </ul>
        </li>
<?php endif;?>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-file"></i>
            <p>Bookings<i class="right fas fa-angle-left"></i></p>
          </a>
          <ul class="nav nav-treeview" style="display: none;">
            <li class="nav-item">
              <a href="new-bookigs.php" class="nav-link">  
                <i class="far fa-circle nav-icon"></i>
                <p>New</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="accepted-bookings.php" class="nav-link">  
                <i class="far fa-circle nav-icon"></i>
                <p>Accepted</p>
              </a>
            </li>
              <li class="nav-item">
              <a href="rejected-bookings.php" class="nav-link">  
                <i class="far fa-circle nav-icon"></i>
                <p>Rejected</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="all-bookings.php" class="nav-link">  
                <i class="far fa-circle nav-icon"></i>
                <p>All</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-table"></i>
            <p>Tables<i class="right fas fa-angle-left"></i></p>
          </a>
          <ul class="nav nav-treeview" style="display: none;">
            <li class="nav-item">
              <a href="add-table.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Add</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="manage-tables.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Manage</p>
              </a>
            </li>
          </ul>
        </li>       

        <li class="nav-item">
          <a href="bw-dates-report.php" class="nav-link">
            <i class="nav-icon fas fa-file"></i>
            <p>Report</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-user-cog"></i> 
            <p>Settings<i class="right fas fa-angle-left"></i></p>
          </a>
          <ul class="nav nav-treeview" style="display: none;">
            <li class="nav-item">
              <a href="profile.php" class="nav-link">
                <i class="far fa-user nav-icon"></i>
                <p>Profile</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="change-password.php" class="nav-link">
                <i class="fas fa-cog nav-icon"></i>
                <p>Password</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="logout.php" class="nav-link">
                <i class="fas fa-sign-out-alt nav-icon"></i>
                <p>Logout</p>
              </a>
            </li>
          </ul>
        </li> 

        </ul>
      </nav>
    </div>
</aside>