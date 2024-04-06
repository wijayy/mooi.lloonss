<div class="nav">
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
                    <i class='bx bxs-chevron-down htmlcss-arrow arrow  '></i>
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
</div>
