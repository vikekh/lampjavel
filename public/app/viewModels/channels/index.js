define(['durandal/app', 'jquery', 'knockout', 'dataService', 'viewModels/shell'], function (app, $, ko, dataService, shell) {
    function Channel(data) {
        this.id = ko.observable(data.id);
        this.isPublic = ko.observable(data.isPublic === 1);
        this.url = ko.computed(function () {
            return '#channels/' + this.id();
        }, this);
    }

    return {
        activate: function (channelId) {
            var self = this;

            shell.header('Channels');

            return dataService.getChannels().done(function (response) {
                for (var i = 0; i < response.length; i++) {
                    self.channels.push(new Channel(response[i]));
                }
            });
        },

        channels: ko.observableArray([])
    };
});