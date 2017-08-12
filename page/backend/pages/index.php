<!DOCTYPE html>
<?php
include("fusioncharts.php");
ob_start();
@session_start();
include("../../../Env/config.php");

if($_SESSION['status'] != 1){
  echo "<meta http-equiv='refresh' content='1;URL=../../../index.php'>";
} else if (!isset($_SESSION['status'])) {
  echo "<meta http-equiv='refresh' content='1;URL=../../../index.php'>";
} else if ($_SESSION['status'] == null) {
  echo "<meta http-equiv='refresh' content='1;URL=../../../index.php'>";
}
?>
<html lang="en">

<!-- Header -->
<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  $file_path = $root . '/lip-inc/components/backend/header.php';
  include($file_path);
?>
<script type="text/javascript" src="../../../js/fusioncharts.js"></script>
<script type="text/javascript" src="../../../js/fusioncharts.theme.carbon.js"></script>
<script type="text/javascript" src="../../../js/fusioncharts.charts.js"></script>
<body>

    <div id="wrapper">
        <!-- Navigation -->
        <?php
          $root = $_SERVER['DOCUMENT_ROOT'];
          $file_path = $root . '/lip-inc/components/backend/navbar.php';
          include($file_path);
        ?>
        <!-- Side Menu -->
        <?php
          $root = $_SERVER['DOCUMENT_ROOT'];
          $file_path = $root . '/lip-inc/components/backend/side-menu.php';
          include($file_path);
        ?>
      </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-shopping-basket fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                  <?php
                                    $sqltxt = "SELECT COUNT(*) FROM orders JOIN payment ON orders.order_id = payment.order_id WHERE payment.status = 'notcheck' ORDER BY payment.id ASC";
                                    $result = mysql_query($sqltxt,$con);
                                    while($rs = mysql_fetch_array($result)){
                                  ?>
                                    <div class="huge"><?php echo $rs[0];?></div>
                                  <?php
                                    }
                                  ?>
                                    <div>รายการสั่งซื้อใหม่</div>
                                </div>
                            </div>
                        </div>
                        <a href="order.php">
                            <div class="panel-footer">
                                <span class="pull-left">ดูรายละเอียด</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                  <?php
                                    $sqltxt2 = "SELECT COUNT(*) FROM product";
                                    $result2 = mysql_query($sqltxt2,$con);
                                    while($rs2 = mysql_fetch_array($result2)){
                                  ?>
                                    <div class="huge"><?php echo $rs2[0];?></div>
                                  <?php
                                    }
                                  ?>
                                    <div>จำนวนสินค้าทั้งหมด</div>
                                </div>
                            </div>
                        </div>
                        <a href="product.php">
                            <div class="panel-footer">
                                <span class="pull-left">ดูรายละเอียด</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-users fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                  <?php
                                    $sqltxt3 = "SELECT COUNT(*) FROM useraccount";
                                    $result3 = mysql_query($sqltxt3,$con);
                                    while($rs3 = mysql_fetch_array($result3)){
                                  ?>
                                    <div class="huge"><?php echo $rs3[0];?></div>
                                  <?php
                                    }
                                  ?>
                                    <div>สมาชิกทั้งหมด</div>
                                </div>
                            </div>
                        </div>
                        <a href="user.php">
                            <div class="panel-footer">
                                <span class="pull-left">ดูรายละเอียด</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <?php
            $sqltxt0 = "SELECT * FROM orders JOIN payment ON orders.order_id = payment.order_id JOIN orders_detail ON orders.order_id = orders_detail.order_id WHERE payment.status = 'checked' ORDER BY payment.id ASC ";
            $result0 = mysql_query ($sqltxt0,$con);
            $arrData0 = array(
                "chart" => array(
                    "xAxisName"=> "ชื่อเดือน",
                    "yAxisName"=> "ยอดขาย (บาท)",
                    "showBorder" => "0",
                    "numberPrefix"=> "฿",
                    "captionFontSize" => "16",
                    "xAxisNameFontSize" => "14",
                    "yAxisNameFontSize" => "14",
                    "paletteColors" => "#0075c2",
                    "bgColor" => "#ffffff",
                    "usePlotGradientColor"=> "0",
                    "showXAxisLine"=> "1",
                    "showAlternateHGridColor" => "0"
                  )
              );

            $arrData0["data"] = array();
            $month01 = 'ม.ค.';
            $month02 = "ก.พ.";
            $month03 = "มี.ค.";
            $month04 = "เม.ย.";
            $month05 = "พ.ค.";
            $month06 = "มิ.ย.";
            $month07 = "พ.ค.";
            $month08 = "ส.ค.";
            $month09 = "ก.ค.";
            $month10 = "ต.ค.";
            $month11 = "พ.ย.";
            $month12 = "ธ.ค.";
            $sales01 = 0;
            $sales02 = 0;
            $sales03 = 0;
            $sales04 = 0;
            $sales05 = 0;
            $sales06 = 0;
            $sales07 = 0;
            $sales08 = 0;
            $sales09 = 0;
            $sales10 = 0;
            $sales11 = 0;
            $sales12 = 0;
            while($row0 = mysql_fetch_array($result0)){
              if(date("m",strtotime($row0["OrderDate"])) == 01){
                $month01 = 'ม.ค.';
                $sales01 += $row0["amount"];
              }
              else if (date("m",strtotime($row0["OrderDate"])) == 02){
                $month02 = "ก.พ.";
                $sales02 += $row0["amount"];
              }
              else if (date("m",strtotime($row0["OrderDate"])) == 03){
                $month03 = "มี.ค.";
                $sales03 += $row0["amount"];
              }
              else if (date("m",strtotime($row0["OrderDate"])) == 04){
                $month04 = "เม.ย.";
                $sales04 += $row0["amount"];
              }
              else if (date("m",strtotime($row0["OrderDate"])) == 05){
                $month05 = "พ.ค.";
                $sales05 += $row0["amount"];
              }
              else if (date("m",strtotime($row0["OrderDate"])) == 06){
                $month06 = "มิ.ย.";
                $sales06 += $row0["amount"];
              }
              else if (date("m",strtotime($row0["OrderDate"])) == 07){
                $month07 = "พ.ค.";
                $sales07 += $row0["amount"];
              }
              else if (date("m",strtotime($row0["OrderDate"])) == 08){
                $month08 = "ส.ค.";
                $sales08 += $row0["amount"];
              }
              else if (date("m",strtotime($row0["OrderDate"])) == 09){
                $month09 = "ก.ค.";
                $sales09 += $row0["amount"];
              }
              else if (date("m",strtotime($row0["OrderDate"])) == 10){
                $month10 = "ต.ค.";
                $sales10 += $row0["amount"];
              }
              else if (date("m",strtotime($row0["OrderDate"])) == 11){
                $month11 = "พ.ย.";
                $sales11 += $row0["amount"];
              }
              else if (date("m",strtotime($row0["OrderDate"])) == 12){
                $month12 = "ธ.ค.";
                $sales12 += $row0["amount"];
              }
            }

            $arrData0["data"] = array(
              array(
                "label" => $month01,
                "value" => $sales01
              ),
              array(
                "label" => $month02,
                "value" => $sales02
              ),
              array(
                "label" => $month03,
                "value" => $sales03
              ),
              array(
                "label" => $month04,
                "value" => $sales04
              ),
              array(
                "label" => $month05,
                "value" => $sales05
              ),
              array(
                "label" => $month06,
                "value" => $sales06
              ),
              array(
                "label" => $month07,
                "value" => $sales07
              ),
              array(
                "label" => $month08,
                "value" => $sales08
              ),
              array(
                "label" => $month09,
                "value" => $sales09
              ),
              array(
                "label" => $month10,
                "value" => $sales10
              ),
              array(
                "label" => $month11,
                "value" => $sales11
              ),
              array(
                "label" => $month12,
                "value" => $sales12
              ));

            $jsonEncodedData0 = json_encode($arrData0);
            $columnChart0 = new FusionCharts("column2D", "saleChart" , "100%", 500, "sales_chart", "json", $jsonEncodedData0);
            $columnChart0->render();

            $sqltxt = "SELECT * FROM orders JOIN payment ON orders.order_id = payment.order_id JOIN orders_detail ON orders.order_id = orders_detail.order_id WHERE payment.status = 'checked' ORDER BY payment.id ASC ";
            $result = mysql_query ($sqltxt,$con);
            $arrData = array(
                "chart" => array(
                    "xAxisName"=> "ชื่อเดือน",
                    "yAxisName"=> "จำนวนสินค้าที่ขายได้ (หน่วย)",
                    "showBorder" => "0",
                    "captionFontSize" => "16",
                    "xAxisNameFontSize" => "14",
                    "yAxisNameFontSize" => "14",
                    "paletteColors" => "#0075c2",
                    "bgColor" => "#ffffff",
                    "usePlotGradientColor"=> "0",
                    "showXAxisLine"=> "1",
                    "showAlternateHGridColor" => "0"
                  )
              );

            $arrData["data"] = array();
            $month01 = 'ม.ค.';
            $month02 = "ก.พ.";
            $month03 = "มี.ค.";
            $month04 = "เม.ย.";
            $month05 = "พ.ค.";
            $month06 = "มิ.ย.";
            $month07 = "พ.ค.";
            $month08 = "ส.ค.";
            $month09 = "ก.ค.";
            $month10 = "ต.ค.";
            $month11 = "พ.ย.";
            $month12 = "ธ.ค.";
            $qty01 = 0;
            $qty02 = 0;
            $qty03 = 0;
            $qty04 = 0;
            $qty05 = 0;
            $qty06 = 0;
            $qty07 = 0;
            $qty08 = 0;
            $qty09 = 0;
            $qty10 = 0;
            $qty11 = 0;
            $qty12 = 0;
            while($row = mysql_fetch_array($result)){
              if(date("m",strtotime($row["OrderDate"])) == 01){
                $month01 = 'ม.ค.';
                $qty01 += $row["qty"];
              }
              else if (date("m",strtotime($row["OrderDate"])) == 02){
                $month02 = "ก.พ.";
                $qty02 += $row["qty"];
              }
              else if (date("m",strtotime($row["OrderDate"])) == 03){
                $month03 = "มี.ค.";
                $qty03 += $row["qty"];
              }
              else if (date("m",strtotime($row["OrderDate"])) == 04){
                $month04 = "เม.ย.";
                $qty04 += $row["qty"];
              }
              else if (date("m",strtotime($row["OrderDate"])) == 05){
                $month05 = "พ.ค.";
                $qty05 += $row["qty"];
              }
              else if (date("m",strtotime($row["OrderDate"])) == 06){
                $month06 = "มิ.ย.";
                $qty06 += $row["qty"];
              }
              else if (date("m",strtotime($row["OrderDate"])) == 07){
                $month07 = "พ.ค.";
                $qty07 += $row["qty"];
              }
              else if (date("m",strtotime($row["OrderDate"])) == 08){
                $month08 = "ส.ค.";
                $qty08 += $row["qty"];
              }
              else if (date("m",strtotime($row["OrderDate"])) == 09){
                $month09 = "ก.ค.";
                $qty09 += $row["qty"];
              }
              else if (date("m",strtotime($row["OrderDate"])) == 10){
                $month10 = "ต.ค.";
                $qty10 += $row["qty"];
              }
              else if (date("m",strtotime($row["OrderDate"])) == 11){
                $month11 = "พ.ย.";
                $qty11 += $row["qty"];
              }
              else if (date("m",strtotime($row["OrderDate"])) == 12){
                $month12 = "ธ.ค.";
                $qty12 += $row["qty"];
              }
            }

            $arrData["data"] = array(
              array(
                "label" => $month01,
                "value" => $qty01
              ),
              array(
                "label" => $month02,
                "value" => $qty02
              ),
              array(
                "label" => $month03,
                "value" => $qty03
              ),
              array(
                "label" => $month04,
                "value" => $qty04
              ),
              array(
                "label" => $month05,
                "value" => $qty05
              ),
              array(
                "label" => $month06,
                "value" => $qty06
              ),
              array(
                "label" => $month07,
                "value" => $qty07
              ),
              array(
                "label" => $month08,
                "value" => $qty08
              ),
              array(
                "label" => $month09,
                "value" => $qty09
              ),
              array(
                "label" => $month10,
                "value" => $qty10
              ),
              array(
                "label" => $month11,
                "value" => $qty11
              ),
              array(
                "label" => $month12,
                "value" => $qty12
              ));

            $jsonEncodedData = json_encode($arrData);
            $columnChart = new FusionCharts("column2D", "myFirstChart" , "100%", 500, "chart-1", "json", $jsonEncodedData);
            $columnChart->render();

            $sqltxt2 = "SELECT * FROM product order by product_id ASC";
            $result2 = mysql_query ($sqltxt2,$con);
            $arrData2 = array(
                "chart" => array(
                    "xAxisName"=> "ชื่อสินค้า",
                    "yAxisName"=> "จำนวนสินค้า",
                    "showBorder" => "0",
                    "captionFontSize" => "16",
                    "xAxisNameFontSize" => "14",
                    "yAxisNameFontSize" => "14",
                    "paletteColors" => "#0075c2",
                    "bgColor" => "#ffffff",
                    "usePlotGradientColor"=> "0",
                    "showXAxisLine"=> "1",
                    "showAlternateHGridColor" => "0"
                  )
              );

            $arrData2["data"] = array();
            while($row2 = mysql_fetch_array($result2)){
              array_push($arrData2["data"], array(
                  "label" => $row2["product_name"],
                  "value" => $row2["product_num"]
                  )
              );
            }
            $jsonEncodedData2 = json_encode($arrData2);
            $columnChart2 = new FusionCharts("column2D", "chart_product" , "100%", 600, "chart-2", "json", $jsonEncodedData2);
            $columnChart2->render();

            ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> ยอดขายสินค้าแต่ละเดือน (บาท)
                            <!-- <div class="pull-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                        Actions
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li><a href="#">Action</a>
                                        </li>
                                        <li><a href="#">Another action</a>
                                        </li>
                                        <li><a href="#">Something else here</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a>
                                        </li>
                                    </ul>
                                </div>
                            </div> -->
                        </div>
                        <div class="panel-body">
                          <div id="sales_chart" style="padding: 1rem"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> ยอดขายสินค้าแต่ละเดือน (หน่วย)
                            <!-- <div class="pull-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                        Actions
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li><a href="#">Action</a>
                                        </li>
                                        <li><a href="#">Another action</a>
                                        </li>
                                        <li><a href="#">Something else here</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a>
                                        </li>
                                    </ul>
                                </div>
                            </div> -->
                        </div>
                        <div class="panel-body">
                          <div id="chart-1" style="padding: 1rem"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> จำนวนสินค้าคงเหลือทั้งหมด
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                          <div id="chart-2" style="padding: 1rem"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
      $root = $_SERVER['DOCUMENT_ROOT'];
      $file_path = $root . '/lip-inc/components/backend/script.php';
      include($file_path);
    ?>

</body>

</html>
