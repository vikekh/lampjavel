define(function (require) {
    var dataService = require('dataService');
    var ko = require('knockout');
    var shell = require('viewModels/shell');

    function Channel(data) {
        this.id = ko.observable(data.id);
        this.imagesCount = ko.observable(data.imagesCount);
        this.isPublic = ko.observable(data.isPublic === 1);
    }

    return {
        activate: function (channelId) {
            var self = this;

            shell.header('Channels');

            return dataService.getChannels().done(function (data, textStatus, jqXhr) {
                self.channels([]);

                data.forEach(function (value, index, array) {
                    self.channels.push(new Channel(value));
                });
            });
        },

        channels: ko.observableArray([])
    };
});