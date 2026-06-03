<?php
$filename = "newfile.txt";
$file = "test.txt";

$new = fopen($file, "a");
fwrite($new, "this is my new line ");
$open = fopen($file, "r");
echo fread($open, filesize($file));
fclose($new);



// // file create karne ke liye 
// if(!file_exists($filename)){

//     $file = fopen($filename, "w");

//     fwrite($file, "File Created Successfully");

//     fclose($file);

//     echo "File created";
//     }else{
//     echo "File already exists";
//     }


// file delete karne ke liye 
// $delete = unlink($filename);
// if($delete){
//     echo "File deleted successfully";   
//     }else{
//     echo "File not found";  
//     }
// if($file){
//     echo fread($file, filesize("test.txt"));
//     fclose($file);
// }else{
//     echo "File not found";
// }




// if(!file_exists($filename)){

//     $file = fopen($filename, "w");
//     fwrite($file, "File Created Successfully");
//     fclose($file);
//     echo "File created";
// }else{
//     echo "File already exists";
// }



// read file and also word count and character count
// echo readfile("newfile.txt");
// $file = fopen("test.txt", "r");
// $file = fopen("newfile.txt", "r");
// echo fread($file, filesize("newfile.txt"));
// fclose($file);



// the fgets() function is used to read a single line from a file. It reads characters from the file until it reaches the end of the line or the end of the file, whichever comes first. This function is particularly useful when you want to read a file line by line, as it allows you to process each line separately without loading the entire file into memory at once.
// $myfile  = fopen("test.txt", "r");
// echo fgets($myfile);
// fclose($myfile);


// $mainfile = fopen("test.txt", "a");
// fwrite($mainfile, "This is a new line added to the file.\n");
// $open = fopen("test.txt", "r");
// echo fread($open, filesize("test.txt"));
// fclose($open);


?>