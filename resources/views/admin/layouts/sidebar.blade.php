<nav class="sidebar">
  <div class="sidebar-header">
    <a href="/admin/dashboard" class="sidebar-brand">
      <img src="/assets/images/asaldi-cms-logo.png" alt="itssaif.dev" style="height: 25px;">
    </a>
    <div class="sidebar-toggler not-active">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
  <div class="sidebar-body">
    <ul class="nav">
      
      <li class="nav-item nav-category">Main</li>
      
      <li class="nav-item {{ active_class(['admin/dashboard']) }} {{ active_class(['admin']) }}">
        <a href="{{ url('/admin/dashboard') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Dashboard</span>
        </a>
      </li>

      <li class="nav-item {{ active_class(['admin/page/*']) }}">
        <a class="nav-link" data-toggle="collapse" href="#page" role="button" aria-expanded="{{ is_active_route(['admin/page/*']) }}" aria-controls="email">
          <i class="link-icon" data-feather="file-text"></i>
          <span class="link-title">Pages</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse {{ show_class(['admin/page/*']) }}" id="page">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{ url('/admin/page') }}" class="nav-link {{ active_class(['admin/page/all']) }}">All Pages</a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/admin/page/create') }}" class="nav-link {{ active_class(['admin/page/create']) }}">Add New</a>
            </li>
          </ul>
        </div>
      </li>

      <li class="nav-item nav-category">Ecommerce</li>

      <li class="nav-item {{ active_class(['admin/abandoned-cart']) }} {{ active_class(['admin/abandoned-cart']) }}">
        <a href="{{ url('/admin/abandoned-cart') }}" class="nav-link">
          <i class="link-icon" data-feather="shopping-bag"></i>
          <span class="link-title">Abandoned Cart</span>
        </a>
      </li>

      <li class="nav-item {{ active_class(['admin/order']) }} {{ active_class(['admin/order']) }}">
        <a href="{{ url('/admin/order') }}" class="nav-link">
          <i class="link-icon" data-feather="package"></i>
          <span class="link-title">Orders</span>
        </a>
      </li>

      <li class="nav-item {{ active_class(['admin/invoice']) }} {{ active_class(['admin/invoice']) }}">
        <a href="{{ url('/admin/invoice') }}" class="nav-link">
          <i class="link-icon" data-feather="file-text"></i>
          <span class="link-title">Invoices</span>
        </a>
      </li>

      <li class="nav-item {{ active_class(['admin/review']) }} {{ active_class(['admin/review']) }}">
        <a href="{{ url('/admin/review') }}" class="nav-link">
          <i class="link-icon" data-feather="star"></i>
          <span class="link-title">Reviews</span>
        </a>
      </li>

      <li class="nav-item {{ active_class(['admin/product/*']) }}">
        <a class="nav-link" data-toggle="collapse" href="#product" role="button" aria-expanded="{{ is_active_route(['admin/product/*']) }}" aria-controls="email">
          <i class="link-icon" data-feather="shopping-cart"></i>
          <span class="link-title">Products</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse {{ show_class(['admin/product/*']) }}" id="product">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{ url('/admin/product') }}" class="nav-link {{ active_class(['admin/product/all']) }}">All Products</a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/admin/product/create') }}" class="nav-link {{ active_class(['admin/product/create']) }}">Add New</a>
            </li>
          </ul>
        </div>
      </li>

      <li class="nav-item {{ active_class(['admin/category/*']) }}">
        <a class="nav-link" data-toggle="collapse" href="#category" role="button" aria-expanded="{{ is_active_route(['admin/category/*']) }}" aria-controls="email">
          <i class="link-icon" data-feather="list"></i>
          <span class="link-title">Categories</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse {{ show_class(['admin/category/*']) }}" id="category">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{ url('/admin/category') }}" class="nav-link {{ active_class(['admin/category']) }}">All Categories</a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/admin/category/create') }}" class="nav-link {{ active_class(['admin/category/create']) }}">Add New</a>
            </li>
          </ul>
        </div>
      </li>

      <li class="nav-item nav-category">Blog</li>
      <li class="nav-item {{ active_class(['admin/post/*']) }}">
        <a class="nav-link" data-toggle="collapse" href="#post" role="button" aria-expanded="{{ is_active_route(['admin/post/*']) }}" aria-controls="email">
          <i class="link-icon" data-feather="file-text"></i>
          <span class="link-title">Posts</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse {{ show_class(['admin/post/*']) }}" id="post">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{ url('/admin/post') }}" class="nav-link {{ active_class(['admin/post/all']) }}">All Posts</a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/admin/post/create') }}" class="nav-link {{ active_class(['admin/post/create']) }}">Add New</a>
            </li>
          </ul>
        </div>
      </li>
      
      <li class="nav-item nav-category">Library</li>
      <li class="nav-item {{ active_class(['admin/media']) }} {{ active_class(['media']) }}">
        <a href="{{ url('/admin/media') }}" class="nav-link">
          <i class="link-icon" data-feather="image"></i>
          <span class="link-title">Manage Media</span>
        </a>
      </li>

      <li class="nav-item nav-category">Others</li>

      <li class="nav-item {{ active_class(['admin/user']) }} {{ active_class(['admin/user']) }}">
        <a href="{{ url('/admin/user') }}" class="nav-link">
          <i class="link-icon" data-feather="users"></i>
          <span class="link-title">Users</span>
        </a>
      </li>

      <li class="nav-item {{ active_class(['admin/newsletter']) }} {{ active_class(['admin/newsletter']) }}">
        <a href="{{ url('/admin/newsletter') }}" class="nav-link">
          <i class="link-icon" data-feather="send"></i>
          <span class="link-title">Newsletter</span>
        </a>
      </li>

      <li class="nav-item {{ active_class(['admin/settings']) }} {{ active_class(['admin/settings']) }}">
        <a href="{{ url('/admin/settings') }}" class="nav-link">
          <i class="link-icon" data-feather="settings"></i>
          <span class="link-title">Site Settings</span>
        </a>
      </li>

      <li class="nav-item {{ active_class(['admin/payments/*']) }}">
        <a class="nav-link" data-toggle="collapse" href="#payments" role="button" aria-expanded="{{ is_active_route(['admin/payments/*']) }}" aria-controls="email">
          <i class="link-icon" data-feather="credit-card"></i>
          <span class="link-title">Payment Methods</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse {{ show_class(['admin/payments/*']) }}" id="payments">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{ url('/admin/payments/bank-transfer') }}" class="nav-link {{ active_class(['admin/payments/bank-transfer']) }}">Bank Transfer</a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/admin/payments/paypal') }}" class="nav-link {{ active_class(['admin/payments/paypal']) }}">PayPal</a>
            </li>
            <li class="nav-item">
              <a href="#_" class="nav-link {{ active_class(['admin/payments/braintree']) }}">Braintree <span class="badge badge-info" style="margin-left: 7px;">Deactivated</span></a>
            </li>
            <li class="nav-item">
              <a href="#_" class="nav-link {{ active_class(['admin/payments/stripe']) }}">Stripe <span class="badge badge-info" style="margin-left: 7px;">Deactivated</span></a>
            </li>
          </ul>
        </div>
      </li>

    </ul>
  </div>
</nav>