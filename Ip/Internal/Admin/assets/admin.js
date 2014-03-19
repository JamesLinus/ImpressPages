
$(document).ready(function() {
    "use strict";
    ipAdmin.init();
});

var ipAdmin = new function () {
    "use strict";
    var $adminMenu;
    var $adminMenuContainer;
    var $container;
    var $currentItem;

    this.init = function () {
        $('body').prepend($(ipAdminNavbar));
        $container = $('.ipsAdminNavbarContainer'); // the most top element physically creates a space
        $currentItem = $('.ipsItemCurrent');

        $adminMenu = $('.ipsAdminMenuBlock');
        $adminMenuContainer = $('.ipsAdminMenuBlockContainer');

        $('.ipsAdminMenu').on('mouseenter', function (e) { showAdminMenu(); });

        $adminMenu.on('mouseleave', function (e) { hideAdminMenu(); });

        //prevent session expire
        if (typeof(ipAdminSessionRefresh) !== 'undefined') {
            setInterval(refreshSession, ipAdminSessionRefresh * 1000);
        }

        fixLayout();
        $(document).trigger('ipAdminPanelInit');
    };

    var showAdminMenu = function () {
        $currentItem.addClass('hidden');
        $adminMenu.removeClass('hidden');
    };

    var hideAdminMenu = function () {
        $currentItem.removeClass('hidden');
        $adminMenu.addClass('hidden');
        $adminMenu.focus(); //makes click outside adminMenu work as roll out.
    };

    var fixLayout = function () {
        var $navbar = $('.ipsAdminNavbar'); // Administration Panel that stays always visible
        $container.height($navbar.outerHeight()); // setting the height to container
        var containerHeight = $(window).height()-$navbar.outerHeight();
        $adminMenuContainer.height(containerHeight);
    }

    var refreshSession = function () {
        $.ajax({
            url: ip.baseUrl, //we assume that for already has m, g, a parameters which will lead this request to required controller
            dataType: 'json',
            type : 'GET',
            data: {sa: 'Admin.sessionRefresh'},
            success: function (response) {
                //do nothing
            }
        });
    };
};

