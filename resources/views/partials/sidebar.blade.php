<div class="sidebar">
  <ul class="nav-list">
    @if(Auth::check() && Auth::user()->role === 'user')
    <li class="{{ Request::is('') ? 'active' : '' }}">
      <a href="{{ route('admin.index') }}">
        <i class="bi bi-pc-display"></i>
        <span class="link_name">Order PC</span>
      </a>
      <span class="tooltip shadow-sm shadow-sm">Order PC</span>
    </li>
    <li class="{{ Request::is('order') ? 'active' : '' }}">
      <a href="{{ route('order') }}">
        <i class="bi bi-cart"></i>
        <span class="link_name">Order Makan/Minum</span>
      </a>
      <span class="tooltip shadow-sm">Order Makan/Minum</span>
    </li>
    @endif

    @if(Auth::check() && Auth::user()->role === 'admin')
    {{-- <li class="nav-item" class="{{ Request::is('admin/payments') ? 'active' : '' }}"> --}}
    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.payments') }}">
        <i class="bi bi-pc-display-horizontal"></i>
        <span class="link_name">PC Order Management</span>
      </a>
    </li>  
    <li class="{{ Request::is('admin.food_orders') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('admin.food_orders') }}">
        <i class="bi bi-cart"></i>
        <span class="link_name">Food Order Management</span>
      </a>
    </li>
    <li class="{{ Request::is('') ? 'active' : '' }}">
      <a href={{ route('admin.index') }}>
        <i class="bi bi-person-circle"></i>
        <span class="link_name">Account Management</span>
      </a>
      <span class="tooltip shadow-sm">Account Management</span>
    </li>
    
    @endif
    <li class="{{ Request::is('') ? 'active' : '' }}">
      <a href="{{ route('chat.cs') }}">
        <i class="bi-chat-dots"></i>
        <span class="link_name">Customer Service</span>
      </a>
      <span class="tooltip shadow-sm">Costumer Service</span>
    </li>
  </ul>
  <div class="copyright">
    <p title="&copy; <?php echo date("Y"); ?>">&copy; <?php echo date("Y"); ?> Internet Cafe Group 3. <br>All rights reserved.</p>
  </div>
</div>