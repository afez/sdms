<?php
/* @var $this PublicationController */
/* @var $model Publication */

?>



<div class="alert alert-info fade in">
                                <button data-dismiss="alert" class="close close-sm" type="button">
                                    <i class="fa fa-times"></i>
                                </button>
    <strong class="btn btn-danger">NOTE!</strong> This is only for HoD use.<br> Upload publications here!
                            </div>
	<div class="col-lg-12">
		<section class="panel panel-primary">
			<header style="background:ghostwhite "class="panel-heading">
				<h4 style="color: black  ">Add publication </h4>
			</header>
			<div class="panel-body">
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
                        </div>
                </section>
        </div>

