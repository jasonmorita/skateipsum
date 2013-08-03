<?php
/*
session_start();

if (!isset($_SESSION['dudesblood']))
{
	header("Location: /");
}
*/

$paragraphs = $_GET['paragraphs'];
$startWith = $_GET['startWith'];
$startText = 'Skate ipsum dolor sit amet, ';
$output = $_GET['output'];




function array_random($arr, $num = 1) {
    shuffle($arr);
    
    $r = array();
    for ($i = 0; $i < $num; $i++) {
        $r[] = $arr[$i];
    }
    return $num == 1 ? $r[0] : $r;
}


require_once($_SERVER['DOCUMENT_ROOT'].'/db.php');

try {
	$stmt = $db->prepare("select phrase from phrases where type = 'random' order by rand()");
	$stmt->execute();
	$randomResults = $stmt->fetchAll();
}
catch (Exception $e) {
	die($e->errorInfo[2]);
}

try {
	$stmt = $db->prepare("select phrase from phrases where type = 'properNoun' order by rand()");
	$stmt->execute();
	$properNounResults = $stmt->fetchAll();
}
catch (Exception $e) {
	die($e->errorInfo[2]);
}

		




$curParagraph = 1; 

for ($p = 1; $p <= $paragraphs; $p++)
{
	$sentences = rand(4,7);
	$words = rand(9,13);
	
	//echo "<p>";
	
	if ($output == "JSON")
	{
		if ($curParagraph == 1)
		{
			echo '[';
		}
		echo '"';
	}
	elseif ($output == "text")
	{
		echo "<p>";
	}
	elseif ($output == "HTML")
	{
		echo "<p>&lt;p&gt;";
	}
	
	
	if ($curParagraph == 1 && $startWith == 1)
	{
		echo $startText;
	}
	
	$curSentence=1;
	
	for ($s = 1; $s <= $words; $s++)
	{
	
		//build sentence out of randoms
		$sentence = array_random($randomResults, $sentences);
				
		//50-50 chance of adding a proper
		$getProper = rand(0,1);
		
		if ($getProper > 0)
		{
			$properNoun = array_random($properNounResults, $getProper);
			array_push($sentence, $properNoun);
			shuffle($sentence);
		}
		
		
		$sentenceCount = count($sentence);
		
		$wordCount = 1;
		
		$firstWord = 1;
		
		foreach ($sentence as $key => $row)
		{
			if ($firstWord == 1)
			{
				if ($curSentence == 1 && $startWith == 1)
				{
					echo " ".$row['phrase'];
					$startWith = 0;
				}
				else 
				{
					echo ucfirst($row['phrase']);
				}
			
				$firstWord = 0;
			}
			else
			{
					echo " ".$row['phrase'];
			}
						
			
			if ($wordCount == $sentenceCount)
			{
				echo ". ";
			}
			
			$wordCount++;
			
			
		}
				
		


		
		$curSentence++;
	}
	
	//echo "</p>";
	
	
	if ($output == "JSON")
	{
		
		if ($curParagraph < $paragraphs)
		{
			echo '",';
		}
		else
		{
			echo '"]';
		}
	}
	elseif ($output == "text")
	{
		echo "</p>";
	}
	elseif ($output == "HTML")
	{
		
		echo "&lt;/p&gt;</p>";
	}
	
	$curParagraph++;
	
}


try {
	$stmt = $db->prepare("insert into served (paragraphs, output, ip) values (?,?,?)");
	$stmt->execute(array($paragraphs,$output,$_SERVER['REMOTE_ADDR']));
}
catch (Exception $e) {
	die($e->errorInfo[2]);
}


?>