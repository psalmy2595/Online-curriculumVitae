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

	/*$return = $db->selectDB($sql, "SELECT * FROM customer");
	if($return->rowCount() > 0){
		$list = $return;
	}else{
		$no_result = TRUE;
	}*/

?>
<div>
	<?php
		if(isset($notification)){
			echo $notification;
		}
	?>
</div>

<!-- Data Table Starts -->
<!-- page start-->

        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <!-- <header class="panel-heading">
                        Basic Wizard
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-cog"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                         </span>
                    </header> -->
                    <div class="panel-body">


                        <style>
                        #registration-step{margin:0;padding:0;}
                        #registration-step li{list-style:none; float:left;padding:5px 10px;border-top:#EEE 1px solid;border-left:#EEE 1px solid;border-right:#EEE 1px solid;}
                        #registration-step li.highlight{background-color:#EEE;}
                        #registration-form{clear:both;border:1px #EEE solid;padding:20px;}
                        .demoInputBox{padding: 10px;border: #F0F0F0 1px solid;border-radius: 4px;background-color: #FFF;width: 50%;}
                        .registration-error{color:#FF0000; padding-left:15px;}
                        .message {color: #00FF00;font-weight: bold;width: 100%;padding: 10;}
                        .btnAction{padding: 5px 10px;background-color: #09F;border: 0;color: #FFF;cursor: pointer; margin-top:15px;}
                        </style>
                        <!-- <script src="http://code.jquery.com/jquery-1.10.2.js"></script> -->
                        
                        </head>
                        <body>
                            <div class="message"><?php if(isset($message)) echo $message; ?></div>
                            <ul id="registration-step">
                                <li id="personalDetails" class="highlight">PERSONAL DETAILS</li>
                                <li id="workExperience">WORK EXPERIENCE</li>
                                <li id="educationalQualification">EDUCATIONAL QUALIFICATION</li>
                                <li id="referees">REFEREES</li>
                            </ul>
                            <form name="frmRegistration" id="registration-form" method="post" action="<?php echo $base_url; ?>/controller.php">

                                <div id="personalDetails-field">
                                    <!-- <label>Email</label><span id="email-error" class="registration-error"></span>
                                    <div><input type="text" name="email" id="email" class="demoInputBox" /></div> -->
                                    <div class="col-md-6 col-lg-6">
                                      <div class="form-group">
                                            <label class="col-lg-4 control-label">Full Name</label>
                                            <div class="col-lg-8">
                                                <input type="text" class="form-control" placeholder="Full Name" name="fullname" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                             <label class="col-lg-4 control-label">Phone</label>
                                            <div class="col-lg-8">
                                                <input type="text" class="form-control" placeholder="Phone" name="phone" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-lg-4 control-label">Religion</label>
                                            <div class="col-lg-8">
                                                <input type="text" class="form-control" placeholder="Religion" name="religion" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-lg-4 control-label">Marital Status</label>
                                            <div class="col-lg-8">
                                                <input type="text" class="form-control" placeholder="Marital Status" name="marital_status" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-lg-4 control-label">Language</label>
                                            <div class="col-lg-8">
                                                <input type="text" class="form-control" placeholder="Language" name="language" required>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- column 1 ends here -->

                                    <!-- column 2 starts here -->
                                    <div class="col-lg-6 col-md-6">

                                          
                                        <div class="form-group">
                                            <label class="col-lg-4 control-label">Gender</label>
                                            <div class="col-lg-8">
                                                <div class="square-red single-row">
                                                <div class="radio ">
                                                    <input tabindex="3" type="radio"  name="gender" value="male">
                                                    <label>Male </label>
                                                </div>
                                                <span class="radio">
                                                    <input tabindex="3" type="radio"  name="gender" value="female">
                                                    <label>Female </label>
                                                </span>
                                            </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-lg-4 control-label">State of Origin</label>
                                            <div class="col-lg-8">
                                                <input type="text" class="form-control" placeholder="State" name="state" required>
                                            </div>
                                        </div> 

                                        <div class="form-group">
                                            <label class="col-lg-4 control-label">Nationality</label>
                                            <div class="col-lg-8">
                                                <input type="text" class="form-control" placeholder="Nationality" name="nationality" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-lg-4 control-label">Address</label>
                                            <div class="col-lg-8">
                                                <textarea class="form-control" name="address" required></textarea>
                                            </div>
                                        </div>
                                    </div>

                                </div>
<!-- END OF PERSONAL DETAILS -->


                                <div id="workExperience-field" style="display:none;">
                                    <!-- <label>Enter Password</label><span id="password-error" class="registration-error"></span>
                                    <div><input type="password" name="password" id="user-password" class="demoInputBox" /></div>
                                    <label>Re-enter Password</label><span id="confirm-password-error" class="registration-error"></span>
                                    <div><input type="password" name="confirm-password" id="confirm-password" class="demoInputBox" /></div> -->
                                    <table class="table table-bordered">
                                        <thead>
                                          <tr>
                                            <th>Company Name</th>
                                            <th>Post Held</th>
                                            <th>Address</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Add more field</th>
                                          </tr>
                                        </thead>
                                        <tbody id="moreWorkExp">
                                          <tr>
                                            <td><input type="text" class="form-control" name="company[0][name]" required></td>
                                            <td><input type="text" class="form-control" name="company[0][post]" required></td>
                                            <td><input type="text" class="form-control" name="company[0][address]" required></td>
                                            <td><input type="date" class="form-control" name="company[0][start_date]" required></td>
                                            <td><input type="date" class="form-control" name="company[0][end_date]" required></td>
                                            <td><button class="btn btn-sm btn-primary" id="addWorkExp">Add</button></td>
                                          </tr>
                                        </tbody>
                                      </table>
                                </div>
<!-- END OF WORK EXPERIENCE -->
                                <div id="educationalQualification-field" style="display:none;">
                                    <!-- <label>Display Name</label>
                                    <div><input type="text" name="display-name" id="display-name" class="demoInputBox"/></div>
                                    <label>Gender</label>
                                    <div>
                                        <select name="gender" id="gender" class="demoInputBox">
                                            <option value="female">Female</option>
                                            <option value="male">Male</option>
                                        </select>
                                    </div> -->
                                    <table class="table table-bordered">
                                        <thead>
                                          <tr>
                                            <th>School Name</th>
                                            <th>Qualification</th>
                                            <th>Course</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Add more field</th>
                                          </tr>
                                        </thead>
                                        <tbody id="moreEduQualification">
                                          <tr>
                                            <td><input type="text" class="form-control" name="school[0][name]" required></td>
                                            <td><input type="text" class="form-control" name="school[0][qualification]" required></td>
                                            <td><input type="text" class="form-control" name="school[0][course]" required></td>
                                            <td><input type="date" class="form-control" name="school[0][start_date]" required></td>
                                            <td><input type="date" class="form-control" name="school[0][end_date]" required></td>
                                            <td><button class="btn btn-sm btn-primary" id="addEduQualification">Add</button></td>
                                          </tr>
                                        </tbody>
                                      </table>
                                </div>

                                <div id="referees-field" style="display:none;">
                                    <!-- <label>Display Name</label>
                                    <div><input type="text" name="display-name" id="display-name" class="demoInputBox"/></div>
                                    <label>Gender</label>
                                    <div>
                                        <select name="gender" id="gender" class="demoInputBox">
                                            <option value="female">Female</option>
                                            <option value="male">Male</option>
                                        </select>
                                    </div> -->

                                    <table class="table table-bordered">
                                        <thead>
                                          <tr>
                                            <th>Referee Name</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>Email</th>
                                            <th>Add more field</th>
                                          </tr>
                                        </thead>
                                        <tbody id="moreReferees">
                                          <tr>
                                            <td><input type="text" class="form-control" name="referee[0][name]" required></td>
                                            <td><input type="text" class="form-control" name="referee[0][phone]" required></td>
                                            <td><input type="text" class="form-control" name="referee[0][address]" required></td>
                                            <td><input type="text" class="form-control" name="referee[0][email]" required></td>
                                            <td><button class="btn btn-sm btn-primary" id="addReferees">Add</button></td>
                                          </tr>
                                        </tbody>
                                      </table>
                                </div>
                                <div>
                                    <input class="btnAction" type="button" name="back" id="back" value="Back" style="display:none;">
                                    <input class="btnAction" type="button" name="next" id="next" value="Next" >
                                    <input class="btnAction" type="submit" name="finish" id="finish" value="Finish" style="display:none;">
                                </div>
                                </form>
                            </div>
                </section>
            </div>
        </div>
        <!-- page end-->
<?php
	include 'footer.php';
	unset($_SESSION['notification']);
?>

        <script>
            $(document).ready(function() {
                var max_fields      = 3; 
                var wrapper         = $("#moreEduQualification"); 
                var add_edu     = $("#addEduQualification");
                var alphabet        = ["k","l","m","n","o"]; 

                
                var x = 1; 
                $(add_edu).click(function(e){ 
                    e.preventDefault();
                    if(x < max_fields){
                      var markup = "<tr><td><input type='text' name='school["+x+"][name]' class='form-control'></td><td><input type='text' name='school["+x+"][qualification]' class='form-control'></td><td><input type='text' name='school["+x+"][course]' class='form-control'></td><td><input type='date' name='school["+x+"][start_date]' class='form-control'></td><td><input type='date' name='school["+x+"][end_date]' class='form-control'></td><td> <a href='#' class='remove_field' style='color:red'> (Remove)</a></td></tr>";
                        $(wrapper).append(markup);
                      $("#"+x).focus();
                      x++;
                    } 
                });
                
                $("table tbody").on("click",".remove_field", function(e){
                    e.preventDefault(); $(this).parentsUntil("tbody").remove(); x--;
                })

            });


            $(document).ready(function() {
                var max_fields      = 5; 
                var wrapper         = $("#moreWorkExp"); 
                var add_work      = $("#addWorkExp");
                var alphabet        = ["k","l","m","n","o"]; 

                
                var x = 1; 
                $(add_work).click(function(e){ 
                    e.preventDefault();
                    if(x < max_fields){
                      var markup = "<tr><td><input type='text' name='company["+x+"][name]' class='form-control'></td><td><input type='text' name='company["+x+"][post]' class='form-control'></td><td><input type='text' name='company["+x+"][address]' class='form-control'></td><td><input type='date' name='company["+x+"][start_date]' class='form-control'></td><td><input type='date' name='company["+x+"][end_date]' class='form-control'></td><td> <a href='#' class='remove_field' style='color:red'> (Remove)</a></td></tr>";
                        $(wrapper).append(markup);
                      $("#"+x).focus();
                      x++;
                    } 
                });
                
                $("table tbody").on("click",".remove_field", function(e){
                    e.preventDefault(); $(this).parentsUntil("tbody").remove(); x--;
                })

            });


            $(document).ready(function() {
                var max_fields      = 2; 
                var wrapper         = $("#moreReferees"); 
                var add_referee      = $("#addReferees");
                var alphabet        = ["k","l","m","n","o"]; 

                
                var x = 1; 
                $(add_referee).click(function(e){ 
                    e.preventDefault();
                    if(x < max_fields){
                      var markup = "<tr><td><input type='text' name='referee["+x+"][name]' class='form-control'></td><td><input type='text' name='referee["+x+"][phone]' class='form-control'></td><td><input type='text' name='referee["+x+"][address]' class='form-control'></td><td><input type='text' name='referee["+x+"][email]' class='form-control'></td><td> <a href='#' class='remove_field' style='color:red'> (Remove)</a></td></tr>";
                        $(wrapper).append(markup);
                      $("#"+x).focus();
                      x++;
                    } 
                });
                
                $("table tbody").on("click",".remove_field", function(e){
                    e.preventDefault(); $(this).parentsUntil("tbody").remove(); x--;
                })

            });


        function validate() {
        var output = true;
        $(".registration-error").html('');
        if($("#account-field").css('display') != 'none') {
            if(!($("#email").val())) {
                output = false;
                $("#email-error").html("required");
            }   
            if(!$("#email").val().match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/)) {
                $("#email-error").html("invalid");
                output = false;
            }
        }

        if($("#password-field").css('display') != 'none') {
            if(!($("#user-password").val())) {
                output = false;
                $("#password-error").html("required");
            }   
            if(!($("#confirm-password").val())) {
                output = false;
                $("#confirm-password-error").html("Not Matched");
            }   
            if($("#user-password").val() != $("#confirm-password").val()) {
                output = false;
                $("#confirm-password-error").html("Not Matched");
            }   
        }
        return output;
        }
        $(document).ready(function() {
            $("#next").click(function(){
                // var output = validate();
                // if(output) {
                    var current = $(".highlight");
                    var next = $(".highlight").next("li");
                    if(next.length>0) {
                        $("#"+current.attr("id")+"-field").hide();
                        $("#"+next.attr("id")+"-field").show();
                        $("#back").show();
                        $("#finish").hide();
                        $(".highlight").removeClass("highlight");
                        next.addClass("highlight");
                        if($(".highlight").attr("id") == $("li").last().attr("id")) {
                            $("#next").hide();
                            $("#finish").show();                
                        }
                    }
                // }
            });
            $("#back").click(function(){ 
                var current = $(".highlight");
                var prev = $(".highlight").prev("li");
                if(prev.length>0) {
                    $("#"+current.attr("id")+"-field").hide();
                    $("#"+prev.attr("id")+"-field").show();
                    $("#next").show();
                    $("#finish").hide();
                    $(".highlight").removeClass("highlight");
                    prev.addClass("highlight");
                    if($(".highlight").attr("id") == $("li").first().attr("id")) {
                        $("#back").hide();          
                    }
                }
            });
        });
        </script>