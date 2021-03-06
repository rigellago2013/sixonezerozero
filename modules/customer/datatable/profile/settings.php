<?php
  $list = $client->get_client($_SESSION['id']);
  foreach ($list as $value) {
 ?>
<div class="content-container">
		<div class="modal-dialog">
			<form method="post" id="admin-prof-form" enctype="multipart/form-data">
				<div class="modal-content">
					<div class="modal-header">
				     <h3 class="text-center">Settings</h3>
						<h4 class="modal-title"></h4>
					</div>
					<div class="modal-body">
						<label>Email</label>
						<input type="text" name="custemail" id="cust_email" class="form-control" value="<?php echo $value['cust_email'];?>" />
							<span id="check_email"></span>
						<br />
						<label>First Name</label>
						<input type="text" name="custfirst" id="cust_firstname" class="form-control" value="<?php echo $value['cust_firstname'];?>"/>
						<br />
						<label>Last Name</label>
						<input type="text" name="custlast" id="cust_lastname" class="form-control" value="<?php echo $value['cust_lastname'];?>"/>
						<br />
            <br />
					</div>
					<div class="modal-footer">
						<input type="hidden" name="custid" id="cust_id" value="<?php echo $_SESSION['id'] ?>"/>
						<input type="hidden" name="operation" id="operation" />
						<input type="submit" name="action" id="action" class="btn btn-success" value="Save" />
						<button type="button" class="btn btn-danger" data-target="#changePassModal" data-toggle="modal" id="change-pass-btn">Change Password</button>
					</div>
				</div>
			</form>
		</div>
</div>

<div id="changePassModal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="change-pass-form" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Change Password</h4>
                </div>

                <div class="modal-body">
                    <label>New password</label>
                    <input type="password" name="newpass" id="newpass" class="form-control" />
                    <br>


                    <label>Confirm password</label>
                    <input type="password" name="conpass" id="conpass" class="form-control"/>
                    <br>
                        <span id="notif"></span>


                </div>

                <div class="modal-footer">
                    <input type="hidden" name="stfidpass" id="stf_id_pass" value="<?php echo $_SESSION['id'] ?>" />
                    <input type="hidden" name="operation-pass" id="operation-pass" />
                    <input type="submit" name="action-pass" id="action-pass" class="btn btn-success" value="Save" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>

<?php
}

 ?>

<script type="text/javascript">

$(document).ready(function(){

  $('#change-pass-btn').click(function(){
		$('#change-pass-form')[0].reset();
      $('#notif').empty();
			$('#action-add').val("Save");
      $('#operation-pass').val("Save");
	});


  $(document).on('submit', '#admin-prof-form', function(event){
    event.preventDefault();

  		$('#action').val("Save");
  		$('#operation').val("Save");

    var stfemail = $('#cust_email').val();
    var stffirst = $('#cust_firstname').val();
    var stflast = $('#cust_lastname').val();

      if(stfemail != '' && stffirst != '' && stflast != '')
    {
      $.ajax({
        url:"process.php",
        method:"POST",
        data:new FormData(this),
        contentType:false,
        processData:false,
        success:function(data)
        {
          alert(data);
        }
      });
    }
    else
    {
      alert("Please fill up all information required.");
    }

  });


  $('#conpass').on('keyup click change', function(){
    var newpass = $('#newpass').val();
    var conpass = $('#conpass').val();
    var form = $('#change-pass-form')[0];
    var alert = 'Password doesnt match please try again.';
    var match = 'Password match.';
    
    if(conpass == newpass){

      $('#notif').empty();
      $('#notif').append(match);
      $('#action-pass').prop('disabled', false);

      $.ajax({
        url: "process.php",
        method:'POST',
        data:new FormData(form),
        contentType:false,
        processData:false,
        success:function(data){
            alert(data);
        }
      });
    }else{
        $('#notif').empty();
        $('#notif').append(alert);
        $('#action-pass').prop('disabled', true);

}
  });//end of conpass

});

</script>
