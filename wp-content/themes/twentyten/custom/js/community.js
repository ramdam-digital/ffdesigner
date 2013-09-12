(function($){
	$(document).ready(function(){
		$('.add_community_media').click(function(e){
			e.preventDefault();
			wp.media({
				title : 'Envoyer une image',
				button : {
					text : 'Choisir un fichier'
				},
				multiple : false
			}).open();
		});
	});
})(jQuery);