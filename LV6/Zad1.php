<?php
    // Create array with 5 elements
    $student = array('Mateo', 'Spajic', '0165092407', 'A/215478', '2023./2024.');
    // Print array
    foreach ($student as $value){
        echo "$value<br>";
    }
    // Create associative multidimensional array
    $car = array(
        'Citroen' => array(
            'car_type' => 'C4',
            'engine_displ' => '1600ccm',
            'colour' => 'red',
            'manuf_year' => 2020,
            'fuel_type' => 'petrol'
        ),
        'Mercedes' => array(
            'car_type' => 'E-Class',
            'engine_displ' => '2000ccm',
            'colour' => 'black',
            'manuf_year' => 2022,
            'fuel_type' => 'diesel'
        ),
    );
    // Print array with foreach loop
    echo('<br>Citroen data:<br>');
    foreach ($car['Citroen'] as $value){
        echo "$value <br>";
    }
    // Print array by calling each element
    echo('<br>Mercedes data:<br>');
    echo($car['Mercedes']['car_type']."<br>");
    echo($car['Mercedes']['engine_displ']."<br>");
    echo($car['Mercedes']['colour']."<br>");
    echo($car['Mercedes']['manuf_year']."<br>");
    echo($car['Mercedes']['fuel_type']."<br>");
    // Create function that returns square of a number
    function Squared($number){
        return $number * $number;
    }
    // Call function
    $number = 5;
    $num_squared = Squared($number);
    // Print result
    echo "<br>Square of $number is $num_squared.<br>";
?>