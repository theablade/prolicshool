 <head>


   <style>
   table {
     border-collapse: collapse;
     width: 100%;
   }

   .head-table th {

     border: 2px solid #ccc;
     border-left: 0px;
     padding: 1rem 0px 1rem 0px;
     border-right: 0px;

   }

   #line td {
     border-left: 0px;
     padding: 1rem;
     border-bottom: 1px solid #ccc;

   }

   .total td {
     padding: 5rem;
   }

   tbody tr:nth-child(odd) {
     background: #eeee;
   }


   .head-info h1 {
     color: #000;
     font-size: 37px;
   }

   .info h4 {
     text-align: end;
   }

   .info p {
     font-size: 12px;
   }

   .head-table {

     padding-top: 1rem;

     margin-bottom: 3rem;
   }

   .total th {
     padding: 1rem 0px 1rem 0px;
   }

   td {
     color: #000;
   }

   .info-primary {
     margin-bottom: 5rem;
   }





   .tabela .date p {
     margin: 0;
     /* Remover margens para evitar espaçamentos extras */
   }


   .tabela {
     margin-top: 16rem;
   }

   .titulo {
     color: black;
     font-weight: bold;
   }

   .footer {
     position: fixed;
     bottom: 0;
     left: 10rem;
   }

   .info-footer {
     text-align: center;
     width: 400px;

     align-items: center;
     margin: 7.4rem auto;

   }

   .ass {

     border-bottom: 1px solid #222;
   }
   </style>
 </head>

 <div class="head-info">
   <div style="float: left;">
     <h1>PINCO</h1>
   </div>

   <div class="contacts" style="float: right;">
     <div class="info">
       <h4>Prolinc lda</h4>
       <p>Av. Eduardo Mondla, Sokoko</p>
     </div>
   </div>
 </div>


 <div class="table-responsive ">


   <div class="tabela">
     <div class="info-primary">


       <h4 style="font-size: 22px; text-decoration: underline;">Relatório de estudantes</h4>

       <div style="float: right;">
         <p> <span class="titulo">Data</span>: <?php echo date("d-m-Y"); ?></p>



       </div>

     </div>
     <table class="table ">

       <thead class=" head-table ">
         <tr>

           <th>#</th>
           <th>Nome</th>
           <th>Gênero</th>
           <th>Email</th>
           <th>Endereço</th>
           <th>Telefone</th>

         </tr>
       </thead>
       <tbody>
         @foreach ($students as $key => $student)

         <tr id="line">
           <td>
             {{ $key+1 }}</td>
           <td>
             {{ $student->nome }}</td>
           <td>{{ $student->genero }}</td>
           <td>{{ $student->email }}</td>
           <td>{{ $student->avenida }}</td>
           <td>{{ $student->ntelefone }}</td>


         </tr>

         @endforeach
       </tbody>
       <tfoot>
         @if (isset($key))


         <tr class="total">
           <th colspan="5" style="text-align: right; ">
             TOTAL
           </th>
           <th style="background-color: #eee; font-size: 18px; text-align: center;">
             {{ $key+1 }}
           </th>

         </tr>
         @endif
       </tfoot>
     </table>
   </div>


   <div class="footer">
     <div class="info-footer ">
       <div class="ass">

       </div>
       <div>

         <p>({{ Auth::user()->name }}
           )</p>
       </div>
     </div>


   </div>

 </div>