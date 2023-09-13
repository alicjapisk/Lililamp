<!DOCTYPE html>
<html lang="en">
    @include('partials/head')
    <body>
        @include('partials/navi')
        <div id="zawartosc">                
            @foreach($prod as $el)
            <form action="<?=config('app.url'); ?>/products/product/{{$el->id}}" method="post">
            @csrf
                    <h1>{{$el->name}}</h1>
                    
                    <p><img src="{{ asset('images/'.$el->pictureURL) }}" alt="$el->$name" width="500" height="600"></p>
                    
                    <p>{{$el->description}}</p>
                
                    <h2>Cena: {{$el->price}} zł</h2>
                @endforeach
                
                @if(Auth::check())
                <label for="quantity">Ilość:</label>
                <input type="number" name="quantity" id="quantity" min="1" value="1">
                @endif
                @if(Auth::check())<p><button type="submit" class="btn btn-primary">Dodaj do koszyka</button></p>@endif
            </form>
            @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
            @endif
        </div>
    </body>
</html>