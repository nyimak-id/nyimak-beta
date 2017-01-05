<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="card">
                <div class="header">
                    <h4 class="title"><i class="pe-7s-graph2"></i> Statistik Pengunjung</h4>
                </div>
                <div class="content">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="card-visitor" style="background-color: #f1f1f1;margin-bottom: 10px">
                                <div class="header" style="text-align: center">
                                    <h5 class="title"><i class="fa fa-user-circle"></i> HARI INI</h5>
                                </div>
                                <div class="count-visitor" style="text-align: center;margin-bottom: 15px;padding-bottom: 30px;margin-top: 20px;font-size: 20px;font-family: Roboto;font-weight: 300">
                                    <?php //print $today_visit ?>98,8906
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="card-visitor" style="background-color: #f1f1f1;margin-bottom: 10px">
                                <div class="header" style="text-align: center">
                                    <h5 class="title"><i class="fa fa-user-circle"></i> MINGGU INI</h5>
                                </div>
                                <div class="count-visitor" style="text-align: center;margin-bottom: 15px;padding-bottom: 30px;margin-top: 20px;font-size: 20px;font-family: Roboto;font-weight: 300">
                                    <?php //print $week_visit ?>789,987,890
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="card-visitor" style="background-color: #f1f1f1;margin-bottom: 10px">
                                <div class="header" style="text-align: center">
                                    <h5 class="title"><i class="fa fa-user-circle"></i> BULAN INI</h5>
                                </div>
                                <div class="count-visitor" style="text-align: center;margin-bottom: 15px;padding-bottom: 30px;margin-top: 20px;font-size: 20px;font-family: Roboto;font-weight: 300">
                                    <?php //print $month_visit ?>8907,876543,00
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="card-visitor" style="background-color: #f1f1f1;margin-bottom: 10px">
                                <div class="header" style="text-align: center">
                                    <h5 class="title"><i class="fa fa-user-circle"></i> TAHUN INI</h5>
                                </div>
                                <div class="count-visitor" style="text-align: center;margin-bottom: 15px;padding-bottom: 30px;margin-top: 20px;font-size: 20px;font-family: Roboto;font-weight: 300">
                                    <?php //print $year_visit ?>9000786.987,980
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card">
                <div class="header">
                    <h4 class="title"><i class="pe-7s-graph2"></i> Grafik Pengunjung</h4>
                </div>
                <div class="content" style="font-family: Roboto;font-weight: 300">
                    <div class="btn-group">
                        <button type="button" id="hari" onclick="javascript:GetToday('<?php print date("Y-m-d") ?>')" class="btn btn-default btn-sm" style="border-radius: 0px;border-width: 1px;"><i class="fa fa-bar-chart-o"></i></i> Hari ini</button>
                        <button type="button" id="minggu" onclick="javascript:GetWeek(<?php print date("Y-m-d") ?>, <?php print date( "Y-m-d", strtotime( date("Y-m-d"). "-7 day" ) ) ?>)" class="btn btn-default btn-sm" style="border-radius: 0px;border-width: 1px;"><i class="fa fa-bar-chart-o"></i></i> Minggu ini</button>
                        <button type="button" id="bulan" onclick="javascript:GetMonth(<?php print date("Y-m-d") ?>)" class="btn btn-default btn-sm" style="border-radius: 0px;border-width: 1px;"><i class="fa fa-bar-chart-o"></i></i> Bulan ini</button>
                        <button type="button" id="tahun" onclick="javascript:GetAllTime()" class="btn btn-default btn-sm" style="border-radius: 0px;border-width: 1px;"><i class="fa fa-bar-chart-o"></i></i> Semua</button>
                    </div>
                    <hr>
                    <div id="container"></div>
                </div>
            </div>
        </div>
    </div>
</div>