<!DOCTYPE html>
<html lang="en">
    @include('partials/head')
    <body>
        @include('partials/navi')
        <div id="zawartosc">
        <h2>Szczegóły zamówienia</h2>
        <form class="form-inline" action="<?=config('app.url'); ?>/shop/checkout/save" method="post">
        @csrf
            <p>
                <label for="first_name">Imię</label>
                <input id="first_name" name="first_name" value="{{$user->first_name}}" readonly>
            </p>
            <p>
                <label for="last_name">Nazwisko: </label>
                <input id="last_name" name="last_name" value="{{$user->last_name}}" readonly>
            </p>
            <p>
                <label for="address">Adres dostawy: </label>
                <input id="address" name="address" value="{{$user->address}}" required>
            </p>
            <p>
                <label for="zip_code">Kod pocztowy: </label>
                <input id="zip_code" name="zip_code" value="{{$user->zip_code}}" required>
            </p>
            <p> Wybierz formę dostawy
            <select name="id" id="id">
             @foreach($shipping as $el) 
                <option value={{$el->id}}>{{$el->shipping_method}} {{$el->shipping_price}}zł</option>
                @endforeach
            </select>
            </p>  
            <table>
                <thead>
                    <tr>
                    <th>Nazwa produktu</th>
                    <th>Ilość</th>
                    <th>Cena za sztukę</th>
                    <th>Łączna cena produktów</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $el)
                    <tr>
                    <td>{{ $el->name }}</td>
                    <td>{{ $el->quantity }}</td>
                    <td>{{ $el->price }}</td>
                    <td>{{ $el->price * $el->quantity }}</td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
            <p>    
            <label for="comment">Komentarz do zamówienia</label>
            <textarea id="comment" name="comment" rows="4" cols="50"></textarea>
            </p>
            <p>
                <label for="gift">Wybierz prezent: </label>
                <input type="radio" name="gift" id="gift" value="pluszak" checked required>
                <label for="gift">Pluszak</label>
                <input type="radio" name="gift" id="gift" value="grzchotka" required>
                <label for="gift">Grzechotka</label>
                <input type="radio" name="gift" id="gift" value="przywieszka" required>
                <label for="gift">Przywieszka</label>
                <input type="radio" name="gift" id="gift" value="gryzak" required>
                <label for="gift">Gryzak</label>

            </p>    
            <p> 
            Cena końcowa za produkty: {{$total}}
            </p>
            <p>
                <button type="submit" class="btn btn-primary mb-2">Kupuję</button></p>
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