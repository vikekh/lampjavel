define(['jquery', 'knockout', 'viewModels/shell'], function ($, ko, shell) {
	return {
		imageUrl: ko.observable(),

        activate: function () {
        	var self = this;
        	var channelId = shell.channelId();

        	return $.ajax({
        		url: 'http://lampjavel.local/api/channels/' + channelId + '/images',
        		dataType: 'json'
        	}).done(function (response) {
        		self.imageUrl(response[0].url);
        	});
        }
    };
});