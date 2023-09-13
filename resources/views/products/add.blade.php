<!DOCTYPE html>
<html lang="en">
    @include('partials/head')
    <body>
        @include('partials/navi')
        <div id="zawartosc">
        <h2>Dodaj produkt</h2>
        <form class="form-inline" action="<?=config('app.url'); ?>/products/save" method="post">
        @csrf
        <p>
                <label for="category">Kategoria:</label>
                <input type="radio" name="category" id="category" value="lampka" checked required>
                <label for="category">Lampka</label>
                <input type="radio" name="category" id="category" value="dywan" required>
                <label for="category">Dywan</label>
                <input type="radio" name="category" id="category" value="tapeta" required>
                <label for="category">Tapeta</label>

            </p>
            <p>
                <label for="name">Nazwa:</label>
                <input id="name" name="name" size="25" required>
            </p>
            <p>    
                <label for="price">Cena:</label>
                <input id="price" name="price" size="25" required>
            </p>
            <p>    
                <label for="condition">Stan:</label>
                <input id="condition" name="condition" size="10" required>
            </p>
            
            <p>    
            <label for="description">Opis:</label>
            <textarea id="description" name="description" rows="4" cols="50"></textarea>
            </p>
            <p>    
                <label for="pictureURL">URL obrazka:</label>
                <input id="pictureURL" name="pictureURL" size="100">
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