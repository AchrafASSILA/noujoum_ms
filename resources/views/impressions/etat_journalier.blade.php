<?php

use App\Models\Fnc\FncEncaissementLine;
?>
<table>
    <tr>
        <td style="vertical-align:center">
            <img src="<?= $config->getLogo() ?>" width="70" alt="">
        </td>
        <td></td>
        <td style="vertical-align:center">
            <br /><br />

            Etat journalier

        </td>
        <td></td>
        <td style="text-align: end;" style="vertical-align:center">
            <br /><br />
            {{$config->Title}}
        </td>
    </tr>
</table>
<br>
<br>
<table border="1">
    <thead>
        <tr>
            <td style="text-align: center;line-height:1.9">Nom et prenom</td>
            <td style="text-align: center;line-height:1.9">      total paye</td>
            <td style="text-align: center;line-height:1.9">Date</td> 
        </tr>
    </thead>
    <tbody>
        <?php
          $total = 0;
          $inscriptions = [];
        foreach ($fnc_inscriptions as $fnc_inscription) {
            if (in_array($fnc_inscription->inscription->id, $inscriptions)) continue;
            $totalPayed = FncEncaissementLine::where('Inscription', $fnc_inscription->inscription->id)->where('created_at', 'like', $date . '%')->whereNull('Canceled')->sum('Amount');

$total += $totalPayed;

        
        ?>
        <tr>
            <td style="text-align: center;line-height:2"> <span style="text-align: right">

                    {{$fnc_inscription->inscription->client->user->getFullName()}}
                </span>
            </td>
            <td style="text-align: center;line-height:2"> <span style="text-align: right">

                    {{ number_format($totalPayed, 2) . ' DH'}}
                </span>
            </td>
            <td style="text-align: center;line-height:2">{{$date}}</td>
                </tr>

        <?php 
     $inscriptions[] = $fnc_inscription->inscription->id;
    }?>
    </tbody>
    <tfoot>
        <tr style=" background-color:#dfffeb;text-align:center;color:#53b678">
            <td style="text-align: center;line-height:2">-</td>
            <td style="text-align: center;line-height:2">{{ number_format($total, 2) . ' DH'}} </td>
            <td style="text-align: center;line-height:2">{{$date}}</td> 
        </tr>

    </tfoot>
</table>