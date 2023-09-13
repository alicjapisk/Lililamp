<!DOCTYPE html>
<html lang="en">
    @include('partials/head')
    <body>
        @include('partials/navi')
        <div id="zawartosc">
        <form method="POST" action="<?=config('app.url'); ?>/users/list/search">
            @csrf
                <select name="is_admin">
                <option value="false">Klienci</option>
                <option value="true">Administratorzy</option>
                </select>
                <button type="submit">Szukaj</button>
        </form>
            <h2>Lista klientów</h2>
            <table>
                <thead>
                    <tr>
                        <th>Imię</th>
                        <th>Nazwisko</th>
                        <th>Email</th>
                        <th>Adres</th>
                        <th>Kod pocztowy</th>
                        <th>Edit</th>
                        <th>Del</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $el)
                    <tr>
                        <td>{{$el->first_name}}</td>
                        <td>{{$el->last_name}}</td>
                        <td>{{$el->email}}</td>
                        <td>{{$el->address}}</td>
                        <td>{{$el->zip_code}}</td>
                        <td><a href="<?=config('app.url'); ?>/users/edit/{{$el->id}}">Edit</a></td>
                        <td><a href="<?=config('app.url'); ?>/users/show/{{$el->id}}">Del</a></td>
                    </tr>
                    @endforeach
            </table>
        </div>
    </body>
</html>