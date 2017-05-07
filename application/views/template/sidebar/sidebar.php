<!-- Navigation -->
    <a id="menu-toggle" href="#" class="btn btn-dark btn-lg toggle"><i class="fa fa-bars"></i></a>
    <nav id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <a id="menu-close" href="#" class="btn btn-light btn-lg pull-right toggle"><i class="fa fa-times"></i></a>
            <li class="sidebar-brand">
                <a href="<?=base_url() . "home"?>">Start Bootstrap</a>
            </li>
            <li>
                <a href="<?=base_url() . 'profile/profile'?>">個人資料</a>
            </li>
			<li>
                <a href="javascript:logout()" type="submit">Logout</a>
            </li>
        </ul>
    </nav>