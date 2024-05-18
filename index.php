<?php  require 'layout/Header.php' ?>
<?php  require 'Authentication/config.php' ;
       require 'script.php'; 
?>


 <!--
Welcome Slider
==================================== -->
<?php 
  if(isset($_GET['message'])){
     $message = $_GET['message'];
    echo " <script> alert('$message') </script> ";
  }

  if(isset($_GET['Unauthorized'])){
   echo " <script> alert('لقد اصبحت عامل في موقعنا , لا يمكنك التقديم مجددا') </script> ";
 }

?>
 <section class="hero-area">
 	<div class="container">
 		<div class="row">
 			<div class="col-md-12">
 				<div class="block mt-4">

          <div class="text-center" data-aos="fade-in">

            <h2 class="text-center backk" data-aos="zoom-in-down" data-aos-duration="2000">سهلنا عليك شغل بيتك</h2>
            <h3 class="text-center backk" data-aos="zoom-in-down" data-aos-duration="2000" data-aos-delay="250">شوف شو بدك من هون وإحنا جاهزين</h3>

            <a data-scroll href="#fromArrow" data-aos="slide-up" data-aos-duration="2000">
              <i class="fa-solid fa-chevron-down fa-beat"></i>
            </a>
          </div>
 				</div>
 			</div>
 		</div>
 	</div>
 </section>

<!--
Start About Section
==================================== -->
<div class="cont" id="fromArrow">
  <section class="service-2 section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6" data-aos="zoom-in-down" data-aos-duration="1000">
          <!-- section title -->
          <div class="title text-center">

            <h2 class="foryou">ماذا نقدم لك</h2>
            <p>
              الإحترافية في تقديم الخدمات المنزلية كركيزة أساسية، ونحمل عنك عناء الصيانة وبعض الأعمال الأخرى داخل منزلك،ونجنبك التعب لصيانتها أو حتى بالبحث عن حلٍ لها.
            </p>
            <div class="border"></div>
          </div>
          <!-- /section title -->
        </div>
      </div>
      <div class="row">
        <div class="col-md-12" data-aos="slide-up" data-aos-duration="1000">
          <div class="row text-center">
            <div class="col-md-3 col-sm-6">
              <div class="service-item">
                <img src="images/plumber-svgrepo-com.svg" alt="" width="20%">
                <h4>خدمات السباكة</h4>
               </div>
            </div><!-- END COL -->
            <div class="col-md-3 col-sm-6">
              <div class="service-item">
                <img src="images/electrician-svgrepo-com.svg" alt="" width="20%">
                <h4>خدمات كهربائية </h4>
              </div>
            </div><!-- END COL -->
            <div class="col-md-3 col-sm-6">
              <div class="service-item">
                <img src="images/carpenter-svgrepo-com.svg" alt="" width="20%">
                <h4>خدمات النجارة</h4>
              </div>
            </div><!-- END COL -->
            <div class="col-md-3 col-sm-6">
              <div class="service-item">
                <img src="images/painter-svgrepo-com.svg" alt="" width="20%">
                <h4>خدمات الدهان</h4>
              </div>
            </div><!-- END COL -->
          </div>
        </div>
      </div> <!-- End row -->
      <div class="row">
        <div class="col-md-12 toservices" data-aos="slide-left" data-aos-duration="500">
          <button class="animated-button" onclick="window.location.href='<?php echo URL ; ?>Services/ourServices.php'">
            <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
              <path
                d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
              ></path>
            </svg>
            <span class="text">الإنتقال إلى صفحة الخدمات</span>
            <span class="circle"></span>
            <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
              <path
                d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
              ></path>
            </svg>
          </button>

        </div>
      </div>
    </div> <!-- End container -->
  </section> <!-- End section -->

