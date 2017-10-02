@php
  $navigations = config()->get('navigation');
  if (file_exists(config()->get('cms.plugin_path'))) {
    $files = File::getRequire(config()->get('cms.plugin_path'));
    foreach ($files['name'] as $name) {
        if (file_exists(base_path('plugins').'/'. $name.'/config/navigation.php')) {
          $navigations = array_merge_recursive($navigations, File::getRequire(base_path('plugins').'/'. $name.'/config/navigation.php'));
        }
    }
  }
@endphp

<nav class="">
  <ul>
    <li><a href="/backend" class="main-menu"><i class="material-icons">album</i> <span>STORY</span></a></li>
  </ul>
  <ul id="nav" role="menubar" class="sidebar-menu">
    @foreach ($navigations as $navigation)
    <li data-submenu-id="submenu-{{ $navigation['key'] }}">
      @if ($navigation['link'] == false)
        <el-popover class="popover" ref="{{ $navigation['key'] }}" placement="right" width="200" trigger="click" >
          <h3 class="popover-title">{{ $navigation['title'] }}</h3>
          <div class="popover-content popover-menu">
            <ul>
              @foreach ($navigation['items'] as $item)
              <li><a href="{{$item['link']}}">{{ $item['name'] }}</a></li>
              @endforeach
            </ul>
          </div>
        </el-popover>
        <span v-popover:{{ $navigation['key'] }} class="main-menu">
          <i class="material-icons font-size-18">{{ $navigation['font'] }}</i>
          <span>{{ $navigation['title'] }}</span>
        </span>
      @else
        <a href="/backend/{{ $navigation['key'] }}" class="main-menu">
          <i class="material-icons">{{ $navigation['font'] }}</i>
          <span>{{ $navigation['title'] }}</span>
        </a>
      @endif
    </li>
    @endforeach
    <li><a href="/backend/logout" class="main-menu"><i class="material-icons">exit_to_app</i> <span>SIGN OUT</span></a></li>
  </ul>
</nav>
