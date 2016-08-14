define(function (require) {
    var $ = require('jquery');
    var app = require('durandal/app');
    var dataService = require('dataService');
    var ko = require('knockout');
    var shell = require('viewModels/shell');

    return {
        activate: function (channelId) {
            var self = this;

            shell.channelId(channelId);
            shell.header('#' + channelId);

            //app.on('channelContext', function (channelId) {
                //self.nextImage();
            //});

            return dataService.getImagesFromChannel(shell.channelId(), { sort: 'random' }).done(function (response) {
                self.items = response;
            });
        },

        index: ko.observable(0),

        items: ko.observableArray([]),

        next: function () {
            var self = this;

            if (self.index() < self.items.length - 1) {
                self.index(self.index() + 1);
            }
        },

        previous: function () {
            var self = this;

            if (self.index() > 0) {
                self.index(self.index() - 1);
            }
        }
    };
});