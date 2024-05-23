<?php
 session_start();
 define('URL' , 'http://localhost/php/theme/');
 ob_start();
 require '../Authentication/config.php' ;
?>
<?php 
if(!isset($_SESSION['user_name'])){
  header('location:'.URL.'Authentication/Login.php?message=يجب عليك تسجيل الدخول لامكانية حجز الخدمة ');
  exit();
}
if($_SESSION['user_type'] == 'worker'){
  header('location:'.URL.'index.php?message=لا يمكنك حجز خدمة من هذا الحساب, انشأ حساب عميل ليمكنك حجز خدمة');
  exit();
}
if(isset($_GET['Sid'])){
   $Sid = $_GET['Sid'];
   $Uid = $_SESSION['user_id'];
    // check if the user already booked a service 
    $select1=$conn->prepare("SELECT * FROM books where user_id = '$Uid' ");
    $select1->execute();
    if($select1->rowCount()>0){
      //type a message in index page that the user already booked a service
      header('location:'.URL.'index.php?message=انت بالفعل حجزت خدمة , انتظر لانهاء الخدمة لتسطيع الحجز مرة اخرى') ;
      exit();
    }
   // fetch user info from user table
    $select=$conn->query("SELECT * FROM user WHERE user_id = '$Uid' ");
    $select->execute();
    $user = $select->fetch(PDO::FETCH_OBJ);
    //fetch info about the service that user pick 
    $select = $conn->query("SELECT * FROM services Where id = '$Sid' ");
    $select->execute();
    $services = $select->fetch(PDO::FETCH_OBJ);
    //fetch worker info that have the same category of the user service and location 
    $select =$conn->query("SELECT * FROM worker WHERE servicetype = '$services->category' AND location = '$user->loc' ");
    $select->execute();
    $workers = $select->fetchAll(PDO::FETCH_OBJ);
}
?>
<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../plugins/bootstrap/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../plugins/rating-plugin/src/css/star-rating-svg.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
* {
  box-sizing: border-box;
}

body {
  background-image: url("../images/slider/slider-bg-1.jpg");
}

#regForm {
  background-color: #ffffff;
  margin: 100px auto;
  font-family: Raleway;
  padding: 40px;
  width: 70%;
  min-width: 300px;
}

h1 {
  text-align: center;  
}

input {
  padding: 10px;
  width: 100%;
  font-size: 17px;
  border: 1px solid #aaaaaa;
}

/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

button {
  background-color: blue;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
  outline: none;

}

button:hover {
  opacity: 0.8;
}

#prevBtn {
  background-color: #bbbbbb;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;  
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #70a2d8;
}
.TimeOsService {
    background-color: #f2f2f2; /* Light grey background */
    border: 1px solid #ccc; /* Grey border */
    border-radius: 4px; /* Rounded borders */
    padding: 10px 15px; /* Some padding inside the select box */
    font-size: 16px; /* Increase font size */
    color: #333; /* Darker font color */
    margin-bottom: 15px;
    width: 200px;
    text-align: right;
  }
  
  .TimeOsService:focus {
    outline: none; /* Removes the default focus outline */
    border-color: #70a2d8; /* Blue border for focus */
  }

  /* Style for options */
  option {
    padding: 5px;
  }
  .radio-input input {
  display: none;
}

.radio-input {
  display: flex;
  flex-direction: column;
  padding: 5px;
  background: #fff;
  color: #000;
  width: 300px;
}

