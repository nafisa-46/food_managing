<?php
include("login.php"); 
if($_SESSION['name']==''){
	header("location: signin.php");
}

$emailid= $_SESSION['email'];
$connection=mysqli_connect("localhost","root","");
$db=mysqli_select_db($connection,'food_managing');
if(isset($_POST['submit']))
{
    $foodname=mysqli_real_escape_string($connection, $_POST['foodname']);
    $meal=mysqli_real_escape_string($connection, $_POST['meal']);
    $category=$_POST['image-choice'];
    $quantity=mysqli_real_escape_string($connection, $_POST['quantity']);
    
    $phoneno=mysqli_real_escape_string($connection, $_POST['phoneno']);
    $district=mysqli_real_escape_string($connection, $_POST['district']);
    $address=mysqli_real_escape_string($connection, $_POST['address']);
    $name=mysqli_real_escape_string($connection, $_POST['name']);
  

 



    $query="insert into food_donations(email,food,type,category,phoneno,location,address,name,quantity) values('$emailid','$foodname','$meal','$category','$phoneno','$district','$address','$name','$quantity')";
    $query_run= mysqli_query($connection, $query);
    if($query_run)
    {

        echo '<script type="text/javascript">alert("data saved")</script>';
        header("location:delivery.html");
    }
    else{
        echo '<script type="text/javascript">alert("data not saved")</script>';
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Donate</title>
    <link rel="stylesheet" href="loginstyle.css">
</head>
<body style="    background-color: #06C167;">
    <div class="container">
        <div class="regformf" >
    <form action="" method="post">
        <p class="logo">Food <b style="color: #06C167; ">Donate</b></p>
        
       <div class="input">
        <label for="foodname"  > Food Name:</label>
        <input type="text" id="foodname" name="foodname" required/>
        </div>
      
      
        <div class="radio">
        <label for="meal" >Meal type :</label> 
        <br><br>

        <input type="radio" name="meal" id="veg" value="veg" required/>
        <label for="veg" style="padding-right: 40px;">Veg</label>
        <input type="radio" name="meal" id="Non-veg" value="Non-veg" >
        <label for="Non-veg">Non-veg</label>
    
        </div>
        <br>
        <div class="input">
        <label for="food">Select the Category:</label>
        <br><br>
        <div class="image-radio-group">
            <input type="radio" id="raw-food" name="image-choice" value="raw-food">
            <label for="raw-food">
              <img src="img/raw-food.png" alt="raw-food" >
            </label>
            <input type="radio" id="cooked-food" name="image-choice" value="cooked-food"checked>
            <label for="cooked-food">
              <img src="img/cooked-food.png" alt="cooked-food" >
            </label>
            <input type="radio" id="packed-food" name="image-choice" value="packed-food">
            <label for="packed-food">
              <img src="img/packed-food.png" alt="packed-food" >
            </label>
          </div>
          <br>
        <!-- <input type="text" id="food" name="food"> -->
        </div>
        <div class="input">
        <label for="quantity">Quantity:(number of person /kg)</label>
        <input type="text" id="quantity" name="quantity" required/>
        </div>
       <b><p style="text-align: center;">Contact Details</p></b>
        <div class="input">
          <!-- <div>
      <label for="email">Email:</label>
      <input type="email" id="email" name="email">
          </div> -->
      <div>
      <label for="name">Name:</label>
      <input type="text" id="name" name="name"value="<?php echo"". $_SESSION['name'] ;?>" required/>
      </div>
      <div>
        <label for="phoneno" >PhoneNo:</label>
      <input type="text" id="phoneno" name="phoneno" maxlength="11" pattern="[0-9]{11}" required />
        
      </div>
      </div>
        <div class="input">
        <label for="location"></label>
        <label for="district">District:</label>
<select id="district" name="district" style="padding:10px;">
  <option value="Chattogram">Chattogram</option>
  <option value="Dhaka">Dhaka</option>
  <option value="Noakhali">Noakhali</option>
  <option value="Cox's Bazar">Cox's Bazar</option>
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

        <label for="address" style="padding-left: 10px;">Address:</label>
        <input type="text" id="address" name="address" required/><br>
        
      
       
       
        </div>
        <div class="btn">
            <button type="submit" name="submit"> submit</button>
     
        </div>
     </form>
     </div>
   </div>
     
    
</body>
</html>