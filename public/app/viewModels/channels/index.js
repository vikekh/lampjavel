define(['durandal/app', 'jquery', 'knockout', 'dataService', 'viewModels/shell'], function (app, $, ko, dataService, shell) {
    return {
        activate: function (channelId) {
            var self = this;

            shell.header('Channels');

            return dataService.getChannels().done(function (response) {
                self.channels(response);
            });
        },

        channels: ko.observableArray([])
    };
});