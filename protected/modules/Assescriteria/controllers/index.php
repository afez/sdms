<div class="row">
    <div class="col-sm-3">
        <section class="panel">
            <div class="panel-body">
                <a href="mail_compose.html"  class="btn btn-compose">
                    Assesment
                </a>
                <ul class="nav nav-pills nav-stacked mail-nav">
                    <li><a href="<?php echo $this->createUrl('/Assescriteria/assesment/criteria'); ?>"> <i class="fa fa-check"></i> Assesment Criteria</a></li>
                    <li><a href="#"> <i class="fa fa-mail-reply"></i> Comments</a></li>

                </ul>
            </div>
        </section>


    </div>
    <div class="col-sm-9">
        <section class="panel">
            <header class="panel-heading wht-bg">
                <h4 style="color: black">Welcome for Assesment </h4>
                <form action="#" class="pull-right mail-src-position">

                </form>
                </h4>
            </header>
            <div class="panel-body minimal">

                <div class="alert alert-info fade in">
                    <button data-dismiss="alert" class="close close-sm" type="button">
                        <i class="fa fa-times"></i>
                    </button>
                    <strong class="btn btn-danger">NOTE!</strong> Grade the publication you selected and submit your results. 
                    start with assesment criteria.
                </div>
            </div>
        </section>
    </div>
</div>