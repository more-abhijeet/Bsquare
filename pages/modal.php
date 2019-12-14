<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


<?php
session_start();
       $id=$_GET['id'];

if(isset($_POST['submit'])){
     include('../config/DbFunction.php');
     $obj=new DbFunction();

     $obj->validateUserForDelete($id,$_POST['id'],$_POST['password']);
}


?>

<script>
$(function() {
$("#myModal").modal();//if you want you can have a timeout to hide the window after x seconds
});
</script>

<!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                  <div >

                <div class="panel panel-primary">

                    <div class="panel-heading">
                     <h3 class="panel-title">Please Enter user name and password</h3>
                    </div>
                    <div class="panel-body">
                        <form method="post">
                            <fieldset>
                                <div class="form-group">
             <input class="form-control" placeholder="Login Id"  id="id"name="id" type="text" >
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" id="password"name="password" type="password" value="">
                                </div>

                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" value="login" name="submit" class="btn btn-lg btn-success btn-block">
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
                </div>

            </div>

        </div>
    </div>

<?php  ?>