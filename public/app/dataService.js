define(['jquery'], function ($) {
	var basePath = 'http://lampjavel.local/api';

	return {
		getImages: function (channelId, pageSize, pageNumber) {
			var url = basePath + '/channels/' + channelId + '/images';

			if (typeof pageSize === 'number' && typeof pageNumber === 'number')  {
				url += '?pageSize=' + pageSize + '&pageNumber=' + pageNumber;
			}

			return $.ajax({
                url: url,
                dataType: 'json'
            });
		}
	};
});