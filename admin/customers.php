<?php 
	session_start();
	include 'header.php';

	//create database object
$db = new db();

//connect to database
if ($sql = $db->connectDB($connStr, $user, $pass)) {
    if (is_string($sql)) {
        echo $sql;
    }
}

	$return = $db->selectDB($sql, "SELECT * FROM recruitee");
	if($return->rowCount() > 0){
		$list = $return;
	}else{
		$no_result = TRUE;
	}

?>
<div>
	<?php
		if(isset($notification)){
			echo $notification;
		}
	?>
</div>

<!-- Data Table Starts -->
 <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    
                    <div class="panel-body">
                    <div class="adv-table">
                    	
                    <table  class="display table table-bordered table-striped" id="dynamic-table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>FULLNAME</th>
                        <th>USERNAME</th>
                        <th>EMAIL</th>
                        <th>PHONE</th>
                        <th>ADDRESS</th>
                        <th>ACTIONS</th>
                        <!-- <th>STATUS</th> -->
                    </tr>
                    </thead>
                    <tbody>
                    	<?php 

                    		$sn = 1;
                    		if(isset($no_result)){

                    		}else{
                    			while ($row = $list->fetch()) {
                                    
                    				echo "<tr>";
                    				echo "<td>$sn</td>";
                    				echo "<td>$row->fullname</td>";
                                    echo "<td>$row->username</td>";
                                    echo "<td>$row->email</td>";
                                    echo "<td>$row->phone</td>";
                                    echo "<td>$row->address</td>";
                    				echo "<td><button class='btn btn-danger btn-sm dltBtn' data-all='".json_encode($row)."'>Delete</button>  <a href='$base_url/admin/cv.php?user_id=$row->id' class='btn btn-info btn-sm'>View CV</a></td>";

                                    // if(cvConfirmed($row->id, $db, $sql)){
                                    //     echo "<td><div class='alert-success'>Confirmed</div></td>";
                                    // }
                    				echo "</tr>";

                    				$sn++;

                    			}

                    		}
                    	?>
                   
                    </tbody>
                    
                    </table>
                    </div>
                    </div>
                </section>
            </div>
        </div>
<!-- DataTable ends -->

<!-- Delete Customer Modal start -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="delModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Delete User</h4>
            </div>
            <div class="modal-body">

                <form class="form-horizontal" role="form" action="<?php echo $base_url; ?>/admin/controller.php" method="POST">
                    <div class="form-group">
                        <p>You are about to delete a User</p><br><br><p>Are you sure you want to continue</p>
                        <div class="col-lg-10">
                            <input type="hidden" class="form-control" name="customer_id">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10" id="toclick">
                            <input type="submit" name="del_cus" class="form-control btn btn-warning" value="Delete User">
                        </div>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>


<?php
	include 'footer.php';
	unset($_SESSION['notification']);
?>