

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Products import page
                    </h1>
                    <ol class="breadcrumb">
                        <li class="active">
                            <i class="fa fa-dashboard"></i> Products import page
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-dashboard fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?=$data['countProducts']?></div>
                                    <div>New Products!</div>
                                </div>
                            </div>
                        </div>
                        <a href="<?=SCRIPT_ROOT . 'products/list'?>">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->

            <div class="row">
                <form action="products/post" class="form-horizontal" role="form" method="post">
                    <input class="form-control" name="mage_url" placeholder="Magento Base URL">
                    <button type="submit" class="btn btn-danger">Import</button>
                </form>
            </div>
            <!-- /.row -->


