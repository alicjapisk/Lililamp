<!DOCTYPE html>
<html lang="en">
    @include('partials/head')
    <body>
        @include('partials/navi')
        <div id="zawartosc">
            <h2>Szczegóły zamówienia</h2>
            <h3>Informacje o produkcie</h3>
            <table>
                <thead>
                    <tr>
                    <th>Nazwa produktu</th>
                    <th>Ilość</th>
                    <th>Cena</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($myDetail as $el)
                    <tr>
                    <td>{{ $el->name }}</td>
                    <td>{{ $el->quantity }}</td>
                    <td>{{ $el->price * $el->quantity }} zł</td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
                <h3> Informacje o zamówieniu </h3>
                <table>
                <thead>
                    <tr>
                    <th>Cena końcowa</th>
                    <th>Komentarz do zamówienia</th>
                    <th>Prezent</th>
                    <th>Status</th>
                    <th>Data zamówienia</th>
                    <th>Adres</th>
                    <th>Kod pocztowy</th>
                    <th>Sposób dostawy</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td>{{ $el->order_price}} zł</td>
                    <td>{{ $el->comment}}</td>
                    <td>{{ $el->gift}}</td>
                    <td>{{ $el->status}}</td>
                    <td>{{ $el->order_date}}</td>
                    <td>{{ $el->address}}</td>
                    <td>{{ $el->zip_code}}
                    <td>{{ $el->shipping_method}}</td>
                    </tr>
                </tbody>
                </table>
        </div>
    </body>
</html>