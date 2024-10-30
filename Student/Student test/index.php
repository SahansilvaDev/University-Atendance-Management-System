<?php include './header.php'; ?>

<main class="ps-3">
    <div class="head-title">
        <div class="left">
            <h3>Welcome</h3>
            <ul class="breadcrumb">
                <li>
                    <a href="#">Dashboard</a>
                </li>
                <li><i class='bx bx-chevron-right menu_bar'></i></li>
                <li>
                    <a class="active" href="#">Home</a>
                </li>
            </ul>
        </div>
        <a href="#" class="btn-download">
            <i class='bx bxs-cloud-download '></i>
            <span class="text">Download PDF</span>
        </a>
    </div>

    <div class="main_section ms-2">
        <div class="atendace">
            <div class="row">
                <div class="col-sm-12 mx-2">
                    <div class="card">
                        <div class="card-header">
                            <h1>Mark Your Attendance</h1>
                        </div>
                        
                        <div class="card-body p-0 m-0 atd_crd_body" >
                            <div class="container mb-5">
                                <div class="row justify-content-center mt-5">
                                    <div class="col-auto">
                                    <form action="" method="post">
                                        <div class="pin-container">
                                           
                                                <p class="me-5">Enter your code</p>
                                                <input type="text" class="pin-input form-control ms-5" maxlength="1" pattern="\d" inputmode="numeric" required aria-label="Digit 1">
                                                <input type="text" class="pin-input form-control" maxlength="1" pattern="\d" inputmode="numeric" required aria-label="Digit 2">
                                                <input type="text" class="pin-input form-control" maxlength="1" pattern="\d" inputmode="numeric" required aria-label="Digit 3">
                                                <input type="text" class="pin-input form-control me-5" maxlength="1" pattern="\d" inputmode="numeric" required aria-label="Digit 4">
                                                
                                                <button type="submit"  class="btn btn-success ms-5 ">Success</button>
                                            
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="atd_img">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include './footer.php'; ?>
