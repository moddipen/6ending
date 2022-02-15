@extends('frontend.layouts.app')

@section('title') {{app_name()}} @endsection

@section('content')

<!-- <section class="section-header pb-6 pb-lg-10 bg-primary text-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 text-center">
                <h1 class="display-1 mb-4">{{app_name()}}</h1>
                <p class="lead text-muted">
                    {!! setting('meta_description') !!}
                </p>


            </div>
        </div>
    </div>
     <div class="pattern bottom"></div>
</section>

<section class="section section-ld">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="mb-4 mb-lg-5" style="text-align: center;">Comming Soon</h1>
            </div>
            
        </div>
    </div>
</section>
-->
<div id="about" class="page-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-heading">
                    <h4>What We Do</h4>
                    <div class="line-dec"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="service-item first-service">
                    <div class="icon"></div>
                    <h4>Easy Customizations</h4>
                    <p>Meteor is free HTML website template by Tooplate. Feel free to use this layout for your project.</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="service-item second-service">
                    <div class="icon"></div>
                    <h4>Creative Ideas</h4>
                    <p>Biodiesel schltz suculents phone cliche ramps snackwave coloring book tumeric poke, typewriter.</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="service-item third-service">
                    <div class="icon"></div>
                    <h4>Good Profit</h4>
                    <p>Biodiesel schltz suculents phone cliche ramps snackwave coloring book tumeric poke, typewriter.</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="service-item fourth-service">
                    <div class="icon"></div>
                    <h4>Open To Public</h4>
                    <p>Biodiesel schltz suculents phone cliche ramps snackwave coloring book tumeric poke, typewriter.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="what-we-do">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="left-text">
                    <h4>New offers just arrived,<br>Get it now and take profit.</h4>
                    <p>Gochujang pitchfork post-ironic hammock kombucha fanny pack cronut. Raw denim chicharrones semiotics af truffaut pinterest. Distillery letterpress authentic adaptogen. Meditation schlitz humblebrag photo booth celiac cliche chartreuse.<br><br>Pinterest 90's wolf celiac dreamcatcher listicle deep v semiotics. Intelligentsia literally meggings trust fund put a bird on it. Shoreditch crucifix artisan pug shaman twee. Health goth bicycle rights retro iPhone.</p>
                    <!-- <ul>
                        <li>
                            <div class="white-button">
                                <a href="#" class="scroll-link" data-id="portfolio">Discover More</a>
                            </div>
                        </li>
                        <li>
                            <div class="primary-button">
                                <a href="#">Purchase Now</a>
                            </div>
                        </li>
                    </ul> -->
                </div>
            </div>
            <div class="col-md-6">
                <div class="right-image">
                    <img src="img/what-we-do-right-image.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
</div>


<!-- <div id="portfolio" class="page-section">
    <div class="content-wrapper">
        <div class="inner-container container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-heading">
                        <h4>Our Portfolio</h4>
                        <div class="line-dec"></div>
                    </div>
                </div>
            </div>
            <div class="projects-holder-3">
                <div class="filter-categories">
                    <ul class="project-filter">
                        <li class="filter" data-filter="all"><span>All</span></li>
                        <li class="filter" data-filter="nature"><span>Nature</span></li>
                        <li class="filter" data-filter="workspace"><span>Workspace</span></li>
                        <li class="filter" data-filter="city"><span>City</span></li>
                        <li class="filter" data-filter="technology"><span>Technology</span></li>
                    </ul>
                </div>
                <div class="projects-holder">
                    <div class="row">
                        <div class="col-md-3 col-sm-6 project-item mix workspace">
                          <div class="thumb">
                              <div class="image">
                                <img src="img/portfolio_01.jpg">
                            </div>
                            <div class="hover-effect">
                                <a href="img/portfolio_big_01.jpg" data-lightbox="image-1"><i class="fa fa-search"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 project-item mix workspace">
                      <div class="thumb">
                          <div class="image">
                            <img src="img/portfolio_02.jpg">
                        </div>
                        <div class="hover-effect">
                            <a href="img/portfolio_big_02.jpg" data-lightbox="image-1"><i class="fa fa-search"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 project-item mix technology">
                  <div class="thumb">
                      <div class="image">
                        <img src="img/portfolio_03.jpg">
                    </div>
                    <div class="hover-effect">
                        <a href="img/portfolio_big_03.jpg" data-lightbox="image-1"><i class="fa fa-search"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 project-item mix city">
              <div class="thumb">
                  <div class="image">
                    <img src="img/portfolio_04.jpg">
                </div>
                <div class="hover-effect">
                    <a href="img/portfolio_big_04.jpg" data-lightbox="image-1"><i class="fa fa-search"></i></a>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 project-item mix nature">
          <div class="thumb">
              <div class="image">
                <img src="img/portfolio_05.jpg">
            </div>
            <div class="hover-effect">
                <a href="img/portfolio_big_05.jpg" data-lightbox="image-1"><i class="fa fa-search"></i></a>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 project-item mix technology">
      <div class="thumb">
          <div class="image">
            <img src="img/portfolio_06.jpg">
        </div>
        <div class="hover-effect">
            <a href="img/portfolio_big_06.jpg" data-lightbox="image-1"><i class="fa fa-search"></i></a>
        </div>
    </div>
</div>
<div class="col-md-3 col-sm-6 project-item mix workspace">
  <div class="thumb">
      <div class="image">
        <img src="img/portfolio_07.jpg">
    </div>
    <div class="hover-effect">
        <a href="img/portfolio_big_07.jpg" data-lightbox="image-1"><i class="fa fa-search"></i></a>
    </div>
