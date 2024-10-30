<?php

include '../../../../config.php';

session_start();

if ($_SESSION($_POST['user_id'])){
  $user_id = $_SESSION($_POST['user_id']);

  $sql = "SELECT * FROM staff WHERE st_id = '$user_id' ";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {  
    $row = $result->fetch_assoc(); 
  
    $_SESSION['email'] = $row['email'];
    $_SESSION['s_name'] = $row['s_name'];
    $_SESSION['st_id'] = $row['st_id'];

    header("Location:../index.php");
  }
}







?>









<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<script src='../dist/index.global.js'></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.0/main.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.0/main.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- <script src="../../calender-setting.js"></script>
<script src="../../fullcalendar.min.js"></script>
<link rel="stylesheet" href="../../fullcalendar.css"> -->
<script>

  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
      },
      initialDate: '2023-01-12',
      navLinks: true,
      nowIndicator: true,
      weekNumbers: true,
      weekNumberCalculation: 'ISO',
      editable: true,
      selectable: true,
      dayMaxEvents: true,
      events: [
        {
          title: 'All Day Event',
          start: '2023-01-01'
        },
        {
          title: 'Long Event',
          start: '2023-01-07',
          end: '2023-01-10'
        },
        {
          groupId: 999,
          title: 'Repeating Event',
          start: '2023-01-09T16:00:00'
        },
        {
          groupId: 999,
          title: 'Repeating Event',
          start: '2023-01-16T16:00:00'
        },
        {
          title: 'Conference ',
          url: 'http://google.com/',
          start: '2023-01-11',
          end: '2023-01-13'
        },
        {
          title: 'Conference lorem ipsum dolor sit amet,lorem ipsum lorem ipsum lore mauris vel lore mauris vel lorem sed diam non pro pos reprehenderit <br> in voluptate velit esse cillum dolore mag nisl vel felis lore mauris',
          start: '2024-03-24',
          end: '2024-03-24'
        },
        {
          title: 'Meeting',
          start: '2023-01-12T10:30:00',
          end: '2023-01-12T12:30:00'
        },
        {
          title: 'Lunch',
          start: '2023-01-12T12:00:00'
        },
        {
          title: 'Meeting',
          start: '2023-01-12T14:30:00'
        },
        {
          title: 'Happy Hour',
          start: '2023-01-12T17:30:00'
        },
        {
          title: 'Dinner',
          start: '2023-01-12T20:00:00'
        },
        {
          title: 'Birthday Party',
          start: '2023-01-13T07:00:00'
        },
        {
          title: 'Click for Google',
          url: 'http://google.com/',
          start: '2023-01-28'
        }
      ],

      eventClick: function(info) {
        // Display modal when an event is clicked
        showModal(info.event.title);
      }
    });

    calendar.render();

    // Function to display modal
    function showModal(title) {
      var modal = document.getElementById("myModal");
      var modalContent = document.getElementById("modalContent");
      var span = document.getElementsByClassName("close")[0];

      // Set title in modal content
      modalContent.innerHTML = title;

      // Display modal
      modal.style.display = "block";

      // Close modal when the close button or outside modal area is clicked
      span.onclick = function() {
        modal.style.display = "none";
      }

      window.onclick = function(event) {
        if (event.target == modal) {
          modal.style.display = "none";
        }
      }
    }
  });

</script>
<style>

  body {
    margin: 40px 10px;
    padding: 0;
    font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
    font-size: 14px;
  }

  #calendar {
    max-width: 1100px;
    margin: 0 auto;
  }

  
/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
}

/* The Close Button */
.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
 
  margin-top: -15px;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}

</style>
</head>
<body>

  <div id='calendar'></div>

  <!-- The Modal -->
  <div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
      <span class="close">&times;</span>
      <div id="modalContent"></div>
    </div>

  </div>















</body>
</html>
