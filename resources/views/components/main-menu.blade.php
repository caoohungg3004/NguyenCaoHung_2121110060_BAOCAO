<div class="dropdown">
                     
                     <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                     <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                     @foreach ($menus as $menu)
                    <x-main-sub-menu :menu="$menu"/>
                         @endforeach

                    </ul>
                     </div>
                  </div>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img src="images/LOGO.png" style="width:100px;"/></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Trang Chủ</a>
        </li>
        <form class="d-flex" role="search"style="margin-right 200px;">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Tìm Kiếm</button>
        </form>
      </ul>
        <li class="nav-item" style="margin-right 200px;">
          {{-- <a href="{{ route('site.cart') }}"> --}}
            <i class="fa-solid fa-user"></i>           
             Đăng Nhập          
          </a>
        
       
        <li class="nav-item" style="margin-left 300px;">
          {{-- <a href="{{ route('site.cart') }}"> --}}
            <i class="fa-solid fa-phone"></i>
            Thông Tin Liên Hệ 
           <p> <strong> 1900 6789 </strong></p>
          </a>
         
        </li>
        <li class="nav-item" style="margin-left 400px;">
          <a href="{{ route('site.cart') }}">
            <i class="fa-solid fa-cart-shopping"></i>
            Giỏ Hàng 
          </a>
        </li>
      
      
 
    </div>
  </div>
</nav>
<div class="container">
    <div class="container">
<nav class="navbar navbar-expand-lg bg-body-white ">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">MENU</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            @foreach ($menus as $menu)
                <x-main-sub-menu :menu="$menu"/>
            @endforeach

        </ul>

      </div>
    </div>
  </nav>
</div>
</div>
