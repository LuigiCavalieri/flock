/**
 * Copyright 2021 Luigi Cavalieri.
 * @license GPL v3.0 (https://opensource.org/licenses/GPL-3.0).
 * *************************************************************** */

window.addEventListener( 'load', function () {
    var close_active_submenu = function() {
        if ( active_submenu ) {
            active_submenu.removeAttribute( 'style' );
            active_submenu = null;
        }
    };

    const site_nav_container = document.getElementById( 'site-nav-container' );
    const hamburger_btn      = document.getElementById( 'mobile-nav-toggle' );

    hamburger_btn.addEventListener( 'click', function() {
        site_nav_container.classList.toggle( 'hide-resp-nav' );
    });

    const navlinks     = site_nav_container.getElementsByTagName( 'a' );
    var active_submenu = null;

    for ( var i = 0; i < navlinks.length; i++ ) {
        navlinks[i].addEventListener( 'focusin', function() {
            if (! this.parentElement.parentElement.classList.contains( 'sub-menu' ) ) {
                close_active_submenu();
                
                if ( this.nextElementSibling ) {
                    active_submenu = this.nextElementSibling;
                    active_submenu.style.display = 'block';
                }
            }
        });
        navlinks[i].addEventListener( 'focusout', function( event ) {
            const focused_element = event.relatedTarget;
            
            if (
                !(
                    focused_element && 
                    focused_element.parentElement.classList.contains( 'menu-item' )
                )
            ) {
                close_active_submenu();
            }
        });
    }

    const scroll_btn = document.getElementById( 'scroll-top' );

    scroll_btn.addEventListener( 'click', function( event ) {
        event.preventDefault();
        window.scrollTo( { top: 0, behavior: 'smooth' } );
    });
});