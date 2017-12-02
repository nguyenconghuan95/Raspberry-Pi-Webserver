$('input[type="checkbox"]').on('change', function() {
	var id = $(this).attr('id');
	var isChecked = $(this).is(':checked');

	if (isChecked) {
		$.post("testLed.php", {action: 'On', device: id});
		alert("Turned On " + id);
	}
	else {
		$.post("testLed.php", {action: 'Off', device: id});
		alert("Turned Off " + id);
	}
})
