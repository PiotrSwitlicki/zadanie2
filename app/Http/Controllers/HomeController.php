<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function show()
    {

    	$dom = new \DOMDocument();    	
    	libxml_use_internal_errors(true);  		
	
    	$dom->loadHTMLFile('wo_for_parse.html');  
    	
		
		$documentElement = $dom->documentElement; 
	
		$wo_number = $dom->getElementById('wo_number');
		$po_number = $dom->getElementById('po_number');
		$scheduled_date = $dom->getElementById('scheduled_date');
		$customer = $dom->getElementById('customer');
		$trader = $dom->getElementById('trade');
		$nte = $dom->getElementById('nte');
		$location_name = $dom->getElementById('location_name');
		$location_address = $dom->getElementById('location_address');
		$store_id = $dom->getElementById('store_id');
		$location_phone = $dom->getElementById('location_phone');		
	
		$scheduled = $scheduled_date->textContent;
		//$scheduled = str_replace(' ', '', $scheduled);
		$scheduled = str_replace('"', '', $scheduled);
		$scheduled = str_replace('\r\n', '', $scheduled);
		$scheduled = str_replace('<br>', '', $scheduled);
		$scheduled = trim(preg_replace('/\s\s+/', ' ', $scheduled));
		$exscheduled=explode(' ', $scheduled);
		foreach($exscheduled as $key => $value){
   			$exscheduledplusone[$key+1] = $value;
		}
	
		$exscheduledplusone[0] = $exscheduledplusone[3];
		ksort($exscheduledplusone);
		
		unset($exscheduledplusone[3]);
		$scheduled_YMD = implode(" ",$exscheduledplusone);

		$customer = $customer->textContent;
		$customer = trim(preg_replace('/\s\s+/', ' ', $customer));

		$location_address = $location_address->textContent;
		$location_address = trim(preg_replace('/\s\s+/', ' ', $location_address));

		$exlocation_address=explode(' ', $location_address);
		$statekey=max(array_keys($exlocation_address))-1;
		$state=$exlocation_address[$statekey];
		$postalkey=max(array_keys($exlocation_address));
		$postalkey=$exlocation_address[$postalkey];	

		$nte=$nte->textContent;
		$nte = str_replace(',', '', $nte);
		$nte = str_replace('$', '', $nte);
		$floatnte = floatval($nte);
		
		 $fileName = 'csv.csv';
		
		        $headers = array(
		            "Content-type"        => "text/csv",
		            "Content-Disposition" => "attachment; filename=$fileName",
		            "Pragma"              => "no-cache",
		            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
		            "Expires"             => "0"
		        );

		        $columns = array('Tracking Number', 'PO Number', 'Scheduled', 'Customer', 'Trade', 'NTE ', 'Store ID', 'Address', 'City', 'State ', 'Postal code', 'Phone');
		        $data = array(array('Tracking Number', 'PO Number', 'Scheduled', 'Customer', 'Trade', 'NTE ', 'Store ID', 'Address', 'City', 'State ', 'Postal code', 'Phone'), array($wo_number->textContent, $po_number->textContent, $scheduled_YMD, $customer, $trader->textContent, $floatnte, $location_name->textContent, $location_address, $store_id->textContent, $state, $postalkey, $location_phone->textContent ));

				    $fp = fopen('csv.csv', 'w');

				    
				   
				    $rowData = array();

				    
				    foreach ($data as $row) {

				        foreach ($row as $item) {
				            $rowData[] = $item;

				        }
				        fputcsv($fp, array_values($rowData),  ';', ' ');
				        unset($rowData);
				    }




        return view('welcome', [
        
        ]); 
    }
}
