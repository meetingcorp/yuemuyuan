<header id="header" data-transparent="false" class="white header-logo-center">
    <div class="header-inner">
		
        <div class="container" style="background-color: #035747">
			<div class="header-extras" style="float: right;">
			<div class="d-block d-sm-none mt-4 mb-1 social-icons social-icons-border social-icons-colored-hover social-icons-rounded right" style="margin-right:-10px;">
                            <ul>
								 <li class="social-gplus"><a class="text-white" target="_blank"
                                        href="tel:{{ setting('tel1') }}"
                                        style="margin-top:3px; margin-right:3px; margin-left:3px;"><i class="fas fa-phone-alt"
                                            aria-hidden="true"></i></a></li>
                                <li class="social-facebook"><a class="text-white" target="_blank" href="{{ setting('facebook_info') }}"
                                        style="margin-top:3px; margin-right:3px; margin-left:3px;"><i class="fab fa-facebook-f"
                                            aria-hidden="true"></i></a></li>

                                <li class="social-line"><a class="text-white" target="_blank"
                                        href="{{ setting('line_info') }}"
                                        style="margin-top:3px; margin-right:3px; margin-left:3px;"><i class="fab fa-line"
                                            aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
				</div>
            <div id="logo" style="margin-top: 8px;">
                <a href="{{ url('/') }}">
                    <span class="logo-default "><img src="{{ asset(setting('logonav')) }}" height="70"
                            style="margin-top:-20px;"></span>
                    <span class="logo-dark "><img src="{{ asset(setting('logonav')) }}" height="70"
                            style="margin-top:-20px;"></span>
                    <span class="logo-responsive"><img src="{{ asset(setting('logonav')) }}" height="70"></span>
                </a>
            </div>
			
            {{-- <div class="header-extras" style="float: right; margin-top: -5px;">
                <div class="header-extras mt-3 social-icons social-icons-large social-icons-border social-icons-rounded social-icons-colored-hover"
                    style="padding: 5px;">
                    <ul>
                        <li class="social-facebook">
                            <a target="_blank" href="{{ setting('facebook_info') }}">
                                <i class="fab fa-facebook-f" style="color:white;"></i>
                            </a>
                        </li>
                        <li class="social-twitter">
                            <a href="#">
                                <i class="fab fa-twitter" style="color:white;"></i>
                            </a>
                        </li>
                        <li class="social-flickr">
                            <a href="#">
                                <i class="fab fa-instagram" style="color:white;"></i>
                            </a>
                        </li>
                        <li class="social-lastfm">
                            <a href="#">
                                <i class="fab fa-google-plus-g" style="color:white;"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div> --}}
            <style>
                #mainMenu nav > ul > li .dropdown-menu > li > a, #mainMenu nav > ul > li .dropdown-menu > li > span, #mainMenu nav > ul > li .dropdown-menu > li [class*=col-] > ul > li > a {
                    font-size:14px !important;
                }
            </style>
            <div id="mainMenu-trigger" style="float: left">
                <a class="lines-button x"><span class="lines"></span> </a>
            </div>
            <div id="mainMenu" class="menu-right menu-rounded">
                <div class="container">
                    <nav>
                        <ul>
                            <li>
                                <a href="{{ url('/') }}">Home</a>
                            </li>
                            <li class="dropdown">
                                <a href="{{ url('/aboutus') }}">About us</a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ url('/aboutus') }}">ทีมแพทย์จีน</a></li>
                                    <li><a href="{{ url('/news') }}">ข่าวสาร</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="{{ url('/service') }}">Service & Promotion</a>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <a href="{{ url('/review') }}">Review</a>
                            </li>
                            <li>
                                <a href="{{ url('/article') }}">Article</a>
                            </li>
                            <li>
                                <a href="{{ url('/contact') }}">Contact</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
