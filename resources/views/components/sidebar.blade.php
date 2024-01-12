    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
            <img src="{{ url('public/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">AdminLTE 3</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ url('public/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                        alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                </div>
            </div>


            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    @php
                        $path = Request::path();
                        $role = Auth::user()->role;
                    @endphp
                    {{-- <li class="nav-item menu-open">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="./index.html" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Dashboard v1</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="./index2.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Dashboard v2</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="./index3.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Dashboard v3</p>
                                </a>
                            </li>
                        </ul>
                    </li> --}}
                    @if ($role === 'admin')
                        {
                        <x-sidebar.menuItem :$path text='Dashboard' url='admin/dashboard'
                            iconText='fas fa-tachometer-alt' />


                        <x-sidebar.menuItem :$path text='Admin' url='admin/list' iconText='fas fa-user' />

                        <x-sidebar.menuItem :$path text='Course' url='admin/courses' iconText='fas fa-book' />

                        <x-sidebar.menuItem :$path text='Subject' url='admin/subjects' iconText='fas fa-book' />

                        <x-sidebar.menuItem :$path text='Assign Subject' url='admin/assign_subjects'
                            iconText='fas fa-book' />

                        <x-sidebar.menuItem :$path text='Logout' url='/logout' iconText='fas fa-out' />
                        }
                    @elseif ($role === 'student')
                        <x-sidebar.menuItem :$path text='Dashboard' url='/student/dashboard'
                            iconText='fas fa-tachometer-alt' />
                        <x-sidebar.menuItem :$path text='Student' url='/student/list' iconText='fas fa-user' />

                        <x-sidebar.menuItem :$path text='Logout' url='/logout' iconText='fas fa-out' />
                    @elseif ($role === 'teacher')
                        <x-sidebar.menuItem :$path text='Dashboard' url='/teacher/dashboard'
                            iconText='fas fa-tachometer-alt' />
                        <x-sidebar.menuItem :$path text='Teacher' url='/teacher/list' iconText='fas fa-user' />

                        <x-sidebar.menuItem :$path text='Logout' url='/logout' iconText='fas fa-out' />
                    @elseif ($role === 'parent')
                        <x-sidebar.menuItem :$path text='Dashboard' url='/parent/dashboard'
                            iconText='fas fa-tachometer-alt' />
                        <x-sidebar.menuItem :$path text='Parent' url='/parent/list' iconText='fas fa-user' />

                        <x-sidebar.menuItem :$path text='Logout' url='/logout' iconText='fas fa-out' />
                    @endif



                </ul>
            </nav>

        </div>

    </aside>
