<?php
// create array without using array() function
$arr = ["a", "b", "c",10, 20, 30];
var_dump($arr); 
echo "<br>";

// crrate array using array() function
$cars = array("Volvo", "BMW", "Toyota"); 
$bikes = ["Yamaha", "Honda", "Suzuki"];

// add a new element to the end of the array using array_push function 
array_push( $cars,"honda" ,"ford");

// add a new element to the begining of the array using array-unshift function
array_unshift( $cars,"audi"); 

// merge two array in a single array using array_merge function
 $full_cars = array_merge($cars, $bikes); // merge two arrays



$numbers= [100, 2, 13, 4, 51, 6, 17, 8, 9, 10];
sort($numbers); // sort the array in ascending order
echo "<br>";
// print the sorted numbers
foreach ($numbers as $number) {
    echo $number , " | ";   
}
echo "<br>";
// print the array using for eac loop 
foreach ($full_cars as $car) {
    echo $car ."|";
 }


//   cerate associative array
$age = array("Peter"=>"35", "Ben"=>"37", "Joe"=>"43");


echo "<br>";
foreach( $age as $name => $value) {
    echo "$name is $value years old.<br>";
}


// create a message printing fuction
function Printmessage($name){
    echo "hello" .$name;
}
echo "<br>";
Printmessage("suraj");

echo "<br>";
echo "<br>";
// loop through the numbers from 1 to 10 and print the square of each number
for ($i = 1; $i <= 10; $i++) {
    echo "The square of $i is " . ($i * $i) . "<br>";
}
echo "<br>";
// for ($a = 1; $a <=10; $a++) {
//    echo "2 X $a = " . (2 * $a) . "<br>";
// }

function table($num){
    for ($a =1 ; $a <= 10; $a++){
        echo "$num X $a = ".$num * $a . "<br>";  }
}

table(5);

// table(7);
echo "<br>";
// while loop
$a = 1;
while($a <= 5){
    echo "The value of a is: $a <br>";
    $a++;
}


// do while loop
echo "<br>";
$b = 1;
do {
    echo "the value of b is :$b <br>";
    $b++;
}while($b <= 5);


// mutidimentional array
$students = array(
    array("name" => "John", "age" => 20, "grade" => "A"),
    array("name" => "suraj", "age" => 22, "grade" => "B"),
    array("name" => "Doe", "age" => 21, "grade" => "C")
);
echo "<br>";


foreach($students as $student){
    echo "Name: " . $student["name"] . ", Age: " . $student["age"] . ", Grade: " . $student["grade"] . "<br>";
}
echo "<br>";

echo "<br>";

for($i = 0;$i < count($students); $i++){
    echo "Name: " . $students[$i]["name"] . ", Age: " . $students[$i]["age"] . ", Grade: " . $students[$i]["grade"] . "<br>";
}
echo "<br>";

// string length strlen() function
$name = "Suraj";
echo strlen($name);
echo "<br>";
echo "<br>";
// strtoupper() function
echo strtoupper($name);
echo "<br>";
echo "<br>";

// reverse a string using strrev() function
echo strrev("Hello");
echo "<br>";
// uppercase first character of a string using ucfirst() function
echo ucwords("hello world");
echo "<br>";

// strtolower() function
echo strtolower($name);
echo "<br>";
echo "<br>";
// str_replace() function
echo str_replace("a", "o", $name);
echo "<br>";
echo "<br>";
// substr() function
echo substr($name, 0, 3);
echo "<br>";
echo "<br>";
// explode() function
$sentence = "Hello World";
$words = explode(" ", $sentence);
print_r($words);
// implode() function

$alphabet = ["a", "b", "c", "d", "e"];
$joined = implode("-", $alphabet);
echo "<br>";
echo "<br>";
echo $joined;
// date function
echo "<br>";
echo date("d-m-Y");
echo "<br>";
echo "<br>";

// isset() function
$var = "Hello";
if(isset($care)){
    echo "Variable is set.";
} else {
    echo "Variable is not set.";
}
echo "<br>";
echo "<br>";
// empty() function
$var2 = "    rgtferg   ";
if(empty($var2)){
    echo "Variable is empty.";
} else {
    echo "Variable is not empty.";
}

// remove white space from the beginning and end of a string using trim() function
echo trim($var2);
echo "<br>";
echo "<br>";

//  md5() function
$password = "mysecretpassword";
$hashed_password = md5($password);
echo $hashed_password;
echo "<br>";
echo "<br>";

$value = "12.5";

// $num = (int)$naam; // type casting to integer
// var_dump($num);
$num = 500;
$naam = 1223.45;
$str = (string)$num;
$word =(string)$naam;
echo $str;

var_dump($num);
var_dump($str);

echo "<br>";
echo "<br>";
function myTest() {
  define("GREETING", "Welcome to W3Schools.com!");
}

myTest();

echo GREETING;

?>

<?php
session_start();
$message = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = $_POST["name"];
     
  if(!isset($_SESSION['carArray'])){
        $_SESSION['carArray'] = [];
    }
    if(isset($_POST['add_car'])){
        $carName = $_POST['car_name'];
        if(!empty($carName)){
             array_push($_SESSION['carArray'], $carName);
               $message = "Car added successfully!";
        } else {
              $message = " Car name empty hai!";
        }
    
    }


    if(isset($_POST['delete'])){
            if(!empty($_SESSION['carArray'])){
            array_pop($_SESSION['carArray']);
            $message = " Car deleted successfully!";
        } else {
            $message = " No cars to delete!";
        }
}

header("Location: " . $_SERVER['PHP_SELF']);
 exit();
}



?>

<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <!-- use both method to submit the form  -->
<!-- <form method="post" action="Learning.php"> -->
<style>
    input{
        background-color:yellow;
         padding: 5px;
         margin: 5px;
        height: 30px;
         border: 1px solid black;
    }
    </style>

  <label for="name">Name:</label>
  <input type="text"  name="name"> <input type="submit" value="Submit"><br><br>
  
  <input type="text" name="car_name" placeholder="Enter Car" required />
  <button type="submit" name="add_car">Add Car</button><br><br>
    <button type="submit" name="delete">Delete Car</button><br><br>
  <!-- <h3>Added Cars (<?php echo count($_SESSION['carArray']); ?>)</h3> -->
    <ul style="list-style-type: square; border: 1px solid black; padding: 10px; width: 200px; BACKGROUND-COLOR: lightyellow;">
        <?php
        if (empty($_SESSION['carArray'])) {
            echo "<li>No cars added yet.</li>";
        } else {
            foreach ($_SESSION['carArray'] as $index => $car) {
                echo "<li><strong>" . ($index + 1) . ".</strong> $car</li>";
            }
        }
        ?>
    </ul>

    <hr>
    <h4>Current Array:</h4>
    <h3><?php echo htmlspecialchars($message); ?></h3>
    <pre><?php
    $total = count($_SESSION['carArray']);
    echo "Total cars: $total\n";
?></pre>
  <br></br>
  <b style="color: blue; display:block;height: 20px; background-color: lightgray; font-size: 18px; padding: 10px; text-align: center;"> Welcome, <?php echo htmlspecialchars($name); ?>!</b>
 
</form>