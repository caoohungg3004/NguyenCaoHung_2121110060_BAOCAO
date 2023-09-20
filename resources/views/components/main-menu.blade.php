<div class="dropdown">
                     <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">All Category 
                     </button>
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
    <a class="navbar-brand" href="#"><img src="images/LOGO.png"</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Trang Chủ</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Giới Thiệu</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Danh mục sản phẩm
          </a>
          <ul class="dropdown-menu">
          @foreach ($menus as $menu)
                    <x-main-sub-menu :menu="$menu"/>
                         @endforeach
            <li><a class="dropdown-item" href="#">Sản phẩm </a></li>
            <li><a class="dropdown-item" href="#">Sản phẩm VIP</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled">Ưu Đãi</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
         
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
