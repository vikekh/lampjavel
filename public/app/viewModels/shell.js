define(['plugins/router', 'durandal/app', 'knockout'], function (router, app, ko) {
    return {
        changeChannel: function () {
            app.trigger('channelContext', this.channelId());
            router.navigate('#channel/' + this.channelId())
        },

        channelId: ko.observable(),

        header: ko.observable(),

        router: router,

        activate: function () {
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
    };
});