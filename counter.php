<!DOCTYPE html>
<html>
	<body>
		<?php
		define("Cnt_num", "CounterNumber.txt");
		define("LIPS", "LoggedIPS.txt");
		$current = "1.1.1.4";//$_SERVER["REMOTE_ADDR"];
		$visitorNumber = file_get_contents(Cnt_num);
		$previous = file_get_contents(LIPS);
		$readablePrevious = unserialize($previous);
		
		if(is_array($readablePrevious)){
			echo "";
		} else {
			$readablePrevious=[];
		}

		if(!is_numeric($visitorNumber)) {
			$visitorNumber = 1;
		 }

		if (!file_exists(Cnt_num) || !file_exists(LIPS)){
			return "error code 404, file not found.";
		}

		if(in_array($current, $readablePrevious)){
			echo "Welcome back $current! ";
		} elseif (!in_array($current, $readablePrevious)){
			array_push($readablePrevious, $current);
			$serCurrent = serialize($readablePrevious);
			file_put_contents(LIPS, $serCurrent);

			$visitorNumber++;
			file_put_contents(Cnt_num, $visitorNumber);

			echo ("Hello $current! ");
		}

		echo ("You are visitor number $visitorNumber!");
		?>
	</body>
</html>