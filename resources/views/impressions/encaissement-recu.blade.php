<style>
	table.header {
		width: 100%;
	}

	table.header tr td {
		font-size: 15px;
		list-style-type: none;
		margin: 0;
		font-weight: 100;
		padding: 0;
	}

	table.header tr td.td-left {
		text-align: left;
		direction: ltr;
		font-size: 12px;
		width: 80%;
	}

	table.header tr td.td-left h3 {
		font-size: 18px;
		font-weight: 600;
		text-transform: uppercase;
	}

	table.header tr td.td-right {
		text-align: right;
		direction: rtl;
		width: 20%;
	}


	.bold {
		font-weight: bold;
	}

	.text-right {
		text-align: right;
		display: block;
	}
</style>

<table style="padding: 0px;width: 100%;border: 2px solid #000;">
	<tr style="width:100%;">
		<td style="width:100%;">
			<table cellpadding="10" class="header">
				<tr>
					<td class="td-left">
						<h3><?php echo ('Noujoum centre') ?></h3>
						<span style="font-size:10px;">
							<br />
							 
								<?php for ($i = 0; $i <= 3; $i++) { ?>&nbsp;<?php } ?><?php echo 'casa,maroc' ?>
								<br />
					  
								<?php for ($i = 0; $i <= 3; $i++) { ?>&nbsp;<?php } ?>Tél : <?php echo '06 43 56 78 98' ?>
						 
						
						</span>
					</td>
					<td class="td-right">
						<br />
						<img src="http://[::1]:5173/resources/js/assets/images/favicon.png" style=" " />
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr style="width:100%;">
		<td>
			<table cellpadding="3" style="width:102%;">
				<tr style="width:100%;">
					<td style="border-top:.4px solid #000;width:98%;">
						<span style="font-size:10px;text-align:right"><?php echo $encaissement->created_at ?date('Y-m-d',strtotime( $encaissement->created_at))  : '-' ?></span>
						<br />
						<span style="text-align:center;margin:0;"> <span class="bold"> Reçu N° : </span> <?php echo $encaissement->RecuNumber ?> </span>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td style="width:100%;">

	 
			<table>
				<tr style="width:100%;">
                    <td style="width:100%;">
						<span style="font-size:14px;"> <span class="bold"> Client : </span><?php echo $encaissement->inscription->client->user->getFullName() ?> </span>
						<br>
						{{-- <span style="font-size:14px;"> <span class="bold"> Matricule : </span>-</span>
						<br> --}}
						 
						<br>
						<span style="font-size:14px;">
							<?php 
                            $total = 0;
							foreach ($encaissement_lines as $item) {
$total += $item->Amount ;
							?>
								<span style="font-size:14px;" class="bold">
									<?php echo $item->Frequenc ?> :
								</span>
								<br>
								 
									 <?php echo $item->service->Label ?> : 
										<b> <?php echo $item->Amount ?> DH</b>
									 
									<br> 
							<?php } ?>
						</span>
                      
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr style="width: 100%;">
		<td style="width:100%;">
			<table>
				<tr>
					<td style="width:25%;">
						<?php for ($i = 0; $i <= 2; $i++) { ?>&nbsp;<?php } ?>
						<table cellpadding="3" border=".1">
							<tr>
								<td>
									&nbsp;<span style="font-size:9px;"> Cachet du centre</span>
									<br />
									<br />
								</td>
							</tr>
						</table>
					</td>
                    <td style="width:75%;">
                        <br />
									<br />
                        <table>
                            <tr>

                                <td>
                                 
                                </td>
                                <td>
                                 
                                </td>
                                <td>
                                    Total : <?= $total?> DH
                                </td>
                            </tr>
                        </table>
                    </td>
					<td>
					</td>
					
				</tr>
			</table>
			<br />
			<br />
		</td>
	</tr>
</table>

<br />

<table cellpadding="0">
	<tr style="width:100%;height:0px;">
		<td style="border-bottom: .3px dashed grey;"></td>
	</tr>
</table>

<br />

<br />


<table style="padding: 0px;width: 100%;border: 2px solid #000;">
	<tr style="width:100%;">
		<td style="width:100%;">
			<table cellpadding="10" class="header">
				<tr>
					<td class="td-left">
						<h3><?php echo  ('Noujoum centre') ?></h3>
						<span style="font-size:10px;">
							<br />
							 
								<?php for ($i = 0; $i <= 3; $i++) { ?>&nbsp;<?php } ?><?php echo 'casa,maroc' ?>
								<br />
					 
							 
								<?php for ($i = 0; $i <= 3; $i++) { ?>&nbsp;<?php } ?>Tél : <?php echo '06 43 56 78 98' ?>
						 
						
						</span>
					</td>
					<td class="td-right">
						<br />
						<img src="http://[::1]:5173/resources/js/assets/images/favicon.png" style=" " />
					</td>   
				</tr>
			</table>
		</td>
	</tr>
	<tr style="width:100%;">
		<td>
			<table cellpadding="3" style="width:102%;">
				<tr style="width:100%;">
					<td style="border-top:.4px solid #000;width:98%;">
						<span style="font-size:10px;text-align:right"><?php echo $encaissement->created_at ?  date('Y-m-d',strtotime($encaissement->created_at))   : '-' ?></span>
						<br />
						<span style="text-align:center;margin:0;"> <span class="bold"> Reçu N° : </span> <?php echo $encaissement->RecuNumber ?> </span>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td style="width:100%;">

	 
			<table>
				<tr style="width:100%;">
					<td style="width:100%;">
						<span style="font-size:14px;"> <span class="bold"> Client : </span><?php echo $encaissement->inscription->client->user->getFullName() ?> </span>
						<br>
						{{-- <span style="font-size:14px;"> <span class="bold"> Matricule : </span>-</span>
						<br> --}}
						 
						<br>
						<span style="font-size:14px;">
							<?php 
                            $total = 0;
							foreach ($encaissement_lines as $item) {
$total += $item->Amount ;
							?>
								<span style="font-size:14px;" class="bold">
									<?php echo $item->Frequenc ?> :
								</span>
								<br>
								 
									 <?php echo $item->service->Label ?> : 
										<b> <?php echo $item->Amount ?> DH</b>
									 
									<br> 
							<?php } ?>
						</span>
                         
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr style="width: 100%;">
		<td style="width:100%;">
			<table>
				<tr>
					<td style="width:25%;">
						<?php for ($i = 0; $i <= 2; $i++) { ?>&nbsp;<?php } ?>
						<table cellpadding="3" border=".1">
							<tr>
								<td>
									&nbsp;<span style="font-size:9px;"> Cachet du centre</span>
									<br />
									<br />
								</td>
                                
							</tr>
						</table>
					</td>
                    <td style="width:75%;">
                        <br />
									<br />
                        <table>
                            <tr>

                                <td>
                                 
                                </td>
                                <td>
                                 
                                </td>
                                <td>
                                    Total : <?= $total?> DH
                                </td>
                            </tr>
                        </table>
                    </td>
					<td>
					</td>
					
				</tr>
			</table>
			<br />
			<br />
		</td>
	</tr>
</table>
 