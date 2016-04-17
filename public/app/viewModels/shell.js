define(['plugins/router', 'durandal/app', 'knockout'], function (router, app, ko) {
    return {
        channelId: ko.observable('lampjavel'),

        router: router,

        activate: function () {
            router.map([{
                route: '(:channelId)',
                title: 'Welcome',
                moduleId: 'viewModels/index',
                nav: true
            }]).buildNavigationModel();
            
            return router.activate();
        }
    };
});