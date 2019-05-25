
    <a href="{{url('contacts/create')}}" class="btn btn-primary">Crear</a>
    @if(session()->get("msj")!="")
    <div class="alert {{session()->get("error")?'alert-danger':'alert-success'}}" role="alert">
        {{session()->get("msj")}}
    </div>
    @endif
    <div class="row justify-content-center">
       <div class="col-12">
       <table class="table">
         <thead class="thead-dark">
            <tr>
               <th scope="col">#</th>
               <th scope="col">Name</th>
               <th scope="col">Phone</th>
               <th scope="col">Actions</th>
            </tr>
         </thead>
         <tbody>
            @foreach ($contacts as $contact)
            <tr>
               <th scope="row">
                @if(!empty($contact->image))
                  <!-- <img style="border-radius:50%;width:100px;height:100px" src="{{'/contacts/'.$contact->image}}" alt="" > -->
                  <img style="border-radius:50%;width:100px;height:100px" src="{{ asset('/contacts/'.$contact->image) }}" alt="" >   
                @endif
               </th>
               <td>{{$contact->name}}</td>
               <td>{{$contact->phone}}</td>
               <td>
                  <a href="{{url('contacts/update/'.$contact->id)}}" class="btn btn-success btn-sm">Modificar</a>
                  <form method="post" action="{{route('deleteform',$contact->id)}}">
                     @csrf
                     <input type="hidden" name="_method" value="DELETE">
                     <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                  </form>
               </td>
            </tr>
            @endforeach
         </tbody>
         </table>
        </div>
    </div>
