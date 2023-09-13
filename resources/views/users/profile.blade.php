<!DOCTYPE html>
<html lang="en">
    @include('partials/head')
    <body>
        @include('partials/navi')
        <div id="zawartosc">
            <h2>Moje dane osobowe</h2>
            <table>
                <thead>
                    <tr>
                        <th>Imię</th>
                        <th>Nazwisko</th>
                        <th>Email</th>
                        <th>Adres</th>
                        <th>Kod pocztowy</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$userData->first_name}}</td>
                        <td>{{$userData->last_name}}</td>
                        <td>{{$userData->email}}</td>
                        <td>{{$userData->address}}</td>
                        <td>{{$userData->zip_code}}</td>
                    </tr>
            </table>
            <p><a href="<?=config('app.url'); ?>/users/editClient/{{$userData->id}}">Aktualizuj dane</a></p>
        </div>
    </body>
</html>