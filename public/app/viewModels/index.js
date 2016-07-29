define(['durandal/app', 'jquery', 'knockout', 'dataService', 'viewModels/shell'], function (app, $, ko, dataService, shell) {
	return {
		imageUrl: ko.observable(),

        pageNumber: ko.observable(0),

        nextImage: function () {
            var self = this;
            
            self.pageNumber(undefined);
            dataService.getNextImage(shell.channelId()).done(function (response) {
                self.imageUrl(response.url);
            });
        },

        activate: function (channelId) {
        	var self = this;

        	if (!channelId) {
        		channelId = 'lampjavel';
        	}

            app.on('channelContext', function (channelId) {
                self.pageNumber(undefined);
                dataService.getNextImage(shell.channelId()).done(function (response) {
                    self.imageUrl(response.url);
                });
            });

        	return dataService.getNextImage(shell.channelId()).done(function (response) {
        		self.imageUrl(response.url);
        	});
        }
    };
});