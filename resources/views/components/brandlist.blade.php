@if(count($list_brand)>0)
<ul class="list-group md-4">
    <li class="list-group-item active">THƯƠNG HIỆU</li>
    @foreach($list_brand as $brand)
    <li class="list-group-item">
        <a href="{{route('site.slug',['slug'=>$brand->slug])}}">{{$brand->name}}</a>

    </li>
    @endforeach
    
  </ul>
@endif