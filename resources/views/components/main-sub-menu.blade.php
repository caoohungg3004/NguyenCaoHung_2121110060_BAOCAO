@if (count($menus)>0)
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="{{$menurow->link}}" role="button" data-bs-toggle="dropdown" aria-expanded="false">
      {{$menurow->name}}
    </a>
    <ul class="dropdown-menu">
        @foreach ($menus as $menu)
        <li><a class="dropdown-item" href="{{$menu->link}}">{{$menu->name}}</a></li>
        @endforeach
    </ul>
  </li>
  @else
  <li class="nav-item">
    <a class="nav-link" href="{{$menurow->link}}">{{$menurow->name}}</a>
  </li>
@endif
