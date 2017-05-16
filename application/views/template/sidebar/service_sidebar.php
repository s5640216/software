<!-- Navigation -->
    <a id="menu-toggle" href="#" class="btn btn-dark btn-lg toggle"><i class="fa fa-bars"></i></a>
    <nav id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <a id="menu-close" href="#" class="btn btn-light btn-lg pull-right toggle"><i class="fa fa-times"></i></a>
            <li class="sidebar-brand">
                <a href="<?=base_url() . "home"?>">首頁</a>
            </li>
            <li>
                <a href="<?=base_url() . 'profile/profile'?>">個人資料</a>
            </li>
			<li>
                <a href="<?=base_url() . 'store/store'?>">店家資訊</a>
            </li>
			<li>
                <a href="<?=base_url() . 'order/order/receive_order_view'?>">接收訂單</a>
            </li>
			<li>
                <a href="<?=base_url() . 'order/order'?>">訂單紀錄</a>
            </li>
			<li>
                <a href="<?=base_url() . 'customer/customer_service'?>">聯絡客服</a>
            </li>
			<li>
                <a href="javascript:logout()" type="submit">登出</a>
            </li>
        </ul>
    </nav>