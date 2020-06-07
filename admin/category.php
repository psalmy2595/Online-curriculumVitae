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

	$return = $db->selectDB($sql, "SELECT * FROM categories");
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
                    	<a href="#myModal-1" data-toggle="modal" class="btn btn-info">
    Add New Category
</a>
                    <table  class="display table table-bordered table-striped" id="dynamic-table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>NAME</th>
                        <th>DATE CREATED</th>
                        <th>ACTION</th>
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
                    				echo "<td>$row->name</td>";
                    				echo "<td></td>";
                    				echo "<td><button class='btn btn-danger btn-sm dltCat' data-all='".json_encode($row)."'>Delete</button></td>";
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

<!-- Modal start -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal-1" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Add New Category</h4>
            </div>
            <div class="modal-body">

                <form class="form-horizontal" role="form" action="<?php echo $base_url; ?>/admin/controller.php" method="POST">
                    <div class="form-group">
                        <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Name</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="name" id="inputEmail4" placeholder="Category Name">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <input type="submit" name="add_cat" class="form-control btn btn-info">
                        </div>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>

<!-- Delete Category Modal start -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="delModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Delete Category</h4>
            </div>
            <div class="modal-body">

                <form class="form-horizontal" role="form" action="<?php echo $base_url; ?>/admin/controller.php" method="POST">
                    <div class="form-group">
                        <p>You are about to delete a Category</p><br><br><p>Are you sure you want to continue</p>
                        <div class="col-lg-10">
                            <input type="hidden" class="form-control" name="category_id">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10" id="toclick">
                            <input type="submit" name="del_cat" class="form-control btn btn-warning" value="Delete Category">
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