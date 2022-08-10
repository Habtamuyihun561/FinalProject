<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('user')}}">
      <div class="sidebar-brand-text mx-3">Online Auction System</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
      <a class="nav-link" href="{{route('user')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>
    
    <div class="sidebar-heading">
      Auction
    </div>

    <!-- Auction -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#postCollapse" aria-expanded="true" aria-controls="postCollapse">
        <i class="fas fa-fw fa-folder"></i>
        <span>Auctions</span>
      </a>
      <div id="postCollapse" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Auction Options:</h6>
          <a class="collapse-item" href="{{route('post.index')}}">Auctions</a>
          <a class="collapse-item" href="{{route('post.create')}}">Add Auction</a>
          <a class="collapse-item" href="{{route('document.create')}}">Add Auctions Document</a>
        </div>
      </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fa fa-trophy"></i>
            <span>View Winner</span>
        </a>
    </li>

    <!-- Make Contract -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-image"></i>
        <span>Contracts</span>
      </a>
      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Contract Options:</h6>
          <a class="collapse-item" href="{{route('contract.index')}}">Contracts</a>
          <a class="collapse-item" href="{{route('contract.create')}}">Add Contracts</a>
          <a class="collapse-item" href="">Add Case</a>
        </div>
      </div>
    </li>

    {{-- <li class="nav-item">
        <a class="nav-link" href="{{route('contract.create')}}">
            <i class="fa fa-check-circle"></i>
            <span>Make Contract</span>
        </a>
    </li> --}}
    <!-- Download -->
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fa fa-download"></i>
            <span>Download</span>
        </a>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#shippingCollapse" aria-expanded="true" aria-controls="shippingCollapse">
        <i class="fas fa-truck"></i>
        <span> Send Feedback</span>
      </a>
      <div id="shippingCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Feedback Options:</h6>
          <a class="collapse-item" href="{{route('feedback.index')}}">Feedback</a>
          <a class="collapse-item" href="{{route('feedback.create')}}">Add Feedback</a>
        </div>
      </div>
  </li>
    {{-- <li class="nav-item">
      <a class="nav-link" href="{{route('feedback.create')}}">
          <i class="fa fa-trophy"></i>
          <span>Send Feedback</span>
      </a>
  </li> --}}
    
    <hr class="sidebar-divider">
    
    
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->

    @if(Auth()->user()->tin_number =="")

    @else
    <div class="sidebar-heading">
      Bids
    </div>
    <!-- Comments -->
    <li class="nav-item">
      <a class="nav-link" href="#">
          <i class="fas fa-comments fa-chart-area"></i>
          <span>Bids</span>
      </a>
    </li>
    @endif
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>