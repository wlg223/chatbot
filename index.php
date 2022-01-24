
<form name="form" action="" method="get">
Input: <input type="text" name="input" value="<?php echo $input;?>">
</form>

<?php

require '/Users/weslee_guarneri/Desktop/winterproject/piazza_folder/piazza_questions_server.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/* 
 if you're having issues with curl, specifically this one: Fatal error: Call to undefined function curl_init()
 run this line : phpinfo(); 
 search for curl, if there are no results then your PHP installation doesn't have curl enabled
*/

$input_utterance = $_GET['input'];

$witRoot = "https://api.wit.ai/message?";
$witVersion = '20200804';

echo "Post:" . "<br>" . "$input_utterance" . "<br>";
$witURL =  $witRoot. "v=". "&q=". urlencode($input_utterance);
// link should be : "https://api.wit.ai/message?v=20200804&q="


$ch = curl_init();
$header = array();
$header[] = 'Authorization: Bearer TUZ6J5B6ELG45E3KU3CHK4VYYKMSNVBU';

curl_setopt($ch, CURLOPT_URL, $witURL);
curl_setopt($ch, CURLOPT_HTTPHEADER,$header); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
// adding certificate, if you cannot locate cacert.pem within your MAMP folder, download it from the Google Drive
// change the path of the certificate to where it is on your local machine
// remember the syntax for the path changes whether your on a mac or windows machine, the below line is windows syntax
$certificate = "/Applications/MAMP/bin/php/php7.4.21/cacert.pem";
curl_setopt($ch, CURLOPT_CAINFO, $certificate);
curl_setopt($ch, CURLOPT_CAPATH, $certificate);

$server_output = curl_exec($ch); 

//if a curl error is thrown
if(curl_errno($ch)){
    echo 'Curl error: ' . curl_error($ch);
}

curl_close ($ch);  

echo "<br>";
echo "Response:";
$server_decoded_rsp = json_decode($server_output)->entities->{"issues:issues"};

$response = "";

//if default ports are changed with MAMP preferences, need to specify port number when connecting sql
for ($i = 0; $i < count($server_decoded_rsp); $i++){
	$keyword = $server_decoded_rsp[$i]->value;
	$con_db = mysqli_connect("localhost:8889", "root", "root", "hw2_witAI"); 
  	if (mysqli_connect_errno($con_db)) {
    	echo "Failed to connect  to MYSql:" . mysqli_connect_error();
  	}
  	$sql_command = "SELECT answer FROM response WHERE keyword = '{$keyword}'";
  	$result = mysqli_query($con_db, $sql_command);
  	$num_rows = mysqli_num_rows($result);
  	if ($num_rows > 0) {
    	$row = mysqli_fetch_array($result);
    	$answer = $row[0];
    	echo "<br>" . $answer;
  	} else {
    	echo "failed";
  	}
  	mysqli_close($con_db);
	
}


#echo($input_utterance);
$command = escapeshellcmd("/usr/local/bin/python3 /Users/weslee_guarneri/Desktop/winterproject/script.py $input_utterance");
//$output = shell_exec($command);
//echo gettype($output);

$myfile = fopen("data.json", "r") or die("Cannot access file.");
$data = json_decode(fread($myfile, filesize("data.json")));
fclose($myfile);

//$jsondata = file_get_contents($output);
//$data = json_decode($output, true);
//print_r($data);
//echo $data;
$table_name = "cse216";
$post_id = $data->id;
$post_problem = $data->problem;
$post_subject = $data->subject;
$post_error = $data->error;
$post_answer = $data->answer;
$post_pid = $data->pid;


$con_db = mysqli_connect("localhost", "root", "root", "piazza_questions"); 
	if(mysqli_connect_errno($con_db)) {
         echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }

createPost($table_name, $post_id, $post_problem, $post_subject, $post_error, $post_answer, $post_pid);





?>




