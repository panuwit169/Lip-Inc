<!DOCTYPE html>
<html>
<?php
  include("../Env/config.php");
?>
<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  $file_path = $root . '/lip-inc/components/header.php';
  include($file_path);
?>
<body>
  <section class="hero is-fullheight is-dark is-bold">
    <div class="hero-body">
      <div class="container">
        <div class="columns is-vcentered" style="margin-top: 3.5rem;">
          <div class="column is-10 is-offset-1">
            <h1 class="title">
              สมัครสมาชิก
            </h1>
            <form class="" action="../process/save_register.php" method="post">
              <div class="box">
                <div class="row column is-6" style="display: inline-block;">
                  <label class="label">ชื่อ</label>
                  <p class="control">
                    <input class="input" type="text" name="name" placeholder="ชื่อ-สกุล" required="">
                  </p>
                </div>
                <div class="row column is-5" style="display: inline-block;">
                  <label class="label">ชื่อผู้ใช้</label>
                  <p class="control">
                    <input class="input" type="text" name="username" placeholder="ไม่เกิน 8 ตัวอักษร" required="">
                  </p>
                </div>
                <div class="row column is-6" style="display: inline-block;">
                  <label class="label">รหัสผ่าน</label>
                  <p class="control">
                    <input class="input" type="password" name="password" placeholder="ไม่เกิน 8 ตัวอักษร" required="">
                  </p>
                </div>
                <div class="row column is-5" style="display: inline-block;">
                  <label class="label">อีเมล</label>
                  <p class="control">
                    <input class="input" type="email" name="email" placeholder="อีเมล" required="">
                  </p>
                </div>

                <hr>
                <div class="row column is-12" style="display: inline-block;">
                  <label class="label">ที่อยู่</label>
                  <p class="control">
                    <input class="input" type="text" name="address" required="">
                  </p>
                </div>
                <div class="row column is-6" style="display: inline-block;">
                  <label class="label">จังหวัด</label>
                  <div class="control">
                    <div class="select">
          						<select class="select2-single" name="province" id="province">
          							<option id="province_list"> เลือกจังหวัด </option>
          						</select>
          					</div>
            			</div>
                </div>

                <div class="row column is-5" style="display: inline-block;">
                <label class="label">อำเภอ</label>
                <div class="control">
                  <div class="select">
        						<select class="select2-single" name="amphur" id="amphur">
        							<option id="amphur_list"> เลือกอำเภอ </option>
                    </select>
        					</div>
          			</div>
                </div>

                <div class="row column is-6" style="display: inline-block;">
            			<label class="label">ตำบล</label>
                  <div class="control">
                    <div class="select">
          						<select class="select2-single" name="district" id="district">
          							<option id="district_list"> เลือกตำบล </option>
                      </select>
          					</div>
            			</div>
                </div>

                <div class="row column is-5" style="display: inline-block;">
                  <label class="label">รหัสไปรษณีย์</label>
                  <p class="control">
                    <input class="input" type="number" name="postcode" required="">
                  </p>
                </div>

                <div class="row column is-6" style="display: inline-block;">
                  <label class="label">เบอร์โทร</label>
                  <p class="control">
                    <input class="input" type="text" name="tel" required="">
                  </p>
                </div>

                <p class="control" style="text-align: center;">
                  <input type="submit" class="button is-primary" value="สมัคร">
                  <a href="../page/login.php" class="button is-default">ยกเลิก</a>
                </p>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

  </section>
  <!-- นำเข้า Javascript jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>


	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>

	<script>

			$(function(){
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
            console.log(data)

						//วนลูปแสดงข้อมูล ที่ได้จาก ตัวแปร data
						$.each(data, function( index, value ) {
							//แทรก Elements ใน id province  ด้วยคำสั่ง append
							  $("#province").append("<option value='"+ value.id +"'> " + value.name + "</option>");
						});
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


			});

	</script>
</body>
</html>
