<div class="header">
    <div class="container">
        <nav class="navbar navbar-inverse" role="navigation">
            <div class="navbar-header">
                <button type="button" id="nav-toggle" class="navbar-toggle" data-toggle="collapse" data-target="#main-nav">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="#" class="navbar-brand scroll-top">
                    <div class="logo"></div>
                </a>
            </div>
            <!--/.navbar-header-->
            <div id="main-nav" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="/" class="scroll-top">Home</a></li>
                    
                    <li>

                        @can('view_backend')
                        <a href="{{ route('backend.dashboard') }}" class="btn btn-white"><i class="fas fa-tachometer-alt mr-2"></i> Dashboard</a>
                        @endcan

                    </li>  

                    @auth
                    <li>
                        <a href="{{ route('logout') }}"
                        class="" onclick="event.preventDefault(); document.getElementById('account-logout-form').submit();">Logout</a>
                    </li>
                    <form id="account-logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    @else
                    <li>
                        <a href="{{ route('login') }}" class="">
                            Login
                        </a>
                    </li>
                    @endauth


                    <!-- <li><a href="#" class="scroll-link" data-id="about">About Us</a></li>
                    <li><a href="#" class="scroll-link" data-id="portfolio">Portfolio</a></li>
                    <li><a href="#" class="scroll-link" data-id="blog">Blog</a></li>
                    <li><a href="#" class="scroll-link" data-id="contact">Contact Us</a></li> -->
                </ul>
            </div>
            <!--/.navbar-collapse-->
        </nav>
        <!--/.navbar-->
    </div>
    <!--/.container-->
</div>
<!--/.header-->

<section class="cd-hero">
    <ul class="cd-hero-slider autoplay">  
        <!-- 
            <ul class="cd-hero-slider autoplay"> for slider auto play 
            <ul class="cd-hero-slider"> for disabled auto play
            -->
            <li class="selected first-slide">
                <div class="cd-full-width">
                    <div class="tm-slide-content-div slide-caption">
                        <!-- <span>Introduction to</span> -->
                        <h2>6enddigits</h2>
                        <!-- <p>Phasellus interdum tortor sem. Quisque sit amet condimentum sem. Phasellus luctus, felis sit amet pulvinar luctus.</p>
                        <div class="primary-button">
                            <a href="#" class="scroll-link" data-id="about">Discover More</a>
                        </div> -->                           
                    </div>                   
                </div> <!-- .cd-full-width -->
            </li>

            <li class="second-slide">
                <div class="cd-full-width">
                    <div class="tm-slide-content-div slide-caption">
                        <!-- <span>We Are Perfect Staffs</span> -->
                        <h2>6enddigits</h2>
                        <!-- <p>Donec dolor ipsum, laoreet nec metus non, tempus elementum massa. Donec non elit rhoncus, vestibulum enim sed, rutrum arcu.</p>
                        <div class="primary-button">
                            <a href="#">Read More</a>
                        </div> -->                        
                    </div>                     
                </div> <!-- .cd-full-width -->
            </li>

            <li class="third-slide">
                <div class="cd-full-width">
                    <div class="tm-slide-content-div slide-caption">
                        <!-- <span>Design is a hobby</span> -->
                        <h2>6enddigits</h2>
                        <!-- <p>Integer ut dolor eget magna congue gravida ut at arcu. Vivamus maximus neque quis luctus tempus. Vestibulum consequat.</p>
                        <div class="primary-button">
                            <a href="#">View Details</a>
                        </div> -->                           
                    </div>                         
                </div> <!-- .cd-full-width -->
            </li>
        </ul> <!-- .cd-hero-slider -->

        <div class="cd-slider-nav">
            <nav>
                <span class="cd-marker item-1"></span>
                
                <ul>
                    <li class="selected"><a href="#0"></a></li>
                    <li><a href="#0"></a></li>
                    <li><a href="#0"></a></li>                        
                </ul>
            </nav> 
        </div> <!-- .cd-slider-nav -->
    </section> <!-- .cd-hero -->
