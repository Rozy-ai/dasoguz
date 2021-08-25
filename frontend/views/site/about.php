<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="w3l-aboutblock py-5" id="about">
    <div class="midd-w3">
        <div class="container py-lg-5 py-md-3">
            <div class="row">
                <div class="col-lg-6 left-wthree-img text-righ">
                    <div class="position-relative">
                        <img src="/source/images/g4.jpg" alt="" class="img-fluid">
                        <a href="#small-dialog" class="popup-with-zoom-anim play-view text-center position-absolute">
                            <span class="video-play-icon">
                                <span class="fa fa-play"></span>
                            </span>
                        </a>
                        <!-- dialog itself, mfp-hide class is required to make dialog hidden -->
                        <div id="small-dialog" class="zoom-anim-dialog mfp-hide">
                            <iframe src="https://www.youtube.com/embed/YWA-xbsJrVg" allow="autoplay; fullscreen"
                                allowfullscreen=""></iframe>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mt-lg-0 mt-5 about-right-faq align-self">
                    <span class="text mb-2">About us</span>
                    <h3 class="title-big">Awesome Award-winning web design studio</h3>
                    <p class="mt-4">Lorem ipsum viverra feugiat. Pellen tesque libero ut justo,
                        ultrices in ligula. Semper at tempufddfel. Lorem ipsum dolor sit amet consectetur adipisicing
                        elit. Non quae, fugiat ad.</p>
                    <ol class="w3l-right mt-4">
                        <li>Latest Bootstrap framework</li>
                        <li>Highly Responsive</li>
                        <li>Easy to Customize</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="w3-about-2" id="features">
    <div class="w3-services-ab py-5">
        <div class="container py-lg-5 py-md-4">
            <span class="text text-center mb-2">Iterative process</span>
            <h3 class="title-big text-center mb-5">How we work</h3>
            <div class="w3-services-grids">
                <div class="w3-services-right-grid">
                    <div class="fea-gd-vv row">
                        <div class="col-lg-6">
                            <div class="float-lt feature-gd">
                                <div class="icon"> <span class="number number1">01.</span></div>
                                <div class="icon-info">
                                    <h5>Situational analysis </h5>
                                    <p> Lorem ipsum dolor sit amet, consectetur dolor adipisicing elit, sed eiusmod tempor
                                        incididunt. lorem ipsum dolor sit amet consectetur. </p>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mt-lg-0 mt-4">
                            <div class="float-mid feature-gd">
                                <div class="icon"> <span class="number number2">02.</span></div>
                                <div class="icon-info">
                                    <h5>Marketing goals establishment</h5>
                                    <p> Lorem ipsum dolor sit amet, consectetur dolor adipisicing elit, sed eiusmod tempor
                                        incididunt. lorem ipsum dolor sit amet consectetur. </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mt-4 pt-md-2">
                            <div class="float-rt feature-gd">
                                <div class="icon"> <span class="number number3">03.</span></div>
                                <div class="icon-info">
                                    <h5>Defining the marketing strategy</h5>
                                    <p> Lorem ipsum dolor sit amet, consectetur dolor adipisicing elit, sed eiusmod tempor
                                        incididunt. lorem ipsum dolor sit amet consectetur. </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mt-4 pt-md-2">
                            <div class="float-lt feature-gd">
                                <div class="icon"> <span class="number number4">04.</span></div>
                                <div class="icon-info">
                                    <h5>Measuring results</h5>
                                    <p> Lorem ipsum dolor sit amet, consectetur dolor adipisicing elit, sed eiusmod tempor
                                        incididunt. lorem ipsum dolor sit amet consectetur. </p>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- services page block 3 -->
<section class="w3l-mobile-content-6 py-5">
    <div class="mobile-info py-lg-5 py-md-4">
        <!-- /mobile-info-->
        <div class="container">
            <span class="text text-center mb-2">Why Choose Us</span>
            <h3 class="title-big text-center mb-5">Industry innovators since 2020 </h3>
            <div class="row mobile-info-inn">
                <div class="col-lg-6 image-left">
                    <img src="/source/images/g3.jpg" class="radius-image img-fluid" alt="">
                </div>
                <div class="col-lg-6 mobile-right mt-lg-0 mt-5">
                    <div class="row mobile-right-grids mb-md-5 mb-4">
                        <div class="col-lg-2 col-md-1 col-2 mobile-right-icon">
                            <div class="mobile-icon text-lg-right mt-2">
                                <span class="fa fa-files-o"></span>
                            </div>
                        </div>
                        <div class="col-lg-10 col-md-11 col-10 mobile-right-info">
                            <h6><a href="#url">Content marketing </a></h6>
                            <p>Lorem ipsum dolor sit amet,Ea sed illum facere aperiam sequi optio consectetur
                                adipisicing elit.</p>
                        </div>
                    </div>
                    <div class="row mobile-right-grids mb-md-5 mb-4">
                        <div class="col-lg-2 col-md-1 col-2 mobile-right-icon">
                            <div class="mobile-icon text-lg-right mt-1">
                                <span class="fa fa-search"></span>
                            </div>
                        </div>
                        <div class="col-lg-10 col-md-11 col-10 mobile-right-info">
                            <h6><a href="#url">Search engine optimization</a></h6>
                            <p>Lorem ipsum dolor sit amet,Ea sed illum facere aperiam sequi optio consectetur
                                adipisicing elit.</p>
                        </div>
                    </div>
                    <div class="row mobile-right-grids">
                        <div class="col-lg-2 col-md-1 col-2 mobile-right-icon">
                            <div class="mobile-icon text-lg-right">
                                <span class="fa fa-video-camera"></span>
                            </div>
                        </div>
                        <div class="col-lg-10 col-md-11 col-10 mobile-right-info">
                            <h6><a href="#url">Social media marketing </a></h6>
                            <p>Lorem ipsum dolor sit amet,Ea sed illum facere aperiam sequi optio consectetur
                                adipisicing elit.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- //mobile-info-->
    </div>
