<aside class="col-md-4 col-lg-3">
    <ul class="nav nav-dashboard flex-column mb-3 mb-md-0" role="tablist">
        <li class="nav-item">
            <a href="{{ url('user/dashboard') }}" class="nav-link active">Dashboard</a>
        </li>
        <li class="nav-item">
            <a href="{{ url('user/orders') }}" class="nav-link">Orders</a>
        </li>
        <li class="nav-item">
            <a href="{{ url('user/edit-profile') }}" class="nav-link">Edit profile</a>
        </li>
        <li class="nav-item">
            <a href="{{ url('user/change-password') }}" class="nav-link">Change Password</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('logout') }}">Sign Out</a>
        </li>
    </ul>
</aside><!-- End .col-lg-3 -->
