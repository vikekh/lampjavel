define(['plugins/router', 'durandal/app', 'knockout'], function (router, app, ko) {
    return {
        changeChannel: function () {
            //app.trigger('channelContext', this.channelId());
            router.navigate('#channels/' + this.channelId())
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
                    route: 'channels',
                    title: 'Channels',
                    moduleId: 'viewModels/channels/index',
                    nav: true
                },
                {
                    route: 'channels/:channelId',
                    moduleId: 'viewModels/channels/viewer',
                    nav: true
                }
            ]).buildNavigationModel();
            
            return router.activate();
        }
    };
});