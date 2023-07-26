<nav class="sidebar sidebar-offcanvas" id="sidebar" >
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" href="{{ route('home')}}">
          <i class="icon-grid menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
          <i class="icon-layout menu-icon"></i>
          <span class="menu-title">Configuration Settings &nbsp;</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-basic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('faculty.index')}}">Manage Faculties/Div</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('department.index')}}">Manage Deparments</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
          <i class="icon-columns menu-icon"></i>
          <span class="menu-title">User Management</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="form-elements">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"><a class="nav-link" href="#">Manage Users</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#personnel-menu" aria-expanded="false" aria-controls="personnel-menu">
          <i class="icon-head menu-icon"></i>
          <span class="menu-title">Personnel Management &nbsp;</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="personnel-menu">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('personnel.create')}}">Add New Personnel</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('personnel.index')}}">View All Personnel</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('personnel.promotion')}}">Promotions</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#application-menu" aria-expanded="false" aria-controls="application-menu">
          <i class="icon-grid-2 menu-icon"></i>
          <span class="menu-title">Manage Applications &nbsp;</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="application-menu">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="/application/register">Log An Application</a></li>
            <li class="nav-item"> <a class="nav-link" href="/application">View All Applications</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
          <i class="icon-contract menu-icon"></i>
          <span class="menu-title">Report Management &nbsp;</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="icons">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="#">Mdi icons</a></li>
          </ul>
        </div>
      </li>
    </ul>
  </nav>
