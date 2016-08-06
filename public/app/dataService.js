define(function (require) {
    var $ = require('jquery');

	var basePath = 'http://lampjavel.local/api';
    var dataService = {};

    dataService.getChannels = function () {
        var url = basePath + '/channels';

        return $.ajax({
            url: url,
            dataType: 'json'
        });
    };

    dataService.getImages = function (channelId) {
        var url = basePath + '/channels/' + channelId + '/images';

        return $.ajax({
            url: url,
            dataType: 'json'
        });
    };

	dataService.getNextImage = function (channelId) {
		var url = basePath + '/channels/' + channelId + '/nextImage';

		return $.ajax({
            url: url,
            dataType: 'json'
        });
	};

    return dataService;
});