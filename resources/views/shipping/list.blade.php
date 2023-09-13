<!DOCTYPE html>
<html lang="en">
    @include('partials/head')
    <body>
        @include('partials/navi')
        <div id="zawartosc">
            <h2>Lista dostaw</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nazwa</th>
                        <th>Cena</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ship as $el)
                    <tr>
                        <td>{{$el->shipping_method}}</td>
                        <td>{{$el->shipping_price}}</td>
                    </tr>
                    @endforeach
            </table>
        </div>
    </body>
</html>