<?php
include '../config.php';

session_start();

// Check if user is logged in as admin
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Use prepared statement for better security
    $a_sql = "SELECT * FROM admin WHERE user_id = ?";
    $stmt_a = $conn->prepare($a_sql);
    $stmt_a->bind_param("i", $user_id); // Assuming user_id is an integer
    $stmt_a->execute();
    $result_a = $stmt_a->get_result();

    if ($result_a->num_rows > 0) {
        // Admin is logged in, proceed with other operations

        // Use prepared statements for select queries
        $sql = "SELECT * FROM faculty";
        $result = $conn->query($sql);

        $sql1 = "SELECT * FROM faculty";
        $result1 = $conn->query($sql1);
    } else {
        // Redirect or show error message if user is not an admin
        echo "You are not authorized to access this page.";
        exit(); // Stop further execution
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming $conn is your database connection
    // Validate and sanitize input
    $degree_code = htmlspecialchars($_POST['degree_code']);
    $degree_name = htmlspecialchars($_POST['degree_name']);
    $module_code = htmlspecialchars($_POST['module_code']);
    $module_name = htmlspecialchars($_POST['module_name']);
    $faculty_code = htmlspecialchars($_POST['faculty_code']);
    $faculty_name = htmlspecialchars($_POST['faculty_name']);

    // Prepared statement to insert data
    $sql_i = "INSERT INTO degree_module (degree_code, degree_name, module_code, module_name, faculty_code, faculty_name) 
            VALUES (?, ?, ?, ?, ?, ?)";
    // Prepare statement
    $stmt = $conn->prepare($sql_i);
    if ($stmt === false) {
        echo "Error preparing statement: <br>" . $conn->error;
    } else {
        // Bind parameters to the prepared statement as strings ('s') or integers ('i')
        $stmt->bind_param("ssssss", $degree_code, $degree_name, $module_code, $module_name, $faculty_code, $faculty_name);
        // Execute the prepared statement
        if ($stmt->execute()) {
            // Redirect after successful insertion
            header("Location: ./create_degree_module.php");
            exit();
        } else {
            // Show error message if insertion fails
            echo "Error: " . $stmt->error;
        }
        // Close statement
        $stmt->close();
    }
} 
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../Student/vendors/styles/core.css" />
    <link rel="stylesheet" type="text/css" href="../Student/vendors/styles/icon-font.min.css" />
    <link rel="stylesheet" type="text/css" href="../Student/src/plugins/datatables/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css" href="../Student/src/plugins/datatables/css/responsive.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css" href="../Student/vendors/styles/style.css" />
    <link rel="stylesheet" href="style.css">
</head>

<body>

<body>
    <div class="container my-5">
        <h2 class="my-3">Create Degree Module</h2>
        <form action="" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="">Degree Code</label><br>
                <input class="form-control" placeholder="Degree Code" type="text" name="degree_code" />
            </div>

            <div class="form-group">
                <label for="">Degree Name</label><br>
                <input class="form-control" placeholder="Degree Name" type="text" name="degree_name" />
            </div>

            <div class="form-group">
                <label for="">Module Code</label><br>
                <input class="form-control" placeholder="Module Code" type="text" name="module_code" />
            </div>

            <div class="form-group">
                <label for="">Module Name</label><br>
                <input class="form-control" placeholder="Module Name" type="text" name="module_name" />
            </div>

            <div class="form-group">
                <label for="">Faculty Code</label><br>
                <select class="selectpicker form-control" data-style="btn-outline-primary" name="faculty_code">
                    <optgroup label="Faculty Codes" data-max-options="2">
                        <?php
                        if ($result && $result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $faculty_id = $row['id'];
                                $faculty_name = $row['faculty_name'];
                                $faculty_code = $row['faculty_code'];

                                echo "<option value='$faculty_code'>$faculty_code - $faculty_name</option>";
                            }
                        } else {
                            echo "<option value=''>No faculties available</option>";
                        }
                        ?>
                    </optgroup>
                </select>
            </div>

            <div class="form-group">
                <label for="">Faculty Name</label><br>
                <select class="selectpicker form-control" data-style="btn-outline-primary" name="faculty_name">
                    <optgroup label="Faculty Names" data-max-options="2">
                        <?php
                        if ($result1 && $result1->num_rows > 0) {
                            while ($row = $result1->fetch_assoc()) {
                                $faculty_id = $row['id'];
                                $faculty_name = $row['faculty_name'];
                                $faculty_code = $row['faculty_code'];

                                echo "<option value='$faculty_name'>$faculty_code - $faculty_name</option>";
                            }
                        } else {
                            echo "<option value=''>No faculties available</option>";
                        }
                        ?>
                    </optgroup>
                </select>
            </div>

            <button type="submit" class="btn mb-20 btn-primary btn-block" name="submit">Submit</button>
        </form>
    </div>
    <!-- Include your script tags here -->
    <!-- js -->
    <script src="../Student/vendors/scripts/core.js"></script>
    <script src="../Student/vendors/scripts/script.min.js"></script>
    <script src="../Student/vendors/scripts/process.js"></script>
    <script src="../Student/vendors/scripts/layout-settings.js"></script>
    <script src="../Student/src/plugins/apexcharts/apexcharts.min.js"></script>
    <script src="../Student/src/plugins/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../Student/src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
    <script src="../Student/src/plugins/datatables/js/dataTables.responsive.min.js"></script>
    <script src="../Student/src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
    <script src="../Student/vendors/scripts/dashboard3.js"></script>

    <script src="sweetalert2.all.js"></script>
    <script src="sweet-alert.init.js"></script>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0" style="display: none; visibility: hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
</body>

</html>