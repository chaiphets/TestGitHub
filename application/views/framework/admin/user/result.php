<div class="container pad-top double">
	
	<div class="row">
		<div class="one fourths padded border">
			<div class="row"><h1>User</h1></div>
			Search user<br>
			Create new user<br>
		</div>
		
		<div class="three fourths padded border-left">
			<h2>User Result</h2>
			<?php if($result == null){ ?>
				<p class="error message">Not found</p>
			<?php } else { ?>
				<table class="two thirds centered">
					<thead>
						<th>Username</th>
						<th>Position</th>
					</thead>
					<tbody>
					<?php foreach($result as $row){ ?>
						<tr>
							<td><?=$row->username?></td>
							<td></td>
						</tr>
					<?php } ?>
					</tbody>
				</table>
			<?php } ?>
		</div>
	</div>
	
</div>