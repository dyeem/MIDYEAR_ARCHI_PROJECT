<?php 
include '../connect.php';



    if(isset($_POST['deleteacccus'])){
        $cus_id = mysqli_real_escape_string($conn,$_POST['deleteacccus']);
        $query = "DELETE FROM usersaccount WHERE id='$cus_id'";
        $run = mysqli_query($conn, $query);

        if($run){
            $_SESSION['alertcus'] = "Customer Information Deleted Successfully";
        }else{
            $_SESSION['alertcus'] = "Customer not Deleted Successfully";
        }
    }
?>

<link rel="stylesheet" href="../../css/ManageAdmin.css">
<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap Bundle with Popper -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>


<div class="container-fluid">
    <div class="row no-gutters">
        <!-- 1st floor -->
        <div class="col-12">
            <div class="row" id="header">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <img src="../images/logo.png" alt="test" id="logo"><h4 class="brand-name">Coffee Hub</h4>
                </div>
            </div>
        </div>
    </div>
    <!-- 2nd floor -->
    <div class="row no-gutters mb-4" id="ultraheader">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" viewBox="0 0 48 48"><g class="nc-icon-wrapper" fill="#543310" stroke-linejoin="round" stroke-linecap="round"><circle data-color="color-2" cx="24" cy="24" r="7" fill="none" stroke="#543310" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2"></circle> <path d="M46,27V21L39.6,20.466a15.89,15.89,0,0,0-2.072-4.991l4.155-4.91L37.435,6.322l-4.91,4.155A15.876,15.876,0,0,0,27.534,8.4L27,2H21l-.534,6.4a15.89,15.89,0,0,0-4.991,2.072l-4.91-4.155L6.322,10.565l4.155,4.91A15.876,15.876,0,0,0,8.4,20.466L2,21v6l6.4.534a15.89,15.89,0,0,0,2.072,4.991l-4.155,4.91,4.243,4.243,4.91-4.155A15.876,15.876,0,0,0,20.466,39.6L21,46h6l.534-6.405a15.89,15.89,0,0,0,4.991-2.072l4.91,4.155,4.243-4.243-4.155-4.91A15.876,15.876,0,0,0,39.6,27.534Z" fill="none" stroke="#543310" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2"></path></g></svg>
                    <p class="headertitle ">Manage Customer</p>
                </div>
                <!-- <div class="">
                    <button type="button" id="addadminbtn" class="btn" data-bs-toggle="modal" data-bs-target="#formmodal">Add New Admin</button>
                </div> -->
            </div>
            <?php include 'alertcus.php'; ?>
            <!-- <div class="modal fade" id="formmodal" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false"> 
                <div class="modal-dialog modal-dialog-centered modal-md" role="document"> 
                    <div class="modal-content"> 
                        <div class="modal-body text-center p-lg-4"> 
                        <script>
                            if(window.history.replaceState){
                                window.history.replaceState(null, null, window.location.href);
                            }
                        </script>
                        <form action="" method="post" >
                            <div class="d-flex flex-column align-items-center justify-content-center text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48"><g class="nc-icon-wrapper" fill="#1b1c1d"><path d="M33.535,22.5l-2.75-.2A6.942,6.942,0,0,0,30,20.4L31.8,18.317a.5.5,0,0,0-.025-.681l-1.414-1.414a.5.5,0,0,0-.68-.025L27.6,18a6.968,6.968,0,0,0-1.9-.789l-.2-2.751A.5.5,0,0,0,25,14H23a.5.5,0,0,0-.5.464l-.2,2.751A6.968,6.968,0,0,0,20.4,18L18.316,16.2a.5.5,0,0,0-.68.025l-1.414,1.414a.5.5,0,0,0-.025.681L18,20.4a6.942,6.942,0,0,0-.789,1.9l-2.75.2A.5.5,0,0,0,14,23v2a.5.5,0,0,0,.465.5l2.75.2A6.962,6.962,0,0,0,18,27.6L16.2,29.684a.5.5,0,0,0,.025.68l1.414,1.414a.5.5,0,0,0,.68.025L20.4,30a6.962,6.962,0,0,0,1.9.789l.2,2.75A.5.5,0,0,0,23,34h2a.5.5,0,0,0,.5-.465l.2-2.75A6.962,6.962,0,0,0,27.6,30L29.684,31.8a.5.5,0,0,0,.68-.025l1.414-1.414a.5.5,0,0,0,.025-.68L30,27.6a6.962,6.962,0,0,0,.789-1.9l2.75-.2A.5.5,0,0,0,34,25V23A.5.5,0,0,0,33.535,22.5ZM24,27a3,3,0,1,1,3-3A3,3,0,0,1,24,27Z" fill="#1b1c1d" data-color="color-2"></path><path d="M45,5a4,4,0,1,0-5,3.858v4.728l-3.707,3.707a1,1,0,1,0,1.414,1.414l4-4A1,1,0,0,0,42,14V8.858A4,4,0,0,0,45,5Z" fill="#1b1c1d"></path><path d="M11.707,17.293,8,13.586V8.858a4,4,0,1,0-2,0V14a1,1,0,0,0,.293.707l4,4a1,1,0,0,0,1.414-1.414Z" fill="#1b1c1d"></path><path d="M27,1H21a1,1,0,0,0-1,1V8a1,1,0,0,0,1,1h2v2a1,1,0,0,0,2,0V9h2a1,1,0,0,0,1-1V2A1,1,0,0,0,27,1Z" fill="#1b1c1d"></path><path d="M44,39H42V34a1,1,0,0,0-.293-.707l-4-4a1,1,0,0,0-1.414,1.414L40,34.414V39H38a1,1,0,0,0-1,1v6a1,1,0,0,0,1,1h6a1,1,0,0,0,1-1V40A1,1,0,0,0,44,39Z" fill="#1b1c1d"></path><path d="M11.707,30.707a1,1,0,0,0-1.414-1.414l-4,4A1,1,0,0,0,6,34v5H4a1,1,0,0,0-1,1v6a1,1,0,0,0,1,1h6a1,1,0,0,0,1-1V40a1,1,0,0,0-1-1H8V34.414Z" fill="#1b1c1d"></path><path d="M25,39.142V37a1,1,0,0,0-2,0v2.142a4,4,0,1,0,2,0Z" fill="#1b1c1d"></path></g></svg>
                                <h4>Create a <span> Admin</span></h4>
                            </div>
                            <div class="input-group mb-3 d-flex">
                                <input type="text" class="form-control form-control-md " style="margin-right: 10px" placeholder="Firstname" name="firstname" required autocomplete="off">
                                <input type="text" class="form-control form-control-md ml-2" style="margin-left: 10px" placeholder="Lastname"name="lastname" required autocomplete="off">
                            </div>
                            <div class="input-group mb-3">
                                <input type="email" class="form-control form-control-md" placeholder="Email Address" name="email" required autocomplete="off">
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control form-control-md" placeholder="Phone Number" name="telephone" required autocomplete="off">
                            </div>
                            <div class="input-group mb-4">
                                <input type="password" class="form-control form-control-md" placeholder="Password"name="password" required autocomplete="off">
                            </div>
                            <div class="">
                                <button type="button" class="btn btn-lg mt-3 btn-danger" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-lg mt-3 btn-success" name="addadmin">Done</button>
                            </div> 
                        </form>
                        </div>
                    </div> 
                </div> 
		    </div> -->
        </div>
    </div>
    
    <!-- 3rd floor -->
    <div class="row no-gutters">
        <div class="col-12">
            <div class="container">
                <table class="table table-bordered table-light table-hover">
                    <thead class="table-warning">
                        <tr class="text-center">
                            <th>Id</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Gender</th>
                            <th>Phone Number</th>
                            <th>Email Address</th>
                            <th>Edit/Delete</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php
                            $query = "SELECT * FROM usersaccount";
                            $run = mysqli_query($conn, $query);
                            
                            if (mysqli_num_rows($run) > 0){
                                foreach($run as $customers){
                                    ?>
                                    <tr class="text-center">
                                        <td><?= $customers ['ID']; ?></td>
                                        <td><?= $customers ['firstname']; ?></td>
                                        <td><?= $customers ['lastname']; ?></td>
                                        <td><?= $customers ['gender']; ?></td>
                                        <td><?= $customers ['phonenumber']; ?></td>
                                        <td><?= $customers ['email']; ?></td>
                                        <td>
                                            <a href="pages/ModifyCustomer.php?id=<?= $customers['ID']; ?>" class="btn btn-success m-1">Edit</a>
                                            <button type="button" class="btn btn-danger m-1" data-bs-toggle="modal" data-bs-target="#deletecus" onclick="confirmDelete(<?= $customers['ID']; ?>)">Delete</button>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }else{
                                echo '<h5> No Records of Customer </h5>';
                            }
                        ?>
                        <div class="modal fade" id="deletecus" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false"> 
                            <div class="modal-dialog modal-dialog-centered modal-sm" role="document"> 
                                <div class="modal-content"> 
                                    <div class="modal-body text-center p-lg-4">
                                        <h4 class="text-danger mt-3">Are you Sure?</h4> 
                                        <p class="mt-3">The Selected Row will be Delete.</p>
                                        <button type="button" class="btn btn-md mt-3 btn-danger" data-bs-dismiss="modal">No</button> 
                                        <form action="" method="post" class="d-inline">
                                            <input type="hidden" name="deleteacccus" id="deleteacccus">
                                            <button type="submit" id= "deletebtn" class="btn btn-md mt-3 btn-success">Yes</button>
                                           
                                        </form>
                                    </div> 
                                </div> 
                            </div> 
                        </div>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    function confirmDelete(ID) {
        document.getElementById('deleteacccus').value = ID;
    }
    
</script>