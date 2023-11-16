@if(count($list_category)>0)
<ul class="list-group md-4">
    <li class="list-group-item active">DANH MỤC SẢN PHẨM</li>
    @foreach($list_category as $category)
    <li class="list-group-item">
        <a href="{{route('site.slug',['slug'=>$category->slug])}}">{{$category->name}}</a>

    </li>
    @endforeach
    
  </ul>
@endif