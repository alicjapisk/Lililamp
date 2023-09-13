<!DOCTYPE html>
<html lang="en">
    @include('partials/head')
    <body>

        @include('partials/navi')
        <div id="zawartosc">
        @if(isset($empty) && $empty == true)
        <h1>Twój koszyk jest pusty</h1>
        @else
            <h1>Twój koszyk</h1>
            <table>
                <thead>
                    <tr>
                    <th>Nazwa produktu</th>
                    <th>Ilość</th>
                    <th>Cena</th>
                    <th>Łączna cena</th>
                    <th>Usuwanie<th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $el)
                    <tr>
                    <td>{{ $el->name }}</td>
                    <td>{{ $el->quantity }}</td>
                    <td>{{ $el->price }}</td>
                    <td>{{ $el->price * $el->quantity }}</td>
                    <td><a href="<?=config('app.url'); ?>/shop/show/{{$el->id_cart}}">Usuń</a></td>
                    </tr>
                    @endforeach
                    <tfoot>
                        <tr>
                            <td>Suma</td>
                            <td>{{$total}}</td>
                    </tfoot>
                </tbody>
                </table>
                <p><a class="button" href="<?=config('app.url'); ?>/shop/checkout">Złóż zamówienie</a></p>    
            @endif  
    </div>
    </body>
</html>