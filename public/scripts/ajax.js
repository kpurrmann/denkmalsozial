$(function(){

	//@todo Auslagern
	var urlPrefix = $('head base').attr('href');
	var run = false;
	if(!run){
		$('a.lightbox:not(.ready)').each(function(){
			var link = $(this).attr('href');
			$(this).addClass('ready');
			$(this).attr('href', urlPrefix + link + '/layout/lightbox');
		});
		run = true;
	}

	$('a.lightbox').colorbox({
		'title' : '',
		'maxWidth' : '550px',
		'loop': false,
		'current' : '',
		'previous' : 'zurück',
		'next' : 'weiter',
		'close' : 'schließen'
	});
	$('a[rel=tooltip]').tooltip({
		'placement' : 'bottom'
	});

});