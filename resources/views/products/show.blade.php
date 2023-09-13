<!DOCTYPE html>
<html lang="en">
    @include('partials/head')
    <body>
        @include('partials/navi')
        <div id="zawartosc">
        <h2>Confirmation - Delete Id: {{$products->id}}</h2>
        <form class="form-inline" action="<?=config('app.url'); ?>/products/delete/{{$products->id}}" method="post">
        @csrf
            <p>
                <label for="id">Id:</label>
                <input id="id" name="id" value="{{$products->id}}" readonly>
            </p>
            <p>
                <label for="name">Nazwa: </label>
                <input id="name" name="name" value="{{$products->name}}">
            </p>
            <p>
                <label for="category">Kategoria:</label>
                <input type="radio" name="category" id="category" value="lampka" @if ($products->category) checked @endif required>
                <label for="category">Lampka</label>
                <input type="radio" name="category" id="category" value="dywan" @if (!($products->category)) checked @endif required>
                <label for="category">Dywan</label>
                <input type="radio" name="category" id="category" value="tapeta" @if (!($products->category)) checked @endif required>
                <label for="category">Tapeta</label>
            </p>
            <p>
                <label for="price">Cena: </label>
                <input id="price" name="price" value="{{$products->price}}">
            </p>
            <p>
                <label for="condition">Stan</label>
                <input id="condition" name="condition" value="{{$products->condition}}">
            </p>
            <p>
            <button type="submit" class="btn btn-primary mb-2">Delete</button></p>
            </p>
        </form>
        </div>
    </body>
</html>