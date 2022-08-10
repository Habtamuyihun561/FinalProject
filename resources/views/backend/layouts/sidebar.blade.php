<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex" href="{{route('admin')}}">
      <div class="sidebar-brand-text mx-3">Admin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
      <a class="nav-link" href="{{route('admin')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>


    
    {{-- <li class="nav-item">
        <a class="nav-link" href="{{route('file-manager')}}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Media Manager</span></a>
    </li> --}}

    <!-- Heading -->
    <div class="sidebar-heading">
      Auction
    </div>

    <!-- Auction -->
    {{-- <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#postCollapse" aria-expanded="true" aria-controls="postCollapse">
        <i class="fas fa-fw fa-folder"></i>
        <span>Auctions</span>
      </a>
      <div id="postCollapse" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Ac Options:</h6>
          <a class="collapse-item" href="{{route('post.index')}}">Auctions</a>
          <a class="collapse-item" href="{{route('post.create')}}">Add Auction</a>
          <a class="collapse-item" href="{{route('document.create')}}">Add Auctions Document</a>
        </div>
      </div>
    </li> --}}

     <!-- Category -->
     <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#postCategoryCollapse" aria-expanded="true" aria-controls="postCategoryCollapse">
          <i class="fas fa-sitemap fa-folder"></i>
          <span>Category</span>
        </a>
        <div id="postCategoryCollapse" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Category Options:</h6>
            <a class="collapse-item" href="{{route('post-category.index')}}">Category</a>
            <a class="collapse-item" href="{{route('post-category.create')}}">Add Category</a>
          </div>
        </div>
      </li>
    <!-- generate report -->
    <li class="nav-item">
      <a class="nav-link" href="#">
        <i class="fa fa-flag"></i>
        <span>Generet Report</span></a>
    </li>
    <!-- View Winner -->
    <li class="nav-item">
      <a class="nav-link" href="#">
        <i class="fa fa-flag"></i>
        <span>View Winner</span></a>
    </li>
    <!-- View Feedback -->
    <li class="nav-item">
      <a class="nav-link" href="{{route('feedback-list')}}">
        <i class="fa fa-flag"></i>
        <span>View Feedback</span></a>
    </li>
    <hr class="sidebar-divider d-none d-md-block">
     <!-- Heading -->
    <div class="sidebar-heading">
        General Settings
    </div>
   
     <!-- Users -->
     <li class="nav-item">
        <a class="nav-link" href="{{route('users.index')}}">
            <i class="fas fa-users"></i>
            <span>Users</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{route('auctioLists')}}">
        <i class="fas fa-fw fa-folder"></i>
          <span>Auctions</span></a>
  </li>
     <!-- General settings -->
     <li class="nav-item">
        <a class="nav-link" href="{{route('settings')}}">
            <i class="fas fa-cog"></i>
            <span>Settings</span></a>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>