<?php
	$wsdl = "https://www.placementpartner.co.za/ws/clients/?wsdl"; 
	$username = 'parallel'; 
	$password = 'parallel'; 
	$client = new SoapClient($wsdl); 
	$session_id = $client->login($username, $password); 
	
	$regions_response = $client->getAdvertRegions($session_id); 
	foreach($regions_response as $region) 
	{ 
		$regions[$region->id] = $region->label;
	} 
	
	//this creates the array needed to populate the table
	$vacancies = $client->getAdverts($session_id); 
	foreach($vacancies as $vacancy)
	{
		$startDate = strtotime($vacancy->start_date);
		$week = date("W", $startDate);
		
		foreach($regions as $region)
		{
			if(!isset($weekVacancyResults["Week#${week}"][$region]))
			{
				$weekVacancyResults["Week#${week}"][$region] = 0;
			}
			if($region == $vacancy->region)
			{	
				++$weekVacancyResults["Week#${week}"][$region];
			}
		}
	}
	ksort($weekVacancyResults);
	
	//creates the categories array for use in the graph
	foreach($weekVacancyResults as $week => $regionAds)
	{
		$categoriesArray[] = "$week";
		foreach($regionAds as $region => $countForWeek)
		{
			$seriesRegions[$region][] = $countForWeek;
		}
	}
	$categories = join($categoriesArray, ',');
	
	//creates the series array for use in the graph
	foreach($seriesRegions as $name => $data)
	{
		$seriesArray[] = (object) ['name' => $name, 'data' => $data];
	}
?>