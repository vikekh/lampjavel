define(function (require) {
    var $ = require('jquery');

	var basePath = 'http://lampjavel.local/api';
    var dataService = {};

    dataService.addImageToChannel = function (channelId, imageId) {
        var url = basePath + '/channels/' + channelId + '/images' + imageId;

        return $.ajax({
            url: url,
            type: 'PUT'
        });
    };

    dataService.createChannel = function (data) {
        var url = basePath + '/channels';

        return $.ajax({
            url: url,
            type: 'POST',
            data: data,
            dataType: 'json'
        });
    };

    dataService.createImage = function (data) {
        var url = basePath + '/images';

        return $.ajax({
            url: 'http://lampjavel.local/api/images',
            type: 'POST',
            data: data,
            dataType: 'json'
        });
    };

    dataService.getChannels = function () {
        var url = basePath + '/channels';

        return $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json'
        });
    };

    dataService.getImagesFromChannel = function (channelId, data) {
        var url = basePath + '/channels/' + channelId + '/images';

        return $.ajax({
            url: url,
            type: 'GET',
            data: data,
            dataType: 'json'
        });
    };

    return dataService;
});