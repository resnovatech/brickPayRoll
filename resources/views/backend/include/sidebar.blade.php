 @php
     $usr = Auth::guard('admin')->user();
 @endphp


@include('backend.include.header');

<!-- removeNotificationModal -->
<div id="removeNotificationModal">
</div><!-- /.modal -->
<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{ route('admin.dashboard') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('/') }}{{ $logo }}" alt="" height="22">
                    </span>
            <span class="logo-lg">
                        <img src="{{ asset('/') }}{{ $logo }}" alt="" height="17">
                    </span>
        </a>
        <!-- Light Logo-->
        <a href="{{ route('admin.dashboard') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('/') }}{{ $logo }}" alt="" height="22">
                    </span>
            <span class="logo-lg">
                        <img src="{{ asset('/') }}{{ $logo }}" alt="" height="17">
                    </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
                id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Dashboard</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link  {{ Route::is('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-widgets">Dashboard</span>
                    </a>
                </li>
                @if ( $usr->can('company_add')  || $usr->can('company_view') ||  $usr->can('company_delete') ||  $usr->can('company_update'))
                <li class="nav-item">
                    <a class="nav-link menu-link {{ Route::is('company.index') ? 'active' : '' }}" href="{{ route('company.index') }}">
                        <i class="ri-building-line"></i> <span data-key="t-widgets">Company</span>
                    </a>
                </li>
                @endif


                @if ( $usr->can('department_add')  || $usr->can('department_view') ||  $usr->can('department_delete') ||  $usr->can('department_update'))
                <li class="nav-item">
                    <a class="nav-link menu-link {{ Route::is('department.index') ? 'active' : '' }}" href="{{ route('department.index') }}">
                        <i class="ri-community-fill"></i> <span data-key="t-widgets">Department</span>
                    </a>
                </li>
                @endif


                @if ( $usr->can('designation_add')  || $usr->can('designation_view') ||  $usr->can('designation_delete') ||  $usr->can('designation_update'))
                <li class="nav-item">
                    <a class="nav-link menu-link {{ Route::is('designation.index') ? 'active' : '' }}" href="{{ route('designation.index') }}">
                        <i class="ri-file-user-fill"></i> <span data-key="t-widgets">Designation</span>
                    </a>
                </li>
                @endif



                @if ( $usr->can('bank_add')  || $usr->can('bank_view') ||  $usr->can('bank_delete') ||  $usr->can('bank_update'))
                <li class="nav-item">
                    <a class="nav-link menu-link {{ Route::is('bank.index') ? 'active' : '' }}" href="{{ route('bank.index') }}">
                        <i class="ri-bank-line"></i> <span data-key="t-widgets">Bank</span>
                    </a>
                </li>
                @endif

                @if ($usr->can('employee_add') || $usr->can('employee_view') ||  $usr->can('employee_delete') ||  $usr->can('employee_update'))
                @if (Route::is('employee.index') ||  Route::is('employee.create') || Route::is('employee.edit') || Route::is('employee.show'))
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarTables" data-bs-toggle="collapse" role="button"
                       aria-expanded="false" aria-controls="sidebarTables">
                        <i class="ri-user-add-line"></i> <span data-key="t-tables">Employee</span>
                    </a>
                    <div class="collapse menu-dropdown show" id="sidebarTables">
                        <ul class="nav nav-sm flex-column">
                            @if ($usr->can('employee_add'))
                            <li class="nav-item">
                                <a href="{{ route('employee.create') }}" class="nav-link {{ Route::is('employee.create')  ? 'active' : '' }}" data-key="t-basic-tables">Add Employee</a>
                            </li>
                            @endif
                            @if ($usr->can('employee_view') ||  $usr->can('employee_delete') ||  $usr->can('employee_update'))
                            <li class="nav-item">
                                <a href="{{ route('employee.index') }}" class="nav-link {{  Route::is('employee.index') || Route::is('employee.edit') || Route::is('employee.show') ? 'active' : '' }}" data-key="t-grid-js">Employee</a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarTables" data-bs-toggle="collapse" role="button"
                       aria-expanded="false" aria-controls="sidebarTables">
                        <i class="ri-user-add-line"></i> <span data-key="t-tables">Employee</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarTables">
                        <ul class="nav nav-sm flex-column">
                            @if ($usr->can('employee_add'))
                            <li class="nav-item">
                                <a href="{{ route('employee.create') }}" class="nav-link {{ Route::is('employee.create')  ? 'active' : '' }}" data-key="t-basic-tables">Add Employee</a>
                            </li>
                            @endif
                            @if ($usr->can('employee_view') ||  $usr->can('employee_delete') ||  $usr->can('employee_update'))
                            <li class="nav-item">
                                <a href="{{ route('employee.index') }}" class="nav-link {{  Route::is('employee.index') || Route::is('employee.edit') || Route::is('employee.show') ? 'active' : '' }}" data-key="t-grid-js">Employee</a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>
                @endif
                @endif


                @if ($usr->can('salary_add') || $usr->can('salary_view') ||  $usr->can('salary_delete') ||  $usr->can('salary_update'))
                @if (Route::is('salary.index') ||  Route::is('salary.create') || Route::is('salary.edit') || Route::is('salary.show'))
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#therapyAppointment" data-bs-toggle="collapse" role="button"
                       aria-expanded="false" aria-controls="therapyAppointment">
                       <i class="bx bx-money"></i> <span data-key="t-tables">Salary Structure</span>
                    </a>
                    <div class="collapse menu-dropdown show" id="therapyAppointment">
                        <ul class="nav nav-sm flex-column">
                            @if ($usr->can('salary_add'))
                            <li class="nav-item">
                                <a href="{{ route('salary.create') }}" class="nav-link {{ Route::is('salary.create')  ? 'active' : '' }}" data-key="t-basic-tables">Add Salary</a>
                            </li>
                            @endif
                            @if ($usr->can('salary_view') ||  $usr->can('salary_delete') ||  $usr->can('salary_update'))
                            <li class="nav-item">
                                <a href="{{ route('salary.index') }}" class="nav-link {{  Route::is('salary.index') || Route::is('salary.edit') || Route::is('salary.show') ? 'active' : '' }}" data-key="t-grid-js">Salary List</a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#therapyAppointment" data-bs-toggle="collapse" role="button"
                       aria-expanded="false" aria-controls="therapyAppointment">
                        <i class="bx bx-money"></i> <span data-key="t-tables">Salary Structure</span>
                    </a>
                    <div class="collapse menu-dropdown" id="therapyAppointment">
                        <ul class="nav nav-sm flex-column">
                            @if ($usr->can('salary_add'))
                            <li class="nav-item">
                                <a href="{{ route('salary.create') }}" class="nav-link {{ Route::is('salary.create')  ? 'active' : '' }}" data-key="t-basic-tables">Add Salary</a>
                            </li>
                            @endif
                            @if ($usr->can('salary_view') ||  $usr->can('salary_delete') ||  $usr->can('salary_update'))
                            <li class="nav-item">
                                <a href="{{ route('salary.index') }}" class="nav-link {{  Route::is('salary.index') || Route::is('salary.edit') || Route::is('salary.show') ? 'active' : '' }}" data-key="t-grid-js">Salary List</a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>
                @endif
                @endif


                @if ( $usr->can('overtime_add')  || $usr->can('overtime_view') ||  $usr->can('overtime_delete') ||  $usr->can('overtime_update'))
                <li class="nav-item">
                    <a class="nav-link menu-link {{ Route::is('overtime.index') ? 'active' : '' }}" href="{{ route('overtime.index') }}">
                        <i class="ri-time-fill"></i> <span data-key="t-widgets">Overtime</span>
                    </a>
                </li>
                @endif



                <li class="menu-title"><span data-key="t-menu">Setting</span></li>


                @if (Route::is('admin.system_information') ||  Route::is('admin.admins') || Route::is('admin.admins.create') || Route::is('admin.admins.edit') || Route::is('admin.roles') || Route::is('admin.roles.create') || Route::is('admin.roles.edit')|| Route::is('admin.permission') || Route::is('admin.permission.create') || Route::is('admin.permission.edit'))


                @if ($usr->can('system_information_add') || $usr->can('system_information_view') ||  $usr->can('system_information_update') ||  $usr->can('system_information_delete'))
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarIcons" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarIcons">
                        <i class="ri-settings-2-fill"></i> <span data-key="t-icons">System Setting</span>
                    </a>
                    <div class="collapse menu-dropdown show" id="sidebarIcons">
                        <ul class="nav nav-sm flex-column">


                            @if ($usr->can('system_information_add') || $usr->can('system_information_view') ||  $usr->can('system_information_update') ||  $usr->can('system_information_delete'))
                            <li class="nav-item"><a data-key="t-remix" href="{{ route('admin.system_information') }}" class="nav-link {{ Route::is('admin.system_information')  ? 'active' : '' }}"> <span>System Information</span> </a></li>

                    @endif


                    @if ($usr->can('admin.create') || $usr->can('admin.view') ||  $usr->can('admin.edit') ||  $usr->can('admin.delete'))
                    <li class="nav-item">
                    <a data-key="t-boxicons" href="{{ route('admin.admins') }}" class=" nav-link {{ Route::is('admin.admins') || Route::is('admin.admins.create') || Route::is('admin.admins.edit') ? 'active' : '' }}"><span>User</span> </a>
                    </li>

                    @endif


                       @if ($usr->can('role.create') || $usr->can('role.view') ||  $usr->can('role.edit') ||  $usr->can('role.delete'))
                            <li class="nav-item"><a data-key="t-material-design" href="{{ route('admin.roles') }}" class=" nav-link {{ Route::is('admin.roles') || Route::is('admin.roles.create') || Route::is('admin.roles.edit') ? 'active' : '' }}"> <span>Role List</span> </a></li>

                    @endif
                       @if ($usr->can('permission.create') || $usr->can('permission.view') ||  $usr->can('permission.edit') ||  $usr->can('permission.delete'))
                         <li class="nav-item">
                                <a data-key="t-line-awesome" href="{{ route('admin.permission') }}" class=" nav-link {{ Route::is('admin.permission') || Route::is('admin.permission.create') || Route::is('admin.permission.edit') ? 'active' : '' }}"><span>Permission</span> </a>
                            </li>
                    @endif

                        </ul>
                    </div>
                </li>
                @endif


                @else


                @if ($usr->can('system_information_add') || $usr->can('system_information_view') ||  $usr->can('system_information_update') ||  $usr->can('system_information_delete'))
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarIcons" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarIcons">
                        <i class="ri-settings-2-fill"></i> <span data-key="t-icons">System Setting</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarIcons">
                        <ul class="nav nav-sm flex-column">


                            @if ($usr->can('system_information_add') || $usr->can('system_information_view') ||  $usr->can('system_information_update') ||  $usr->can('system_information_delete'))
                            <li class="nav-item"><a data-key="t-remix" href="{{ route('admin.system_information') }}" class="nav-link {{ Route::is('admin.system_information')  ? 'active' : '' }}"> <span>System Information</span> </a></li>

                    @endif


                    @if ($usr->can('admin.create') || $usr->can('admin.view') ||  $usr->can('admin.edit') ||  $usr->can('admin.delete'))
                    <li class="nav-item">
                    <a data-key="t-boxicons" href="{{ route('admin.admins') }}" class=" nav-link {{ Route::is('admin.admins') || Route::is('admin.admins.create') || Route::is('admin.admins.edit') ? 'active' : '' }}"><span>User</span> </a>
                    </li>

                    @endif


                       @if ($usr->can('role.create') || $usr->can('role.view') ||  $usr->can('role.edit') ||  $usr->can('role.delete'))
                            <li class="nav-item"><a data-key="t-material-design" href="{{ route('admin.roles') }}" class=" nav-link {{ Route::is('admin.roles') || Route::is('admin.roles.create') || Route::is('admin.roles.edit') ? 'active' : '' }}"> <span>Role List</span> </a></li>

                    @endif
                       @if ($usr->can('permission.create') || $usr->can('permission.view') ||  $usr->can('permission.edit') ||  $usr->can('permission.delete'))
                         <li class="nav-item">
                                <a data-key="t-line-awesome" href="{{ route('admin.permission') }}" class=" nav-link {{ Route::is('admin.permission') || Route::is('admin.permission.create') || Route::is('admin.permission.edit') ? 'active' : '' }}"><span>Permission</span> </a>
                            </li>
                    @endif

                        </ul>
                    </div>
                </li>
                @endif
                @endif
            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
