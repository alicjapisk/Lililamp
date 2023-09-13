<!DOCTYPE html>
<html lang="en">
    @include('partials/head')
    <body>
        @include('partials/navi')
        <div id="zawartosc">
            <h2>Lista zamówień</h2>
            <table>
                <thead>
                    <tr>
                        <th>Numer zamówienia</th>
                        <th>Imię</th>
                        <th>Nazwisko</th>
                        <th>Email</th>
                        <th>Data</th>
                        <th>Status</th>
                        <th>Edytowanie</th>
                        <th>Szczegóły zamówienia</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order as $el)
                    <tr>
                        <td>{{$el->id}}</td>
                        <td>{{$el->first_name}}</td>
                        <td>{{$el->last_name}}</td>
                        <td>{{$el->email}}</td>
                        <td>{{$el->order_date}}</td>
                        <td>{{$el->status}}</td>
                        <td><a href="<?=config('app.url'); ?>/orders/edit/{{$el->id}}">Edytuj</a></td>
                        <td><a href="<?=config('app.url'); ?>/orderdetails/list/{{$el->id}}">Zobacz</a></td>

                    </tr>
                    @endforeach
            </table>
        </div>
    </body>
</html>