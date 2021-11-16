/**
 * Copyright 2021 Luigi Cavalieri.
 * @license GPL v3.0 (https://opensource.org/licenses/GPL-3.0).
 * *************************************************************** */

window.addEventListener( 'load', () => {
    const scroll_btn = document.getElementById( 'scroll-top' );

    scroll_btn.addEventListener( 'click', ( event ) => {
        event.preventDefault();
        window.scrollTo( { top: 0, behavior: 'smooth' } );
    } );

    const site_nav_container = document.getElementById( 'site-nav-container' );

    if (! site_nav_container ) {
        return false;
    }

    let active_submenu = null;

    let close_active_submenu = () => {
        if ( active_submenu ) {
            active_submenu.removeAttribute( 'style' );
            active_submenu = null;
        }
    };
    
    const hamburger_btn = document.getElementById( 'mobile-nav-toggle' );
    const navlinks      = site_nav_container.getElementsByTagName( 'a' );
    
    hamburger_btn.addEventListener( 'click', () => {
        site_nav_container.classList.toggle( 'hide-resp-nav' );
    } );

    for ( let navlink of navlinks ) {
        navlink.addEventListener( 'focusin', ( event ) => {
            const target = event.target;
            
            if (! target.parentElement.parentElement.classList.contains( 'sub-menu' ) ) {
                close_active_submenu();

                if ( 
                    target.nextElementSibling && 
                    target.nextElementSibling.classList.contains( 'sub-menu' )
                ) {
                    active_submenu = target.nextElementSibling;
                    active_submenu.style.display = 'block';
                }
            }
        } );
        navlink.addEventListener( 'focusout', ( event ) => {
            const prev_target = event.relatedTarget;
            
            if (
                !(
                    prev_target && 
                    prev_target.parentElement.classList.contains( 'menu-item' )
                )
            ) {
                close_active_submenu();
            }
        } );
    }
} );