</div>
<!--
Start About Section
==================================== -->
<div class="cont" id="US">
  <section class="about-2 section" id="about">
    <div class="container">
      <div class="row justify-content-center">
        <!-- section title -->
        <div class="col-lg-6">
          <div class="title text-center">
            <h2  data-aos="zoom-in-down" data-aos-duration="1000">من نحن</h2>
            <p  data-aos="zoom-in-down" data-aos-duration="1000">
              نبذه عنا
            </p>
            <div class="border"></div>
          </div>
        </div>
        <!-- /section title -->
      </div>

      <div class="row">

        <div class="col-md-6 mb-4 mb-md-0">
          <p style="direction: rtl;" class="whous"  data-aos="zoom-in-down" data-aos-duration="1000">
            نحن فريق من الخبراء المتخصصين في مجال الصيانة المنزلية، نسعى جاهدين لتقديم خدمات عالية الجودة تلبي احتياجاتك وتفوق توقعاتك، بفضل خبرتنا الواسعة والمهارات المتقنة، نقدم حلاً شاملاً لجميع مشاكل الصيانة في منزلك،
             نحن هنا لنجعل حياتك اسهل وأكثر راحة من خلال توفير اشخاص يقدمون لك حلول فعالة وموثوقة لجميع إحتياجاتك المنزلية،
             لذلك إعتمد علينا لجعل بيتك أمناً لك ولعائلتك.
          </p>
          <h3 style="text-align: right;"  data-aos="zoom-in-down" data-aos-duration="1000"> تابعنا على حسابات التواصل الإجتماعي
            <div class="social_media"  data-aos="zoom-in-up" data-aos-duration="1000">
              <i class="fa-brands fa-instagram"></i>
              <i class="fa-brands fa-facebook"></i>
              <i class="fa-brands fa-x-twitter"></i>
             </div> </h3>

        </div>
        <div class="col-md-6">
          <img loading="lazy" src="images/man.png" class="img-fluid" alt="">
        </div>
      </div> <!-- End row -->
    </div> <!-- End container -->
  </section> <!-- End section -->

</div>
<!--
Start Call To Action
==================================== -->
<section class="call-to-action section">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-xl-6 col-lg-8 text-center">
				<h2  data-aos="zoom-in-down" data-aos-duration="1000">تواصل معنا</h2>
        <p  data-aos="zoom-in-down" data-aos-duration="1000">نحن دائمًا هنا لمساعدتك! إذا كان لديك أي استفسارات، أسئلة، أو تحتاج إلى المساعدة بشأن منتجاتنا أو خدماتنا، فلا تتردد في التواصل معنا. يمكنك إرسال رسالة من هٌنا .</p>
				<a  data-aos="zoom-in-down" data-aos-duration="1000" href="contact.html" class="btn btn-main">تواصل معنا</a>
			</div>
		</div> <!-- End row -->
	</div> <!-- End container -->
</section> <!-- End section -->

<section class="counter-wrapper section-sm">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-xl-6 col-lg-8 text-center">
				<div class="title">
					<h2  data-aos="zoom-in-down" data-aos-duration="1000">إحصائيات خدماتنا</h2>

				</div>
			</div>
		</div>
		<div class="row">
			<!-- first count item -->
			<div class="col-md-3 col-sm-6 col-xs-6 text-center ">
				<div class="counters-item">
					<img src="images/plumber-svgrepo-com.svg" alt="" style="width: 20%;">
					<div>
						<span class="counter" data-count="<?php echo $plumber->plumber ; ?>" data-aos="zoom-in-down" data-aos-duration="1000">0</span>
					</div>
					<h3>السباكة</h3>
				</div>
			</div>
			<!-- end first count item -->

			<!-- second count item -->
			<div class="col-md-3 col-sm-6 col-xs-6 text-center ">
				<div class="counters-item">
					<img src="images/electrician-svgrepo-com.svg" alt=""style="width: 20%;">
					<div>
						<span class="counter" data-count="<?php echo $electrician->electrician ;?>" data-aos="zoom-in-down" data-aos-duration="1000">0</span>
					</div>
					<h3>الكهرباء</h3>
				</div>
			</div>
			<!-- end second count item -->

			<!-- third count item -->
			<div class="col-md-3 col-sm-6 col-xs-6 text-center ">
				<div class="counters-item">
					<img src="images/carpenter-svgrepo-com.svg" alt=""style="width: 20%;">
					<div>
						<span class="counter" data-count="<?php echo $carpenter->carpenter ; ?>" data-aos="zoom-in-down" data-aos-duration="1000">0</span>
					</div>
					<h3>النجارة</h3>

				</div>
			</div>
			<!-- end third count item -->

			<!-- fourth count item -->
			<div class="col-md-3 col-sm-6 col-xs-6 text-center ">
				<div class="counters-item kill-border">
					<img src="images/painter-svgrepo-com.svg" alt=""style="width: 20%;">
					<div>
						<span class="counter" data-count="<?php  echo $painter->painter ; ?>" data-aos="zoom-in-down" data-aos-duration="1000">0</span>
					</div>
					<h3>الدهان</h3>
				</div>
			</div>
			<!-- end fourth count item -->
		</div> <!-- end row -->
	</div> <!-- end container -->
</section> <!-- end section -->

<?php require 'layout/footer.php'  ?>