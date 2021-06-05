<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/images/admin/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info" style="max-width: 70%;">
                <p style=" word-wrap: anywhere;"> Welcome, <br>{{\Illuminate\Support\Facades\Auth::user()->name}}</p>
            </div>
        </div>

        <ul class="sidebar-menu">
            <li class="header">Registers</li>
            <li><a href="/customers"><i class="fa fa-users"></i> <span>Customers</span></a></li>
            <li><a href="/numbers"><i class="fa fa-list"></i> <span>Numbers</span></a></li>
            <li><a href="/number-preferences"><i class="fa fa-list"></i> <span>Number Preferences</span></a></li>
        </ul>
    </section>
</aside>
