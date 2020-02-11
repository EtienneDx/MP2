$(() => {
	var id = 0;
	$('#starContainer div').hover(function(e) {
		$t = $(this);
		$t.nextAll().children(":nth-child(2)").hide();
		$t.nextAll().children(":nth-child(1)").show();
		$t.prevAll().children(":nth-child(1)").hide();
		$t.prevAll().children(":nth-child(2)").show();
		$t.children(":nth-child(1)").hide();
		$t.children(":nth-child(2)").show();
	}).click(function(e) {
		$t = $(this);
		id = $t.index() + 1;
	});
	$('#starContainer').mouseout(function(e) {
		if(!$(this).is(":hover"))
		{
			for(var i = 1; i <= 5; i++)
			{
				$e = $('#starContainer div:nth-child(' + i + ')');
				$e.children(":nth-child(1)").toggle(i > id);
				$e.children(":nth-child(2)").toggle(i <= id);
			}
		}
	});

	$('#send').click(() => {
		if(id > 0)
		{
			$('#note').val(id);
			$('#form').submit();
		}
	})
});
