<!-- Sidebar  -->
<nav id="sidebar">
    <div id="dismiss">
        <i class="fas fa-arrow-left"></i>
    </div>
    <div id="openSidebar">
        <i class="fas fa-arrow-right"></i>
    </div>
    <div class="sidebar-header">
        <h3 id="sidebar-name"><a href="/admin">{{ config('app.name') }}</a></h3>
    </div>
    <ul class="list-unstyled components">
        <li class="active">
            <a href="/admin" data-toggle="tooltip" data-placement="right" title="Dashboard">
                <i class="fas fa-tachometer-alt"></i>
                <span class="dsh-text">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="/admin/menus" data-toggle="tooltip" data-placement="right" title="Master Menu">
                <i class="fas fa-tasks"></i>
                <span class="dsh-text">Master Menu</span>
            </a>
        </li>
        <li>
            <a href="/admin/tags" data-toggle="tooltip" data-placement="right" title="Tags">
                <i class="fas fa-tags"></i>
                <span class="dsh-text">Tags</span>
            </a>
        </li>
        <li>
            <a href="/admin/posts" data-toggle="tooltip" data-placement="right" title="Posts">
                <i class="fas fa-newspaper"></i>
                <span class="dsh-text">Posts</span>
            </a>
        </li>
        <li>
            <a href="#productSubMenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="fas fa-store-alt" data-toggle="tooltip" data-placement="right" title="Product"></i>
                <span class="dsh-text">Product</span>
            </a>
            <ul class="collapse list-unstyled" id="productSubMenu">
                <li>
                    <a href="/admin/products" data-toggle="tooltip" data-placement="right" title="Products">
                        <i class="fas fa-store"></i>
                        <span class="dsh-text">Products</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/etalase" data-toggle="tooltip" data-placement="right" title="Etalse">
                        <i class="fas fa-stream"></i>
                        <span class="dsh-text">Etalase</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/address" data-toggle="tooltip" data-placement="right" title="Address">
                        <i class="fas fa-map-marker-alt"></i>
                        <span class="dsh-text">Address</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/product/offline" data-toggle="tooltip" data-placement="right" title="Offline/Offer">
                        <i class="fas fa-sticky-note"></i>
                        <span class="dsh-text">Offline/Offer</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/orders" data-toggle="tooltip" data-placement="right" title="Orders">
                        <i class="fas fa-dolly-flatbed"></i>
                        <span class="dsh-text">Orders</span>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#forumSubMenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="fas fa-users" data-toggle="tooltip" data-placement="right" title="Forum"></i>
                <span class="dsh-text">Forum</span>
            </a>
            <ul class="collapse list-unstyled" id="forumSubMenu">
                <li>
                    <a href="/admin/category" data-toggle="tooltip" data-placement="right" title="Category">
                        <i class="fas fa-cubes"></i>
                        <span class="dsh-text">Category</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/forums" data-toggle="tooltip" data-placement="right" title="Threads">
                        <i class="fas fa-book-open"></i>
                        <span class="dsh-text">Threads</span>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="/admin/inbox" data-toggle="tooltip" data-placement="right" title="Inbox">
                <i class="fas fa-envelope"></i>
                <span class="dsh-text">Inbox</span>
            </a>
        </li>
        <li>
            <a href="/admin/social-media" data-toggle="tooltip" data-placement="right" title="Social-media">
                <i class="fas fa-mobile"></i>
                <span class="dsh-text">Social Media</span>
            </a>
        </li>
        <li>
            <a href="/admin/users" data-toggle="tooltip" data-placement="right" title="Users">
                <i class="fas fa-users-cog"></i>
                <span class="dsh-text">Users</span>
            </a>
        </li>
        <li>
            <a href="/admin/accounts" data-toggle="tooltip" data-placement="right" title="Account (Bank)">
                <i class="fas fa-university"></i>
                <span class="dsh-text">Account <i>(Bank)</i></span>
            </a>
        </li>
        <li>
            <a href="/admin/application" data-toggle="tooltip" data-placement="right" title="App Setting">
                <i class="fas fa-cogs"></i>
                <span class="dsh-text">Setting</span>
            </a>
        </li>
    </ul>
</nav>