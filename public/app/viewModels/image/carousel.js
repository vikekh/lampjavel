define(function (require) {
    var app = require('durandal/app');
    var dataService = require('dataService');
    var ko = require('knockout');
    var shell = require('viewModels/shell');

    function Image(data) {
        var self = this;

        self.id = data.id;
        self.url = data.url;
    }

    function getImages(channelId, images) {
        return dataService.getImagesFromChannel(
            channelId,
            { sort: 'random' }
        ).done(function (data) {
            data.forEach(function (value, index, array) {
                images.push(new Image(value));
            });
        }).fail(function () {
            images.removeAll();
        });
    }

    return {
        activate: function (channelId) {
            var self = this;

            shell.channelId(channelId);
            shell.header('#' + channelId);

            app.on('channelChange', function (channelId) {
                getImages(channelId, self.images);
            });

            return getImages(channelId, self.images);
        },

        images: ko.observableArray([]),

        index: ko.observable(0),

        next: function () {
            var self = this;

            if (self.index() < self.images().length - 1) {
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