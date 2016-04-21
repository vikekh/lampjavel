define(['plugins/router', 'durandal/app', 'knockout'], function (router, app, ko) {
    return {
        changeChannel: function () {
            app.trigger('channelContext', this.channelId());
        },

        channelId: ko.observable('lampjavel'),

        router: router,

        activate: function () {
            router.map([
                {
                    route: '(:channelId)',
                    title: 'Home',
                    moduleId: 'viewModels/index',
                    nav: true
                },

            ]).buildNavigationModel();
            
            return router.activate();
        }
    };
});