</div>
</div>
<div class="col-md-3 col-sm-6 project-item mix city">
  <div class="thumb">
      <div class="image">
        <img src="img/portfolio_08.jpg">
    </div>
    <div class="hover-effect">
        <a href="img/portfolio_big_08.jpg" data-lightbox="image-1"><i class="fa fa-search"></i></a>
    </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div> 
</div>
-->

<!-- <div id="blog" class="page-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-heading">
                    <h4>Our Blog Posts</h4>
                    <div class="line-dec"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="blog-item b1">
                    <div class="thumb">
                        <img src="img/blog_01.jpg" alt="">
                        <div class="text-content">
                            <h4>Delecioius Food Served</h4>
                            <span>Posted: <em>George</em>  /  Date: <em>11 Aug 2017</em>  /  Category: <em>Design</em></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="blog-item second-blog b2">
                    <div class="thumb">
                        <img src="img/blog_02.jpg" alt="">
                        <div class="text-content">
                            <h4>Creative &amp; Clean Workspace</h4>
                            <span>Posted: <em>Kerley</em>  /  Date: <em>24 Jul 2017</em>  /  Category: <em>Artwork</em></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="blog-item b3">
                    <div class="thumb">
                        <img src="img/blog_03.jpg" alt="">
                        <div class="text-content">
                            <h4>Crashed Plane Captured</h4>
                            <span>Posted: <em>Johnny</em>  /  Date: <em>16 Jul 2017</em>  /  Category: <em>Branding</em></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="pop">
                  <span>✖</span>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin quis neque lacinia, porta nulla in, pellentesque ante. Vivamus in luctus mauris, non pharetra nibh. Morbi porttitor nisl sit amet velit pellentesque consequat. Etiam blandit libero turpis, id vehicula leo posuere a. In vel massa sollicitudin, tincidunt massa et, tincidunt ex.<br><br>Duis volutpat condimentum mollis. Sed eleifend libero ut viverra mattis. Suspendisse consectetur diam dolor, ut efficitur sem finibus vel. Vivamus tristique lacus sed dapibus varius. Fusce pharetra, quam quis congue pretium, ante dui imperdiet ipsum, eget lobortis leo leo sed diam.</p>
              </div>
              <div class="pop2">
                  <span>✖</span>
                  <p>Praesent purus leo, aliquet et efficitur id, pulvinar scelerisque enim. Maecenas a arcu sagittis, ornare ante ut, suscipit lectus. Donec dolor ipsum, laoreet nec metus non, tempus elementum massa. Donec non elit rhoncus, vestibulum enim sed, rutrum arcu. Vestibulum et purus ac diam condimentum volutpat sed ac est. Phasellus interdum tortor sem. Quisque sit amet condimentum sem. Phasellus luctus, felis sit amet pulvinar luctus, lectus dui mattis tellus, et placerat nunc ante at lacus.<br><br>Vivamus vestibulum, nisi sed placerat accumsan, felis felis venenatis tortor, vel condimentum arcu neque vel mauris. Donec a magna gravida, egestas libero non, molestie massa. Integer ut dolor eget magna congue gravida ut at arcu. Vivamus maximus neque quis luctus tempus. Vestibulum consequat a justo id feugiat. </p>
              </div>
              <div class="pop3">
                  <span>✖</span>
                  <p>Nullam rhoncus, orci et iaculis sodales, quam lectus suscipit augue, ut auctor massa dolor id metus. Nulla porta ut diam sodales dignissim. Ut sit amet augue vel justo laoreet dignissim. Maecenas vitae sollicitudin eros. In commodo placerat cursus. Quisque malesuada, nisl ac lacinia commodo, justo eros maximus ex, quis cursus odio erat at neque. Sed tincidunt eu dolor eget posuere.<br><br>Curabitur sit amet elit sit amet ligula eleifend aliquam quis eget quam. Mauris id mi nec justo venenatis tincidunt at ac massa. Sed et volutpat nunc. Quisque at urna quam. Duis sit amet neque eget quam iaculis iaculis. Quisque maximus porta elementum. Nam ac mattis erat, quis accumsan odio.</p>
              </div>
          </div>
      </div>
  </div>
</div>
-->
<div id="fun-facts">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="fact-item">
                    <div class="counter" data-count="926">0</div>
                    <span>Total Users</span>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="fact-item">
                    <div class="counter" data-count="214">0</div>
                    <span>Total Matches</span>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="fact-item">
                    <div class="counter" data-count="118">0</div>
                    <span>Total Coins</span>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="fact-item">
                    <div class="counter" data-count="16">0</div>
                    <span>Total Bets</span>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- <div id="contact" class="page-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-heading">
                    <h4>Contact Us</h4>
                    <div class="line-dec"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="map">
                    <img src="img/map.jpg" alt="">
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                  <form id="contact" action="" method="post">
                    <div class="col-md-6">
                      <fieldset>
                        <input name="name" type="text" class="form-control" id="name" placeholder="Your name..." required="">
                    </fieldset>
                </div>
                <div class="col-md-6">
                  <fieldset>
                    <input name="email" type="email" class="form-control" id="email" placeholder="Your email..." required="">
                </fieldset>
            </div>
            <div class="col-md-12">
              <fieldset>
                <textarea name="message" rows="6" class="form-control" id="message" placeholder="Your message..." required=""></textarea>
            </fieldset>
        </div>
        <div class="col-md-12">
          <fieldset>
            <button type="submit" id="form-submit" class="btn">Send Message</button>
        </fieldset>
    </div>
</form>
</div>
</div>
</div>
</div>
</div>
-->

@endsection
