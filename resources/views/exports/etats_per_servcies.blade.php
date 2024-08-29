 <table border="1">
     <thead>
         <tr>
             <td style="text-align: center;line-height:1.9">Service</td>
             <td style="text-align: center;line-height:1.9">Chiffre d'affaire</td>
             <td style="text-align: center;line-height:1.9">Montant encaissé</td>
             <td style="text-align: center;line-height:1.9">Le reste à payé</td>
         </tr>
     </thead>
     <tbody>
         @foreach ($services as $service)
         <?php 


            $ca = $service->getCA(); //chiffre d'affaire
            $me = $service->getME(); //montant encaissé
            $reste = $ca - $me;
            ?>
         <tr>
             <td style="text-align: center;line-height:2"> <span style="text-align: right">

                     {{$service->Label}}
                 </span>
             </td>
             <td style="text-align: center;line-height:2"> <span style="text-align: right">

                     {{number_format( $ca ,2)}} DH
                 </span>
             </td>
             <td style="text-align: center;line-height:2">{{number_format($me,2)}} DH</td>
             <td style="text-align: center;line-height:2">{{number_format($reste,2)}} DH</td>
         </tr>

         @endforeach
     </tbody>
     <tfoot>
         <tr style=" background-color:#dfffeb;text-align:center;color:#53b678">
             <td style="text-align: center;line-height:2">Total</td>
             <td style="text-align: center;line-height:2">{{number_format($ca_total,2)}} DH</td>
             <td style="text-align: center;line-height:2">{{number_format($me_total,2)}} DH</td>
             <td style="text-align: center;line-height:2">{{number_format($reste_total,2)}} DH</td>
         </tr>

     </tfoot>
 </table>