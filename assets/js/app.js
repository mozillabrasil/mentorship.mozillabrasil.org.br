var APP = {
  support: Modernizr.csstransitions && Modernizr.csstransforms,
  language: null,
  onLocalized: function() {
    /*var $l10n = document.webL10n;
    $l10n.setLanguage(APP.language);*/
  },

  onHashChange: function() {
    var hash = (window.location.hash).toString();
    hash = hash.replace('#', '');
    if (!$.trim(hash)) {
      window.location.hash = '#members';
      return false;
    }

    var $explode = hash.split('/');
    var $page = $explode[0];
    var $method = $.trim($explode[1]) ? $explode[1] : 'init';
    var $value = $.trim($explode[2]) ? $explode[2] : '';
    require(['pages/' + $page], function($object) {
      if ($.isFunction($object[$method])) {
        $object[$method]($value);
      } else {
        console.log($object);
        console.log($method);
        console.log($value);
      }
    });
  },

  login: function() {
    navigator.id.request();
  },

  init: function() {
    var _this = this;
    window.onhashchange = _this.onHashChange;
    window.onhashchange();
    $('.pm-dropdown.pm-language-selector-menu .pm-dropmenu-active a').click(function() {
      APP.language = $(this).data('l10n');
      _this.onLocalized();
    });

    $('main header form#logout').submit(function() {
      navigator.id.logout();
      return false;
    });

    require.config({
      urlArgs: (new Date()).getTime()
    });
    $.ajaxSetup({
      beforeSend: function() {
        $('body').addClass('blur');
      },

      complete: function() {
        $('body').removeClass('blur');
        _this.onLocalized();
      }
    });
    navigator.id.watch({
      onlogin: function() {
      },

      onready: function() {
      },

      onlogout: function() {
        $.ajax({
          url: URL_BASE + 'main/logout',
          success: function() {
            window.location = URL_BASE + 'login/index';
          }
        });
      }
    });
  }
};
APP.init();
