 <!-- ======= Sidebar ======= -->
 <aside id="sidebar" class="sidebar">

     <ul class="sidebar-nav" id="sidebar-nav">

         <li class="nav-item">
             <a class="nav-link " href="{{ route('instructor.home') }}">
                 <i class="bi bi-grid"></i>
                 <span>Dashboard</span>
             </a>
         </li><!-- End Dashboard Nav -->

         <li class="nav-item">
             <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                 <i class="bi bi-journal-text"></i><span>Management</span><i class="bi bi-chevron-down ms-auto"></i>
             </a>
             <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('instructor.courses.index') }}">
                        <i class="bi bi-book"></i><span>Courses</span>
                    </a>
                </li>
             </ul>
         </li><!-- End Forms Nav -->

         <li class="nav-heading">Pages</li>

         <li class="nav-item">
             <a class="nav-link collapsed" href="">
                 <i class="bi bi-person"></i>
                 <span>Profile(To do)</span>
             </a>
         </li><!-- End Profile Page Nav -->

     </ul>

 </aside><!-- End Sidebar-->
