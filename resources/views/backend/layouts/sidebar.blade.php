 <div class="vertical-menu">

                <div data-simplebar class="h-100">

                    <!-- User details -->


                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li class="menu-title">Menu</li>

                            <li>
                                <a href="{{route('dashboard')}}" class="waves-effect">
                                    <i class="ri-dashboard-line"></i><span class="badge rounded-pill bg-success float-end">3</span>
                                    <span>Dashboard</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="ri-file-edit-fill"></i>
                                    <span>Course</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{url('courses')}}">All Course</a></li>
                                    <li><a href="{{url('courses/create')}}">Add New</a></li>
                                    {{-- <li><a href="{{url('course-categories')}}">Categories</a></li> --}}
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
