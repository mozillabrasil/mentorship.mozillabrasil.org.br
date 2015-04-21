var APP = {
  language: null,
  onLocalized: function() {
    //var $l10n = document.webL10n;
    //$l10n.setLanguage(APP.language);
  },

  login: function() {
    navigator.id.request({
      siteName: 'Mentorship',

      //siteLogo: 'https://mentorship.mozillabrasil.org.br/assets/images/mozilla-brasil.png',
      //termsOfService: '/tos.html',
      //privacyPolicy: '/privacy.html',
      //returnTo: '/welcome.html',
      oncancel: function() {
        //alert('Tentativa de login cancelada');
      }
    });
  },

  openModalRequestMentor: function() {
    var $modal = $('#modal-request-mentor');
    $modal.modal('show');
  },

  init: function() {
    var _this = this;
    $('main #login button#btn-request-mentor').click(function() {
      _this.openModalRequestMentor();
    });

    $('main #login button#btn-login-persona').click(function() {
      _this.login();
    });

    $('main #login button#btn-contribute').click(function() {
      if (window.confirm('Você será redirecionado para outra página.\nDeseja continuar ?')) {
        window.open('http://contribua.mozillabrasil.org.br/', 'What can I do for Mozilla');
      }
    });

    navigator.id.watch({
      onlogin: function($assertion) {
        $.ajax({
          url: URL_BASE + 'login/auth',
          data: {
            assertion: $assertion
          },
          dataType: 'json',
          method: 'POST',
          success: function($json) {
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

      oncancel: function() {},

      onlogout: function() {},

      onready: function() {}
    });
  }
};
APP.init();
