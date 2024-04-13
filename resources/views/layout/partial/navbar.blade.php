<div x-data="{ scrolled: false, isOpen: false, links: ['home', 'products', 'contact', 'about'] }" x-on:scroll.window="scrolled = (window.pageYOffset > 0)" class="fixed z-50 w-full">
    <!-- Navbar -->
    <nav class="w-full py-4 transition-all duration-500 bg-sky-500 px-[12%]"
        :class="{ 'bg-transparent text-black shadow-md py-7': !scrolled, 'bg-sky-400 text-white': scrolled }">
        <div class="container flex items-center justify-between "
            @@scroll.window="scrolled = (window.pageYOffset > 30)">
            <!-- Logo -->
            <div class="flex-shrink-0 ">
                <a href="#" class="text-2xl font-[700] text-inherit font-comfortaa">Mooi.lloons</a>
            </div>
            <!-- Links -->
            <div class="items-center hidden space-x-6 lg:flex">
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
                <i class="text-2xl cursor-pointer text-inherit bx bx-user" x-on:click="userOpen = !userOpen"></i>

                <div :class="{ 'top-20 visible ': userOpen, 'invisible top-28 ': !userOpen }"
                    class="absolute flex flex-col block p-2 transition-all duration-500 border-4 rounded-lg right-6 border-sky-400 w-36 lg:right-0">
                    <a href="#" class="text-lg text-black"><i
                            class="mr-2 text-2xl text-inherit bx bx-user"></i>User</a>
                    <a href="#" class="text-lg text-black"><i
                            class="mr-2 text-2xl text-inherit bx bx-cart-alt"></i>Cart</a>
                    <a href="#" class="text-lg text-black"><i
                            class="mr-2 text-2xl text-inherit bx bx-log-out"></i>Logout</a>
                </div>

                <!-- Menu Button -->
                <button x-on:click="isOpen = !isOpen" class=" lg:hidden focus:outline-none">
                    <i class="text-2xl text-inherit bx bx-menu-alt-left"
                        x-bind:class="{ 'bx-menu-alt-left': !isOpen, 'bx-x': isOpen }"></i>
                </button>
            </div>
        </div>
    </nav>
    <!-- Mobile Menu -->
    <div x-show="isOpen" class="py-2 transition-all duration-300 lg:hidden"
        :class="{ 'bg-transparent text-black shadow-md': !scrolled, 'bg-sky-400 text-white': scrolled }">
        <template x-for="link in links">
            <a :href="link" class="block py-2 capitalize text-inherit px-7p" x-text="link"></a>
        </template>

    </div>
</div>
