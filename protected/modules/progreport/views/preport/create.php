<?php
/* @var $this PreportController */
/* @var $model Preport */


?>
<div class="alert alert-info fade in">
                                <button data-dismiss="alert" class="close close-sm" type="button">
                                    <i class="fa fa-times"></i>
                                </button>
    <strong class="btn btn-primary">NOTE!</strong> Only academic staff on studies can fill the form below.
                            </div>
<div class="col-lg-12">
		<section class="panel panel-primary">
			<header style="background:ghostwhite "class="panel-heading">
				<h4 style="color: black  ">Upload Progress REport </h4>
			</header>
			<div class="panel-body">
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
                        </div>
                </section>
</div>
               