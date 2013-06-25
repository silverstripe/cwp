<div id="$Name" class="field<% if extraClass %> $extraClass<% end_if %>">
	<% if Title %><label class="left" for="$ID">$Title</label><% end_if %>
	<% if RightTitle %><label class="extra" for="$ID">$RightTitle</label><% end_if %>

	$Field

	<% if Message %><span class="message $MessageType">$Message</span><% end_if %>
</div>