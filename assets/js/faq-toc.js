/**
 * Single FAQ (single-dsn_faq.php): the left-column actions and the
 * Sections navigation. Ported from the DesignStudio v4 theme's post-toc.js.
 *
 * - Copy link / Share buttons (with a small "Link copied" notice).
 * - Sections: highlights the section being read in the sticky list (desktop)
 *   and the pinned bar (phones), jumps to sections, previous/next buttons and
 *   the reading-progress line.
 *
 * Vanilla JS, no dependencies. Styling is Tailwind in single-dsn_faq.php;
 * this flips aria-* / the faq-chip--active class and sets two CSS variables
 * (where sticky things stick, and the scroll offset for headings).
 */
( function () {
	'use strict';

	const side = document.querySelector( '[data-post-side]' );
	if ( ! side ) {
		return;
	}
	const $ = ( s, c = document ) => c.querySelector( s );
	const $$ = ( s, c = document ) => Array.from( c.querySelectorAll( s ) );
	const reduce = window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;

	// A short notice at the bottom of the screen.
	let toastTimer = 0;
	const say = ( msg ) => {
		if ( ! msg ) {
			return;
		}
		let el = $( '.faq-toast' );
		if ( ! el ) {
			el = document.createElement( 'p' );
			el.className = 'faq-toast';
			el.setAttribute( 'role', 'status' );
			document.body.appendChild( el );
		}
		el.textContent = msg;
		el.hidden = false;
		window.clearTimeout( toastTimer );
		toastTimer = window.setTimeout( () => {
			el.hidden = true;
		}, 2500 );
	};

	/* ------------------------------------------------------------------
	 * Actions: copy link, share
	 * ---------------------------------------------------------------- */
	const copy = ( btn ) => {
		const url = btn.dataset.url;
		if ( navigator.clipboard && navigator.clipboard.writeText ) {
			navigator.clipboard.writeText( url ).then( () => say( btn.dataset.copied ), () => say( url ) );
		} else {
			say( url );
		}
	};

	const copyBtn = $( '[data-post-copy]', side );
	if ( copyBtn ) {
		copyBtn.addEventListener( 'click', () => copy( copyBtn ) );
	}

	const shareBtn = $( '[data-post-share]', side );
	if ( shareBtn ) {
		shareBtn.addEventListener( 'click', () => {
			if ( navigator.share ) {
				navigator.share( { title: shareBtn.dataset.title, url: shareBtn.dataset.url } ).catch( () => {} );
			} else {
				copy( shareBtn );
			}
		} );
	}

	/* ------------------------------------------------------------------
	 * Sections navigation
	 * ---------------------------------------------------------------- */
	const links = $$( '[data-toc-link]' );
	if ( ! links.length ) {
		return;
	}
	const bar = $( '[data-post-toc]' ); // The pinned bar on phones.
	const body = $( '[data-post-body]' ) || document.body;
	const barList = $( '[data-toc-list]' );
	const deskList = $( '[data-post-sections] ol' );
	const progress = $( '[data-toc-progress]' );
	const prev = $( '[data-toc-prev]' );
	const next = $( '[data-toc-next]' );
	const heads = [];
	links.forEach( ( a ) => {
		heads[ Number( a.dataset.i ) ] = document.getElementById( decodeURIComponent( a.getAttribute( 'href' ).slice( 1 ) ) );
	} );
	const total = heads.length;
	let current = -1;

	// Height of a header that stays on screen (the "Sticky Header?" option):
	// the lowest fixed or sticky element at the top of the page (under the
	// WordPress toolbar for logged-in users).
	const headerHeight = () => {
		const admin = document.getElementById( 'wpadminbar' );
		let h = admin && 'fixed' === getComputedStyle( admin ).position ? admin.offsetHeight : 0;
		$$( 'body > header, body > div > header, #header, .sticky-header, header' ).forEach( ( el ) => {
			const pos = getComputedStyle( el ).position;
			const r = el.getBoundingClientRect();
			if ( ( 'fixed' === pos || 'sticky' === pos ) && r.top <= h + 1 && r.bottom > h && r.height < window.innerHeight / 2 ) {
				h = r.bottom;
			}
		} );
		return Math.max( 0, h );
	};

	// Where sticky things stick (under the sticky header) and the heading scroll offset.
	const place = () => {
		const top = headerHeight();
		const barH = bar && bar.offsetParent ? bar.offsetHeight : 0;
		document.documentElement.style.setProperty( '--toc-top', top + 'px' );
		document.documentElement.style.setProperty( '--toc-scroll', top + barH + 16 + 'px' );
	};
	const offset = () => parseFloat( getComputedStyle( document.documentElement ).getPropertyValue( '--toc-scroll' ) ) || 120;

	const setCurrent = ( i ) => {
		if ( i === current ) {
			return;
		}
		current = i;
		links.forEach( ( a ) => {
			const on = Number( a.dataset.i ) === i;
			if ( on ) {
				a.setAttribute( 'aria-current', 'location' );
			} else {
				a.removeAttribute( 'aria-current' );
			}
			if ( a.classList.contains( 'faq-chip' ) ) {
				a.classList.toggle( 'faq-chip--active', on );
			}
		} );
		// Keep the active entry visible inside its own scroller without moving the page.
		links.filter( ( a ) => Number( a.dataset.i ) === i ).forEach( ( a ) => {
			if ( barList && barList.contains( a ) ) {
				barList.scrollTo( { left: a.offsetLeft - barList.clientWidth / 2 + a.offsetWidth / 2, behavior: reduce ? 'auto' : 'smooth' } );
			} else if ( deskList && deskList.contains( a ) ) {
				const li = a.parentElement;
				deskList.scrollTo( { top: li.offsetTop - deskList.clientHeight / 2 + li.offsetHeight / 2, behavior: reduce ? 'auto' : 'smooth' } );
			}
		} );
		if ( prev ) {
			prev.disabled = i < 0;
		}
		if ( next ) {
			next.disabled = i >= total - 1;
		}
	};

	const update = () => {
		const y = offset();
		let idx = -1;
		heads.forEach( ( h, n ) => {
			if ( h && h.getBoundingClientRect().top <= y + 2 ) {
				idx = n;
			}
		} );
		setCurrent( idx );
		if ( progress ) {
			const r = body.getBoundingClientRect();
			const len = r.height - window.innerHeight * 0.5;
			progress.style.width = ( len > 0 ? Math.min( 1, Math.max( 0, -r.top / len ) ) : 0 ) * 100 + '%';
		}
	};

	// Jump to a heading, under the sticky header.
	const go = ( el ) => {
		if ( ! el ) {
			return;
		}
		window.scrollTo( { top: el.getBoundingClientRect().top + window.scrollY - offset(), behavior: reduce ? 'auto' : 'smooth' } );
	};

	links.forEach( ( a ) =>
		a.addEventListener( 'click', ( e ) => {
			e.preventDefault();
			go( heads[ Number( a.dataset.i ) ] );
			if ( window.history && window.history.replaceState ) {
				window.history.replaceState( null, '', a.getAttribute( 'href' ) );
			}
		} )
	);
	if ( prev ) {
		// Before the first section, "previous" goes back to the top of the article.
		prev.addEventListener( 'click', () => ( current > 0 ? go( heads[ current - 1 ] ) : go( body ) ) );
	}
	if ( next ) {
		next.addEventListener( 'click', () => go( heads[ Math.min( total - 1, current + 1 ) ] ) );
	}

	let ticking = false;
	window.addEventListener(
		'scroll',
		() => {
			if ( ! ticking ) {
				ticking = true;
				window.requestAnimationFrame( () => {
					update();
					ticking = false;
				} );
			}
		},
		{ passive: true }
	);
	window.addEventListener( 'resize', () => {
		place();
		update();
	} );
	place();
	update();
}() );
