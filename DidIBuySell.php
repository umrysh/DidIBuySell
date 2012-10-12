<?php
// Stocks to watch
// example: $stocks = array("ENB","RCI.B");
$stocks = array("","");
// Your brokers name as it shows on stockwatch.com
// example: $MyName = "79 CIBC";
$MyName = "";
// Your email
$emailAddress = "";






$log = "";

date_default_timezone_set('US/Eastern');
// 25 minutes ago
$currenttime = time()-1500;


for ($count=0;$count<count($stocks);$count++)
{
	$var = file_get_contents("http://www.stockwatch.com/Quote/Detail.aspx?symbol=" . $stocks[$count] . "&region=C");
	
	$pos = strpos($var, 'TradeList1_Table1_Table1');
	$mystring = substr($var, $pos);

	$Endpos = strpos($mystring, '</table>') - 6;

	$pos2 = 0;
	while($pos2<$Endpos)
	{
		$pos = strpos($mystring, '<td class="gt">');
		$mystring = substr($mystring, $pos+15);

		$pos2 = $pos2 + $pos + 15;

		$pos = strpos($mystring, '</td>');
		$time = substr($mystring, 0, $pos);

		$pos = strpos($mystring, '<b>');
		$mystring = substr($mystring, $pos+3);

		$pos2 = $pos2 + $pos +3;
		
		$pos = strpos($mystring, '</b>');
		$price = substr($mystring, 0, $pos);


		$pos = strpos($mystring, 'q-regright');
		$mystring = substr($mystring, $pos+12);

		$pos2 = $pos2 + $pos + 12;

		$pos = strpos($mystring, '</td>');
		$qty = substr($mystring, 0, $pos);

		$pos = strpos($mystring, '<td class="gt">');
		$mystring = substr($mystring, $pos+15);

		$pos2 = $pos2 + $pos + 15;

		$pos = strpos($mystring, '</td>');
		$buyer = substr($mystring, 0, $pos);

		$pos = strpos($mystring, '<td class="gt">');
		$mystring = substr($mystring, $pos+15);

		$pos2 = $pos2 + $pos + 15;

		$pos = strpos($mystring, '</td>');
		$seller = substr($mystring, 0, $pos);

		//finish off line

		$pos = strpos($mystring, '</tr>');
		$mystring = substr($mystring, $pos+5);

		$pos2 = $pos2 + $pos + 5;

		if($buyer == $MyName and strtotime($time) > $currenttime)
		{
			$log = $log . "You Might Have Bought Stock\n\nStock: $stocks[$count]\nQTY: $qty\nTime: $time\nPrice: $price\n\n";
		}
		if($seller == $MyName and strtotime($time) > $currenttime)
		{
			$log = $log . "You Might Have Sold Stock\n\nStock: $stocks[$count]\nQTY: $qty\nTime: $time\nPrice: $price\n\n";
		}

		//echo $time . " - " . $qty . " - " . $price . " - " . $buyer . " - " . $seller . "\n";

	}
	
}

////////// Email ///////////
if($log != "")
{
	$to = $emailAddress;
	$from_header = "From: " . $emailAddress;
	$subject = "StockWatch";
	mail($to, $subject, $log, $from_header);
}
?>