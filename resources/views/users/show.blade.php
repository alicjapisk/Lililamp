<!DOCTYPE html>
<html lang="en">
    @include('partials/head')
    <body>
        @include('partials/navi')
        <div id="zawartosc">
        <h2>Confirmation - Delete Id: {{$users->id}}</h2>
        <form class="form-inline" action="<?=config('app.url'); ?>/users/delete/{{$users->id}}" method="post">
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
                <label for="last_name">Nazwisko:</label>
                <input id="last_name" name="status" value="{{$users->last_name}}">
            </p>
            <p>    
                <label for="email">Email:</label>
                <input id="email" name="email" value="{{$users->email}}">
            </p>
            <p>
                <button type="submit" class="btn btn-primary mb-2">Delete</button></p>
            </p>
        </form>
        @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
            @endif
        </div>
    </body>
</html>