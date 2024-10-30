<?php include './header.php'; ?>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>




<div class="main-container">

    <div class="pd-20 card-box mb-30">
        <div class="clearfix">
            <div class="pull-left">
                <h4 class="text-blue h4">Users Registrtion</h4>
                <p class="mb-30"></p>
            </div>

        </div>


        <form action="./user_reg_form.php" method="post">
            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">User Role</label>
                <div class="col-sm-12 col-md-10">
                    <select class="custom-select col-12" name="role" id="userRole"  id="userRole1" id="userRole2">
                        <option selected="">Choose...</option>
                        <option value="1">Student</option>
                        <option value="2">Teacher</option>
                        <option value="3">Admin</option>
                    </select>
                </div>
            </div>

            <div class="form-group row" id="batchField">
                <label class="col-sm-12 col-md-2 col-form-label">Batch</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" name="year" type="text" placeholder="<?php echo date('Y'); ?> 8A" />
                </div>
            </div>

            <div class="form-group row" id="batchField">
                <label class="col-sm-12 col-md-2 col-form-label">Batch</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" name="batch" type="text" placeholder=" 8A" />
                </div>
            </div>

            <div class="form-group row" id="batchField2">
                <label class="col-sm-12 col-md-2 col-form-label">Course  code</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" name="degree" type="text" placeholder="data science" />
                </div>
            </div>

            <div class="form-group row" id="batchField1">
                <label class="col-sm-12 col-md-2 col-form-label">Course Programme</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" name="degree_code" type="text" placeholder="ds" />
                </div>
            </div>


            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Full Name</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" name="name" type="text" placeholder="Full Name" />
                </div>
            </div>
            
            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">User ID</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" name="userid" placeholder="User ID" type="search" />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Email</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" name="email" placeholder="abc@example.com" type="email" />
                </div>
            </div>



            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Password</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" name="password" placeholder="password" type="password" />
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Telephone</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" name="telephone" placeholder="+94 123456789" type="tel" />
                </div>
            </div>






            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>





    </div>
</div>
</div>


</div>

<script>
    // Wait for the document to be ready
    $(document).ready(function() {
        // Initially hide the batch field
        $('#batchField').hide();

        // Add change event listener to the user role dropdown
        $('#userRole').change(function() {
            // Get the selected value
            var selectedRole = $(this).val();

            // Check the selected role and show/hide the batch field accordingly
            if (selectedRole == '1') { // Student
                $('#batchField').show();
            } else {
                $('#batchField').hide();
            }
        });
    });


    $(document).ready(function() {
        // Initially hide the batch field
        $('#batchField1').hide();

        // Add change event listener to the user role dropdown
        $('#userRole').change(function() {
            // Get the selected value
            var selectedRole = $(this).val();

            // Check the selected role and show/hide the batch field accordingly
            if (selectedRole == '1') { // Student
                $('#batchField1').show();
            } else {
                $('#batchField1').hide();
            }
        });
    });

    $(document).ready(function() {
        // Initially hide the batch field
        $('#batchField2').hide();

        // Add change event listener to the user role dropdown
        $('#userRole').change(function() {
            // Get the selected value
            var selectedRole = $(this).val();

            // Check the selected role and show/hide the batch field accordingly
            if (selectedRole == '1') { // Student
                $('#batchField2').show();
            } else {
                $('#batchField2').hide();
            }
        });
    });
</script>

<?php include './footer.php'; ?>