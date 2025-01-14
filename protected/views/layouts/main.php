<?php /* @var $this Controller */ ?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="keywords" content="ktvs, fmfi ktvs, katedra telesnej vychovy a sportu" />
   	<meta name="description" content=" katedra telesnej vychovy a sportu. Univerzita komenskeho Bratislava" />
    <link href='http://fonts.googleapis.com/css?family=Noto+Serif&subset=latin-ext' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/styles.css" />
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/js-image-slider.js" type="text/javascript"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.mmenu.min.js" type="text/javascript"></script>
	<script>
		// Slider
		 // DOM ready
		 $(function() {
		   
	      // Create the dropdown base
	      $("<select />").appendTo("nav");
	      
	      // Create default option "Go to..."
	      $("<option />", {
	         "selected": "selected",
	         "value"   : "",
	         "text"    : "Select a page"
	      }).appendTo("nav select");
	      
	      // Populate dropdown with menu items
	      $("nav a").each(function() {
	       var el = $(this);
	       $("<option />", {
	           "value"   : el.attr("href"),
	           "text"    : el.text()
	       }).appendTo("nav select");
	      });
	      
		   // To make dropdown actually work
	      $("nav select").change(function() {
	        window.location = $(this).find("option:selected").val();
	      });
		 
		 });

		// Dropdown login
		$(document).ready(function(){
			$('#login-trigger').click(function(){
				$(this).next('#login-content').slideToggle();
				$(this).toggleClass('active');					
				
				if ($(this).hasClass('active')) 
					$(this).find('span').html('&#x25B2;');
				else 
					$(this).find('span').html('&#x25BC;');
			})
		});
	</script>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body>
	<header>
		<nav>
			<div id="vyskakovacie_menu">
				<?php $this->widget('application.components.MainMenu'); ?>
			</div>
		</nav>
		
		<div  id ="login_link">
			<ul>
				<li id="login">
					<?php if(Yii::app()->user->isGuest): ?>
						<a id="login-trigger" href="#">Prihlásenie učiteľa<span>▼</span></a>
					<?php else: ?>
						<a id="login-trigger" href="#">Odhlásenie<span>▼</span></a>
						<?php endif; ?>
					</a>
					<div id="login-content">
		   				<?php if(Yii::app()->user->isGuest): ?>
							<?php $form=$this->beginWidget('CActiveForm', array(
								'id'=>'login-form',
								'enableClientValidation'=>true,
								'clientOptions'=>array(
									'validateOnSubmit'=>true,
								),
							)); ?>

							<fieldset id="inputs">
								<?php echo $form->labelEx($this->loginForm,'username'); ?>
								<?php echo $form->textField($this->loginForm,'username', array('placeholder'=>'email@email.com')); ?>
								<?php echo $form->error($this->loginForm,'username'); ?>

								<?php echo $form->labelEx($this->loginForm,'password'); ?>
								<?php echo $form->passwordField($this->loginForm,'password', array('placeholder'=>'Heslo')); ?>
								<?php echo $form->error($this->loginForm,'password'); ?>
								<!--<p class="hint">
									Nápoveda: môžeš sa prihlásiť s <kbd>admin@admin.com</kbd>/<kbd>admin</kbd> alebo <kbd>user@user.com</kbd>/<kbd>user</kbd>.
								</p>-->
							</fieldset>

							<fieldset id="actions">
								<?php echo $form->checkBox($this->loginForm,'rememberMe'); ?>
								<?php echo $form->label($this->loginForm,'rememberMe'); ?>
								<?php echo $form->error($this->loginForm,'rememberMe'); ?>
							
								<?php echo CHtml::submitButton('Login', array('class' => 'prihlas')); ?>
							</fieldset>
						<?php $this->endWidget(); ?>
				 	
		   				<?php else: ?>
		  					<?php echo CHtml::link(Yii::app()->user->email, Yii::app()->createUrl('user/'.Yii::app()->user->id)); ?>
		   					<?php echo CHtml::button('Odhlásiť', array('submit' => array('site/logout'))); ?>
		   	    		<?php endif; ?>
	   	    		</div> 
	   	   		</li>
	   	    </ul>
		</div>
		
	    <div class="clearfloat"></div>
	</header>
	
	<div class="logo1">
        <a href="http://www.uniba.sk/" target='_blank'><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo1.png" alt="FMFI">
    	<p>Univerzita Komenského v Bratislave</p></a> 
    </div>

    <div class="logo2">
        <a href="http://www.fmph.uniba.sk/" target='_blank'><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo2.png" alt="FMFI">
    	<p>Fakulta matematiky, fyziky a informatiky</p></a> 
    </div>
    <div class="logo">
    	<a href=""><?php echo CHtml::encode(Yii::app()->name); ?></a>
    </div>
   
	<div class="wrapper">
	     <div id="sliderFrame">
	        <div id="slider">
	            <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/1.jpg" />
	            <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/2.png"  />
	            <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/3.jpg" />
	            <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/5.png" />
	            <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/9.jpg" />
	        </div>
	    </div>  
	    
	    <div class="contentBody">
	    	<?php if(isset($this->breadcrumbs)):?>
				<?php $this->widget('zii.widgets.CBreadcrumbs', array(
					'links'=>$this->breadcrumbs,
				)); ?><!-- breadcrumbs -->
			<?php endif?>
			
			<?php
			    foreach(Yii::app()->user->getFlashes() as $key => $message) {
			        echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
			    }
			?>
			
	    	<div class="post">
	    		<?php echo $content; ?>
	        </div>
	    </div>
	    
	    <div class="sidebar">
	    	<h2>Športy</h2><br />
	    	<?php if(Yii::app()->user->checkAccess('createSport')): ?>
	    		<?php echo CHtml::button('Pridať šport', array('submit' => array('sport/create'))); ?>
	    	<?php endif; ?>
			<?php $this->widget('application.components.SportMenu'); ?>
	    
	    </div>
	
	    <div class="clearfloat"></div>   
	</div>
	
	<footer>
	    <p class="copyright">
	        Copyright &copy; <b style="color: orange;">D r e a m T e a m</b> | Designed by <b style="color: orange;">M a t f y z a c i</b>
	    </p>
	</footer>
</body>
</html>
