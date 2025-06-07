<header>
    <nav>
        <ul>
            <li>
                <div class="logo-wrapper">
                    <img class="logo" src="{{ asset('images/logo.svg') }}" />
                </div>
            </li>
            <li><a href="#">الرئيسية</a></li>
            <li class="menu">
                <a href="#">الفرص</a>
                <ul class="submenu">
                    <li><a href="#">فرصة ١</a></li>
                    <li><a href="#">فرصة ٢</a></li>
                </ul>
            </li>
            <li><a href="#">موارد معرفية</a></li>
            <li class="active"><a href="#">الباقات</a></li>
        </ul>
    </nav>

    <nav class="auth-links">
        <ul>
            @guest
                <li><a href="{{ route('login') }}" class="punderlined">تسجيل الدخول</a></li>
                <li><a href="{{ route('register') }}" class="pbtn pbtn-main">إنشاء حساب مجانًا</a></li>
                <li>
                    <a href="{{ route('homePageOrganization') }}" class="piconed">
                        <span>للمؤسسات</span>
                        <img src="{{ asset('images/send.svg') }}" />
                    </a>
                </li>
            @endguest

            @auth
                <li style="display: flex; align-items: center; gap: 6px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M5.121 17.804A13.937 13.937 0 0112 15c2.489 0 4.824.672 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>                    <span>مرحبًا، {{ Auth::user()->getTranslation('name', 'ar') }}</span>
                </li>
                                    <li>
                        <a href="#" title="الإشعارات"
                            style="display: inline-flex; align-items: center; padding: 6px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 17h5l-1.5-1.5a2 2 0 01-.5-1.4V11a6 6 0 00-12 0v3.1a2 2 0 01-.5 1.4L4 17h5m6 0v1a3 3 0 11-6 0v-1h6z" />
                            </svg>
                        </a>
                    </li>
                                <li><a href="#" class="pbtn pbtn-light">
              
                            لوحة التحكم</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="pbtn pbtn-danger" style="padding: 6px 12px;">خروج</button>
                    </form>
                </li>
            @endauth
        </ul>
    </nav>

    <div class="mobile">
        <div class="mobile-header">
            <button id="burger-btn" class="burger">
                <!-- Burger Icon -->
                <svg width="32" height="32" fill="#000000" viewBox="0 0 256 256">
                    <path
                        d="M224,128a8,8,0,0,1-8,8H40a8,8,0,0,1,0-16H216A8,8,0,0,1,224,128ZM40,72H216a8,8,0,0,0,0-16H40a8,8,0,0,0,0,16ZM216,184H40a8,8,0,0,0,0,16H216a8,8,0,0,0,0-16Z" />
                </svg>
            </button>
            <div class="logo-wrapper">
                <img class="logo" src="{{ asset('images/logo.svg') }}" />
            </div>
        </div>

        <div id="mobile-menu" class="mobile-main">
            <ul>
                <li><a href="#">الرئيسية</a></li>
                <li>
                    <a href="#">الفرص</a>
                    <ul class="submenu">
                        <li><a href="#">فرصة ١</a></li>
                        <li><a href="#">فرصة ٢</a></li>
                    </ul>
                </li>
                <li><a href="#">موارد معرفية</a></li>
                <li><a href="#">الباقات</a></li>

                @guest
                    <li><a href="{{ route('login') }}" class="punderlined pbtn pbtn-light">تسجيل الدخول</a></li>
                    <li><a href="{{ route('register') }}" class="pbtn pbtn-light ptext-center">إنشاء حساب مجانًا</a></li>
                    <li>
                        <a href="{{ route('homePageOrganization') }}" class="piconed pbtn pbtn-light">
                            <span>للمؤسسات</span>
                            <img src="{{ asset('images/send.svg') }}" />
                        </a>
                    </li>
                @endguest

                @auth
                    <li style="display: flex; align-items: center; gap: 8px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M5.121 17.804A13.937 13.937 0 0112 15c2.489 0 4.824.672 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span style="font-weight: 500;">مرحبًا، {{ Auth::user()->getTranslation('name', 'ar') }}</span>
                    </li>
                    <li>
                        <a href="#" title="الإشعارات"
                            style="display: inline-flex; align-items: center; padding: 6px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 17h5l-1.5-1.5a2 2 0 01-.5-1.4V11a6 6 0 00-12 0v3.1a2 2 0 01-.5 1.4L4 17h5m6 0v1a3 3 0 11-6 0v-1h6z" />
                            </svg>
                        </a>
                    </li>
                    <li><a href="#" class="pbtn pbtn-light">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 17h5l-1.5-1.5a2 2 0 01-.5-1.4V11a6 6 0 00-12 0v3.1a2 2 0 01-.5 1.4L4 17h5m6 0v1a3 3 0 11-6 0v-1h6z" />
                            </svg>
                            لوحة التحكم</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="pbtn pbtn-danger">خروج</button>
                        </form>
                    </li>
                @endauth
            </ul>

            <button id="mobile-menu-close-btn" class="mobile-close">
                <svg width="32" height="32" fill="#ffffff" viewBox="0 0 256 256">
                    <path
                        d="M205.66,194.34a8,8,0,0,1-11.32,11.32L128,139.31,61.66,205.66a8,8,0,0,1-11.32-11.32L116.69,128,50.34,61.66A8,8,0,0,1,61.66,50.34L128,116.69l66.34-66.35a8,8,0,0,1,11.32,11.32L139.31,128Z" />
                </svg>
            </button>
        </div>
    </div>
</header>
