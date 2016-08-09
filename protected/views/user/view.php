<?php
/* @var $this UserController */
/* @var $model User */


?>

<div id="tab-details" class="tab-pane fade in active">
	<div class="row">
<div class="col-md-9">
	<div class="user-info-right">
		<div class="basic-info">
			<h4><i class="fa fa-user"></i>User Information</h4>
			</div>
			<p class="data-row">
				<span class="data-name">User name: </span>
				<span class="data-value"><?php echo $model->username; ?></span>
			</p>



			<p class="data-row">
				<span class="data-name">Gender: </span>
				<span class="data-value"><?php echo $model->gender; ?></span>
			</p>
			<p class="data-row">
				<span class="data-name">Status: </span>
				<span class="data-value"><?php echo $model->status; ?></span>
			</p>
</div>
	</div>

</div>

		</div>



