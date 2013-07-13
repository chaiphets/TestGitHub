<script type="text/javascript" src="<?=base_url('extlib/js/plugins/jquery.cycle2.js')?>"></script>
<script type="text/javascript" src="<?=base_url('extlib/js/plugins/jquery.magnific-popup.js')?>"></script>
<script type="text/javascript" src="<?=base_url('extlib/js/groundwork.all.js')?>"></script>
<script>
	function toggleHMsg(){
		$('.headermsg.success').remove();
		
		if($('.headermsg').css('display') == 'none'){
			$('.headermsg').each(function(index){
				$(this).slideDown(200).fadeTo(200, 1);
			});
		} else {
		$('.headermsg').each(function(index){
				$(this).slideUp(200).fadeTo(200, 0);
			});
		}
		$('#btn_hmsg').toggleClass('gap-top');
	}
	
	$(document).ready(function(){
		var num_hmsg = 0;
		$('.headermsg').each(function(index){
			$(this).slideDown(200);
			$(this).delay(3000*(num_hmsg++));
			$(this).fadeTo(3000, 0);
			$(this).slideUp(200);
			
			if((index+1) == $('.headermsg').length && $('.headermsg.error').length > 0)
				$('#btn_hmsg').delay((3000*num_hmsg)+1000).slideDown(500);
		});
		$('#btn_hmsg').on('click', toggleHMsg);
	});
</script>
</body>
</html>