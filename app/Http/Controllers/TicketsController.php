<?php

namespace App\Http\Controllers;

class TicketsController extends Controller
{
    public function GetTickets(){
		$tickets = $this->ReadJSON();                                                                                                                      
		return view('ticket',compact('tickets'));
	}

	public function ReadJSON(){
		
	    $jsonString = file_get_contents(public_path('json/tickets.json'));
	    $data = json_decode($jsonString, true);
	    return $data;	
	}

	public function Priority(){
		$tickets = $this->ReadJson();
		$count = [];
		//SUBJECT
	    $reclameaqui  = 'reclameAqui';
		$procon      = 'procon';
		$reclamacao = 'Reclamação';
		$resposta = 'RE: ';
		//SENDER
		$customer = 'Customer';
		$expert = 'Expert';
		foreach($tickets as $key => $ticket){
			$interactions = $ticket['Interactions'];
			$datecreate = $ticket['DateCreate'];
			$dateupdate = $ticket['DateUpdate'];
			$count[$key] = 0;
			foreach($interactions as $keyInteractions => $interaction){
				$subject = $interaction['Subject'];
				$sender = $interaction['Sender'];
				if (strpos($sender, $customer) !== false) {
					$count[$key]+= 20;
				}
				if (strpos($sender, $expert) !== false) {
					$count[$key]-= 10;
				}
				if (strpos($subject, $resposta) !== false && strpos($sender, $customer) !== false) {
					$count[$key]+= 15;
				}
				if (strpos($subject, $resposta) !== false && strpos($sender, $expert) !== false) {
					$count[$key]-= 10;
				}
				if (strpos($subject, $reclamacao) !== false && strpos($sender, $customer) !== false){
					$count[$key]+= 35;
				}
				if (strpos($subject, $reclamacao) !== false && strpos($sender, $expert) !== false){
					$count[$key]-= 25;
				}
			}

	        $dateI = date_create($datecreate);
	        $dateF = date_create($dateupdate);
	        $diff = date_diff($dateI,$dateF); 
	        $dateDif = $diff->format("%a");	  
	       
	        if ($dateDif >= 30 && strpos($subject, $resposta) !== false) {
	        	$count[$key]+=20;
	        }
	
	     
			if($count[$key] >= 35){
				$ticketPriority = 'Alta';
				$string = file_get_contents(public_path('json/tickets.json'));
				$json = json_decode($string, true);
				$json[$key]["ticketPriority"][] = $ticketPriority;
				$fp = fopen(public_path('json/tickets.json'), 'w');
				fwrite($fp, json_encode($json));
				fclose($fp);					
		    } else{
		        $ticketPriority = 'Normal';
				$string = file_get_contents(public_path('json/tickets.json'));
				$json = json_decode($string, true);
				$json[$key]["ticketPriority"][] = $ticketPriority;
				$fp = fopen(public_path('json/tickets.json'), 'w');
				fwrite($fp, json_encode($json));
				fclose($fp);								
		    }
		}
	}
}
