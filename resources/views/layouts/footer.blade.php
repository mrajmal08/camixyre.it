{{-- FOOTER --}}
<footer class="pattern footer-type1 pt-30">
	<div class="footer-top">
		<div class="container">
			<div class="row">
				<!-- footer widget -->
				<div class="col-md-6 col-lg-4 col-sm-6">
					<div class="footer-widget">
						<div class="footer-logo">
							<a href="/{{$lang}}/home"><img src="/web-assets/img/logo.png" alt=""></a>
						</div>
						<div class="footer-about-text">
							<p>The thing that makes Camixyre Drones so user friendly are the obstacle avoidance and vision sensors on the drone themselves. These sensors work together to keep the drone in one place even if your hands are off the controller and there are 15 mph winds.</p>
						</div>
					</div>
				</div>
				<!-- End of footer widget -->

				<!-- footer widget -->
				<div class="col-md-6 col-lg-4 col-sm-6">
					<div class="footer-widget">
						<!-- footer Widget heading -->
						<div class="footer-header">
							<h5>Useful Links</h5>
						</div>
						<!--End of footer Widget heading -->
						<div class="footer-links">
							<ul class="links-list list-unstyled mb-0">
								@foreach($footerPages as $page)
									@switch($lang)
										@case("en")
											@php
												$pageTitle = $page->title_en;
												$pageUrl   = $page->url_en;
											@endphp
											@break
										@case("it")
											@php
												$pageTitle = (empty($page->title_it)) ? $page->title_en : $page->title_it;
												$pageUrl   = (empty($page->url_it)) ? $page->url_en : $page->url_it;
											@endphp
											@break
										@case("fr")
											@php
												$pageTitle = (empty($page->title_fr)) ? $page->title_en : $page->title_fr;
												$pageUrl   = (empty($page->url_fr)) ? $page->url_en : $page->url_fr;
											@endphp
											@break
										@case("es")
											@php
												$pageTitle = (empty($page->title_es)) ? $page->title_en : $page->title_es;
												$pageUrl   = (empty($page->url_es)) ? $page->url_en : $page->url_es;
											@endphp
											@break
										@case("de")
											@php
												$pageTitle = (empty($page->title_de)) ? $page->title_en : $page->title_de;
												$pageUrl   = (empty($page->url_de)) ? $page->url_en : $page->url_de;
											@endphp
											@break
										@default
											@php
												$pageTitle = $page->title_en;
												$pageUrl   = $page->url_en;
											@endphp
									@endswitch
									<li>
										<a href="/{{$lang}}/page/{{ $pageUrl }}">{{ $pageTitle }}</a>
									</li>
								@endforeach
							</ul>
						</div>
					</div>
				</div>
				<!-- End of footer widget -->

				<!-- footer widget -->
				<div class="col-md-6 col-lg-4 col-sm-6">
					<div class="footer-widget">
						<!-- footer Widget heading -->
						<div class="footer-header">
							<h5>Contact Us</h5>
						</div>
						<!--End of footer Widget heading -->
						<div class="footer-contact-wrap">
							<ul class="footer-contact-list list-unstyled mb-0">
								<li>
									<span><i class="fa fa-building" aria-hidden="true"></i></span>
									CA&RE s.r.l.<br>P.IVA: 02825780907 
								</li>
								<li>
									<span><i class="fa fa-map-marker" aria-hidden="true"></i></span>
									OSSI (SS) Località Monte Muros snc<br>C.A.P. 07045 ITALIA 
								</li>
								<li>
									<span><i class="fa fa-envelope" aria-hidden="true"></i></span>
									<a href="mailto:info@camixyre.it">Email: info@camixyre.it</a>
								</li>
							</ul>
						</div>
						<div class="footer-social-area">
							<ul class="list-unstyled mb-0">
								<li>
									<a href="https://www.facebook.com/camixyre.it"><i class="fa fa-facebook"></i></a>
								</li>
								<li>
									<a href="https://twitter.com/camixyre"><i class="fa fa-twitter"></i></a>
								</li>
								<li>
									<a href="https://www.pinterest.it/CAMIXYRE/"><i class="fa fa-pinterest"></i></a>
								</li>
								<li>
									<a href="https://www.instagram.com/camixyre/?igshid=1b2cj1lmywsmc"><i class="fa fa-instagram"></i></a>
								</li>
								<li>
									<a href="https://www.youtube.com/channel/UCRJKovNy9A1cpAR4pq1B9LQ?view_as=subscriber"><i class="fa fa-youtube"></i></a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- End of footer widget -->
			</div>
		</div>
	</div>
	<div class="footer-bottom">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="footer-bottom-wrap">
						<!-- copyright text -->
						<div class="copyright-text">
							<p><a href="/{{$lang}}/home">Camixyre</a> © 2021. All rights reserved</p>
						</div>
						<!-- End of copyright text -->

						<!-- tarms and condition -->
						<div class="trams-conditaion">
							<ul class="list-unstyled mb-0">
								<li>
									<img src="/web-assets/img/payment.png" alt="">
								</li>
							</ul>
						</div>
						<!-- End of tarms and condition -->
					</div>

				</div>
			</div>
		</div>
	</div>
</footer>