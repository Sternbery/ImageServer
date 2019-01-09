<div style="padding:10px;">
<script src="<?php asset('js/fileUI.js'); ?>"></script>


<form action="<?php echo Request::getCurrentRequest().'';?>" method="POST" enctype="multipart/form-data">
		<div id="form"></div>
		<input type="submit" class="btn btn-success"/>
</form>

</div>
<script>
	var numImgs=0;
	var numInputs=0;
	
	function onFileChange(evt){
		if(evt.target.files){
			
			for(var i=0; i<evt.target.files.length; i++){
				
				var file = evt.target.files[i];
				var reader = new FileReader();
				
				//1) create placeholder
				var div = newUploadElement(file);
				putId('form',div);
				
				//3) on image load: change placeholder to reflect the image
				reader.onload = function(e){
					var id =this.div.childNodes[0].childNodes[0].getAttribute('id');
					putAttrId(id,{src:e.target.result});
				}.bind({div:div});
				
				reader.readAsDataURL(file);
			}
			hideFileInput();
		}
	}
	
	function newUploadElement(f){
		var img = newElem('img',{src:'http://image-server.local/assets/img/Right-50.png',id:'img-'+numImgs});
		img = newPutDiv('','img-preview',img,{style:'width:200px;height:200px;'});

		var div = newPutDiv('','upload-block',img,{});

		numImgs++;
		return div;
	}

	function createFileInput(){
		var ninput = newFileInput('file-'+(numInputs)+'[]',{multiple:true,id:'file-'+(numInputs)});
		ninput.addEventListener('change',onFileChange);
		putId('form',ninput);
		
	}
	
	function hideFileInput(){
		putAttrId('file-'+numInputs,{style:'display:none'});
		numInputs++;
		createFileInput();
	}
	
	createFileInput();
</script>
