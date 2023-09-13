<nav>
 <div class="navbar">
 <a href="<?=config('app.url'); ?>/.">Strona główna</a>
 @if (auth()->check() && auth()->user()->is_admin == 1)
 <a href="<?=config('app.url'); ?>/orders/list">Lista zamówień</a>
 <a href="<?=config('app.url'); ?>/users/list">Lista klientów</a>
 <a href="<?=config('app.url'); ?>/products/add">Dodaj produkt</a>
 <a href="<?=config('app.url'); ?>/products/list">Lista produtków</a>
 <a href="<?=config('app.url'); ?>/shipping/add">Dodaj formę dostawy</a>
 <a href="<?=config('app.url'); ?>/shipping/list">Lista dostaw</a>
 @endif
 <a href="<?=config('app.url'); ?>/products/lampki">Lampki</a>
 <a href="<?=config('app.url'); ?>/products/dywany">Dywany</a>
 <a href="<?=config('app.url'); ?>/products/tapety">Tapety</a>
 <a href="<?=config('app.url'); ?>/crewskills/list">O nas</a>
 <a href="<?=config('app.url'); ?>/crewskills/add">Blog</a>
 @if (auth()->check() && auth()->user()->is_admin == 0)
 <a href="<?=config('app.url'); ?>/shop/shopping-cart">Koszyk</a>
 <a href="<?=config('app.url'); ?>/orders/orderList">Twoje zamówienie</a>
 <a href="<?=config('app.url'); ?>/users/profile">Twoje dane</a>
@endif
 @if(Auth::check())
 <a href="<?=config('app.url'); ?>/wyloguj">Wyloguj</a>
      @else
      <a href="<?=config('app.url'); ?>/loguj">Zaloguj</a>
      @endif
 </div>
</nav>