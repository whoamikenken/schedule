<?php

$pdf = new \Mpdf\Mpdf(array('mode' => 'utf-8','format' => 'LETTER-L', 'orientation' => 'L'));
$pdf->SetTitle($reportName);
$pdf->SetProtection(array('print', 'copy'), "KMSI001", "KMSIOWN"); 

$info  = "  <style>
                @page{            
                    /*margin-top: 4.35cm;*/
                    margin-top: 3.15cm;
                    odd-header-name: html_Header;
                    odd-footer-name: html_Footer;
                }
                th{
                	color: white;
                }  
                .content{
                    height: 100%;
                    margin-top: 15px;
                }
                table{
                    border-collapse: collapse;
                    font-size: 12px;
                    border-spacing: 5px;
                }
                .content-header{
                    text-align: center;
                    font-size: 12px;
                }
                .content-body{
                    border: 1px solid black;
                    padding-top: 8px;
                    padding-bottom: 8px;
                    padding-left: 8px;
                }

			    .footer{
			    	width: 100%;
			    	text-align: right;
			    }
            </style>";
$info .= "
<htmlpageheader name='Header'>
    <div>
        <table width='60%'  >
            <tr>
                <td rowspan='4' style='text-align: right;' width='60%'><img src='images/logo.png' style='width: 70px;text-align: center;' /></td>
                <td valign='middle' width='90%' style='padding: 0;text-align: center;' width='45%'><span style='font-size: 13px;'><b>KINGS MANPOWER SERVICES</b></span></td>
            </tr>
            <tr>
                <td valign='middle' style='padding: 0;text-align: center;'><span style='font-size: 13px;' width='45%'><strong>Envision and achieve an optimum goal
</strong></span></td>
            </tr>
            <tr>
                <td valign='middle' style='padding: 0;text-align: center;'><span style='font-size: 13px;' width='45%'><strong>" . $reportName . "</strong></span></td>
            </tr>
            <tr>
                <td valign='middle' style='padding: 0;text-align: center;'><span style='font-size: 11px;' width='45%'><strong></strong>" . $dateof . "</span></td>
            </tr>
        </table>
    </div>
</htmlpageheader>";
$info .= "

<div class='content'>
    <div class='content-header'>
        <table border=1 width='100%' style='font-size: 9px;' id='datas'>
            <thead>
            <tr style='background-color: black;'>
            ";
            foreach ($edatalist as $key => $value) {
                $info .= "<th style='padding: 5px;text-align: center;font-size: 12px;font-weight: bold;'>". $value."</th>";
            }
$info .= "</thead>";
$info .= "<tbody>";
$totalCost = $med1 = $med2 = $med3 = $med4 = $nc2 = 0;
$currencyArray = array('med_first_cost', 'med_second_cost', 'med_third_cost', 'med_fourth_cost', 'cert_nc2_cost','total_cost');
if(count($result) > 0 ){
            foreach($result as $value){
            $info .= "<tr>";
                    foreach ($edatalist as $row => $val) {
                        if($row == "fullname"){
                            $info .= "<td style='padding: 2px;text-align: center;font-size: 13px;'>" . $value->lname . ", " . $value->lname . " " . $value->mname . "</td>";
                        }elseif ($row == "user_profile_face") {
                            $info .= "<td style='padding: 2px;text-align: center;font-size: 13px;'><img src='" . $value->user_profile_face . "' style='width: 60px;text-align: center;' /></td>";
                        }elseif ($row == "user_profile") {
                            $info .= "<td style='padding: 2px;text-align: center;font-size: 13px;'><img src='" . $value->user_profile . "' style='width: 60px;text-align: center;' /></td>";
                        }else{
                            if(in_array($row, $currencyArray)){
                                $info .= "<td style='padding: 2px;text-align: center;font-size: 13px;'>₱" . $value->{$row} . ".00</td>";
                            }else{
                                $info .= "<td style='padding: 2px;text-align: center;font-size: 13px;'>" . $value->{$row} . "</td>";
                            }
                            
                        }
                    }
                    $totalCost += $value->total_cost;
                    $med1 += $value->med_first_cost;
                    $med2 += $value->med_second_cost;
                    $med3 += $value->med_third_cost;
                    $med4 += $value->med_fourth_cost;
                    $nc2 += $value->cert_nc2_cost;

        $info .= "</tr>";
        }
}else{
    $info .= "<tr><td colspan='".count($edatalist)."' style='text-align:center;font-size:20px;'>No Data</td></tr>";
}
$info .= "<tr>
<td colspan='" . (count($edatalist) - 6) . "' style='text-align:right;font-size:20px;'>TOTAL:</td>
<td style='text-align:center;font-size:20px;'>₱". $med1. ".00</td>
<td style='text-align:center;font-size:20px;'>₱" . $med2 . ".00</td>
<td style='text-align:center;font-size:20px;'>₱" . $med3 . ".00</td>
<td style='text-align:center;font-size:20px;'>₱" . $med4 . ".00</td>
<td style='text-align:center;font-size:20px;'>₱" . $nc2 . ".00</td>
<td style='text-align:center;font-size:20px;'>₱" . $totalCost . ".00</td>
</tr>";
$info .= "      
            </tbody>
        </table>
    </div>
</div>";
$info .= "
	<htmlpagefooter name='Footer'>
		<br>
		<div class='footer'>
			Page : {PAGENO} of {nb}
		</div>
	</htmlpagefooter>
";
$pdf->WriteHTML($info);

$pdf->Output($reportName.'.pdf', 'I');
