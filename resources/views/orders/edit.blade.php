<!DOCTYPE html>
<html lang="en">
    @include('partials/head')
    <body>
        @include('partials/navi')
        <div id="zawartosc">
        <h2>Edytowanie zamówienia</h2>
        <form class="form-inline" action="<?=config('app.url'); ?>/orders/update/{{$orders->id}}" method="post">
        @csrf
            <p>
                <label for="id">Id:</label>
                <input id="id" name="id" value="{{$orders->id}}" readonly>
            </p>
            <label for="status">Status:</label>
            <input type="radio" name="status" id="status-nieopłacone" value="nieopłacone" 
            @if ($orders->status == 'nieopłacone') checked @endif required>
            <label for="status-nieopłacone">Oczekuje na opłatę</label>
            <input type="radio" name="status" id="status-realizacja" value="realizacja" 
            @if ($orders->status == 'realizacja') checked @endif required>
            <label for="status-realizacja">W trakcie realizacji</label>
            <input type="radio" name="status" id="status-wysłane" value="wysłane" 
            @if ($orders->status == 'wysłane') checked @endif required>
            <label for="status-wysłane">Wysłane</label>
            <input type="radio" name="status" id="status-dostarczone" value="dostarczone" 
            @if ($orders->status == 'dostarczone') checked @endif required>
            <label for="status-dostarczone">Dostarczone</label>
            <input type="radio" name="status" id="status-anulowane" value="anulowane" 
            @if ($orders->status == 'anulowane') checked @endif required>
            <label for="status-anulowane">Anulowane</label>
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