 <!-- ======= Sidebar ======= -->
 <aside id="sidebar" class="sidebar">

     <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link {{ Request::routeIs('instructor.home') ? '' : 'collapsed' }}" href="{{ route('instructor.home') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->
    
        <li class="nav-item">
            <a class="nav-link {{ Request::routeIs('instructor.courses.*') ? '' : 'collapsed' }}" href="{{ route('instructor.courses.index') }}">
                <i class="bi bi-book"></i><span>Courses</span>
            </a>
        </li><!-- End Dashboard Nav -->
    
        <li class="nav-heading">Pages</li>
    
        <li class="nav-item">
            <a class="nav-link {{ Request::routeIs('instructor.profile.index') ? '' : 'collapsed' }}" href="{{ route('instructor.profile.index') }}">
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>
        </li><!-- End Profile Page Nav -->

     </ul>

 </aside><!-- End Sidebar-->
