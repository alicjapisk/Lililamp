<!DOCTYPE html>
<html lang="en">
    @include('partials/head')
    <body>
        @include('partials/navi')
        <div id="zawartosc">
        <h2>Edytowanie danych produktów</h2>
        <form class="form-inline" action="<?=config('app.url'); ?>/products/update/{{$products->id}}" method="post">
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
                <input type="radio" name="category" id="category-lampka" value="lampka" 
                @if ($products->category == 'lampka') checked @endif required>
                <label for="category-lampka">Lampka</label>
                
                <input type="radio" name="category" id="category-dywan" value="dywan" 
                @if ($products->category == 'dywan') checked @endif required>
                <label for="category-dywan">Dywan</label>
                
                <input type="radio" name="category" id="category-tapeta" value="tapeta" 
                @if ($products->category == 'tapeta') checked @endif required>
                <label for="category-tapeta">Tapeta</label>
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
            <label for="description">Opis:</label>
            <textarea id="description" name="description"  rows="4" cols="50" value="{{$products->description}}">{{$products->description}}</textarea>
            </p>
            <p>    
                <label for="pictureURL">URL obrazka:</label>
                <input id="pictureURL" name="pictureURL"  size="100" value="{{$products->pictureURL}}">
            </p>
            <p>
                <button type="submit" class="btn btn-primary mb-2">Aktualizuj</button></p>
                <button type="reset" class="btn btn-primary mb-2">Resetuj dane</button></p>
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