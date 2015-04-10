<!DOCTYPE html>
<html>
	<body>
		<?php
		define("VISITOR_COUNT_FILE", "CounterNumber.txt");
		define("IP_LOG_FILE", "LoggedIPS.txt");
		$current = $_SERVER["REMOTE_ADDR"];
		$visitorNumber = file_get_contents(VISITOR_COUNT_FILE);
		$previous = file_get_contents(IP_LOG_FILE);
		$readablePrevious = unserialize($previous);
		
		
		//For debugging, must be run once if CounterNumber.txt or LoggedIPS.txt is empty.
		
		/*
		if(!is_array($readablePrevious)){
			$readablePrevious = [];
		}
		if(!is_numeric($visitorNumber)) {
			$visitorNumber = 0;
		}
		*/

		if (!file_exists(VISITOR_COUNT_FILE) || !file_exists(IP_LOG_FILE)){
			return "error code 404, file not found.";
		}

		if(in_array($current, $readablePrevious)){
			echo "Welcome back $current! ";
		} elseif (!in_array($current, $readablePrevious)){
			array_push($readablePrevious, $current);
			$serCurrent = serialize($readablePrevious);
			file_put_contents(IP_LOG_FILE, $serCurrent);

			$visitorNumber++;
			file_put_contents(VISITOR_COUNT_FILE, $visitorNumber);

			echo "Hello $current! ";
		}

		echo "You are visitor number $visitorNumber!";
		?>
	</body>
</html>