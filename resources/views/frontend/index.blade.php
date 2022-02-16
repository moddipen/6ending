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
<!-- <div id="about" class="page-section">
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
--><div id="what-we-do">
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
