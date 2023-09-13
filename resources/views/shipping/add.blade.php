<!DOCTYPE html>
<html lang="en">
    @include('partials/head')
    <body>
        @include('partials/navi')
        <div id="zawartosc">
        <h2>Dodaj formę dostawy</h2>
        <form class="form-inline" action="<?=config('app.url'); ?>/shipping/save" method="post">
        @csrf
            <p>
                <label for="shipping_method">Nazwa</label>
                <input id="shipping_method" name="shipping_method" size="25" required>
            </p>
            <p>    
                <label for="shipping_price">Cena</label>
                <input id="shipping_price" name="shipping_price" size="25" required>
            </p>
            <p>
                <button type="submit" class="btn btn-primary mb-2">Save</button></p>
            </p>
        </form>
        <p>
        @if ($errors->any()) 
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div> 
        @endif    
        </p>
        </div>
    </body>
</html>