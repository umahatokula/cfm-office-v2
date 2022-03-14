<div class="app-sidebar">
    <div class="logo">
        <a href="index.html" class="logo-icon"><span class="logo-text">Neptune</span></a>
        <div class="sidebar-user-switcher user-activity-online">
            <a href="#">
                <img src="{{ asset('assets') }}/images/avatars/avatar.png">
                <span class="activity-indicator"></span>
                <span class="user-info-text">Chloe<br><span class="user-state-info">On a call</span></span>
            </a>
        </div>
    </div>
    <div class="app-menu">
        <ul class="accordion-menu">

            <li class="{{ url()->current() == route('dashboard') ? 'active-page' : '' }}">
                <a href="{{route('dashboard')}}" class="active"><i class="material-icons-two-tone">dashboard</i>Dashboard</a>
            </li>
            <li>
                <a href=""><i class="material-icons-two-tone">star</i>Members<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                <ul class="sub-menu">
                    <li>
                        <a href="{{ route('members.index') }}" class="item">All Members</a>
                    </li>
                    <li>
                        <a href="{{ route('members.create') }}" class="item">Add Member</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="{{ route('church-services.index') }}"><i class="material-icons-two-tone">star</i>Service Day</a>
            </li>
            
            <li>
                <a href=""><i class="material-icons-two-tone">star</i>Follow Up<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                <ul class="sub-menu">
                    <li>
                        <a href="{{route('followup-targets.index')}}" class="item">Targets</a>
                    </li>
                    <li>
                        <a href="{{ route('life-coaches.index') }}" class="item">Life Coaches</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href=""><i class="material-icons-two-tone">star</i>Reports<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                <ul class="sub-menu">
                    <li>
                        <a href="{{ route('reportsServiceDays') }}" class="item">Service Days</a>
                    </li>
                    <li>
                        <a href="{{ route('reportsGeneral') }}" class="item">General Stats</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href=""><i class="material-icons-two-tone">star</i>Staff<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                <ul class="sub-menu">
                    <li>
                        <a href="{{ route('staff.index') }}" class="item">All Staff</a>
                    </li>
                    <li>
                        <a href="{{ route('staff.create') }}" class="item">Add Staff</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#"><i class="material-icons-two-tone">star</i>Accounting<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                <ul class="sub-menu">
                    <li>
                        <a href="#">Requisitions<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                        <ul class="sub-menu">
                            <li>
                                <a href="{{ route('requisitions.index') }}">View Requisitions</a>
                            </li>
                            <li>
                                <a href="{{ route('requisitions.create') }}">New Requisition</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Salaries<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                        <ul class="sub-menu">
                            <li>
                                <a href="{{ route('salaries.index') }}">Staff Salaries</a>
                            </li>
                            <li>
                                <a href="{{ route('salaries-schedules.index') }}">Salary Schedule</a>
                            </li>
                            <li>
                                <a href="{{ route('salaries-schedule-elements.index') }}">Schedule Elements</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#"><i class="material-icons-two-tone">star</i>Settings<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                <ul class="sub-menu">
                    <li>
                        <a href="#">Users<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                        <ul class="sub-menu">
                            <li>
                                <a href="{{ route('users.index') }}">All Users</a>
                            </li>
                            <li>
                                <a href="{{ route('users.create') }}">New User</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Error</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
