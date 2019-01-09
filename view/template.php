<?php
	function url($scheme, $address, $echo = true){
		global $request;
		
		$nRequest = $request->copy();
	
		$nRequest->setControl($scheme);
		$nRequest->setAddress($address);
		
		if($echo)
			echo $nRequest.'';
		else
			return $nRequest.'';
	}

	function select($selection){
		global $request;
		
		if($request->getControl()==$selection)
			echo 'selected';
	}
	
	function uri($res,$echo=true){
		global $request;
		
		$nRequest = $request->copy();
	
		$nRequest->setAddress($res);
		
		if($echo)
			echo $nRequest.'';
		else
			return $nRequest.'';
	}
	
	function rescheme($scheme, $echo =true){
		global $request;
		
		$nRequest = $request->copy();
	
		$nRequest->setControl($scheme);
		
		if($echo)
			echo $nRequest.'';
		else
			return $nRequest.'';
	}
	
	function asset($address,$echo=true){
		return url('assets',$address,$echo);
	}
	
?><html>
<head>
	<title>Image Server</title>
	<link rel="stylesheet" href="<?php asset('css/style.css');?>"/>
	<link rel="stylesheet" href="<?php asset('css/bootstrap.min.css');?>"/>
	<style>
	#searchbar{
		box-sizing:border-box;		
		border:solid 3px #aaaaff;
		border-radius:5px;
		
		padding:15px;
		color:#aaaaff;
		width:100%;
		height:100%;
		display:block;
		font-family:Arial;
		font-size:200%;
	}
	img.transparent{
		background-image: url(<?php url('assets','img/opaque-bg.png');?>);
	}
	</style>

</head>
<body>
	<nav>
		<span class="pull-left">
			<a href="<?php url('browse','');?>" class="button" alt="Return to Home" title="Return to Home"><img src="<?php asset('img/Home-50.png');?>"/></a>
			<a href="<?php rescheme('browse');?>" class="button <?php select('browse');?>" alt="Browse" title="Browse"><img src="<?php url('assets','img/Folder-50.png');?>"/></a>
			<a href="<?php rescheme('upload');?>" class="button <?php select('upload');?>" alt="Upload" title="Upload"><img src="<?php asset('img/Upload-50.png');?>"/></a>
			<a href="javascript:void(0)" class="button" alt="Settings" title="Settings"><img src="<?php url('assets','img/Settings-50.png');?>"/></a>
		</span>
		<span class="pull-right">
			<a href="javascript:void(0)" class="button" alt="Go to this directory" title="Go to this directory"><img src="<?php asset('img/Right-50.png');?>"/></a>
			<a href="javascript:void(0)" class="button" alt="Search for this term" title="Search for this term"><img src="<?php asset('img/Search-50.png');?>"/></a>
			</span>
		<span class="middle-column">
			<input id="searchbar" type="text" name="searchbar" value="<?php echo '/'.$request->getAddress(); ?>"/>
		</span>
	</nav>
	<section>
		<?php $view->render(); ?>
	</section>
</body>
</html>