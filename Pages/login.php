<?php
    $name = $id = '';
    $nameErr = $idErr = '';

    if(isset($_POST['submit'])) {
      if(empty($_POST['name'])){
        $nameErr = 'Name is required';
      }
      else{
        $name = filter_input(INPUT_POST, 
        'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      }
      if(empty($_POST['id'])){
        $idErr = 'ID is required';
      }
      else{
        $id = filter_input(INPUT_POST, 
        'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      }
      if($name == 'john' && $id == '11111'){
        echo 'Welcome';
      }
      else {
        echo 'Incorrect Login';
      }
    }


?>

<!DOCTYPE html>
<html>
<header>
    <meta charset="UTF-8">
    <meata http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login Page</title>
</header>

<head>
    <style>
      div {
        margin-bottom: 10px;
      }
      label {
        display: inline-block;
        width: 50px;
        text-align: left;
      }
    </style>
</head>


<body>
    <center>
        <h1>Login!</h1>
        <p>Please Enter Login information</p>
        <form action="
        <?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>
        " method="POST" class="mt-4 w-75">
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control 
            <?php echo $nameErr ? 'is-invalid' : null?>
            " id="name" name="name" placeholder="Enter your name">
            <div class="invalid-feedback">
              <?php echo $nameErr; ?>
            </div>
          </div>
          <div class="mb-3">
            <label for="id" class="form-label">ID</label>
            <input type="text" class="form-control 
            <?php echo $passErr ? 'is-invalid' : null?>
            " id="id" name="id" placeholder="Enter your ID">
            <div class="invalid-feedback">
              <?php echo $idErr; ?>
            </div>
          </div>
          <div class="mb-3">
            <input type="submit" name="submit" value="Send" class="btn btn-dark w-100">
          </div>
        </form>
    </center>
    <div>
        <a href="../"> Return to Home Page</a>
    </div>
</body>

</html>