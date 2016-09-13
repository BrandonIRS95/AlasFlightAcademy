<!doctype html>
<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,700' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="{{URL::to('css/admin/reset.css')}}"> <!-- CSS reset -->
    <link rel="stylesheet" href="{{URL::to('css/admin/style.css')}}"> <!-- Resource style -->
    <script src="{{URL::to('js/admin/modernizr.js')}}"></script> <!-- Modernizr -->

    <title>Alas Flight Academy</title>
    <style>
        .Navbar__logo--alas {
            color: white;
        }

        .Navbar__logo--academy {
            color: #abcff8;
        }

        .Navbar__logo--alas, .Navbar__logo--academy{
            font-size: 22px;
        }

        .title-view{
            background: #cdd8e2;
            width: 100%;
            padding: 20px;
            font-size: 30px;
            color: rgba(0, 0, 0, 0.87);
        }
        .content-wrapper{
            padding-left: 0;
            padding-right: 0;
        }
    </style>
</head>
<body>
<header class="cd-main-header">
    <a href="#0" class="cd-logo"><span class="Navbar__logo--alas">Alas</span><span class="Navbar__logo--academy">Academy</span></a>

    <a href="#0" class="cd-nav-trigger">Menu<span></span></a>

    <nav class="cd-nav">
        <ul class="cd-top-nav">
            <li class="has-children account">
                <a href="#0">
                    <img src="{{URL::to('images/admin/cd-avatar.png')}}" alt="avatar">
                    Frank Requen
                </a>

                <ul>

                    <li><a href="#0">My Account</a></li>
                    <li><a href="#0">Edit Account</a></li>
                    <li><a href="#0">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <div class="cd-search is-hidden">
        <form action="#0">
            <input type="search" placeholder="Search...">
        </form>
    </div> <!-- cd-search -->


</header> <!-- .cd-main-header -->

<main class="cd-main-content">
    <nav class="cd-side-nav">
        <ul>
            <li class="cd-label">Academy</li>
            <li class="has-children overview active">
                <a href="#0">Aspirants</a>

                <!--<ul>
                    <li><a href="#0">All Data</a></li>
                    <li><a href="#0">Category 1</a></li>
                    <li><a href="#0">Category 2</a></li>
                </ul>-->
            </li>


            <li class="has-children comments">
                <a href="#0">Students</a>

                <ul>
                    <li><a href="#0">All Comments</a></li>
                    <li><a href="#0">Edit Comment</a></li>
                    <li><a href="#0">Delete Comment</a></li>
                </ul>
            </li>

            <li class="has-children comments">
                <a href="#0">Calendar</a>
            </li>

            <li class="has-children notifications">
                <a href="#0">Contact<span class="count">3</span></a>

                <ul>
                    <li><a href="#0">All Notifications</a></li>
                    <li><a href="#0">Friends</a></li>
                    <li><a href="#0">Other</a></li>
                </ul>
            </li>
        </ul>

        <ul>
            <li class="cd-label">System</li>

            <li class="has-children users">
                <a href="#0">Users</a>

                <ul>
                    <li><a href="#0">All Users</a></li>
                    <li><a href="#0">Edit User</a></li>
                    <li><a href="#0">Add User</a></li>
                </ul>
            </li>
        </ul>

        <ul>
            <li class="cd-label">Action</li>
            <li class="action-btn"><a href="{{ route('logout') }}">Logout</a></li>
        </ul>
    </nav>

    <div class="content-wrapper">
        <div class="title-view">@yield('title-view')</div>
        @yield('content')
    </div> <!-- .content-wrapper -->
</main> <!-- .cd-main-content -->
<script src="{{URL::to('js/admin/jquery-2.1.4.js')}}"></script>
<script src="{{URL::to('js/admin/jquery.menu-aim.js')}}"></script>
<script src="{{URL::to('js/admin/main.js')}}"></script> <!-- Resource jQuery -->
@yield('javascript')
</body>
</html>