<?php
include './header.php';
include '../config.php';
session_start();

if (isset($_GET['correctCode'])) {
    $correctCode = $_GET['correctCode'];
    $query_update = "UPDATE create_qr_attendance SET expired = 1 WHERE qr_code = '$correctCode'"; 
    $result_update = mysqli_query($conn, $query_update);

    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        date_default_timezone_set('Asia/Colombo'); // Set the time zone to Asia/Colombo
        $filter_year = date('d F Y'); // Get the current day in the format "day Month Year"


        $query = "SELECT * FROM create_qr_attendance WHERE qr_code = '$correctCode'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $subject_code = $row['subject_code'];
            $subject_select = $row['subject_select'];
            $batch = $row['batch'];
            $batch_year = $row['batch_year'];
            $qr_date = $filter_year;
            $teacher_id = $row['teacher_id'];
            $currentTime = date('H:i:s');
?>
            <div class="main-container">
                <div class="pd-ltr-20">
                    <div class="card-box pd-20 height-100-p mb-30">
                        <div class="list_p1 mx-5 my-2">
                            <h5 class="my-4">Attend Details</h5>
                            <form action="./Attendance/db_fixed_attendance.php" method="post">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>Student ID : </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo isset($user_id) ? $user_id : ''; ?></p>
                                        <input type="hidden" name="user_id" value="<?php echo isset($user_id) ? $user_id : ''; ?>">
                                    </div>
                                </div>
                                <div class="list_p1">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p>Subject name : </p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><?php echo isset($subject_select) ? $subject_select : ''; ?></p>
                                            <input type="hidden" name="subject_select" value="<?php echo isset($subject_select) ? $subject_select : ''; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="list_p1">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p>Student Code : </p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><?php echo isset($subject_code) ? $subject_code : ''; ?></p>
                                            <input type="hidden" name="subject_code" value="<?php echo isset($subject_code) ? $subject_code : ''; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="list_p1">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p>Batch : </p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><?php echo isset($batch) ? $batch : ''; ?></p>
                                            <input type="hidden" name="batch" value="<?php echo isset($batch) ? $batch : ''; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="list_p1">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p>Qr Date : </p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><?php echo isset($qr_date) ? $qr_date : ''; ?></p>
                                            <input type="hidden" name="qr_date" value="<?php echo isset($qr_date) ? $qr_date : ''; ?>">
                                        </div>
                                        <input type="hidden" name="correctCode" value="<?php echo isset($correctCode) ? $correctCode : ''; ?>">
                                        <input type="hidden" name="teacher_id" value="<?php echo isset($teacher_id) ? $teacher_id : ''; ?>">
                                        <input type="hidden" name="currentTime" value="<?php echo isset($currentTime) ? $currentTime : ''; ?>">
                                    </div>
                                </div>
                                <div class="submit-btn-list mx-5 my-3">
                                    <button type="submit" name="attend_on" class="btn btn-outline-primary btn-lg-outline btn-block">
                                        Attend On
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
<?php
        } else {
            echo "<p>No data found for QR code: $correctCode</p>";
        }
    }
} else {
    echo "<p>No QR code provided</p>";
}
include './footer.php';
?>
