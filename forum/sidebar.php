<div id="forum-sidebar">
	<ul class="nav nav-list">
		<li class="active">
			<a href="/forum/">Latest Topics</a>
		</li>
		<? if (getPosition($username)=="admin" || getPosition($username)=="mod") { ?>
			<li>
				<a href="/forum?category=Staff Discussion">Staff Discussion</a>
			</li>
		<? } ?>
	</ul>
	<h4>MC Zone</h4>
	<ul class="nav nav-list">
		<li class="forum-cat">
			<a href="/forum?category=Official News">Official News</a>
		</li>
		<li>
			<a href="/forum?category=Website Feedback">Website Feedback</a>
		</li>
		<li>
			<a href="/forum?category=Moderator Applications">Moderator Applications</a>
		</li>
		<li>
			<a href="/forum?category=Plugin Feedback">Plugin Feedback</a>
		</li>
		<li>
			<a href="/forum?category=Ask the Staff">Ask the Staff</a>
		</li>
	</ul>
	<h4>Main</h4>
	<ul class="nav nav-list">
		<li>
			<a href="/forum?category=General Discussion">General Discussion</a>
		</li>
		<li>
			<a href="/forum?category=Map Discussion">Map Discussion</a>
		</li>
		<li>
			<a href="/forum?category=Suggestions">Suggestions</a>
		</li>
		<li>
			<a href="/forum?category=Media">Media</a>
		</li>
	</ul>
	<h4>Other</h4>
	<ul class="nav nav-list">
		<li>
			<a href="/forum?category=Minecraft Discussion">Minecraft Discussion</a>
		</li>
		<li>
			<a href="/forum?category=Off Topic">Off Topic</a>
		</li>
	</ul>
	<h4>Report Players</h4>
	<ul class="nav nav-list">
		<li>
			<a href="/forum?category=Modders or Hackers">Modders or Hackers</a>
		</li>
		<li>
			<a href="/forum?category=Team Killers">Team Killers</a>
		</li>
	</ul>
</div>