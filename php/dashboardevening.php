<?php
session_start();
if(!isset($_SESSION['usernamea'])){
    header("Refresh:0; url=index.php");
}
require 'connect.php';
$i=0;
$s="SELECT * FROM attendanceevening";
    $q=mysqli_query($conn,$s);
echo "<form method='POST' action='dashboardevening.php'>
<table class='rwd-table' align='center'>

  <thead>
  <input type='date' id='dob' name='dob'
               value='2018-01-22'
               min='2009-01-01' max='2090-12-31' / required>
    <tr>
      <th>Name</th>
      <th>CRN</th>
      <th>LECTURES ATTENDED</th>
      <th>TOTAL LECTURES</th>
      <th>PERCENTAGE</th>
      <th>Mark Attendance</th>
    </tr>
  </thead>
   <tbody>";
   if( mysqli_num_rows( $q )==0 ){
        echo '<tr><td colspan="4">No Rows Returned</td></tr>';
      }
      else{$i=0;
        while( $row = mysqli_fetch_assoc( $q ) ){
          if($row['TotalLectures']!=0)
          $P=(int)((($row['attendance']/$row['TotalLectures'])*100));
        else
          $P=0;
          echo "<tr><td data-th='Name'>{$row['name']}</td><td data-th='CRN'>{$row['crn']}</td><td data-th='LECTURES ATTENDED'>{$row['attendance']}</td><td data-th='TOTAL LECTURES'>{$row['TotalLectures']}</td><td data-th='PERCENTAGE'>{$P}</td><td data-th='Mark Attendance'><input type='radio' name='t_".$i."' value='absent'> Absent <input type='radio' name='t_".$i."' value='present' checked> Present</tr>\n";

          $i++;
        }
      }
      echo "</tbody></table>
      <button style='background-color: #34495E;
    border: none;margin:auto auto auto 10%;position:relative;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;' value='submit' name='submit' type='submit'>Mark Attendance</button></form>";
?>

<?php
if (isset($_POST['submit'])) {
    $date1 = $_POST['dob'];
    $u99="SELECT dates FROM daterecordevening WHERE dates='$date1'";
  $results = mysqli_query($conn,$u99);
if((mysqli_num_rows($results)>0)) {
  echo "<script language='javascript'>alert('Attendance of this date already exists')</script>";
}else{
  $i=0;

$z="ALTER TABLE recordevening ADD column `$date1` BOOLEAN NOT NULL";
$z1=mysqli_query($conn,$z);
$u98="INSERT INTO daterecordevening(dates)VALUES('".$date1."')";
$r5=mysqli_query($conn,$u98);
  $s="SELECT * FROM attendanceevening";
    $q=mysqli_query($conn,$s);
while( $row = mysqli_fetch_assoc( $q ) ){
  $e=$_POST['t_'.$i];
  $f = (int)($row['crn']);
if(isset($_POST['t_'.$i]))
{
if($e=='present'){
  $r3="UPDATE `recordevening` SET `$date1`=1 WHERE crn='$f'";
  $r4=mysqli_query($conn,$r3);
$l="UPDATE attendanceevening SET attendance=(attendance+1) WHERE crn='$f'";
$q7=mysqli_query($conn,$l);
}
}
$i++;
}
$l2='UPDATE attendanceevening SET TotalLectures=(TotalLectures+1) WHERE 1';
$q7=mysqli_query($conn,$l2);
 echo "<script language='javascript'>window.location.href = 'admin.php'</script>";
}
}
?>
<html><head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>

<link rel="shortcut icon" href="https://www.gndec.ac.in/sites/default/files/acquia_marina_favicon.png" type="image/x-icon" />
<title>ATTENDANCE | EVENING</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
   
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <style>
<?php include 'css/styled.css'; ?>
body
{
    background-color:#333;
}
</style>
</head><body><p></p><a style="text-decoration:none;color:white;" href="logout.php"><button style="background-color: #34495E;
    border: none;margin:auto auto auto 10%;position:relative;
    color: white;
    padding: 0 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;"><h2>Logout</h2></button></a>
<a style="text-decoration:none;color:white;" href="admin.php"><button style="background-color: #34495E;position:relative;
    border: none;
    color: white;
    padding: 0 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;"><h2>Back</h2></button></a><p>&nbsp</p></body>
</html>
