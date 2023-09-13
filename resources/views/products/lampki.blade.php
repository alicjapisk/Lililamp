<!DOCTYPE html>
<html lang="en">
    @include('partials/head')
    <body>
        @include('partials/navi')
        <div id="zawartosc">
            <h2>Lampki</h2>
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($prod as $el)
                    <tr>
                    <td><a href="<?=config('app.url'); ?>/products/product/{{$el->id}}">{{$el->name}}</a></td>
                    <td>{{$el->price}} zł</td>
                    <td><img src="{{ asset('images/'.$el->pictureURL) }}" alt="$el->$name" width="100" height="100"></td>
                    </tr>
                    @endforeach
            </table>
        </div>
    </body>
</html>