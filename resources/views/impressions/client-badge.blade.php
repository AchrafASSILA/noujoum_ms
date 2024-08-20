<table>
    <tbody>
        <tr align="center">
            <td width="30%">
                <div>
                    <?php $logo  ='http://[::1]:5173/resources/js/assets/images/favicon.png'; ?>
                    <img src="<?php echo $logo ?>" />
                </div>
            </td>
            <td width="40%">
                <br>
                <br>
                <span class="padge-title" style="color: rgb(1, 123, 176);">BADGE D'ACCÈS</span>
                <br>
                <span class="school-name-header"> <?php echo 'Noujoum'?></span>

            </td>
            <td width="30%">
                <div>
                    <?php $logo = 'http://[::1]:5173/resources/js/assets/images/favicon.png'; ?>
                    <img src="<?php echo $logo ?>"   />
                </div>
            </td>
        </tr>
    </tbody>
</table>
<div style="border-bottom: 1px solid #017bb0;"></div>
<br>
<table>
    <tbody>
        <tr align="center">
            <td width="40%">

                    <img src="<?php  echo  $client->user->getImage();
                            ?>" style="border-radius: 50%; height: 90px; width: 90px;">
                            
                <br>
                
                <span style="font-size: 12px!important; text-align: center;"><span class="val"><?php echo strtoupper($client->inscription() ? $client->inscription()->promotion->Label : '-') ?></span></span>
            </td>
            <td width="60%" align="left">
                <span class="information-title" style="height:20%">Nom et prénom: <span class="val" style="text-align: left;"><?php echo strtoupper($client->user->getFullName()) ?></span></span>
                <br>
                <br>
                <span class="information-title" style="height:20%">Téléphone : <span class="val" style="text-align: left;"><?php echo $client->user->tel?></span></span>
                <br>
                <br>
                  <span class="information-title" style="height:20%">Promotion : <span class="val" style="text-align: left;"><?php echo $client->inscription()->promotion->Year?></span></span>
            </td>
        </tr>
    </tbody>
</table>
 
 
<style>
    .padge-title {
        font-size: 12px !important;
        text-transform: uppercase !important;
        text-align: center !important;
        font-weight: 700 !important;
        /* color: #017bb0 !important; */
    }

    .school-name-header {
        margin-top: 10px;
        margin: 0 !important;
        text-align: center !important;
        font-size: 13px !important;
        font-weight: bold;
    }

    .information-title {
        font-size: 18px !important;
        font-weight: 600 !important;

    }
</style>