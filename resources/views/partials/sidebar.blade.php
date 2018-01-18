<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 sidebar">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 site-logo-container">
            <h3 class="text-center site-logo">timetable</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <ul class="menu">
                <?php $page = Request::segment(1); ?>
                <li class="{{ ($page == 'dashboard') ? 'active' : '' }}">
                    <a href="/dashboard"><span class="fa fa-dashboard"></span><span class="text">Dashboard</span></a>
                </li>
                <li class="{{ ($page == 'rooms') ? 'active' : '' }}">
                    <a href="/rooms"><span class="fa fa-home"></span><span class="text">Rooms</span></a>
                </li>
                <li class="{{ ($page == 'courses') ? 'active' : '' }}">
                    <a href="/courses"><span class="fa fa-book"></span><span class="text">Courses</span></a>
                </li>
                <li class="{{ ($page == 'professors') ? 'active' : '' }}">
                    <a href="/professors"><span class="fa fa-graduation-cap"></span><span class="text">Professors</span></a>
                </li>
                <li class="{{ ($page == 'timeslots') ? 'active' : '' }}">
                    <a href="/timeslots"><span class="fa fa-clock-o"></span><span class="text">Timeslots</span></a>
                </li>
                <li class="{{ ($page == 'days') ? 'active' : '' }}">
                    <a href="/days"><span class="fa fa-calendar"></span><span class="text">Days</span></a>
                </li>
                <li class="{{ ($page == 'users') ? 'active' : '' }}">
                    <a href="/users"><span class="fa fa-user"></span><span class="text">Users</span></a>
                </li>
            </ul>
        </div>
    </div>
</div>