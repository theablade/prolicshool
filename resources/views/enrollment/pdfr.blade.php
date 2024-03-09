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
     margin-top: 6rem;
   }

   .titulo {
     color: black;
     font-weight: bold;
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





 <div class="tabela">
   <div class="info-primary">


     <h4 style="font-size: 22px; text-decoration: underline;">Recibo de pagamento da matricula</h4>

     <div style="float: right;">
       <p> <span class="titulo">Data</span>: <?php echo date("d-m-Y"); ?></p>

     </div>

   </div>

   @foreach ($enrollments as $key => $enrollment)

   <p>
     Recebemos do Sr(a) <b>{{ $enrollment->student }}</b> a
     importância de {{ $enrollment->price_enrollemnt }} (Quinheitos Meticais), referente ao pagamento da mensalidade e
     {{ $enrollment->price_subscrab }} referente ao valor da incrição. <br>
     Emitente: Pinco <br>
     Endereço: Av. Eduardo Mondlane, Sokoko –
     Quelimane– Moçabique
   </p>

   @endforeach

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