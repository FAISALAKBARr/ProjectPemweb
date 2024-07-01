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
    <li class="{{ Request::is('chat/cs') ? 'active' : '' }}">
      <a href="{{ route('chat.cs') }}">
        <i class="bi bi-chat-dots"></i>
        <span class="link_name">Customer Service</span>
        @if(Auth::check())
          @php
            $unreadCount = \App\Models\Message::where('to_user_id', Auth::id())->where('seen', false)->count();
          @endphp
          @if($unreadCount > 0)
          <span id="unread-badge" class="badge badge-pill ms-2" style="background-color: red; color: white;">{{ $unreadCount }}</span>
          @endif
        @endif
      </a>
      <span class="tooltip shadow-sm">Customer Service</span>
    </li>

  </ul>
  <div class="copyright">
    <p title="&copy; <?php echo date("Y"); ?>">&copy; <?php echo date("Y"); ?> Internet Cafe Group 3. <br>All rights reserved.</p>
  </div>
</div>
<script>
  // Auto refresh unread message count every 30 seconds
  setInterval(function() {
    fetch('{{ route('chat.unreadCount') }}')
      .then(response => response.json())
      .then(data => {
        const unreadCount = data.unread_count;
        const badge = document.getElementById('unread-badge');
        if (unreadCount > 0) {
          badge.textContent = unreadCount;
          badge.style.display = 'inline-block'; // Show badge if there are unread messages
        } else {
          badge.style.display = 'none'; // Hide badge if there are no unread messages
        }
      })
      .catch(error => console.error('Error fetching unread messages count:', error));
  }, 5000); 
</script>