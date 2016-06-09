

<script>
 $(document).ready(function(){
    $("#framepdf").attr("src",'<?php echo $url ?>');
    $('#iframe').each(function() {
	 this.contentWindow.location.reload(true);
	});
});
</script>

<div class="container">

<div class="span12">


    <div id="ofuscado">
    	<iframe id="framepdf" frameborder='0' width='1000' height='700' src='' ></iframe>
    </div>
</div>

</div>

