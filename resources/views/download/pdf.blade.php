 <table class="table table-bordered table-striped">
   <thead class="table-dark">
     <tr>
       <th>ID</th>
       <th>Nome</th>
       <th>Email</th>
       <th>Endereço</th>
       <th>Telefone</th>
       <th>Documento</th>
       <th>Actions</th>
     </tr>
   </thead>
   <tbody>
     @foreach ($students as $student)
     <tr>
       <td>{{ $student->id }}</td>
       <td setTimeout(function() { document.getElementById('success-message').style.display='none' ; }, 3000);>
         {{ $student->nome }}</td>
       <td>{{ $student->email }}</td>
       <td>{{ $student->avenida }}</td>
       <td>{{ $student->ntelefone }}</td>
       @if ($student->tipodoc == "bi")

       <td>
         BI:
         {{$student->numerodoc}}
       </td>

       @elseif($student->tipodoc == "cedula")
       <td>
         Cedula:
         {{$student->numerodoc}}

       </td>
       @else
       <td>
         Cartão de eleitor:
         {{$student->numerodoc}}

       </td>
       @endif

       <td>
         <a href="{{ route('student.show', $student->id) }}">Ver</a>
         <a href="{{ route('student.edit', $student->id) }}">Edit</a>
         <form action="{{ route('student.destroy', $student ->id) }}" method="POST">
           @csrf
           @method('DELETE')
           <button type="submit"
             onclick="return confirm('Tens certeza que queres apagar esse estudante?')">Delete</button>
         </form>


       </td>


     </tr>
     @endforeach
   </tbody>
 </table>