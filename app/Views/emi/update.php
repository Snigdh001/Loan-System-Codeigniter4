<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  </head>
<body>

  <form action="admindashboard/update1" method="get" >
    <!-- <?= csrf_field() ?> -->
    <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
    <div class="form-group">
      <label for="upt_email">Email address</label>
      <input type="email" class="form-control" id="upt_email" aria-describedby="emailHelp" name='email' placeholder="Enter email">
    </div>
    <div class="form-group">
      <label for="upt_mob">Mobile No</label>
      <input type="text" class="form-control" id="upt_mob" name="mobile" placeholder="Mobile No">
    </div>
    <div class="form-group">
      <label for="upt_fname">First Name</label>
      <input type="text" class="form-control" id="upt_fname" name="fname" placeholder="First Name">
    </div>
    <div class="form-group">
      <label for="upt_lname">Last Name</label>
      <input type="text" class="form-control" id="upt_lname" name="lname" placeholder="Last Name">
    </div>
    <div class="form-group form-check">
      <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
      <label class="form-check-label" for="exampleCheck1">Check me to verify</label>
    </div>
    <button type="submit" class="btn btn-primary value="update">Update</button> 
    <!-- data-bs-dismiss="modal" -->
  </form>
</body>

</html>
