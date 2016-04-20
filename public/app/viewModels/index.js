define(['durandal/app', 'jquery', 'knockout', 'viewModels/shell'], function (app, $, ko, shell) {
	return {
		imageUrl: ko.observable(),

        activate: function (channelId) {
        	var self = this;

        	if (!channelId) {
        		channelId = 'lampjavel';
        	}

            app.on('channelChange', function (event) {
                return $.ajax({
                    url: 'http://lampjavel.local/api/channels/' + shell.channelId() + '/images',
                    dataType: 'json'
                }).done(function (response) {
                    self.imageUrl(response[0].url);
                });
            });

        	return $.ajax({
        		url: 'http://lampjavel.local/api/channels/' + channelId + '/images',
        		dataType: 'json'
        	}).done(function (response) {
        		self.imageUrl(response[0].url);
        	});
        }
    };
});