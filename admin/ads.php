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

	$return = $db->selectDB($sql, "SELECT * FROM advert");
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
                        <th>AVATAR</th>
                        <th>SELLER</th>
                        <th>TITLE</th>
                        <th>DESCRIPTION</th>
                        <th>PRICE</th>
                        <th>ACTIONS</th>
                    </tr>
                    </thead>
                    <tbody>
                    	<?php 

                    		$sn = 1;
                    		if(isset($no_result)){

                    		}else{
                    			while ($row = $list->fetch()) {
                                    $seller_name = get_customer_name($row->customer_id, $db, $sql);
                                    $category_name = get_category_name($row->category_id, $db, $sql);
                                    $status = get_ad_status($row->id, $db, $sql);
                    				echo "<tr>";
                    				echo "<td>$sn</td>";
                    				echo "<td><img src='$base_url/covers/$row->cover' width='150px' class='img-responsive' alt='AvAtAr' target='blank'></td>";
                                    echo "<td>$seller_name</td>";
                                    echo "<td>$row->title</td>";
                                    echo "<td>$row->description</td>";
                                    echo "<td>$row->price</td>";
                                    if($status){
                                    	echo "<td><button class='btn btn-info btn-sm deactAds' data-all='".json_encode($row)."'>De-Activate</button>&nbsp&nbsp<button class='btn btn-danger btn-sm dltAds' data-all='".json_encode($row)."'>Delete</button></td>";
                                    }else{
                                    	echo "<td><button class='btn btn-info btn-sm actAds' data-all='".json_encode($row)."'>Activate</button>&nbsp&nbsp<button class='btn btn-danger btn-sm dltAds' data-all='".json_encode($row)."'>Delete</button></td>";
                                    }
                    				
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

<!-- Delete Ads Modal start -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="delModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Delete Customer</h4>
            </div>
            <div class="modal-body">

                <form class="form-horizontal" role="form" action="<?php echo $base_url; ?>/admin/controller.php" method="POST">
                    <div class="form-group">
                        <p>You are about to delete a Customer</p><br><br><p>Are you sure you want to continue</p>
                        <div class="col-lg-10">
                            <input type="hidden" class="form-control" name="ads_id">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10" id="toclick">
                            <input type="submit" name="del_ad" class="form-control btn btn-warning" value="Delete Ad">
                        </div>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>


<!-- Activate Ads Modal start -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="actModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Activate Ads</h4>
            </div>
            <div class="modal-body">

                <form class="form-horizontal" role="form" action="<?php echo $base_url; ?>/admin/controller.php" method="POST">
                    <div class="form-group">
                        <p>You are about to activate this Ad</p><br><br><p>Are you sure you want to continue</p>
                        <div class="col-lg-10">
                            <input type="hidden" class="form-control" name="ads_id">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10" id="toclick">
                            <input type="submit" name="act_ad" class="form-control btn btn-warning" value="Activate Ad">
                        </div>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>

<!-- De-Activate Ads Modal start -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="deactModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">De-Activate Ads</h4>
            </div>
            <div class="modal-body">

                <form class="form-horizontal" role="form" action="<?php echo $base_url; ?>/admin/controller.php" method="POST">
                    <div class="form-group">
                        <p>You are about to de-activate this Ad</p><br><br><p>Are you sure you want to continue</p>
                        <div class="col-lg-10">
                            <input type="hidden" class="form-control" name="ads_id">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10" id="toclick">
                            <input type="submit" name="deact_ad" class="form-control btn btn-warning" value="De-Activate Ad">
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