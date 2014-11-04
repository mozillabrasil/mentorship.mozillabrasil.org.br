var APP = {
    language: null,
    onLocalized: function () {
//        var $l10n = document.webL10n;
//        $l10n.setLanguage(APP.language);
    },
    login: function () {
        navigator.id.request();
    },
    init: function () {
        var self = this;
        $('main #login button#login-persona').click(function () {
            self.login();
        });
        navigator.id.watch({
            loggedInUser: null,
            onlogin: function ($assertion) {
                $.ajax({
                    url: URL_BASE + 'login/auth',
                    data: {
                        'assertion': $assertion
                    },
                    dataType: 'json',
                    method: 'POST',
                    success: function ($json) {
                        if ($.isPlainObject($json)) {
                            if ($json.success === true) {
                                window.location = URL_BASE;
                            } else {
                                alert($json.error);
                            }
                        }
                    }
                });
            },
            onlogout: function () {

            },
            onready: function () {
            }
        });
    }
};
APP.init();