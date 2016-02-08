<?php
// title: 'title', start: new Date(y,m,d), end: new Date(y,m,d), allDay:false, url:'http://';
$mapc_date = (! empty($mapc_date_from) ) ? $mapc_date_from : date('Y-m-d');

$tmp = explode("-", $mapc_date);
$search_y = $tmp[0];
$search_m = $tmp[1];
$search_d = $tmp[2];
?>
<script type="text/javascript">
	$(document).ready(function() {
	
		var date = new Date();
		var d = ("0" + date.getDate()).slice(-2);
		var m = ("0" + date.getMonth() + 1).slice(-2);
		var y = date.getFullYear();
        var search_date = y + '-' + m + '-' + d;

		$('#calendar').fullCalendar({

			header: {
				left: 'prev,next today',
				center: 'title',
                right: ''
			},
			editable: true,
            events: '<?= $URL['mapc']['root']; ?>core_page/post_date/<?= $url_search_addition; ?>'

		});
        $('#calendar').fullCalendar('gotoDate', '<?= $search_y; ?>', '<?= $search_m - 1; ?>', '<?= $search_d; ?>');

	});
</script>
<style>
    #calendar {
        width: 100%;
        margin: 0 auto;
    }
</style>
<div id='calendar'></div>
