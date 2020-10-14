<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Banking System</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@300&display=swap" rel="stylesheet">
</head>
<style>
body{
  background-color: grey;
}
.send{
  color: black;
  font-family: Roboto;
}
.receive{
  color: black;
  font-family: Roboto;
}
.am{
  color: black;
  font-family: Roboto;
}
h1 {
  text-align: center;
  color: white;
  font-family: 'Roboto Slab', serif;
}
.bg-secondary{
  background-color: #45545F!important;
    font-family: 'Roboto Slab', serif!important;
}
.flex-container {
  display: flex;
  justify-content: center;

}
.footer {
  position: fixed;
   left: 0;
   bottom: 0;
   width: 100%;
   background-color: #45545F;
   color:white;
   text-align: center;
   font-family: Roboto;
}
</style>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-secondary ">
  <a class="navbar-brand" href="index.php">Banking System</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="transaction.php">Transaction Details<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="select_customer.php">Select Customer<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a href="index.php"><input type="button"  name="back" class="btn btn-dark" value="Back"></button></a>
      </li>
    </ul>
  </div>
</nav>
<?php
$insert = false;
if(isset($_POST['transferamount'])){
    //set connection variable
    include 'connection.php';
    //echo "success connecting to the db";
    //Collect post values
    $sender = $_POST['sender'];
    $receiver = $_POST['receiver'];
    $amount = $_POST['amount'];

    $sql = "INSERT INTO transaction (sender, receiver, amount) VALUES ('$sender', '$receiver', '$amount');";
    //echo $sql;
    // excecute the query
    if($conn->query($sql) == true){
        //echo "successfully inserted data ";
        //flag for successfull insertion
        $insert = true;
    }
    else{
        echo "ERROR : $sql <br> $conn->error";
    }
    // Close connection
    mysqli_close($conn);}
?>

    <?php include 'links.php'?>
    <script type="text/javascript">
        function validate(){
            var varsender = document.amountform.sender;
            var varreceiver = document.amountform.receiver;
            var varamount = document.amountform.amount;
            console.log(varsender.value);
            if(varsender.value == 'select sender'){
                alert('Enter Valid Sender Name');
                varsender.focus();
                return false;
            }

            else if(varreceiver.value == 'select receiver'){
                alert('Enter Valid Receiver Name');
                varreceiver.focus();
                return false;
            }

            else if(varsender.value == varreceiver.value){
                alert("Sender and Receiver name must be different!!!");
                varsender.focus();
                varreceiver.focus();
                return false;
            }

            else if(varamount.value.length <=0){
                alert("Enter amount");
                varamount.focus();
                return false;
            }

            else if(varamount.value <= 0){
                alert("SORRY!! Credit should be equal to or greater than 0.");
                varamount.focus();
                return false;
            }

            else{
                //window.location.reload();
                return true;
            }
        }
    </script>

    <div class="flex-container">
    <form action="" method="post" name="creditform" onsubmit ="return validate()">
        <h1>Transfer Amount</h1>
            <div class="transaction">
                <label class="send"for="sender">Sender's Name : </label>
                    <select name="sender" class="sel">
                    <option value="select sender">Select Sender</option>
                    <option value="Amith">Amith</option>
                    <option value="Arav">Arav</option>
                    <option value="Ayesha">Ayesha</option>
                    <option value="Kishore">Kishore</option>
                    <option value="Manju">Manju</option>
                    <option value="Manoj">Manoj</option>
                    <option value="Rohith">Rohith</option>
                    <option value="Sanjeeth">Sanjeeth</option>
                    <option value="Usman">Usman</option>
                    <option value="Yusuf">Yusuf</option>
                    </select></br>

                <label class="receive" for="receiver">Receiver's Name : </label>
                    <select name="receiver" class="sel">
                        <option value="select receiver">Select Receiver</option>
                        <option value="Amith">Amith</option>
                        <option value="Arav">Arav</option>
                        <option value="Ayesha">Ayesha</option>
                        <option value="Kishore">Kishore</option>
                        <option value="Manju">Manju</option>
                        <option value="Manoj">Manoj</option>
                        <option value="Rohith">Rohith</option>
                        <option value="Sanjeeth">Sanjeeth</option>
                        <option value="Usman">Usman</option>
                        <option value="Yusuf">Yusuf</option>
                        </select>
                        <br>

                    <label class="am"for="amount">Amount : </label><input type="text" name="amount" class="amount"><br>
                    <br>
            <div class="choose">
                <input type="submit" name="transferamount" class="btn btn-dark" value="Transfer" onclick="return success()"></button>

            </div>
    </form>
    </div>
    <?php       if(isset($_POST['transaction'])){
                include 'connection.php';
                $transen = $_POST['sender'];
                $maxcredit = "SELECT cd_currentbalance FROM record WHERE cd_name = '$transen' ";
                $result = mysqli_query($conn,$maxcredit);
                $avlbalance = mysqli_fetch_array($result);
                //echo ($avlbalance['cd_credit']);
                if($avlbalance['cd_amount'] < $amount){
            ?>
                <script>
                    alert("Sender can be transfer maximum of <?php echo($avlbalance['cd_amount']);?> amount! ");
                </script>
            <?php
                return false;
                }
            }
            ?>
<?php

    if($insert == true){
?>
    <script type="text/javascript">
        alert("SUCCESSFULLY CREDITED!");
    </script>
<?php
    }
?>


<?php
    include 'connection.php';
    if($insert == true){
        $transaction = "UPDATE record
            SET  cd_amount = CASE WHEN cd_name = '$sender' THEN cd_amount - '$amount'
                                  WHEN cd_name = '$receiver' THEN cd_amount + '$amount'
                             END

            WHERE cd_name IN ('$sender','$receiver')";

            $transect = mysqli_query($conn,$transaction);

            if($transect){
                //echo ('ok');
            }else{
                //echo ('Something went wrong! User details is not updated! ');
            }
        }
    ?>
    <div class="footer">
      <p>Made with  &#10084; Mohammed Kaif</p>

    </div>
</body>
</html>
