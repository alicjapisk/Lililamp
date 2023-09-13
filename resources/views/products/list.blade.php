<!DOCTYPE html>
<html lang="en">
    @include('partials/head')
    <body>
        @include('partials/navi')
        <div id="zawartosc">
            <h2>Lista produktów</h2>
            <form method="POST" action="<?=config('app.url'); ?>/products/list/search">
            @csrf
                <select name="category">
                @foreach($categories as $category)
                <option value="{{ $category->category }}">{{ $category->category }}</option>
                 @endforeach
                </select>
                <button type="submit">Szukaj</button>
            </form>
            <table>
                <thead>
                    <tr>
                        <th>Nazwa</th>
                        <th>Kategoria</th>
                        <th>Cena</th>
                        <th>Stan</th>
                        <th>Edit</th>
                        <th>Del</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $el)
                    <tr>
                        <td>{{$el->name}}</td>
                        <td>{{$el->category}}</td>
                        <td>{{$el->price}}</td>
                        <td>{{$el->condition}}</td>
                        <td><a href="<?=config('app.url'); ?>/products/edit/{{$el->id}}">Edit</a></td>
                        <td><a href="<?=config('app.url'); ?>/products/show/{{$el->id}}">Del</a></td>
                    </tr>
                    @endforeach
            </table>
        </div>
    </body>
</html>