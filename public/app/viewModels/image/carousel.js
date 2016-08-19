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

    return {
        activate: function (channelId) {
            var self = this;

            shell.channelId(channelId);
            shell.header('#' + channelId);

            app.on('channelChange', function (channelId) {
                self.getImages();
            });

            return self.getImages();
        },

        getImages: function () {
            var self = this;

            self.images.removeAll();

            return dataService.getImagesFromChannel(
                shell.channelId(),
                { sort: 'random' }
            ).done(function (data) {
                data.forEach(function (value, index, array) {
                    self.images.push(new Image(value));
                });
            }).fail(function () {});
        },

        images: ko.observableArray([]),

        index: ko.observable(0),

        next: function () {
            var self = this;

            self.stepIndex(1);
        },

        previous: function () {
            var self = this;

            self.stepIndex(-1);
        },

        stepIndex: function (value) {
            var self = this;
            var index = self.index() + value;

            if (index >= 0 && index < self.images().length) {
                self.index(index);
            }
        }
    };
});