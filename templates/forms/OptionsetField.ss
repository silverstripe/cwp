<ul id="$ID" class="$extraClass"<% if Description %> title="$Description"<% end_if %>>
	<% loop Options %>
		<li class="$Class">
			<input id="$ID" class="radio" name="$Name" type="radio" value="$Value"<% if isChecked %> checked<% end_if %><% if isDisabled %> disabled<% end_if %>>
			<label for="$ID" class="inline">$Title</label>
		</li>
	<% end_loop %>
</ul>
