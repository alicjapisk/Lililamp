<!DOCTYPE html>
<html lang="en">
    @include('partials/head')
    <body>
        @include('partials/navi')
        <div id="zawartosc">
        <h2>Czy na pewno chcesz usunąć ten produkt?</h2>
        <form class="form-inline" action="<?=config('app.url'); ?>/shop/shopping-cart/delete/{{$cart->id_cart}}" method="post">
        @csrf
            <p>
            <button type="submit" class="btn btn-primary mb-2">Usuń</button></p>
            </p>
        </form>
        </div>
    </body>
</html>