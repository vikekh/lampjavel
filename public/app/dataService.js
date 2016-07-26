define(['jquery'], function ($) {
	var basePath = 'http://lampjavel.local/api';

	return {
		getImages: function (channelId, pageSize, pageNumber, sort) {
			var url = basePath + '/channels/' + channelId + '/images';
            var params = {
                pageSize: pageSize,
                pageNumber: pageNumber,
                sort: sort
            };

            url += '?' + $.param(params);

			return $.ajax({
                url: url,
                dataType: 'json'
            });
		}
	};
});