</section>
<!-- services page block 3 -->
<!--/testimonials-->
<section class="w3l-clients" id="clients">
    <!-- /grids -->
    <div class="cusrtomer-layout py-5">
        <div class="container py-lg-5 py-md-4">
            <div class="heading text-center mx-auto">
                <span class="text text-center mb-2">Our Testimonials</span>
                <h3 class="title-big-portfolio mb-5">2000+ Positive reviews by our satisfied clients </h3>
            </div>
            <!-- /grids -->
            <div class="testimonial-width">
                <div id="owl-demo1" class="owl-carousel owl-theme mb-4">
                    <div class="item">
                        <div class="testimonial-content">
                            <div class="testimonial">
                                <blockquote>
                                    <q>Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit beatae laudantium
                                        voluptate rem ullam dolore nisi voluptatibus esse quasi, doloribus tempora.
                                        Dolores molestias adipisci dolor sit amet!.</q>
                                </blockquote>
                                <div class="testi-des">
                                    <div class="test-img"><img src="/source/images/team1.jpg" class="img-fluid" alt="/">
                                    </div>
                                    <div class="peopl align-self">
                                        <h3>Johnson smith</h3>
                                        <p class="indentity">Seattle, Washington</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimonial-content">
                            <div class="testimonial">
                                <blockquote>
                                    <q>Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit beatae laudantium
                                        voluptate rem ullam dolore nisi voluptatibus esse quasi, doloribus tempora.
                                        Dolores molestias adipisci dolor sit amet!.</q>
                                </blockquote>
                                <div class="testi-des">
                                    <div class="test-img"><img src="/source/images/team2.jpg" class="img-fluid" alt="/">
                                    </div>
                                    <div class="peopl align-self">
                                        <h3>Alexander leo</h3>
                                        <p class="indentity">Seattle, Washington</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimonial-content">
                            <div class="testimonial">
                                <blockquote>
                                    <q>Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit beatae laudantium
                                        voluptate rem ullam dolore nisi voluptatibus esse quasi, doloribus tempora.
                                        Dolores molestias adipisci dolor sit amet!.</q>
                                </blockquote>
                                <div class="testi-des">
                                    <div class="test-img"><img src="/source/images/team3.jpg" class="img-fluid" alt="/">
                                    </div>
                                    <div class="peopl align-self">
                                        <h3>Roy Linderson</h3>
                                        <p class="indentity">Seattle, Washington</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimonial-content">
                            <div class="testimonial">
                                <blockquote>
                                    <q>Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit beatae laudantium
                                        voluptate rem ullam dolore nisi voluptatibus esse quasi, doloribus tempora.
                                        Dolores molestias adipisci dolor sit amet!.</q>
                                </blockquote>
                                <div class="testi-des">
                                    <div class="test-img"><img src="/source/images/team4.jpg" class="img-fluid" alt="/">
                                    </div>
                                    <div class="peopl align-self">
                                        <h3>Mike Thyson</h3>
                                        <p class="indentity">Seattle, Washington</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimonial-content">
                            <div class="testimonial">
                                <blockquote>
                                    <q>Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit beatae laudantium
                                        voluptate rem ullam dolore nisi voluptatibus esse quasi, doloribus tempora.
                                        Dolores molestias adipisci dolor sit amet!.</q>
                                </blockquote>
                                <div class="testi-des">
                                    <div class="test-img"><img src="/source/images/team2.jpg" class="img-fluid" alt="/">
                                    </div>
                                    <div class="peopl align-self">
                                        <h3>Laura gill</h3>
                                        <p class="indentity">Seattle, Washington</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimonial-content">
                            <div class="testimonial">
                                <blockquote>
                                    <q>Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit beatae laudantium
                                        voluptate rem ullam dolore nisi voluptatibus esse quasi, doloribus tempora.
                                        Dolores molestias adipisci dolor sit amet!.</q>
                                </blockquote>
                                <div class="testi-des">
                                    <div class="test-img"><img src="/source/images/team3.jpg" class="img-fluid" alt="/">
                                    </div>
                                    <div class="peopl align-self">
                                        <h3>Smith Johnson</h3>
                                        <p class="indentity">Seattle, Washington</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /grids -->
    </div>
    <!-- //grids -->
