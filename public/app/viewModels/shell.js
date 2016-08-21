define(function (require) {
    var app = require('durandal/app');
    var ko = require('knockout');
    var router = require('plugins/router');

    var viewModel = {
        activate: activate,
        changeChannel: changeChannel,
        channelId: ko.observable(),
        header: ko.observable(),
        router: router
    };

    function activate() {
        router.map([
            {
                route: '',
                title: 'Home',
                moduleId: 'viewModels/home/index',
                nav: true
            },
            {
                route: 'channel',
                title: 'Channels',
                moduleId: 'viewModels/channel/index',
                nav: true
            },
            {
                route: 'channel/:channelId',
                moduleId: 'viewModels/image/carousel'
            },
            {
                route: 'utils/import/:channelId',
                moduleId: 'viewModels/utils/import'
            }
        ]).buildNavigationModel();
        
        return router.activate();
    }

    function changeChannel() {
        var self = this;
        
        app.trigger('channelChange', self.channelId());
    }

    return viewModel;
});