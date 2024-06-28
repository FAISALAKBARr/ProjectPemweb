<div class="sidebar">
  <ul class="nav-list">
    <li class="{{ Request::is('') ? 'active' : '' }}">
      <a href="">
        <i class="bi bi-calendar2-check"></i>
        <span class="link_name">Today</span>
      </a>
      <span class="tooltip shadow-sm shadow-sm">Today</span>
    </li>
    
    <li class="{{ Request::is('') ? 'active' : '' }}">
      <a href="">
        <i class="bi bi-exclamation-square"></i>
        <span class="link_name">Priority</span>
      </a>
      <span class="tooltip shadow-sm">Priority</span>
    </li>
    
    <li class="{{ Request::is('') ? 'active' : '' }}">
      <a href="">
        <i class="bi bi-calendar2-week"></i>
        <span class="link_name">Upcoming</span>
      </a>
      <span class="tooltip shadow-sm">Upcoming</span>
    </li>

    <li class="{{ Request::is('') ? 'active' : '' }}">
      <a href="">
        <i class="bi bi-tags"></i>
        <span class="link_name">Labels</span>
      </a>
      <span class="tooltip shadow-sm">Labels</span>
    </li>

    <li class="{{ Request::is('') ? 'active' : '' }}">
      <a href="">
        <i class="bi bi-clock-history"></i>
        <span class="link_name">History</span>
      </a>
      <span class="tooltip shadow-sm">History</span>
    </li>

    @if(Auth::check() && Auth::user()->role === 'admin')
    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.payments') }}">
        <i class="bi bi-pc-display-horizontal"></i>
        <span class="link_name">PC Order Management</span>
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
  </ul>
  <div class="copyright">
    <p title="&copy; <?php echo date("Y"); ?> UdinTechnology. All rights reserved.">&copy; <?php echo date("Y"); ?> @lang('sidebar.UdinTechnology. All rights reserved')</p>
  </div>
</div>
