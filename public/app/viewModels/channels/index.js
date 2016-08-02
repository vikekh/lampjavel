define(function (require) {
    var app = require('durandal/app');
    var dataService = require('dataService');
    var ko = require('knockout');
    var shell = require('viewModels/shell');

    function Channel(data) {
        this.id = ko.observable(data.id);
        this.imagesCount = ko.observable(data.imagesCount);
        this.isPublic = ko.observable(data.isPublic === 1);
    }

    var viewModel = {};

    viewModel.activate = function (channelId) {
        var self = this;

        shell.header('Channels');

        return dataService.getChannels().done(function (response) {
            self.channels([]);

            for (var i = 0; i < response.length; i++) {
                self.channels.push(new Channel(response[i]));
            }
        });
    };

    viewModel.channels = ko.observableArray([]);

    return viewModel;
});