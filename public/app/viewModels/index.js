define(['durandal/app', 'jquery', 'knockout', 'dataService', 'viewModels/shell'], function (app, $, ko, dataService, shell) {
	return {
		imageUrl: ko.observable(),

        pageNumber: ko.observable(0),

        nextImage: function () {
            var self = this;
            
            self.pageNumber(undefined);
            dataService.getImages(shell.channelId(), 1, this.pageNumber(), 'random').done(function (response) {
                self.imageUrl(response[0].url);
            });
        },

        activate: function (channelId) {
        	var self = this;

        	if (!channelId) {
        		channelId = 'lampjavel';
        	}

            app.on('channelContext', function (channelId) {
                self.pageNumber(undefined);
                dataService.getImages(shell.channelId(), 1, self.pageNumber(), 'random').done(function (response) {
                    self.imageUrl(response[0].url);
                });
            });

        	return dataService.getImages(shell.channelId(), 1, self.pageNumber(), 'random').done(function (response) {
        		self.imageUrl(response[0].url);
        	});
        }
    };
});