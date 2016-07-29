define(['jquery'], function ($) {
	var basePath = 'http://lampjavel.local/api';

	return {
		getNextImage: function (channelId) {
			var url = basePath + '/channels/' + channelId + '/nextImage';

			return $.ajax({
                url: url,
                dataType: 'json'
            });
		}
	};
});