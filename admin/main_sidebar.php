<?php
$filename = basename($_SERVER['SCRIPT_FILENAME']);

?>



<div class="sidebar" id="sidebar">
  <div class="sidebar-inner slimscroll">
    <div id="sidebar-menu" class="sidebar-menu">
      <ul>
        <li class="<?php echo $filename === "dashboard.php" ?  "active" : ''; ?>">
          <a href="dashboard.php"><i data-feather="airplay"></i> <span>Dashboard</span></a>
        </li>

        <li class="<?php echo $filename === "hostels.php" || $filename === "add-hostel.php" || $filename === "edit-hostel.php" ? "active" : ''; ?>">
          <a href="hostels.php"><i data-feather="home"></i> <span>Hostels</span></a>
        </li>

        <li class="<?php echo $filename === "students.php" || $filename === "add-student.php" || $filename === "edit-studentsDetails.php"  ?  "active" : ''; ?>">
          <a href="students.php"><i data-feather="users"></i> <span>Students</span></a>
        </li>
        <li class="<?php echo $filename === "complaints.php" ?  "active" : ''; ?>">
          <a href="complaints.php"><i data-feather="file-text"></i> <span>Complaints</span></a>
        </li>
        <li class="<?php echo $filename === "contacts.php" ?  "active" : ''; ?>">
          <a href="contacts.php"><i data-feather="file"></i> <span>Contacts</span></a>
        </li>
        <li class="<?php echo $filename === "booking_inquiries.php" ?  "active" : ''; ?>">
          <a href="booking_inquiries.php"><i data-feather="message-square"></i> <span>Booking Inquiries</span></a>
        </li>
        <li class="<?php echo $filename === "slider.php" ?  "active" : ''; ?>">
          <a href="slider.php"><i data-feather="user"></i> <span>Slider</span></a>
        </li>
        <li class="<?php echo $filename === "about-us.php" ?  "active" : ''; ?>">
          <a href="about-us.php"><i data-feather="user"></i> <span>AboutUs </span></a>
        </li>
      </ul>
    </div>
  </div>
</div>