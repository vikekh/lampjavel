define(['jquery'], function ($) {
	var basePath = 'http://lampjavel.local/api';

	return {
        getChannels: function () {
            var url = basePath + '/channels';

            return $.ajax({
                url: url,
                dataType: 'json'
            });
        },

		getNextImage: function (channelId) {
			var url = basePath + '/channels/' + channelId + '/nextImage';

			return $.ajax({
                url: url,
                dataType: 'json'
            });
		}
	};
});