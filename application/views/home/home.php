<!-- Header -->
    <header id="top" class="header">
        <div class="text-vertical-center">
            <h1>外送查</h1>
            <h3>滿足 你 &amp; 我 &amp; 他 必需性需求</h3>
            <br>
            <a href="#about" class="btn btn-dark btn-lg">點我了解更多</a>
        </div>
    </header>

    <!-- About -->
    <section id="about" class="about bg2">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center" >
                    <h1 class="text">story</h1>
                    <p class="lead text">現今每個人都有空閒時間，透過共享經濟讓有空的人幫助需要幫助的人，不僅止於餐點也可以幫忙外送東西，只需要簡單小額便可以到所需，雙方得利，互取所需</p>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>

    <!-- Services -->
    <!-- The circle icons use Font Awesome's stacked icon classes. For more information, visit http://fontawesome.io/examples/ -->
    
    <!-- Callout -->
    <aside class="callout">
        <div class="text-vertical-center">
            <h1></h1>
        </div>
    </aside>

    <!-- Portfolio -->
    <section id="portfolio" class="portfolio bg">
        <div class="container ">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1 text-center">
                    <h2 class="text">Our Work</h2>
                    <hr class="small">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="portfolio-item">
							 <h2 class="text">Deliver</h2>
                                <a href="#">
                                    <img class="img-portfolio img-responsive" src="<?=base_url('assets/home/img/deliver.jpg');?>">
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="portfolio-item">
							 <h2 class="text">Shop</h2>
                                <a href="#">
                                    <img class="img-portfolio img-responsive" src="<?=base_url('assets/home/img/shop.jpg');?>">
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="portfolio-item">
							 <h2 class="text">Convenient</h2>
                                <a href="#">
                                    <img class="img-portfolio img-responsive" src="<?=base_url('assets/home/img/busy.jpg');?>">
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="portfolio-item">
							 <h2 class="text">Mutual benefit</h2>
                                <a href="#">
                                    <img class="img-portfolio img-responsive" src="<?=base_url('assets/home/img/hand.jpg');?>">
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- /.row (nested) -->
                    <a href="#" class="btn btn-dark">View More Items</a>
                </div>
                <!-- /.col-lg-10 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>

    <!-- Call to Action -->
    

    <!-- Map -->
    

    <!-- Footer -->
    <footer>
        <div class="container footer-bg">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1 text-center">
                    <h4><strong>外送查總公司</strong>
                    </h4>
                    <p>807高雄市三民區</p>
                    <ul class="list-unstyled">
                        <li><i class="fa fa-phone fa-fw"></i> (07) 123-456</li>
                        <li><i class="fa fa-envelope-o fa-fw"></i> <a href="mailto:delivery@example.com">delivery@example.com</a>
                        </li>
                    </ul>
                    <br>
                    <ul class="list-inline">
                        <li>
                            <a href="#"><i class="fa fa-facebook fa-fw fa-3x"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-twitter fa-fw fa-3x"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-dribbble fa-fw fa-3x"></i></a>
                        </li>
                    </ul>
                    <hr class="small">
                    <p class="text-muted">Copyright &copy; delivery 2017</p>
                </div>
            </div>
        </div>
        <a id="to-top" href="#top" class="btn btn-dark btn-lg"><i class="fa fa-chevron-up fa-fw fa-1x"></i></a>
    </footer>
	
	
	<script>
		// Disable Google Maps scrolling
		// See http://stackoverflow.com/a/25904582/1607849
		// Disable scroll zooming and bind back the click event
		var onMapMouseleaveHandler = function(event) {
			var that = $(this);
			that.on('click', onMapClickHandler);
			that.off('mouseleave', onMapMouseleaveHandler);
			that.find('iframe').css("pointer-events", "none");
		}
		var onMapClickHandler = function(event) {
				var that = $(this);
				// Disable the click handler until the user leaves the map area
				that.off('click', onMapClickHandler);
				// Enable scrolling zoom
				that.find('iframe').css("pointer-events", "auto");
				// Handle the mouse leave event
				that.on('mouseleave', onMapMouseleaveHandler);
			}
			// Enable map zooming with mouse scroll when the user clicks the map
		$('.map').on('click', onMapClickHandler);
	</script>