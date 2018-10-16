<div class="sidebar-wrapper">
  <div class="image-logo">
    <img src="{{ asset('img/logo.png') }}" alt="Card image cap">
  </div>
  <ul class="sidebar">
    <li class="sidebar__item sidebar__header">
      <div class="sidebar__header_wrapper">
        <a>BISNIS PARIWISATA</a>
      </div>
    </li>
    <li class="sidebar__item">
      <div class="sidebar__link__wrapper">
        <a href="{{ route('home') }}" class="sidebar__link">Akomodasi</a>
      </div>
    </li>
    <li class="sidebar__item">
      <div class="sidebar__link__wrapper">
        <a href="{{ route('objek_wisata') }}" class="sidebar__link">Objek Wisata</a>
      </div>
    </li>
    <li class="sidebar__item">
      <div class="sidebar__link__wrapper">
        <a href="{{ route('kuliner') }}" class="sidebar__link">Kuliner</a>
      </div>
    </li>
    <li class="sidebar__item">
      <div class="sidebar__link__wrapper">
        <a href="{{ route('transportasi') }}" class="sidebar__link">Transportasi</a>
      </div>
    </li>
    <li class="sidebar__item">
      <div class="sidebar__link__wrapper">
        <a href="{{ route('souvenir') }}" class="sidebar__link">Souvenir</a>
      </div>
    </li>


    <li class="sidebar__item sidebar__group">
      <div class="sidebar__link__wrapper">
        <a href="" class="sidebar__link">Menu Dropdown</a>
        <i class="icon fa fa-chevron-down" aria-hidden="true"></i>
      </div>
      <ul class="sidebar__dropdown">
        <li class="sidebar__item">
          <div class="sidebar__link__wrapper">
            <a href="" class="sidebar__link">Sub Menu 1</a>
          </div>
        </li>
        <li class="sidebar__item">
          <div class="sidebar__link__wrapper">
            <a href="" class="sidebar__link">Sub Menu 2</a>
          </div>
        </li>
        <li class="sidebar__item">
          <div class="sidebar__link__wrapper">
            <a href="" class="sidebar__link">Sub Menu 3</a>
          </div>
        </li>
      </ul>
    </li>


  </ul>
</div>
