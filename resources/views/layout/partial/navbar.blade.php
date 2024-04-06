{{-- <div class="nav">
    <div class="navbar">
        <i class='bx bx-menu'></i>
        <div class="logo"><a href="#">Mooi.lloons</a></div>
        <div class="nav-links">
            <div class="sidebar-logo">
                <span class="logo-name">Mooi.lloons</span>
                <i class='bx bx-x'></i>
            </div>
            <ul class="links">
                <li><a href="#">Home</a></li>
                <li>
                    <a href="/products">Products</a>
                    <i class='bx bxs-chevron-down htmlcss-arrow arrow '></i>
                    <ul class="htmlCss-sub-menu sub-menu">
                        @foreach ($categories as $category)
                            <li><a href="/products?category={{ $category->slug }}">{{ $category->nama }}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li>
                    <a href="#">JAVASCRIPT</a>
                    <i class='bx bxs-chevron-down js-arrow arrow '></i>
                    <ul class="js-sub-menu sub-menu">

                        <li><a href="#">Form Validation</a></li>
                        <li><a href="#">Card Slider</a></li>
                        <li><a href="#">Complete Website</a></li>
                    </ul>
                </li>
                <li><a href="#">ABOUT US</a></li>
                <li><a href="#">CONTACT US</a></li>
                <li><a href="#">Dashboard</a></li>
            </ul>
        </div>
        <div class="nav-button">
            <div class="user">
                <img src="logo.png" alt="">
                <div class="user-box">
                    <ul>
                        <li><a href="#"><i class='bx bx-user'></i>Akun Saya</a></li>
                        <li><a href="#"><i class='bx bx-cart'></i>Cart</a></li>
                        <li><a href="#"><i class='bx bx-log-out'></i>Logout</a></li>
                    </ul>
                </div>
            </div>
            <form class="search-box">
                <i class='bx bx-search'></i>
                <div class="input-box">
                    <input type="text" placeholder="Search...">
                </div>
            </form>
        </div>
    </div>
</div> --}}
<div x-data="{ scrolled: false, isOpen: false, links: ['home', 'products', 'contact', 'about'] }" @scroll.window="scrolled = (window.pageYOffset > 0)" class="fixed w-full">
    <!-- Navbar -->
    <nav class="w-full py-4 transition-all duration-500 bg-sky-500 px-7p"
        :class="{ 'bg-transparent text-black shadow-md py-7': !scrolled, 'bg-sky-400 text-white': scrolled }">
        <div class="container flex items-center justify-between " @scroll.window="scrolled = (window.pageYOffset > 30)">
            <!-- Logo -->
            <div class="flex-shrink-0 ">
                <a href="#" class="text-2xl font-[700] text-inherit font-comfortaa">Mooi.lloons</a>
            </div>
            <!-- Links -->
            <div class="items-center hidden space-x-6 md:flex">
                <template x-for="link in links">
                    <a :href="link" class="capitalize text-inherit" x-text="link"></a>
                </template>
            </div>
            <!-- Searchbar and Menu Button -->
            <div class="relative flex items-center space-x-4" x-data="{ userOpen: false }">
                <!-- Searchbar -->
                <form action="/" method="get">
                    <input type="text" placeholder="Search"
                        class="px-3 py-2 text-black placeholder-gray-400 rounded-md bg-blue-50 focus:outline-none"
                        :class="{ 'bg-transparent border-blue-400 border': !scrolled, 'bg-blue-50 ': scrolled }">
                </form>
                <i class="text-2xl cursor-pointer text-inherit bx bx-log-in"></i>
                <i class="text-2xl cursor-pointer text-inherit bx bx-user" @click="userOpen = !userOpen"></i>

                <div :class="{ 'top-20 visible ': userOpen, 'invisible top-28 ': !userOpen }"
                    class="absolute flex flex-col block p-2 transition-all duration-500 border-4 rounded-lg right-6 border-sky-400 w-36 md:right-0">
                    <a href="#" class="text-lg text-black"><i
                            class="mr-2 text-2xl text-inherit bx bx-user"></i>User</a>
                    <a href="#" class="text-lg text-black"><i
                            class="mr-2 text-2xl text-inherit bx bx-cart-alt"></i>Cart</a>
                    <a href="#" class="text-lg text-black"><i
                            class="mr-2 text-2xl text-inherit bx bx-log-out"></i>Logout</a>
                </div>

                <!-- Menu Button -->
                <button @click="isOpen = !isOpen" class=" md:hidden focus:outline-none">
                    <i class="text-2xl text-inherit bx bx-menu-alt-left"
                        x-bind:class="{ 'bx-menu-alt-left': !isOpen, 'bx-x': isOpen }"></i>
                </button>
            </div>
        </div>
    </nav>
    <!-- Mobile Menu -->
    <div x-show="isOpen" class="py-2 transition-all duration-300 md:hidden"
        :class="{ 'bg-transparent text-black shadow-md': !scrolled, 'bg-sky-400 text-white': scrolled }">
        <template x-for="link in links">
            <a :href="link" class="block py-2 capitalize text-inherit px-7p" x-text="link"></a>
        </template>

    </div>
</div>
