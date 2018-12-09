<div class="sidebar-wrapper">
  <div class="image-logo">
    <img class="rounded-circle" src="{{ asset('img/logo1.jpg') }}" alt="Card image cap">
  </div>
  <ul class="sidebar">
    <li class="sidebar__item sidebar__header">
      <div class="sidebar__header_wrapper">
        <p>BISNIS PARIWISATA</p>
      </div>
    </li>
    <li class="sidebar__item">
      <div class="sidebar__link__wrapper">
        <img class="sidebar__logo" src="{{ asset('icon/akomodasi@4x.png') }}" alt="">
        <a href="{{ route('akomodasi') }}" class="sidebar__link">Akomodasi</a>
      </div>
    </li>
    <li class="sidebar__item">
      <div class="sidebar__link__wrapper">
        <img class="sidebar__logo" src="{{ asset('icon/object_wisata@4x.png') }}" alt="">
        <a href="{{ route('objek_wisata') }}" class="sidebar__link">Objek Wisata</a>
      </div>
    </li>
    <li class="sidebar__item">
      <div class="sidebar__link__wrapper">
        <img class="sidebar__logo" src="{{ asset('icon/kuliner@4x.png') }}" alt="">
        <a href="{{ route('kuliner') }}" class="sidebar__link">Kuliner</a>
      </div>
    </li>
    <li class="sidebar__item">
      <div class="sidebar__link__wrapper">
        <img class="sidebar__logo" src="{{ asset('icon/transportasi@4x.png') }}" alt="">
        <a href="{{ route('transportasi') }}" class="sidebar__link">Transportasi</a>
      </div>
    </li>
    <li class="sidebar__item">
      <div class="sidebar__link__wrapper">
        <img class="sidebar__logo" src="{{ asset('icon/biro_perjalanan@4x.png') }}" alt="">
        <a href="{{ route('biro_perjalanan') }}" class="sidebar__link">Biro Perjalanan</a>
      </div>
    </li>
    <li class="sidebar__item">
      <div class="sidebar__link__wrapper">
        <img class="sidebar__logo" src="{{ asset('icon/ekonomi_kreatif@4x.png') }}" alt="">
        <a href="{{ route('ekonomi_kratif') }}" class="sidebar__link">Ekonomi Kreatif</a>
      </div>
    </li>
    <li class="sidebar__item">
      <div class="sidebar__link__wrapper">
        <img class="sidebar__logo" src="{{ asset('icon/money_changer@4x.png') }}" alt="">
        <a href="#" class="sidebar__link">Money Changer</a>
      </div>
    </li>
    <li class="sidebar__item">
      <div class="sidebar__link__wrapper">
        {{-- <img class="sidebar__logo" src="{{ asset('icon/souvenir@4x.png') }}" alt=""> --}}
        <a href="{{ route('souvenir') }}" class="sidebar__link">Souvenir</a>
      </div>
    </li>

    <li class="sidebar__item sidebar__header">
      <div class="sidebar__header_wrapper">
        <p>PELAKU PARIWISATA</p>
      </div>
    </li>
    <li class="sidebar__item">
      <div class="sidebar__link__wrapper">
        <img class="sidebar__logo" src="{{ asset('icon/pramuwisata@4x.png') }}" alt="">
        <a href="{{ route('pramuwisata') }}" class="sidebar__link">Pramuwisata</a>
      </div>
    </li>
    <li class="sidebar__item">
      <div class="sidebar__link__wrapper">
        <img class="sidebar__logo" src="{{ asset('icon/sanggar_seni@4x.png') }}" alt="">
        <a href="{{ route('sanggar_wisata') }}" class="sidebar__link">Sanggar Seni</a>
      </div>
    </li>


    {{-- <li class="sidebar__item sidebar__group">
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
    </li> --}}


  </ul>
</div>
