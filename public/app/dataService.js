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
		},

        getRandomImages: function (channelId, pageSize) {
            var url = basePath + '/channels/' + channelId + '/images?sort=random';

            if (typeof pageSize === 'number')  {
                url += '&pageSize=' + pageSize;
            }

            return $.ajax({
                url: url,
                dataType: 'json'
            });
        }
	};
});