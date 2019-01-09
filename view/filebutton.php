<a class="pull-left file-block" 
	href="<?php uri($uri);?>"
	style="width:<?php echo (100.0/$cols)-$spacing;?>%;height:<?php echo $height?>;">
		<div>
			<img class="transparent" 
				src="<?php echo $image; ?>"  />
		</div>
		<p><?php echo $file->getFilename(); ?></p>
</a>
