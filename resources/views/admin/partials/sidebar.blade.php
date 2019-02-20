<!-- aside -->
<div id="aside" class="app-aside modal fade nav-expand">
  <div class="left navside dark dk" layout="column">
    <div class="navbar no-radius">
      <!-- brand -->
      <a class="navbar-brand">
        <div ui-include="{{ asset("'/admin-assets/images/logo.svg'") }}"></div>
        <a href="<?= action('admin\DashboardController@index') ?>"><img src="{{ asset("images/popup-menu-final-color-01.png") }}" alt="." class="" style=" max-width: 100%;display: block;max-width: 100%;width: 76%;height: 48px !important;max-height: 100%;padding: 10px;border-radius: 2px; "/></a>
        <span class="hidden-folded inline hide">Resturent Managment</span>
      </a>
      <!-- / brand -->
    </div>
    <div flex-no-shrink>
      <div ui-include="'../views/blocks/aside.top.2.html'"></div>
    </div>
    <div flex class="hide-scroll">
      <nav class="scroll nav-stacked nav-active-primary">
        <hr>
        <ul class="nav hidden" ui-nav id="parwaz">
          <li><a href="<?= action('admin\DashboardController@index') ?>"> <span class="nav-icon"> <i class="fa fa-tachometer "></i> </span> <span class="nav-text">Dashboard</span></a></li>
          <?php if(Auth::user()->role == 1){ ?>
          <li class="nav-header hidden-folded">
            <small class="text-muted">Admin</small>
          </li>
          <li>
            <a> <span class="nav-caret"> <i class="fa fa-caret-down"></i> </span> <span class="nav-icon"> <i class="fa fa-user-plus"></i> </span> <span class="nav-text">Admin</span> </a>
            <ul class="nav-sub">
              <li><a href="{{ action('admin\UserController@index') }}"> <span class="nav-text"><i class="fa fa-table "></i>List</span></a></li>
              <li><a href="{{ action('admin\UserController@create') }}"> <span class="nav-text"><i class="fa fa-plus "></i>Add</span></a></li>
            </ul>
          </li>

          <li><a href="{{ action('admin\UserController@hotels') }}"> <span class="nav-icon"> <i class="fa fa-building"></i> </span> <span class="nav-text">Resturents</span></a></li>
          <li><a href="{{ action('admin\PagesController@homePage') }}"> <span class="nav-icon"> <i class="fa fa-clipboard"></i> </span> <span class="nav-text">Home Page</span></a></li>
          <li><a href="{{ action('admin\MailController@index') }}"> <span class="nav-icon"> <i class="fa fa-envelope"></i> </span> <span class="nav-text">Mails</span></a></li>
          <?php } ?>
          <li class="nav-header hidden-folded">
            <small class="text-muted">Buissness</small>
          </li>
          <li><a href="{{ action('admin\PosController@index') }}"><span class="nav-icon"><i class="fa fa-archive"></i></span><span class="nav-text">POS</span></a></li>
          <li><a href="{{ action('admin\ExpenseController@index') }}"> <span class="nav-icon"> <i class="fa fa-diamond "></i> </span> <span class="nav-text">Expense</span></a></li>

          <li class="nav-header hidden-folded">
            <small class="text-muted">Resturent</small>
          </li>

          <li><a href="{{ action('admin\CategoriesController@index') }}"> <span class="nav-icon"> <i class="fa fa-diamond "></i> </span> <span class="nav-text">Slider</span></a></li>
          <li style="display: none">
            <a> <span class="nav-caret"> <i class="fa fa-caret-down"></i> </span> <span class="nav-icon"> <i class="fa fa-align-justify"></i> </span> <span class="nav-text">New Categories</span> </a>
            <ul class="nav-sub">
              <li><a href="{{ action('admin\CategoriesController@index') }}"><span class="nav-icon"><i class="fa fa-tags"></i></span>Add Cat</a></li>
              <li><a href="{{ action('admin\PagesController@index') }}"><span class="nav-icon"><i class="fa fa-align-left"></i></span>Cat Pages</a></li>
            </ul>
          </li>
          <li><a href="{{ action('admin\DishesController@index') }}"> <span class="nav-icon"> <i class="fa fa-cutlery "></i> </span> <span class="nav-text">Dishes </span> </a></li>
          <li><a href="{{ action('admin\DrinksController@index') }}"><span class="nav-icon"><i class="fa fa-glass"></i></span><span class="nav-text">Drinks</span></a></li>
          <li><a href="{{ action('admin\SpecialmenuController@index') }}"><span class="nav-icon"><i class="fa fa-tag"></i></span><span class="nav-text">Special Menu</span></a></li>
          <li><a href="{{ action('admin\StaffController@index') }}"><span class="nav-icon"><i class="fa fa-users"></i></span><span class="nav-text">Manage Staff</span></a></li>

          <li class="nav-header hidden-folded">
            <small class="text-muted">Settings</small>
          </li>
          <li><a href="{{ action('admin\SettingController@index') }}"><span class="nav-icon"><i class="fa fa-gear"></i></span><span class="nav-text">Settings</span></a></li>

          <li style="display: none"><a href="#"><span class="nav-icon"><i class="fa fa-user"></i></span><span class="nav-text">Users</span></a></li>
          <li><a href="{{ action('admin\UserController@profileEdit') }}"><span class="nav-icon"><i class="fa fa-user"></i></span><span class="nav-text">Edit Profile</span></a></li>
          <li style=""><a data-clicker="{{ action('frontEndController@index' ,['id'=>Auth::user()->name]) }}" href="#" onclick="return targetBlank('clicker') " id="clicker"><span class="nav-icon"><i class="fa fa-windows"></i></span><span class="nav-text">Website</span></a></li>
          <li style="display: none"><a data-clicker="{{ action('frontEndController@qrimage' ,['id'=>Auth::user()->name]) }}" href="#" onclick="return targetBlank('clicker2') " id="clicker2"><span class="nav-icon"><i class="fa fa-qrcode"></i></span><span class="nav-text">QR Scan</span></a></li>
        </ul>
      </nav>
    </div>
    <div flex-no-shrink>
      <div ui-include="'../views/blocks/aside.bottom.0.html'"></div>
    </div>
  </div>
</div>
<!-- / aside -->
<script>
		function targetBlank(id) {
				window.open($("#" + id).data('clicker') , '_blank');
		}
</script>