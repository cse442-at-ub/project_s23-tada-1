<?php

function navbar($username)
{

	$html = <<<"EOT"
		<div class="page-top-view">
			<div class="title-container">
				<ul class="nav">
					<li>
						<h2 class="logo"><a class="unstyled" href="index.php">TADA!</a></h2>
					</li>
				</ul>
			</div>
			<div class="menu-container">
				<ul class="nav>
					<li> 
						<p>link here etc.</p>
					</li>
				</ul>
			</div>
		</div>
		EOT;
	echo $html;
}
