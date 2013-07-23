<script type="text/javascript">
	function doNothing(){}
</script>

<?php if($menu != null){?>
<div class="container">
	
	<div class="row padded blue">
		<div class="three fourths">
			<nav class="inline nav menu">
				<ul>
					<?php 	for($i=0;$i<sizeof($menu);$i++){
								$m = $menu[$i];
								if($m->menu_id % 100 == 0){?>
									<li <?=($m->path=='')?"class=\"menu\"":""?>>
										<a href="<?=site_url($m->path)?>"><?=$m->menu_name?></a>
					<?php			if(($i+1)<sizeof($menu) && $menu[$i+1]->menu_id % 100 == 0){?>
										</li>
					<?php 			}?>
					<?php		} else {
									if($i!=0 && $menu[$i-1]->menu_id % 100 == 0){?>
										<ul>
					<?php			}?>
									<li><a href="<?=site_url($m->path)?>"><?=$m->menu_name?></a></li>
					<?php			if($i+1==sizeof($menu) || $menu[$i+1]->menu_id % 100 == 0){?>
										</ul>
					<?php 			}
								}
							}?>
				</ul>
			</nav>
		</div>
		<div class="one fourths align-right">
			<?=form_open('authentication/logout')?>
				<input type="submit" value="Logout">
			</form>
		</div>
	</div>
	
</div>
<?php } ?>
