define(['plugins/router', 'durandal/app', 'knockout'], function (router, app, ko) {
    return {
        changeChannel: function () {
            //app.trigger('channelContext', this.channelId());
            router.navigate('#' + this.channelId())
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
                    route: ':channelId',
                    title: 'Home',
                    moduleId: 'viewModels/channels/viewer',
                    nav: true
                }
            ]).buildNavigationModel();
            
            return router.activate();
        }
    };
});