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
    echo $number . "<br>";
}
echo "<br>";
// print the array using for eac loop 
foreach ($full_cars as $car) {
    echo $car . "<br>";
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

echo "<br>";
?>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = $_POST["name"];

}
?>

<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <!-- use both method to submit the form  -->
<!-- <form method="post" action="Learning.php"> -->


  <label for="name">Name:</label>
  <input type="text"  name="name">
  <br></br>
  <b> Welcome, <?php echo $name; ?>!</b>
  <input type="submit" value="Submit">
</form>