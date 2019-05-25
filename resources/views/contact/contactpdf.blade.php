@if(!empty($pepe))
    <table class="" border="1" width="100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>            
            @foreach($pepe as $contact)
                <tr>
                    <td>{{$contact->name}}</td>
                    <td>{{$contact->email}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
 @else
    No se encontraron registros
@endif