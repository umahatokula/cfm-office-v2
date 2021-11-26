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
            <li class="sidebar-title">
                Church Admin
            </li>
            <li class="{{ url()->current() == route('index') ? 'active-page' : '' }}">
                <a href="{{route('index')}}" class="active"><i class="material-icons-two-tone">dashboard</i>Dashboard</a>
            </li>
            <li class="{{ url()->current() == route('all-life-coach') ? 'active-page' : '' }}">
                <a href="{{route('all-life-coach')}}" class="active"><i class="material-icons-two-tone">dashboard</i>All Coaches</a>
            </li>
            <li class="{{ url()->current() == route('create-life-coach') ? 'active-page' : '' }}">
                <a href="{{route('create-life-coach')}}" class="active"><i class="material-icons-two-tone">dashboard</i>Create Coach</a>
            </li>
            <li class="{{ url()->current() == route('all-target') ? 'active-page' : '' }}">
                <a href="{{route('all-target')}}" class="active"><i class="material-icons-two-tone">dashboard</i>All Targets</a>
            </li>
            <li class="{{ url()->current() == route('create-target') ? 'active-page' : '' }}">
                <a href="{{route('create-target')}}" class="active"><i class="material-icons-two-tone">dashboard</i>Create Target</a>
            </li>

            <li class="{{ url()->current() == route('index') ? 'active-page' : '' }}">
                <a href="{{route('index')}}" class="active"><i class="material-icons-two-tone">dashboard</i>All Love</a>
            </li>
            <li>
                <a href="#"><i class="material-icons-two-tone">bookmark</i>Documentation</a>
            </li>
            <li>
                <a href="#"><i class="material-icons-two-tone">access_time</i>Change Log</a>
            </li>
            <li>
                <a href="{{ route('church-services.index') }}"><i class="material-icons-two-tone">done</i>Service Day</a>
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
        </ul>
    </div>
</div>
