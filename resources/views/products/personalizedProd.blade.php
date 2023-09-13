<!DOCTYPE html>
<html lang="en">
    @include('partials/head')
    <body>
        @include('partials/navi')
        <div id="zawartosc">
            <h2>Produkt personalizowany</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nazwa</th>
                        <th>Cena</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($prod as $el)
                    <tr>
                        <td>{{$el->name}}</td>
                        <td>{{$el->price}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="<?=config('app.url'); ?>/add-to-card/{{$el->id}}">Dodaj do koszyka</a>
        </div>
    </body>
</html>