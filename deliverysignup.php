<?php
// session_start();
// $connection=mysqli_connect("localhost:3307","root","");
// $db=mysqli_select_db($connection,'demo');
include '../connection.php';
$msg=0;
if(isset($_POST['sign']))
{

    $username=$_POST['username'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $location=$_POST['district'];

    // $location=$_POST['district'];

    $pass=password_hash($password,PASSWORD_DEFAULT);
    $sql="select * from delivery_persons where email='$email'" ;
    $result= mysqli_query($connection, $sql);
    $num=mysqli_num_rows($result);
    if($num==1){
        // echo "<h1> already account is created </h1>";
        // echo '<script type="text/javascript">alert("already Account is created")</script>';
        echo "<h1><center>Account already exists</center></h1>";
    }
    else{
    
    $query="insert into delivery_persons(name,email,password,city) values('$username','$email','$pass','$location')";
    $query_run= mysqli_query($connection, $query);
    if($query_run)
    {
        // $_SESSION['email']=$email;
        // $_SESSION['name']=$row['name'];
        // $_SESSION['gender']=$row['gender'];
       
        header("location:delivery.php");
        // echo "<h1><center>Account does not exists </center></h1>";
        //  echo '<script type="text/javascript">alert("Account created successfully")</script>'; -->
    }
    else{
        echo '<script type="text/javascript">alert("data not saved")</script>';
        
    }
}


   
}
?>





<!DOCTYPE html>
<html lang="en">


  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Animated Login Form | CodingNepal</title>
    <link rel="stylesheet" href="deliverycss.css">
  </head>
  <body>
    <div class="center">
      <h1>Register</h1>
      <form method="post" action=" ">
        <div class="txt_field">
          <input type="text" name="username" required/>
          <span></span>
          <label>Username</label>
        </div>
        <div class="txt_field">
          <input type="password" name="password" required/>
          <span></span>
          <label>Password</label>
        </div>
        <div class="txt_field">
            <input type="email" name="email" required/>
            <span></span>
            <label>Email</label>
          </div>
          <div class="input-field">
                        <!-- <label for="district">Location:</label> -->
                        <!-- <br> -->
                        <select id="district" name="district" style="padding:10px; padding-left: 20px;">

  <option value="chattogram">Chattogram</option>
  <option value="dhaka">Dhaka</option>
  <option value="Noakhali">Noakhali</option>
  <option value="Faridpur">Faridpur</option>
  <option value="Gazipur">Gazipur</option>
  <option value="Gopalganj">Gopalganj</option>
  <option value="Khulna">Khulna</option>
  <option value="Rajshahi">Rajshahi</option>
  <option value="Barishal">Barishal</option>
  <option value="Sylhet">Sylhet</option>
  <option value="Rangpur">Rangpur</option>
  <option value="Mymensingh">Mymensingh</option>
  <option value="Kishoreganj">Kishoreganj</option>
  <option value="Madaripur">Madaripur</option>
  <option value="Manikganj">Manikganj</option>
  <option value="Munshiganj">Munshiganj</option>
  <option value="Narayanganj">Narayanganj</option>
  <option value="Narsingdi">Narsingdi</option>
  <option value="Netrokona">Netrokona</option>
  <option value="Rajbari">Rajbari</option>
  <option value="Shariatpur">Shariatpur</option>
  <option value="Sherpur">Sherpur</option>
  <option value="Tangail">Tangail</option>
  <option value="Bogra">Bogra</option>
  <option value="Joypurhat">Joypurhat</option>
  <option value="Naogaon">Naogaon</option>
  <option value="Natore">Natore</option>
  <option value="Nawabganj">Nawabganj</option>
  <option value="Pabna">Pabna</option>
  <option value="Sirajgonj">Sirajgonj</option>
  <option value="Dinajpur">Dinajpur</option>
  <option value="Gaibandha">Gaibandha</option>
  <option value="Cox's Bazar">Cox's Bazar</option>
  <option value="Kurigram">Kurigram</option>
  <option value="Lalmonirhat">Lalmonirhat</option>
  <option value="Nilphamari">Nilphamari</option>
  <option value="Panchagarh">Panchagarh</option> 
  <option value="Thakurgaon">Thakurgaon</option>
  <option value="Barguna">Barguna</option>
  <option value="Bhola">Bhola</option>
  <option value="Jhalokati">Jhalokati</option>
  <option value="Patuakhali">Patuakhali</option>
  <option value="Pirojpur">Pirojpur</option>
  <option value="Bandarban">Bandarban</option>
  <option value="Brahmanbaria">Brahmanbaria</option>
  <option value="Chandpur">Chandpur</option>
  <option value="Cumilla">Cumilla</option>
  <option value="Feni">Feni</option>
  <option value="Khagrachari">Khagrachari</option>
  <option value="Lakshmipur">Lakshmipur</option>
  <option value="Rangamati ">Rangamati </option>
  <option value="Habiganj">Habiganj</option>
  <option value="Maulvibazar ">Maulvibazar </option>
  <option value="Sunamganj">Sunamganj</option>
  <option value="Bagerhat">Bagerhat</option>
  <option value="Chuadanga">Chuadanga</option>
  <option value="Jessore">Jessore</option>
  <option value="Jhenaidah">Jhenaidah</option>
  <option value="Kushtia">Kushtia</option>
  <option value="Magura">Magura</option>
  <option value="Meherpur">Meherpur</option>
  <option value="Narail">Narail </option>
  <option value="Satkhira">Satkhira</option>
  <option value="Jamalpur">Jamalpur</option>


 </select> 
                        
          </div>
          <br>
        <!-- <div class="pass">Forgot Password?</div> -->
        <input type="submit" name="sign" value="Register">
        <div class="signup_link">
          Alredy a member? <a href="deliverylogin.php">Sigin</a>
        </div>
      </form>
    </div>

</body>
</html>
