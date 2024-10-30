<?php
include '../config.php';

if (isset($_POST['submit'])) {
    // Get user inputs and sanitize them
    $name = test_input($_POST['name']);
    $userid = test_input($_POST['userid']);
    $email = test_input($_POST['email']);
    $password = test_input($_POST['password']);
    $year =test_input($_POST['year']);
    $batch =test_input($_POST['batch']);
    
    $course =test_input($_POST['degree']);
    $course_code =test_input($_POST['degree_code']);
    $telephone = test_input($_POST['telephone']);
    $role = test_input($_POST['role']);

    $token = bin2hex(random_bytes(16));
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Common SQL statement for inserting into 'users' table
    $sql_users = "INSERT INTO users (user_id, name, email, password, telephone, token, role) 
                  VALUES (?, ?, ?, ?, ?, ?, ?)";

    // SQL statement for inserting into 'student' table
    $sql_student = "INSERT INTO students (s_id, f_name, email, password, year, batch, course, course_id, CourseCo_d, tp_number, token) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // SQL statement for inserting into 'admin' table
    $sql_teachers = "INSERT INTO teachers (t_id, f_name, email, password, telephone, token) 
                 VALUES (?, ?, ?, ?, ?, ?)";


    $stmt_users = $conn->prepare($sql_users);

    if ($stmt_users) {
        $stmt_users->bind_param("sssssss", $userid, $name, $email, $hashed_password, $telephone, $token, $role);

        if ($stmt_users->execute()) {
            // Insert additional details based on the user role
            switch ($role) {
                case 1: // Student
                    $stmt_student = $conn->prepare($sql_student);
                    if ($stmt_student) {
                        // You need to provide a non-null value for 's_id'
                        $student_id = $userid; // You need to implement a function to generate a unique student ID
                        // Provide values for the student table
                        $stmt_student->bind_param("sssssssssss", $userid, $name, $email, $hashed_password, $year, $batch, $course, $course_code, $course_code, $telephone, $token);
                        $stmt_student->execute();
                        $stmt_student->close();
                    }
                    break;
                case 2: // Teacher
                        $stmt_teachers = $conn->prepare($sql_teachers);
                        if ($stmt_teachers) {
                            // You need to provide values for the teachers table
                            $student_id = $userid; 
                            $stmt_teachers->bind_param("ssssss", $userid, $name, $email, $hashed_password, $telephone, $token);
                            $stmt_teachers->execute();
                            $stmt_teachers->close();
                        }
                        break;
                // Add more cases if you have additional roles
            }

            // Redirect to user registration page
            header("Location:./user_reg.php");
        } else {
            echo "Error: " . $stmt_users->error;
        }

        $stmt_users->close();
    } else {
        echo "Error: " . $conn->error;
    }
}

// Close the database connection
$conn->close();

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = strtolower($data);
    return $data;
}
?>


