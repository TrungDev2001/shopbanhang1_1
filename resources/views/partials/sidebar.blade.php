<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a class="active" href="{{ route('home.index') }}">
                        <i class="fa fa-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                {{-- <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Mẫu</span>
                    </a>
                    <ul class="sub">
                        <li><a href="web/grids.html">Grids</a></li>
                    </ul>
                </li> --}}

                <li>
                    <a class="" href="{{ route('category.index') }}">
                        <i class="fa fa-list-ul"></i>
                        <span>Category</span>
                    </a>
                </li>

                <li>
                    <a class="" href="{{ route('brands.index') }}">
                        <i class="fa fa-audio-description" aria-hidden="true"></i>
                        <span>Brand</span>
                    </a>
                </li>

                <li>
                    <a class="" href="{{ route('sliders.index') }}">
                        <i class="fa fa-bullseye" aria-hidden="true"></i>
                        <span>Slider</span>
                    </a>
                </li>

                <li>
                    <a class="" href="{{ route('products.index') }}">
                        <i class="fa fa-product-hunt" aria-hidden="true"></i>
                        <span>Product</span>
                    </a>
                </li>

                <li>
                    <a class="" href="{{ route('ads.index') }}">
                        <i class="fa fa-adn" aria-hidden="true"></i>
                        <span>Ads</span>
                    </a>
                </li>

                <li>
                    <a class="" href="{{ route('manageOrder.index') }}">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        <span>Manage order</span>
                    </a>
                </li>

                <li>
                    <a class="" href="{{ route('voucher.index') }}">
                        <i class="fa fa-flash (alias)" aria-hidden="true"></i>
                        <span>Voucher</span>
                    </a>
                </li>

                <li>
                    <a class="" href="{{ route('transport_fee.index') }}">
                        <i class="fa fa-truck" aria-hidden="true"></i>
                        <span>Transport fee</span>
                    </a>
                </li>

                <li>
                    <a class="" href="{{ route('CategoryPost.index') }}">
                        <i class="fa fa-calendar-o" aria-hidden="true"></i>
                        <span>Category Post</span>
                    </a>
                </li>

                <li>
                    <a class="" href="{{ route('Post.index') }}">
                        <i class="fa fa-pencil" aria-hidden="true"></i>
                        <span>Post</span>
                    </a>
                </li>

                <li>
                    <a class="" href="{{ route('Video.index') }}">
                        <i class="fa fa-caret-square-o-right" aria-hidden="true"></i>
                        <span>Video</span>
                    </a>
                </li>

                <li>
                    <a class="" href="{{ route('contact.index') }}">
                        <i class="fa fa-volume-control-phone" aria-hidden="true"></i>
                        <span>Contact</span>
                    </a>
                </li>

                <li>
                    <a class="" href="{{ route('GoogleDriveDocumentController.index') }}">
                        <i class="fa fa-google-plus-official" aria-hidden="true"></i>
                        <span>Document</span>
                    </a>
                </li>
                
                <li>
                    <a class="" href="{{ route('UserController.index') }}">
                        <i class="fa fa-users" aria-hidden="true"></i>
                        <span>User</span>
                    </a>
                </li>

                <li>
                    <a class="" href="{{ route('RoleController.index') }}">
                        <i class="fa fa-sun-o" aria-hidden="true"></i>
                        <span>Role</span>
                    </a>
                </li>

                <li>
                    <a class="" href="{{ route('PermissionController.index') }}">
                        <i class="fa fa-filter" aria-hidden="true"></i>
                        <span>Permission</span>
                    </a>
                </li>

            </ul>
        </div>
        <!-- sidebar menu end-->
    </div>
</aside>