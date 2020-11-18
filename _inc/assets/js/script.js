// Scripts

( function ( $ ) {
    $( document ).ready( function() {
        const $sideMenuWrap = $( '.side-menu-wrap' ),
            $sideMenuInner = $sideMenuWrap.find( '.inner-wrap' ),
            $topSearchWrap = $( '.top-search-wrap' ),
            $topSearchInput = $topSearchWrap.find( '.search-input' ),
            $sideCartWrap = $( '.side-cart-wrap' ),
            $sideCartInner = $sideMenuWrap.find( '.inner-wrap' );

        function init() {
            $( '.vertical-scrollbar' ).overlayScrollbars( {} );
            bindEvents();
        }

        function bindEvents() {
            // Site Header Submenus
            $( document ).click( function (event) {

                const $target = $( event.target ),
                    $submenuWrap = $target.closest( '.site-header .submenu-wrap' );

                if ( $submenuWrap.length ) {
                    $( '.site-header .submenu-wrap' ).each( function () {
                        if ( ! $( this ).is( $submenuWrap ) ) {
                            $( this ).removeClass( 'show-submenu' );
                        }
                    } );
                    if ( $( event.target ).closest( '.btn-toggle-submenu' ).length ||
                        $( event.target ).is( '.btn-toggle-submenu' ) ) {
                        $submenuWrap.toggleClass( 'show-submenu' );
                    }
                } else {
                    $( '.site-header .submenu-wrap' ).removeClass( 'show-submenu' );
                }

            } );

            // Full Overlay
            $( '.full-overlay' ).click( function (event) {
                if ( $( this ).is( event.target ) ) $( this ).removeClass( 'show' );
            } );

            $( '.full-overlay .btn-close-overlay' ).click( function() {
                $( this ).closest( '.full-overlay' ).removeClass( 'show' );
            } );

            // Side Menu
            $( '.btn-side-menu' ).click( function() {
                $sideMenuWrap.addClass( 'show' );
            } );

            $( '.side-menu .btn-toggle-submenu' ).click( function () {
                $( this ).closest( 'li' ).toggleClass(' show-submenu ').siblings().removeClass( 'show-submenu' );
            } );

            // Top Search
            $( '.site-header .btn-search' ).click( function () {
                $topSearchWrap.addClass( 'show' );
                $topSearchInput.focus();
            } );

            // Side Cart
            $( '.site-header .btn-cart' ).click( function () {
                $sideCartWrap.addClass( 'show' );
            } );

        }

        init();

    } );
} )( jQuery );
