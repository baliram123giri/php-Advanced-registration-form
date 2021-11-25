<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regitrtion Systm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

</head>

<body>
    <?php
    // echo "Hello Baliram";
    // Check If The Registration Data is comming or not
    if(isset($_GET['registerSubmit'])){
      // echo"OK";
 
      //1. DB CONECTION OPEN
        $conn = mysqli_connect("localhost", "root", '',"flipkart_db");
            // always filter/ Sanatize the incomming data
        $name = mysqli_real_escape_string($conn,$_GET['name']);
        $uname = mysqli_real_escape_string($conn,$_GET['uname']);
        $email = mysqli_real_escape_string($conn,$_GET['email']);
        $pass = mysqli_real_escape_string($conn,$_GET['pass']);
        $cpass = mysqli_real_escape_string($conn,$_GET['cpass']);
        $dob = mysqli_real_escape_string($conn,$_GET['dob']);
      if(isset($_GET['agree'])){
        $agree = mysqli_real_escape_string($conn,$_GET['agree']);
      }
        if(isset( $agree) && $agree == 'yes'){
          // echo"okokok";
         
          //check for password 
          if($pass == $cpass){
            // echo"passwerd match";
            $query = "SELECT * FROM users_tbl WHERE 	username = '$uname' OR email = '$email' ";
              $da =  mysqli_query($conn, $query);
            $count = mysqli_num_rows($da);
            if($count > 0){
               //username already Available
               echo"<script>toastr.error('Username or Email Alredy Exist!')</script>";
            }else{
                // username not aviailble Available
                // we can procced for registration
                $pass = sha1($pass);
                  $sql = "INSERT INTO users_tbl(`name`,`username`, `email`, `dob`, `password`) VALUES('$name', '$uname', '$email','$dob','$pass')";
                  mysqli_query($conn, $sql);
                  echo"<Script>swal('Great Job', 'Rgistration SuccessFull', 'success')</script>";
            }
          }else{
            // echo"<Script>swal('Password Dosn't match!', 'Please enter the match password!', 'error')</script>";
             echo"<Script>swal('Password not match!', 'Please enter the same password', 'error')</script>";
          }
        }else{
          echo"<Script>swal('Please accept the terms and condition!', 'Please accept!', 'error')</script>";
        }
      // 2. Build The Query
        // $sql = "INSERT INTO users_tbl() VALUES()";
        //  mysqli_query($conn, $sql);
      //3. Excute the query
      //4. display the Query

      //5. DB CONNECTION CLOSE
      mysqli_close($conn);
    }
   
    ?>
    <form class="w-50 offset-3" action="" >
        <h1>Registration Form</h1>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Name</label>
            <input name="name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail3" class="form-label">UserName</label>
            <input name="uname" type="text" class="form-control" id="exampleInputEmail3" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail2" class="form-label">Email address</label>
            <input name="email" type="email" class="form-control" id="exampleInputEmail2" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input name="pass" type="password" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword2" class="form-label">Confirm Password</label>
            <input name="cpass" type="password" class="form-control" id="exampleInputPassword2">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword3" class="form-label">Date Of Birth</label>
            <input name="dob" type="date" class="form-control" id="exampleInputPassword3">
        </div>
        <div class="mb-3 form-check">
            <input name="agree" value="yes"  type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Do you agree to terms and condition ?</label>
        </div>
        <button type="submit" name="registerSubmit" class="btn btn-primary">Submit</button>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>