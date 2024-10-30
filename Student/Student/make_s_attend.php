<?php  

include './header.php';



include './Attendance/st_at.php';


?>




<style>

#qr-card-w{
    border: 1px solid rgba(126, 126, 126, 0.301) !important;
}



.card-container {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-left: 20px;
 
  }

  .card1 {
    width: 40px;
    height: 40px;
    margin: 0 5px;
    border: 1px solid #ccc;
    border-radius: 5px;
    display: flex;
    justify-content: center;
    align-items: center;
    font-family: 'Arial', sans-serif;
    font-size: 18px;
    cursor: pointer;
    text-align: center;
    transition: background-color 0.3s;
    font-weight: 600;
  }

  .card1:hover{
    border: solid 2px #333;
    
  }

  .card1:focus {
    background-color: #C6D7FF; /* Green color */
  }


  /* atend_fing_img */

  .atend_fing_img,
  img , .sm_crd{
    background-position: center;
    display: flex;
    align-items: center;
    justify-content: center;
  }


  iframe:focus {
  outline: none;
}

iframe[seamless] {
  display: block;
}

</style>

<script src="./vendors/sweetalert2.all.js"></script>
    <script src="./vendors/sweet-alert.init.js"></script>

<?php  

include './footer.php';






?>