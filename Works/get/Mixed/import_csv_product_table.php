<?PHP

$csv = array();
// prepare a file called customers.csv with email, firstname, lastname
if( ($handle = fopen('exports.csv', "r")) !== FALSE) {
   $rowCounter = 0;
   while (($rowData = fgetcsv($handle, 0, ",")) !== FALSE) {
       if( 0 === $rowCounter) {
           $headerRecord = $rowData;
       } else {
           foreach( $rowData as $key => $value) {
               $csv[ $rowCounter - 1][ $headerRecord[ $key] ] = $value;  
           }
       }
       $rowCounter++;
   }
   fclose($handle);
}
$x = 0;

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "myDB";
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
	}

$i = 0;
foreach ($csv as $product) {
	$product_id = $product['product_id'];
    $i++;
	$sql = "INSERT INTO product (product_id)VALUES ('$product_id')";
    if ($conn->query($sql) === TRUE) {
		echo "New record created successfully => {$product_id}<br>";
	}
}
echo $i;
$conn->close();
?>