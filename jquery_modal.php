<meta charset="utf-8">
	
	<script>
	$(function() {
		// a workaround for a flaw in the demo system (http://dev.jqueryui.com/ticket/4375), ignore!
		$( "#dialog:ui-dialog" ).dialog( "destroy" );
	
		$( "#dialog-modal" ).dialog({
			height: 140,
			modal: true
		});
	});
	</script>



<div class="demo">

<div id="dialog-modal" title="Basic modal dialog">
	<p>Adding the modal overlay screen makes the dialog look more prominent because it dims out the page content.</p>
</div>

<!-- Sample page content to illustrate the layering of the dialog -->
<div class="hiddenInViewSource" style="padding:20px;">
	<p>Sed vel diam id libero <a href="http://example.com">rutrum convallis</a>. Donec aliquet leo vel magna. Phasellus rhoncus faucibus ante. Etiam bibendum, enim faucibus aliquet rhoncus, arcu felis ultricies neque, sit amet auctor elit eros a lectus.</p>
	<form>
		<input value="text input" /><br />
		<input type="checkbox" />checkbox<br />
		<input type="radio" />radio<br />
		<select>
			<option>select</option>
		</select><br /><br />
		<textarea>textarea</textarea><br />
	</form>
</div><!-- End sample page content -->

</div><!-- End demo -->



<div class="demo-description">
<p>A modal dialog prevents the user from interacting with the rest of the page until it is closed.</p>
</div><!-- End demo-description -->