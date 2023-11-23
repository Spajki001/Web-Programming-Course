<?php
    // Cleaning the text file to initial state to avoid making the file bigger and bigger
    $filename = 'TextZad2.txt';
    // Read the contents of the file
    $fileContents = file($filename);
    // Keep the first line
    $firstLine = array_shift($fileContents);
    // Truncate the file
    $file = fopen($filename, 'w');
    if ($file) {
        fwrite($file, $firstLine);
        fclose($file);
    }

    // Open the text file as read/write with pointer at the end of the file
    $myfile = fopen($filename, "a+") or die("Unable to open file!");
    // Read the text file
    $str_text = fread($myfile,filesize($filename));
    // Split the text into array of words
    $cut_text = explode(" ", $str_text);
    // Write the text file
    fwrite($myfile, "\n");
    // Write each word from array into text file (1 word per line)
    foreach ($cut_text as $value){
        fwrite($myfile, $value . "\n");
    }
    // Find first appearance of 'k' and total appearance of 'k'
    $first_appear = strpos($str_text, "k");
    $total_appear = substr_count($str_text, "k");
    // Print the results
    echo("First appearance of 'k' is on position $first_appear and total appearance is $total_appear times.<br>");
    // Close the text file
    fclose($myfile);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task 2</title>
</head>
    <body>
        <h1><script>$str_text</script></h1>
    </body>
</html>