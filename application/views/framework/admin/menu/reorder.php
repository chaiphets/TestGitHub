<div class="container pad-top double">

<div class="row">
	<div class="one fourths padded border">
		<div class="row"><h1>Menu</h1></div>
		<div class="row submenu">
			<div class="two thirds"><a href="<?=site_url('admin/menu/reorder')?>"><p>Reorder menu</p></a></div>
			<div class="two thirds"><a href="<?=site_url('admin/menu/main')?>"><p>Create new main menu</p></a></div>
			<div class="two thirds"><a href="<?=site_url('admin/menu/sub')?>"><p>Create new sub menu</p></a></div>
			<div class="two thirds"><a href="<?=site_url('admin/menu/edit')?>"><p>Edit menu name and path</p></a></div>
		</div>
	</div>
	
	<div class="three fourths padded border-left">
		<h2>Reorder menu</h2>
		<?=form_open('admin/menu/reorder')?>
			<input type="hidden" name="save" value="save" />
			<ul class="sortable bordered padded">
				<?php foreach($menus as $menu):?>
					<li class="info callout gapped">
						<?=$menu['menu_name']?>
						<input type="hidden" name="mainName[]" value="<?=$menu['menu_name']?>" />
						<input type="hidden" name="mainPermission[]" value="<?=$menu['permission_id']?>" />
						<?php if(!empty($menu['sub'])):?>
							<ul>
							<?php foreach($menu['sub'] as $sub):?>
								<li class="callout gapped">
									<?=$sub['menu_name']?>
									<input type="hidden" name="subMainName[]" value="<?=$menu['menu_name']?>" />
									<input type="hidden" name="subName[]" value="<?=$sub['menu_name']?>" />
									<input type="hidden" name="subPermission[]" value="<?=$sub['permission_id']?>" />
								</li>
							<?php endforeach;?>
							</ul>
						<?php endif;?>
					</li>
				<?php endforeach;?>
			</ul>
			<input type="submit" value="Save" />
		</form>
	</div>
</div>

</div>


<script>
$(function() {
	$("ul.sortable, ul.sortable ul").sortable({
		placeholder: "warning callout gapped"
	}).disableSelection();

	$("ul.sortable").each(function(){
		var min = $(this).height() + 22;
		$(this).css("minHeight", min+"px");
	});
	
});
</script>