<?php 
  
// Function to calculate the number of days between two dates
function daysBetweenDates($date1, $date2) {
    // Create DateTime objects for the given dates
    $datetime1 = date_create($date1);
    $datetime2 = date_create($date2);

    // Calculates the difference between DateTime objects 
    $interval = date_diff($datetime1, $datetime2);

    // Return the difference in days
    return $interval->days;
}

// Function to check if the number of days is odd or even
function oddOrEvenDays($days) {
    if ($days % 2 == 0) {
        return "Even";
    } else {
        return "Odd";
    }
}

// Example dates
$date1 = '2018-09-17';
$date2 = '2018-09-29';

// Calculate the number of days between the dates
$days = daysBetweenDates($date1, $date2);

// Display the result
//echo $interval->format('Difference between two dates: %R%a days');
echo "Difference between $date1 and $date2: $days days\n";
echo "<br>";
echo "Number of days between $date1 and $date2 is " . oddOrEvenDays($days) . "\n";
?>
