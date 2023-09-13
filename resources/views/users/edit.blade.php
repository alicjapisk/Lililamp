<!DOCTYPE html>
<html lang="en">
    @include('partials/head')
    <body>
        @include('partials/navi')
        <div id="zawartosc">
        <h2>Edytowanie danych osobowych</h2> 
        <form class="form-inline" action="<?=config('app.url'); ?>/users/update/{{$users->id}}" method="post">
        @csrf
            <p>
                <label for="id">Id:</label>
                <input id="id" name="id" value="{{$users->id}}" readonly>
            </p>
            <p>
                <label for="first_name">Imię</label>
                <input id="first_name" name="first_name" value="{{$users->first_name}}">
            </p>
            <p>
                <label for="last_name">Nazwisko</label>
                <input id="last_name" name="last_name" value="{{$users->last_name}}">
            </p>
            <p>
                <label for="email">Email</label>
                <input id="email" name="email" value="{{$users->email}}">
            </p>
            <p>
                <label for="login">Login</label>
                <input id="login" name="login" value="{{$users->login}}">
            </p>
            <p>
                <label for="address">Adres</label>
                <input id="address" name="address" value="{{$users->address}}">
            </p>
            <p>
                <label for="zip_code">Kod pocztowy</label>
                <input id="zip_code" name="zip_code" value="{{$users->zip_code}}">
            </p>
            <label for="is_admin">Czy użytkownik jest administratorem?</label>
            <input type="checkbox" name="is_admin" value="1" {{ $users->is_admin ? 'checked' : ''}}>
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