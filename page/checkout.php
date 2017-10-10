<!DOCTYPE html>
<?php
  ob_start();
  @session_start();
  include("../Env/config.php");
?>
<html>
<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  $file_path = $root . '/lip-inc/components/header.php';
  include($file_path);
?>
  <body>
    <?php
      $root = $_SERVER['DOCUMENT_ROOT'];
      $file_path = $root . '/lip-inc/components/navbar.php';
      include($file_path);
    ?>

    <div class="page">
      <div class="container">
        <div class="columns">
          <div class="column is-3">
            <?php
              $root = $_SERVER['DOCUMENT_ROOT'];
              $file_path = $root . '/lip-inc/components/side-menu.php';
              include($file_path);
            ?>
          </div>
          <div class="column is-9">
            <div class="container">
              <h1 class="title" style="margin-top:30px">
                เช็คเอ้าสินค้า
              </h1>
              <table class="table" style="width:70%">
                <thead>
                  <tr>
                    <th>ชื่อสินค้า</th>
                    <th>ราคา</th>
                    <th>จำนวน</th>
                    <th>ราคารวม</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                $Total = 0;
                $SumTotal = 0;

                for($i=0;$i<=(int)$_SESSION["intLine"];$i++)
                {
              	  if($_SESSION["strProductID"][$i] != "")
              	  {
              		$strSQL = "SELECT * FROM product WHERE product_id = '".$_SESSION["strProductID"][$i]."' ";
              		$objQuery = mysql_query($strSQL)  or die(mysql_error());
              		$objResult = mysql_fetch_array($objQuery);
              		$Total = $_SESSION["strQty"][$i] * $objResult["product_price"];
              		$SumTotal = $SumTotal + $Total;
              	  ?>
              	  <tr>
                		<td><?php echo $objResult["product_name"];?></td>
                		<td><?php echo $objResult["product_price"];?></td>
                		<td><?php echo $_SESSION["strQty"][$i];?></td>
                		<td><?php echo number_format($Total,2);?></td>
              	  </tr>
              	  <?php
              	  }
                }
                ?>
                </tbody>
              </table>
              <div class="columns">
                <div class="column">
                  <div style="width:70%">
                    <div class="is-pulled-right">
                      ราคคารวมทั้งหมด : <?php echo number_format($SumTotal,2);?>
                    </div>
                  </div>
                </div>
              </div>
              <?php if(isset($_SESSION['ses_id'])){ ?>
              <h2 class="subtitle">
                ที่อยู่สำหรับจัดส่ง
              </h2>
              <?php
              $strSQL2 = "SELECT * FROM useraccount WHERE id = '".$_SESSION['user_id']."' ";
              $objQuery2 = mysql_query($strSQL2)  or die(mysql_error());
              while($objResult2 = mysql_fetch_array($objQuery2)){
                $name = $objResult2["name"];
                $email = $objResult2["email"];
                $tel = $objResult2["tel"];
                $address = $objResult2["address"];
                $postcode= $objResult2["postcode"];
                $province= $objResult2["province"];
                $amphur= $objResult2["amphur"];
                $district= $objResult2["district"];
              }
              ?>
              <form name="form1" method="post" action="../process/save_checkout.php">
                <div class="field" style="width:30%">
                  <label class="label">ชื่อ</label>
                  <p class="control">
                    <input class="input" type="text" name="txtName" value="<?php echo $name;?>" required="">
                  </p>
                </div>

                <div class="field" style="width:30%">
                  <label class="label">ที่อยู่</label>
                  <p class="control">
                    <input class="input" name="txtAddress" value="<?php echo $address;?>" required="">
                  </p>
                </div>

                <div class="field" style="width:30%">
                  <label class="label">จังหวัด</label>
                  <div class="control">
                    <div class="select">
          						<select class="select2-single" name="province" id="province">
          							<option id="province_list"> เลือกจังหวัด </option>
          						</select>
          					</div>
            			</div>
                </div>
                <input type="hidden" name="hidden_province" value="<?php echo $province;?>">

                <div class="field" style="width:30%">
                  <label class="label">อำเภอ</label>
                  <div class="control">
                    <div class="select">
          						<select class="select2-single" name="amphur" id="amphur">
          							<option id="amphur_list"> เลือกอำเภอ </option>
                      </select>
          					</div>
            			</div>
                </div>
                <input type="hidden" name="hidden_amphur" value="<?php echo $amphur;?>">

                <div class="field" style="width:30%">
            			<label class="label">ตำบล</label>
                  <div class="control">
                    <div class="select">
          						<select class="select2-single" name="district" id="district">
          							<option id="district_list"> เลือกตำบล </option>
                      </select>
          					</div>
            			</div>
                </div>
                <input type="hidden" name="hidden_district" value="<?php echo $district;?>">

                <div class="field" style="width:30%">
                  <label class="label">รหัสไปรษณีย์</label>
                  <p class="control">
                    <input class="input" type="number" name="postcode" value="<?php echo $postcode;?>" required="">
                  </p>
                </div>

                <div class="field" style="width:30%">
                  <label class="label">เบอร์โทร</label>
                  <p class="control">
                    <input class="input" type="text" name="txtTel" value="<?php echo $tel;?>" required="">
                  </p>
                </div>
                <div class="field" style="width:30%">
                  <label class="label">อีเมล</label>
                  <p class="control">
                    <input class="input" type="email" name="txtEmail" value="<?php echo $email;?>" required="">
                  </p>
                </div>
                <input type="submit" class="button is-success" name="Submit" value="ยืนยัน">
              </form>
              <?php
            } else {
              echo '
              <div class="notification is-warning" style="width:70%">
                <div class="has-text-centered">
                  กรุณาเข้าสู่ระบบ ก่อนการสั่งซื้อสินค้า !
                </div>
              </div>';
            }
              mysql_close();
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- นำเข้า Javascript jQuery -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>


  	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>

    <script>

  			$(function(){
          var province_id = $('input[name=hidden_province]').val()
          var amphur_id = $('input[name=hidden_amphur]').val()
          var district_id = $('input[name=hidden_district]').val()

  				//เรียกใช้งาน Select2
  				$(".select2-single").select2();
          $(".select2-selection__arrow").hide();;
          $(".select2-container").css("width","260px");

  				//ดึงข้อมูล province จากไฟล์ get_data.php
  				$.ajax({
  					url:"get_data.php",
  					dataType: "json", //กำหนดให้มีรูปแบบเป็น Json
  					data:{show_province:'show_province'}, //ส่งค่าตัวแปร show_province เพื่อดึงข้อมูล จังหวัด
  					success:function(data){
  						//วนลูปแสดงข้อมูล ที่ได้จาก ตัวแปร data
  						$.each(data, function( index, value ) {
  							//แทรก Elements ใน id province  ด้วยคำสั่ง append
  							  $("#province").append("<option value='"+ value.id +"'> " + value.name + "</option>");
  						});
              $("#province").val(province_id).change();
  					}
  				});


  				//แสดงข้อมูล อำเภอ  โดยใช้คำสั่ง change จะทำงานกรณีมีการเปลี่ยนแปลงที่ #province
  				$("#province").change(function(){

  					//กำหนดให้ ตัวแปร province มีค่าเท่ากับ ค่าของ #province ที่กำลังถูกเลือกในขณะนั้น
  					var province_id = $(this).val();

  					$.ajax({
  						url:"get_data.php",
  						dataType: "json",//กำหนดให้มีรูปแบบเป็น Json
  						data:{province_id:province_id},//ส่งค่าตัวแปร province_id เพื่อดึงข้อมูล อำเภอ ที่มี province_id เท่ากับค่าที่ส่งไป
  						success:function(data){

  							//กำหนดให้ข้อมูลใน #amphur เป็นค่าว่าง
  							$("#amphur").text("");

  							//วนลูปแสดงข้อมูล ที่ได้จาก ตัวแปร data
  							$.each(data, function( index, value ) {

  								//แทรก Elements ข้อมูลที่ได้  ใน id amphur  ด้วยคำสั่ง append
  								  $("#amphur").append("<option value='"+ value.id +"'> " + value.name + "</option>");
  							});
                $("#amphur").val(amphur_id).change();
  						}
  					});

  				});

  				//แสดงข้อมูลตำบล โดยใช้คำสั่ง change จะทำงานกรณีมีการเปลี่ยนแปลงที่  #amphur
  				$("#amphur").change(function(){

  					//กำหนดให้ ตัวแปร amphur_id มีค่าเท่ากับ ค่าของ  #amphur ที่กำลังถูกเลือกในขณะนั้น
  					var amphur_id = $(this).val();

  					$.ajax({
  						url:"get_data.php",
  						dataType: "json",//กำหนดให้มีรูปแบบเป็น Json
  						data:{amphur_id:amphur_id},//ส่งค่าตัวแปร amphur_id เพื่อดึงข้อมูล ตำบล ที่มี amphur_id เท่ากับค่าที่ส่งไป
  						success:function(data){

  							  //กำหนดให้ข้อมูลใน #district เป็นค่าว่าง
  							  $("#district").text("");

  							//วนลูปแสดงข้อมูล ที่ได้จาก ตัวแปร data
  							$.each(data, function( index, value ) {

  							  //แทรก Elements ข้อมูลที่ได้  ใน id district  ด้วยคำสั่ง append
  							  $("#district").append("<option value='" + value.id + "'> " + value.name + "</option>");

  							});
                $("#district").val(district_id).change();
  						}
  					});

  				});

  				//คำสั่ง change จะทำงานกรณีมีการเปลี่ยนแปลงที่  #district
  				$("#district").change(function(){

  					//นำข้อมูลรายการ จังหวัด ที่เลือก มาใส่ไว้ในตัวแปร province
  					var province = $("#province option:selected").text();

  					//นำข้อมูลรายการ อำเภอ ที่เลือก มาใส่ไว้ในตัวแปร amphur
  					var amphur = $("#amphur option:selected").text();

  					//นำข้อมูลรายการ ตำบล ที่เลือก มาใส่ไว้ในตัวแปร district
  					var district = $("#district option:selected").text();

  				});

          //นำข้อมูลรายการ จังหวัด ที่เลือก มาใส่ไว้ในตัวแปร province
          // $("#province option[value='1']:selected").text();
          $('#province').val(1)
          $('#province option[value="1"]').attr("selected",true);

          //นำข้อมูลรายการ อำเภอ ที่เลือก มาใส่ไว้ในตัวแปร amphur
          $("#amphur option:selected").text();

          //นำข้อมูลรายการ ตำบล ที่เลือก มาใส่ไว้ในตัวแปร district
          $("#district option:selected").text();


  			});

  	</script>

    <?php
      $root = $_SERVER['DOCUMENT_ROOT'];
      $file_path = $root . '/lip-inc/components/footer.php';
      include($file_path);
    ?>


    </body>
    </html>
