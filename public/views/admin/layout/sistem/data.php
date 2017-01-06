<div class="content">
    <div class="container-fluid">
        <div class="row">
            <?php echo $this->session->flashdata('notif'); ?>
            <div class="card">
                <div class="header">
                    <h4 class="title"><i class="pe-7s-config"></i> Server Information</h4>
                </div>
                <div class="content">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="card-visitor" style="background-color: #f1f1f1;margin-bottom: 10px">
                                <div class="header" style="text-align: center">
                                    <h5 class="title"><i class="fa fa-hdd-o"></i> WEB SERVER</h5>
                                </div>
                                <div class="count-visitor" style="text-align: center;margin-bottom: 15px;padding-bottom: 30px;margin-top: 20px;font-size: 15px;font-family: Roboto;font-weight: 300">
                                    <?php print $_SERVER['SERVER_SOFTWARE'] ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="card-visitor" style="background-color: #f1f1f1;margin-bottom: 10px">
                                <div class="header" style="text-align: center">
                                    <h5 class="title"><i class="fa fa-envelope-o"></i> SERVER ADMIN</h5>
                                </div>
                                <div class="count-visitor" style="text-align: center;margin-bottom: 15px;padding-bottom: 30px;margin-top: 20px;font-size: 15px;font-family: Roboto;font-weight: 300">
                                    <?php print $_SERVER['SERVER_ADMIN'] ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="card-visitor" style="background-color: #f1f1f1;margin-bottom: 10px">
                                <div class="header" style="text-align: center">
                                    <h5 class="title"><i class="fa fa-globe"></i> SERVER PROTOKOL</h5>
                                </div>
                                <div class="count-visitor" style="text-align: center;margin-bottom: 15px;padding-bottom: 30px;margin-top: 20px;font-size: 15px;font-family: Roboto;font-weight: 300">
                                    <?php print $_SERVER['SERVER_PROTOCOL'] ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="card-visitor" style="background-color: #f1f1f1;margin-bottom: 10px">
                                <div class="header" style="text-align: center">
                                    <h5 class="title"><i class="fa fa-map-marker"></i> IP ADDRESS</h5>
                                </div>
                                <div class="count-visitor" style="text-align: center;margin-bottom: 15px;padding-bottom: 30px;margin-top: 20px;font-size: 15px;font-family: Roboto;font-weight: 300">
                                    <?php print $_SERVER['REMOTE_ADDR'] ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="header">
                    <h4 class="title"><i class="pe-7s-config"></i> Session Information</h4>
                </div>
                <div class="content">
                    <table class="table table-bordered table-striped" style="font-family: Roboto;font-weight: 300;">
                        <tbody>
                        <thead>
                        <tr>
                            <th class="text-center" style="color: #000;"><i class="fa fa-file-text-o"></i> DATA</th>
                            <th class="text-center" style="color: #000;"><i class="fa fa-map-marker"></i> IP ADDRESS</th>
                        </tr>
                        </thead>
                        <?php
                        if($data_session != NULL):
                        foreach($data_session->result() as $hasil):
                            ?>
                            <tr>
                                <td><?php echo $hasil->data ?></td>
                                <td><?php echo $hasil->ip_address ?></td>
                            </tr>
                            <?php
                        endforeach;
                        ?>
                        </tbody>
                    </table>
                    <?php else : ?>
                        </tbody>
                        </table>
                        <div class="alert alert-danger">
                            <span><b> Warning! </b> Data tidak ada didatabase </span>
                        </div>
                        <div class="reload" style="text-align: center;margin-bottom: 7px">
                            <a  href="<?php echo base_url('auth/sistem?source=reload&utf8=✓') ?>" class="btn btn-danger btn-reset" id="load" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Reloading..."><i class="fa fa-repeat"></i> Reload Page</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>