.info {
  margin-bottom: 10px;
  padding: 10;
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.question {
  color: rgb(49, 49, 49);
  font-size: 1rem;
  line-height: 1rem;
  font-weight: 800;
}

.steps {
  background-color: rgb(0, 0, 0);
  padding: 4px;
  color: #fff;
  border-radius: 4px;
  font-size: 12px;
  line-height: 12px;
  font-weight: 600;
}

.radio-input  label {
  
  background-color: #fff;
 
  font-size: 13px;
  font-weight: 600;
  border-radius: 10px;
  cursor: pointer;
  border: 1px solid rgba(187, 187, 187, 0.164);
  color: #000;
  transition: .3s ease;
  width:400px;
  

}

.radio-input  label:hover {
  background-color: rgba(24, 24, 24, 0.13);
  border: 1px solid #bbb;
}

.result {
  margin-top: 10px;
  font-weight: 600;
  font-size: 12px;
  display: none;
  transition: display .4s ease;
}

.radio-input input:checked + label {
  border-color: gray;
  color: gray;
}
.label {
 
  flex-direction: row;
  justify-content: center;
  align-items: center;
 
  
  
}
.label img {
  width: 50% !important;
  margin : 0px 10px;
  clip-path: circle(60px);
}
.label span {
  font-size: 20px;
}

.radio-inputsis {
  display: flex;
  justify-content: space-between;
  align-items: center;
  max-width: 350px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  margin: auto;
}
.radio-inputsis > * {
  margin: 6px;
}
.radio-inputt:checked + .radio-tile {
  border-color: #2260ff;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
  color: #2260ff;
}
.radio-inputt:checked + .radio-tile:before {
  transform: scale(1);
  opacity: 1;
  background-color: #2260ff;
  border-color: #2260ff;
}
.radio-inputt:checked + .radio-tile .radio-icon svg {
  fill: #2260ff;
}
.radio-inputt:checked + .radio-tile .radio-label {
  color: #2260ff;
}
.radio-inputt:focus + .radio-tile {
  border-color: #2260ff;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1), 0 0 0 4px #b5c9fc;
}
.radio-inputt:focus + .radio-tile:before {
  transform: scale(1);
  opacity: 1;
}
.radio-tile {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  width: 80px;
  min-height: 80px;
  border-radius: 0.5rem;
  border: 2px solid #b5bfd9;
  background-color: #fff;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
  transition: 0.15s ease;
  cursor: pointer;
  position: relative;
}
.radio-tile:before {
  content: "";
  position: absolute;
  display: block;
  width: 0.75rem;
  height: 0.75rem;
  border: 2px solid #b5bfd9;
  background-color: #fff;
  border-radius: 50%;
  top: 0.25rem;
  left: 0.25rem;
  opacity: 0;
  transform: scale(0);
  transition: 0.25s ease;
}
.radio-tile:hover {
  border-color: #2260ff;
}
.radio-tile:hover:before {
  transform: scale(1);
  opacity: 1;
}
.radio-icon svg {
  width: 2rem;
  height: 2rem;
  fill: #494949;
}
.radio-label {
  color: #707070;
  transition: 0.375s ease;
  text-align: center;
  font-size: 13px;
}
.radio-inputt{
  clip: rect(0 0 0 0);
  -webkit-clip-path: inset(100%);
  clip-path: inset(100%);
  height: 1px;
  overflow: hidden;
  position: absolute;
  white-space: nowrap;
  width: 1px;
}

/*.social-link {
    width: 30px;
    height: 30px;
    border: 1px solid #ddd;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #666;
    border-radius: 50%;
    transition: all 0.3s;
    font-size: 0.9rem;
}

.social-link:hover, .social-link:focus {
    background: #ddd;
    text-decoration: none;
    color: #555;
}
*/
</style>
<body>
<div class="container"></div>
<form id="regForm" action="Approve.php?Uid=<?php echo $Uid;?>&Sid=<?php echo $Sid ?>" method="POST">
  <h1>حجز الخدمة</h1>
  <!-- One "tab" for each step in the form: -->

  <div class="tab" style="text-align: right;">
    <h2>
        : هل تريد هذه الخدمة خلال
    </h2>    
    <select name="booking_time" id="" class="TimeOsService">
        <option value="حالاً">حالاً</option>
        <option value="خلال شهر">خلال شهر</option>
        <option value="خلال اسبوع "> خلال اسبوع </option>
    </select>
  </div>
  <div class="tab" style="text-align: right;">
    <h2>
        : نوع الموقع
    </h2>
    <select name="locType" id="" class="TimeOsService">
        <option value="المنزل">المنزل</option>
        <option value="العمل">العمل</option>
    </select>
  </div>
  <div class="tab" style="text-align: right;">
    <h2>
        : حجم الموقع
    </h2>
    <select name="locSize" id="" class="TimeOsService">
        <option value="اقل من 200 متر مربع"> اقل من 200 متر مربع </option>
        <option value="اكبر من 200 متر مربع"> اكبر من 200 متر مربع </option>
    </select>
  </div>
  <div class="tab" style="text-align: center;">
    <h2>
        : اخبرنا اكثر عن المشكلة 
    </h2>
    <textarea name="details" id="" cols="30" rows="5"></textarea>
  </div>
  <div class="tab" style="text-align: right;">
    <h3>تأكيد معلوماتك</h3>
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <h5> <?php  echo $user->username ;?> : الإسم </h5>
            <h5> العنوان :<?php  echo $user->loc ;?>  </h5>
        </div>
        <div class="col-md-6 col-sm-12">
            <h5> <?php echo $user->email;  ?> : البريد الإلكتروني </h5>
            <h5>  <?php  echo $user->phone ;?> : رقم الهاتف </h5>
        </div>
    </div>
  </div>
  <div class="tab " style="text-align: right; direction: rtl;">
    <div class="radio-input" style="text-align: right;">

      <div class="info" style="text-align: right;">
      <span class="question">إختر مُقدم الخدمة</span>
       </div>
       <div class="row text-center ">
        
      <?php
       foreach( $workers as $worker ){?>
        <div>
        <input type="radio" id="value-<?php echo $worker->id;?>" name="worker" value="<?php echo $worker->id;?>">
      <label for="value-<?php echo $worker->id;?>" class="label" width="200%">
        <img src="../images/users_img/<?php echo $worker->img ; ?>">
        <span> <?php echo $worker->fullname ?>  </span>
        <div>
        <div class="my-rating" dir="ltr">
                                      
        <i class="bi bi-star-fill text-warning"></i>
        <i class="bi bi-star-fill text-warning"></i>
        <i class="bi bi-star-fill text-warning"></i>
        <i class="bi bi-star-fill text-warning "></i>
        <i class="bi bi-star-fill text-warning"></i>

      </div>
              خبرة <?php echo $worker->experience  ; ?>
         <h6 class="text-<?php if($worker->availability == 1 ) {echo 'success' ;}else{ echo 'danger' ; }?>"> <?php if( $worker->availability == 1) { echo  "  متاح حاليا" ; }else{ echo "  غير متاح حاليا" ; }?> </h6>
        </div>
      

    
      </label>
      </div>
          <?php  } ?>
        </div>
    </div>
  </div>
  
  <!--
<div class="tab">
  <p class="question mt-5" style="text-align: center;">اختر طريقة الدفع</p>
  <div class="radio-inputsis ">
    <label>
      <input class="radio-inputt" type="radio" name="payment" value="cash">
        <span class="radio-tile">
              <span class="radio-icon">
                <img src="../images/cash-payment.svg" alt="" style="width: 50px;" >
              </span>
              <span class="radio-label">كاش</span>
            </span>
    </label>
    <label>
      <input checked="" class="radio-inputt" type="radio" name="payment" value="online">
      <span class="radio-tile">
            <span class="radio-icon">
              <img src="../images/online-payment.svg" alt="" style="width: 50px;" >
            </span>
            <span class="radio-label">اونلاين</span>
          </span>
    </label>
</div>
</div>
       -->
  <div style="overflow:auto;">
    <div style="float:right;">
      <button type="button" id="prevBtn" onclick="nextPrev(-1)" class="btn btn-secondary">السابق</button>
      <button type="button" id="nextBtn" onclick="nextPrev(1)" class="btn btn-primary">التالي</button>
      <button type="submit" name="submit" id="submit" class="btn btn-primary" style="display:none">حجز</button>
    </div>
  </div>
  <!-- Circles which indicates the steps of the form: -->
  <div style="text-align:center;margin-top:40px;">
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
  </div>
</form>
</div>

<script>
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("submit").style.display = "inline";
    document.getElementById("nextBtn").style.display = "none";
  } else {
    document.getElementById("nextBtn").innerHTML = "التالي";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}
</script>
<script src="/plugins/bootstrap/bootstrap.js"></script>
<script src="/plugins/bootstrap/bootstrap.min.js"></script>
<script src="../plugins/rating-plugin/dist/jquery.star-rating-svg.js"></script>
 
<script>

$(".my-rating").starRating({
    readOnly: true,
    starSize: 25,
    initialRating : <?php 
        if(isset($workers->rating)){
           echo  $workers->rating ;
           }  
          else{
            echo "0";    
            }
    ?>,
  })
 
</script> 

</body>
</html>
