<? $title = "Edit Profile" ?>
<div class="row">
	<div class="span6">
		<h2>Contact Information</h2>
		<hr>
		<form accept-charset="UTF-8" action="/users" class="edit_user" id="edit_user" method="post"><div style="margin:0;padding:0;display:inline"><input name="utf8" type="hidden" value="✓"><input name="_method" type="hidden" value="put"><input name="authenticity_token" type="hidden" value="DHtSf/BQUJnsjWnCl/5hW+rqMQbh+DR70Zs+X/5/Eq0="></div>
			<div>
				<label for="user_skype">Skype</label>
				<input id="user_skype" name="user[skype]" size="30" type="text" value="kt.funky">
			</div>
			<div>
				<label for="user_twitter">Twitter</label>
				<input id="user_twitter" name="user[twitter]" size="30" type="text" value="mczoneco">
			</div>
			<div>
				<label for="user_facebook">Facebook</label>
				<input id="user_facebook" name="user[facebook]" size="30" type="text" value="">
			</div>
			<div>
				<label for="user_steam">Steam</label>
				<input id="user_steam" name="user[steam]" size="30" type="text" value="">
			</div>
			<div>
				<label for="user_youtube">YouTube</label>
				<input id="user_youtube" name="user[youtube]" size="30" type="text" value="">
			</div>
			<div>
				<label for="user_twitch">Twitch</label>
				<input id="user_twitch" name="user[twitch]" size="30" type="text" value="">
			</div>
			<div>
				<input class="btn btn-primary" name="commit" type="submit" value="Update">
			</div>
		</form>
	</div>
	<div class="span6">
		<h2>Account Settings</h2>
		<hr>
		<form accept-charset="UTF-8" action="/users" class="edit_user" id="edit_user" method="post"><div style="margin:0;padding:0;display:inline"><input name="utf8" type="hidden" value="✓"><input name="_method" type="hidden" value="put"><input name="authenticity_token" type="hidden" value="DHtSf/BQUJnsjWnCl/5hW+rqMQbh+DR70Zs+X/5/Eq0="></div>
			<div>
				<label for="user_email">Email</label>
				<input id="user_email" name="user[email]" size="30" type="email" value="kt.funky@gmail.com">
			</div>
			<div>
				<label for="user_password">Password</label>
				<input id="user_password" name="user[password]" size="30" type="password">
			</div>
			<div>
				<label for="user_password_confirmation">Password confirmation</label>
				<input id="user_password_confirmation" name="user[password_confirmation]" size="30" type="password">
			</div>
			<div>
				<label for="user_current_password">Current password</label>
				<input id="user_current_password" name="user[current_password]" size="30" type="password">
			</div>
			<div>
				<input class="btn btn-primary" name="commit" type="submit" value="Update">
			</div>
		</form>
	</div>
</div>
<div class="row">
	<div class="span12">
		<h2>Miscellaneous Details</h2>
		<hr>
	</div>
	<form accept-charset="UTF-8" action="/users" class="edit_user" id="edit_user" method="post"><div style="margin:0;padding:0;display:inline"><input name="utf8" type="hidden" value="✓"><input name="_method" type="hidden" value="put"><input name="authenticity_token" type="hidden" value="DHtSf/BQUJnsjWnCl/5hW+rqMQbh+DR70Zs+X/5/Eq0="></div>
		<div class="span6">
			<div>
				<label for="user_gender">Gender</label>
				<select id="user_gender" name="user[gender]"><option value=""></option>
					<option value="Male" selected="selected">Male</option>
					<option value="Female">Female</option></select>
				</div>
				<div>
					<label for="user_location">Location</label>
					<input id="user_location" name="user[location]" size="30" type="text" value="">
				</div>
				<div>
					<label for="user_occupation">Occupation</label>
					<input id="user_occupation" name="user[occupation]" size="30" type="text" value="">
				</div>
			</div>
			<div class="span6">
				<label for="user_about">About You</label>
				<textarea cols="40" id="user_about" name="user[about]" rows="20" style="height: 100px; width: 450px;">&lt;h1&gt;woot&lt;/h1&gt;</textarea>
				<div>
					<input class="btn btn-primary" name="commit" type="submit" value="Update">
				</div>
			</div>
		</form>
	</div>