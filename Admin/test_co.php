<?php

include '../config.php';









$query_student = "SELECT user_id, degree_programe, degree_code, batch, name
                  FROM student
                  WHERE degree_code IN (
                      SELECT DISTINCT degree_code
                      FROM student AS s1
                      WHERE NOT EXISTS (
                          SELECT 1
                          FROM student AS s2
                          WHERE s2.degree_programe = s1.degree_programe
                          AND s2.degree_code != s1.degree_code
                      )
                  )";

$result_student = mysqli_query($conn, $query_student);

$unique_degree_codes = array(); // Array to store unique degree codes

if (mysqli_num_rows($result_student) > 0) {
    while ($row = mysqli_fetch_assoc($result_student)) {
        $degree_code = $row['degree_code'];
        $degree_programe = $row['degree_programe'];

        // Check if the degree code for this degree program has already been shown
        if (!isset($unique_degree_codes[$degree_programe])) {
            // If not, display the degree program and degree code
            echo $degree_programe . "<br>";
            echo $degree_code . "<br>";
            
            // Add the degree code to the array to mark it as shown
            $unique_degree_codes[$degree_programe] = $degree_code;
        }
    }
}

?>