</section>
<!--//testimonials-->
<section class="w3l-team" id="team">
	<div class="teams1 py-5 mb-3">
		<div class="container py-lg-3 pb-lg-5 pb-4">
			<div class="teams1-content">
                <span class="text text-center mb-2">Lovely team</span>
                <h3 class="title-big text-center mb-5">Meet Our Team</h3>
					<div class="owl-carousel owl-theme text-center">
						<div class="item">
							<div class="d-grid team-info">
								<div class="column position-relative">
									<a href="#url"><img src="/source/images/team1.jpg" alt="" class="img-fluid rounded team-image" /></a>
								</div>
								<div class="column">
									<h3 class="name-pos"><a href="#url">Anthony</a></h3>
									<p>Project Manager</p>
									<div class="social">
										<a href="#facebook" class="facebook"><span class="fa fa-facebook" aria-hidden="true"></span></a>
										<a href="#twitter" class="twitter"><span class="fa fa-twitter" aria-hidden="true"></span></a>
										<a href="#linkedin" class="linkedin"><span class="fa fa-linkedin" aria-hidden="true"></span></a>
									</div>
								</div>
							</div>
						</div>
						<div class="item">
							<div class="d-grid team-info">
								<div class="column position-relative">
									<a href="#url"><img src="/source/images/team2.jpg" alt="" class="img-fluid rounded team-image" /></a>
								</div>
								<div class="column">
									<h3 class="name-pos"><a href="#url">Dennis Jack</a></h3>
									<p>Team Lead</p>
									<div class="social">
										<a href="#facebook" class="facebook"><span class="fa fa-facebook" aria-hidden="true"></span></a>
										<a href="#twitter" class="twitter"><span class="fa fa-twitter" aria-hidden="true"></span></a>
										<a href="#linkedin" class="linkedin"><span class="fa fa-linkedin" aria-hidden="true"></span></a>
									</div>
								</div>
							</div>
						</div>
						<div class="item">
							<div class="d-grid team-info">
								<div class="column position-relative">
									<a href="#url"><img src="/source/images/team3.jpg" alt="" class="img-fluid rounded team-image" /></a>
								</div>
								<div class="column">
									<h3 class="name-pos"><a href="#url">Harold</a></h3>
									<p>Web Developer</p>
									<div class="social">
										<a href="#facebook" class="facebook"><span class="fa fa-facebook" aria-hidden="true"></span></a>
										<a href="#twitter" class="twitter"><span class="fa fa-twitter" aria-hidden="true"></span></a>
										<a href="#linkedin" class="linkedin"><span class="fa fa-linkedin" aria-hidden="true"></span></a>
									</div>
								</div>
							</div>
						</div>
						<div class="item">
							<div class="d-grid team-info">
								<div class="column position-relative">
									<a href="#url"><img src="/source/images/team4.jpg" alt="" class="img-fluid rounded team-image" /></a>
								</div>
								<div class="column">
									<h3 class="name-pos"><a href="#url">Lawrence</a></h3>
									<p>Web Designer</p>
									<div class="social">
										<a href="#facebook" class="facebook"><span class="fa fa-facebook" aria-hidden="true"></span></a>
										<a href="#twitter" class="twitter"><span class="fa fa-twitter" aria-hidden="true"></span></a>
										<a href="#linkedin" class="linkedin"><span class="fa fa-linkedin" aria-hidden="true"></span></a>
									</div>
								</div>
							</div>
						</div>
						<div class="item">
							<div class="d-grid team-info">
								<div class="column position-relative">
									<a href="#url"><img src="/source/images/team2.jpg" alt="" class="img-fluid rounded team-image" /></a>
								</div>
								<div class="column">
									<h3 class="name-pos"><a href="#url">Bradley</a></h3>
									<p>Graphic Designer</p>
									<div class="social">
										<a href="#facebook" class="facebook"><span class="fa fa-facebook" aria-hidden="true"></span></a>
										<a href="#twitter" class="twitter"><span class="fa fa-twitter" aria-hidden="true"></span></a>
										<a href="#linkedin" class="linkedin"><span class="fa fa-linkedin" aria-hidden="true"></span></a>
									</div>
								</div>
							</div>
						</div>
					</div>
			</div>
		</div>
	</div>
</section>
<div class="quote py-5">
    <div class="container py-lg-4">
        <div class="quote-left">
            <div class="left">
                <h3 class="title-big mb-3">We have offered the best pricing to make life easier!</h3>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dolorum impedit aut quae reprehenderit
                    iusto
                    nihil itaque facilis sapiente at fugit?</p>
            </div>
            <a href="#pricing" class="btn btn-style btn-effect mt-lg-0 mt-4">Check our Pricing plans</a>
        </div>
    </div>
</div>