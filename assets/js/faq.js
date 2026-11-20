/**
 * FAQ pages: live search, expand all, deep links (#faq-123), the topic
 * scroll-spy, the Explorer landing page (instant answers, product tabs) and
 * the Concierge landing page (guided chat). The
 * expanders themselves are native <details> elements and the
 * search also works without JavaScript (?q=), so this is an enhancement only.
 * No dependencies; vanilla JS only.
 */
( function () {
	'use strict';

	function ready( fn ) {
		if ( document.readyState !== 'loading' ) {
			fn();
		} else {
			document.addEventListener( 'DOMContentLoaded', fn );
		}
	}

	// FAQs (each { q, a, c? }) containing every word of the query; questions
	// that contain the words rank above answers that do. Shared by the
	// Explorer instant answers and the Concierge.
	function matchFaqs( list, query ) {
		var words = String( query ).toLowerCase().split( /\s+/ ).filter( Boolean );
		if ( ! words.length ) {
			return { words: words, hits: [] };
		}
		var score = function ( f ) {
			return words.filter( function ( w ) { return f.ql.indexOf( w ) !== -1; } ).length;
		};
		var hits = list.filter( function ( f ) {
			if ( f.hay === undefined ) {
				f.hay = ( f.q + ' ' + f.a + ' ' + ( f.c || '' ) ).toLowerCase();
				f.ql = f.q.toLowerCase();
			}
			return words.every( function ( w ) { return f.hay.indexOf( w ) !== -1; } );
		} );
		hits.sort( function ( a, b ) {
			return score( b ) - score( a );
		} );
		return { words: words, hits: hits };
	}

	function escHtml( s ) {
		return String( s == null ? '' : s ).replace( /[&<>"']/g, function ( c ) {
			return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[ c ];
		} );
	}

	ready( function () {
		var root = document.querySelector( '[data-faq-root]' );
		if ( ! root ) {
			return;
		}

		var items = Array.prototype.slice.call( root.querySelectorAll( '[data-faq-item]' ) );
		var groups = Array.prototype.slice.call( root.querySelectorAll( '[data-faq-group]' ) );
		var search = root.querySelector( '[data-faq-search]' );
		var clearBtn = root.querySelector( '[data-faq-clear]' );
		var status = root.querySelector( '[data-faq-status]' );
		var empty = root.querySelector( '[data-faq-empty]' );
		var expandAll = root.querySelector( '[data-faq-expand-all]' );

		// Each FAQ is a native <details>: it opens without JavaScript. This
		// only keeps the URL hash and the "Expand all" button in step.
		function details( item ) {
			return item.querySelector( 'details' );
		}

		function setOpen( item, open ) {
			var d = details( item );
			if ( d ) {
				d.open = open;
			}
		}

		function isOpen( item ) {
			var d = details( item );
			return !! ( d && d.open );
		}

		function syncExpandAll() {
			if ( ! expandAll ) {
				return;
			}
			var visible = items.filter( function ( i ) { return ! i.hidden; } );
			var allOpen = visible.length > 0 && visible.every( isOpen );
			expandAll.textContent = allOpen ? expandAll.getAttribute( 'data-collapse' ) : expandAll.getAttribute( 'data-expand' );
			expandAll.setAttribute( 'data-state', allOpen ? 'open' : 'closed' );
		}

		// "toggle" doesn't bubble, so listen in the capture phase.
		var bulk = false;
		root.addEventListener( 'toggle', function ( e ) {
			var item = e.target.closest && e.target.closest( '[data-faq-item]' );
			if ( ! item || bulk ) {
				return;
			}
			if ( e.target.open && window.history && history.replaceState ) {
				history.replaceState( null, '', window.location.pathname + window.location.search + '#' + item.id );
			}
			syncExpandAll();
		}, true );

		if ( expandAll ) {
			expandAll.hidden = false;
			expandAll.addEventListener( 'click', function () {
				var open = expandAll.getAttribute( 'data-state' ) !== 'open';
				bulk = true;
				items.forEach( function ( i ) {
					if ( ! i.hidden ) {
						setOpen( i, open );
					}
				} );
				// Toggle events fire asynchronously; sync once they have.
				setTimeout( function () {
					bulk = false;
					syncExpandAll();
				}, 0 );
				syncExpandAll();
			} );
		}
		// Live search.
		function plural( n ) {
			if ( ! status ) {
				return '';
			}
			return n === 1 ? status.getAttribute( 'data-one' ) : status.getAttribute( 'data-many' ).replace( '%d', n );
		}

		function clearMarks( item ) {
			item.querySelectorAll( 'h3 mark' ).forEach( function ( m ) {
				m.replaceWith( document.createTextNode( m.textContent ) );
			} );
			var span = item.querySelector( 'h3 span' );
			if ( span ) {
				span.normalize();
			}
		}

		function markTitle( item, terms ) {
			var span = item.querySelector( 'h3 span' );
			if ( ! span || ! terms.length ) {
				return;
			}
			var text = span.textContent;
			var re = new RegExp( '(' + terms.map( function ( t ) {
				return t.replace( /[.*+?^${}()|[\]\\]/g, '\\$&' );
			} ).join( '|' ) + ')', 'ig' );
			if ( ! re.test( text ) ) {
				return;
			}
			span.textContent = '';
			text.split( re ).forEach( function ( part, idx ) {
				if ( idx % 2 ) {
					var m = document.createElement( 'mark' );
					m.textContent = part;
					span.appendChild( m );
				} else if ( part ) {
					span.appendChild( document.createTextNode( part ) );
				}
			} );
		}

		function runSearch() {
			var q = search ? search.value.trim().toLowerCase() : '';
			var terms = q ? q.split( /\s+/ ).filter( Boolean ) : [];
			var shown = 0;

			items.forEach( function ( item ) {
				clearMarks( item );
				var hay = item.getAttribute( 'data-search' ) || '';
				var match = terms.every( function ( t ) { return hay.indexOf( t ) !== -1; } );
				item.hidden = ! match;
				if ( match ) {
					shown++;
					markTitle( item, terms );
				}
			} );

			groups.forEach( function ( g ) {
				g.hidden = ! g.querySelector( '[data-faq-item]:not([hidden])' );
			} );

			if ( empty ) {
				empty.classList.toggle( 'dsn:hidden', shown > 0 );
			}
			if ( clearBtn ) {
				clearBtn.classList.toggle( 'dsn:hidden', ! q );
			}
			if ( status ) {
				status.textContent = q ? plural( shown ) + ' — ' + '"' + search.value.trim() + '"' : plural( shown );
			}
			syncExpandAll();
		}

		if ( search ) {
			search.addEventListener( 'input', runSearch );
			search.form && search.form.addEventListener( 'submit', function ( e ) { e.preventDefault(); } );
			var preset = new URLSearchParams( window.location.search ).get( 'q' );
			if ( preset ) {
				search.value = preset;
				runSearch();
			}
		}
		if ( clearBtn ) {
			clearBtn.addEventListener( 'click', function () {
				search.value = '';
				runSearch();
				search.focus();
			} );
		}

		// Deep link: #faq-123 opens that FAQ and scrolls to it.
		function openFromHash() {
			var id = window.location.hash.slice( 1 );
			if ( ! id || id.indexOf( 'faq-' ) !== 0 ) {
				return;
			}
			var item = document.getElementById( id );
			if ( item && item.hasAttribute( 'data-faq-item' ) ) {
				item.hidden = false;
				setOpen( item, true );
				syncExpandAll();
				item.scrollIntoView( { block: 'center' } );
			}
		}
		openFromHash();
		window.addEventListener( 'hashchange', openFromHash );

		// Scroll-spy for the topic list (product line page only). The active
		// topic is the last group whose top has scrolled past a line near the
		// top of the screen; a clicked topic stays active until the visitor
		// scrolls again themselves (a short last group may never reach the line).
		var navLinks = Array.prototype.slice.call( root.querySelectorAll( '[data-faq-nav]' ) );
		var allLink = root.querySelector( '[data-faq-nav-all]' );
		if ( navLinks.length && groups.length && ! document.querySelector( '[aria-current="page"][data-faq-nav]' ) ) {
			var locked = false;
			var setActive = function ( slug ) {
				navLinks.forEach( function ( a ) {
					a.classList.toggle( 'faq-chip--active', a.getAttribute( 'data-faq-nav' ) === slug );
				} );
				if ( allLink ) {
					allLink.classList.toggle( 'faq-chip--active', ! slug );
				}
			};
			var spy = function () {
				if ( locked ) {
					return;
				}
				var line = Math.max( 160, window.innerHeight * 0.3 );
				var current = '';
				groups.forEach( function ( g ) {
					if ( ! g.hidden && g.getBoundingClientRect().top <= line ) {
						current = g.id.replace( 'cat-', '' );
					}
				} );
				setActive( current );
			};
			navLinks.forEach( function ( a ) {
				a.addEventListener( 'click', function () {
					locked = true;
					setActive( a.getAttribute( 'data-faq-nav' ) );
				} );
			} );
			var unlock = function () {
				locked = false;
			};
			[ 'wheel', 'touchstart', 'keydown' ].forEach( function ( ev ) {
				window.addEventListener( ev, unlock, { passive: true } );
			} );
			var ticking = false;
			window.addEventListener( 'scroll', function () {
				if ( ! ticking ) {
					ticking = true;
					window.requestAnimationFrame( function () {
						spy();
						ticking = false;
					} );
				}
			}, { passive: true } );
			if ( window.location.hash.indexOf( '#cat-' ) === 0 ) {
				locked = true;
				setActive( window.location.hash.slice( 5 ) );
			} else {
				spy();
			}
		}

		syncExpandAll();
	} );

	// Explorer landing page: instant answers. As the visitor types, matching
	// questions appear under the search box with their quick answer; arrow
	// keys move through them, Enter opens one (or searches every answer).
	ready( function () {
		var input = document.querySelector( '[data-faq-instant]' );
		var form = input && input.form;
		var box = form && form.querySelector( '[data-faq-suggest-box]' );
		var list = box && box.querySelector( '[data-faq-suggest]' );
		var data = form && form.querySelector( '[data-faq-index]' );
		if ( ! input || ! box || ! list || ! data ) {
			return;
		}
		var index = [];
		try {
			index = JSON.parse( data.textContent ) || [];
		} catch ( e ) {
			return;
		}
		var all = box.querySelector( '[data-faq-suggest-all]' );
		var foot = box.querySelector( '[data-faq-suggest-foot]' );
		var empty = box.querySelector( '[data-faq-suggest-empty]' );
		var active = -1;

		var esc = escHtml;

		// Escaped text with the search words wrapped in <mark>.
		function mark( text, words ) {
			var re = new RegExp( '(' + words.map( function ( w ) {
				return w.replace( /[.*+?^${}()|[\]\\]/g, '\\$&' );
			} ).join( '|' ) + ')', 'ig' );
			return String( text ).split( re ).map( function ( part, n ) {
				return n % 2 ? '<mark>' + esc( part ) + '</mark>' : esc( part );
			} ).join( '' );
		}

		function options() {
			return Array.prototype.slice.call( list.querySelectorAll( '[role="option"]' ) );
		}

		function setActive( i ) {
			var opts = options();
			active = opts.length ? ( i + opts.length ) % opts.length : -1;
			opts.forEach( function ( o, n ) {
				o.classList.toggle( 'is-active', n === active );
				o.setAttribute( 'aria-selected', n === active ? 'true' : 'false' );
			} );
			if ( active > -1 ) {
				input.setAttribute( 'aria-activedescendant', opts[ active ].id );
				opts[ active ].scrollIntoView( { block: 'nearest' } );
			} else {
				input.removeAttribute( 'aria-activedescendant' );
			}
		}

		function close() {
			box.hidden = true;
			input.setAttribute( 'aria-expanded', 'false' );
			input.removeAttribute( 'aria-activedescendant' );
			active = -1;
		}

		function render() {
			var q = input.value.trim();
			if ( q.length < 2 ) {
				close();
				return;
			}
			var found = matchFaqs( index, q );
			var words = found.words;
			var hits = found.hits;
			list.innerHTML = hits.slice( 0, 6 ).map( function ( f, n ) {
				var a = f.a.length > 150 ? f.a.slice( 0, 147 ).replace( /\s+\S*$/, '' ) + '…' : f.a;
				return '<li><a id="faq-sug-' + n + '" role="option" aria-selected="false" href="' + esc( f.u ) + '" class="faq-suggestion dsn:block dsn:rounded-faq-btn dsn:px-4 dsn:py-3 dsn:transition dsn:hover:bg-faq-surface">' +
					( f.c ? '<span class="faq-eyebrow dsn:block dsn:text-[10px] dsn:text-faq-primary">' + esc( f.c ) + '</span>' : '' ) +
					'<span class="dsn:mt-0.5 dsn:block dsn:font-semibold dsn:leading-snug dsn:text-faq-ink">' + mark( f.q, words ) + '</span>' +
					'<span class="dsn:mt-1 dsn:block dsn:text-sm dsn:leading-snug dsn:text-faq-ink/60">' + mark( a, words ) + '</span></a></li>';
			} ).join( '' );
			list.hidden = ! hits.length;
			if ( empty ) {
				empty.hidden = hits.length > 0;
			}
			// The server search also reads the full answers, so it can find more.
			if ( all && foot ) {
				foot.hidden = ! hits.length;
				all.textContent = all.getAttribute( 'data-label' ).replace( '%s', q );
			}
			box.hidden = false;
			input.setAttribute( 'aria-expanded', 'true' );
			active = -1;
		}

		input.addEventListener( 'input', render );
		input.addEventListener( 'focus', function () {
			if ( input.value.trim().length >= 2 ) {
				render();
			}
		} );
		input.addEventListener( 'keydown', function ( e ) {
			if ( box.hidden ) {
				return;
			}
			if ( e.key === 'ArrowDown' || e.key === 'ArrowUp' ) {
				e.preventDefault();
				setActive( active + ( e.key === 'ArrowDown' ? 1 : -1 ) );
			} else if ( e.key === 'Enter' && active > -1 ) {
				e.preventDefault();
				window.location.href = options()[ active ].href;
			} else if ( e.key === 'Escape' ) {
				close();
			}
		} );
		document.addEventListener( 'click', function ( e ) {
			if ( ! form.contains( e.target ) ) {
				close();
			}
		} );
	} );

	// Explorer landing page: product tabs. Without JavaScript every product
	// panel is shown in turn; this turns them into tabs (arrow keys move
	// between tabs, #line-<slug> opens one directly).
	ready( function () {
		var tablist = document.querySelector( '[data-faq-tabs]' );
		if ( ! tablist ) {
			return;
		}
		var tabs = Array.prototype.slice.call( tablist.querySelectorAll( '[data-faq-tab]' ) );
		var panels = Array.prototype.slice.call( document.querySelectorAll( '[data-faq-panel]' ) );
		if ( tabs.length < 2 ) {
			return;
		}

		function select( slug, focus ) {
			tabs.forEach( function ( t ) {
				var on = t.getAttribute( 'data-faq-tab' ) === slug;
				t.setAttribute( 'aria-selected', on ? 'true' : 'false' );
				t.tabIndex = on ? 0 : -1;
				if ( on && focus ) {
					t.focus();
				}
				if ( on ) {
					t.scrollIntoView( { block: 'nearest', inline: 'nearest' } );
				}
			} );
			panels.forEach( function ( p ) {
				p.hidden = p.getAttribute( 'data-faq-panel' ) !== slug;
			} );
		}

		tablist.hidden = false;
		var fromHash = window.location.hash.indexOf( '#line-' ) === 0 ? window.location.hash.slice( 6 ) : '';
		var first = tabs.some( function ( t ) { return t.getAttribute( 'data-faq-tab' ) === fromHash; } ) ? fromHash : tabs[ 0 ].getAttribute( 'data-faq-tab' );
		select( first, false );

		tabs.forEach( function ( t, i ) {
			t.addEventListener( 'click', function () {
				select( t.getAttribute( 'data-faq-tab' ), false );
				if ( window.history && history.replaceState ) {
					history.replaceState( null, '', window.location.pathname + window.location.search + '#line-' + t.getAttribute( 'data-faq-tab' ) );
				}
			} );
			t.addEventListener( 'keydown', function ( e ) {
				var step = { ArrowRight: 1, ArrowLeft: -1 }[ e.key ];
				if ( e.key === 'Home' ) {
					step = -i;
				} else if ( e.key === 'End' ) {
					step = tabs.length - 1 - i;
				}
				if ( step !== undefined ) {
					e.preventDefault();
					select( tabs[ ( i + step + tabs.length ) % tabs.length ].getAttribute( 'data-faq-tab' ), true );
				}
			} );
		} );
	} );

	// Concierge landing page: a guided, chat-style answer finder. Product →
	// topic → question, answered with the quick answer; or a typed question,
	// answered with the best match. The tree and the messages come from the
	// page (data-cc-tree, data-i18n); without JavaScript the first choices are
	// plain links and the typed question is a normal search.
	ready( function () {
		var box = document.querySelector( '[data-faq-concierge]' );
		var data = box && box.querySelector( '[data-cc-tree]' );
		var log = box && box.querySelector( '[data-cc-log]' );
		if ( ! data || ! log ) {
			return;
		}
		var tree;
		var t;
		try {
			tree = JSON.parse( data.textContent );
			t = JSON.parse( box.getAttribute( 'data-i18n' ) ) || {};
		} catch ( e ) {
			return;
		}
		var faqs = tree.faqs || {};
		var all = Object.keys( faqs ).map( function ( id ) {
			faqs[ id ].id = id;
			return faqs[ id ];
		} );
		var form = box.querySelector( '[data-cc-form]' );
		var input = box.querySelector( '[data-cc-input]' );
		var restartBtn = box.querySelector( '[data-cc-restart]' );
		var start = log.innerHTML;
		var reduce = window.matchMedia && window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;
		var busy = false;

		function fmt( s, v ) {
			return String( s || '' ).replace( '%s', v );
		}

		function scroll() {
			log.scrollTo( { top: log.scrollHeight, behavior: reduce ? 'auto' : 'smooth' } );
		}

		function add( cls, html ) {
			var li = document.createElement( 'li' );
			li.className = cls;
			li.innerHTML = html;
			log.appendChild( li );
			scroll();
			return li;
		}

		function user( text ) {
			add( 'cc-user', '<p class="cc-bubble">' + escHtml( text ) + '</p>' );
			restartBtn.hidden = false;
		}

		// A reply from the concierge, after a short "typing" pause.
		function say( html, then ) {
			busy = true;
			var typing = add( 'cc-bot', '<p class="cc-bubble cc-typing" aria-label="' + escHtml( t.typing ) + '"><i></i><i></i><i></i></p>' );
			window.setTimeout( function () {
				typing.innerHTML = '<div class="cc-bubble">' + html + '</div>';
				busy = false;
				if ( then ) {
					then();
				}
				scroll();
			}, reduce ? 0 : 550 );
		}

		// A row of choices; picking one freezes the row and runs its action.
		function choices( items ) {
			var li = add( 'cc-choices', '' );
			items.forEach( function ( item ) {
				var b = document.createElement( 'button' );
				b.type = 'button';
				b.className = 'cc-chip' + ( item.quiet ? ' cc-chip--quiet' : '' );
				b.innerHTML = ( item.icon || '' ) + '<span>' + escHtml( item.label ) + '</span>';
				b.addEventListener( 'click', function () {
					if ( busy || li.classList.contains( 'is-done' ) ) {
						return;
					}
					freeze( li, b );
					item.run();
				} );
				li.appendChild( b );
			} );
			scroll();
		}

		function freeze( row, chosen ) {
			row.classList.add( 'is-done' );
			Array.prototype.slice.call( row.children ).forEach( function ( c ) {
				c.classList.toggle( 'is-chosen', c === chosen );
				c.setAttribute( 'tabindex', '-1' );
				c.setAttribute( 'aria-disabled', 'true' );
			} );
		}

		function card( f, lead ) {
			return '<span class="cc-lead">' + escHtml( lead ) + '</span>' +
				'<strong class="dsn:mt-1 dsn:block dsn:font-faq-display dsn:text-lg dsn:font-medium dsn:leading-snug dsn:text-faq-ink">' + escHtml( f.q ) + '</strong>' +
				'<span class="dsn:mt-2 dsn:block dsn:leading-relaxed dsn:text-faq-ink/80">' + escHtml( f.a ) + '</span>' +
				'<span class="dsn:mt-4 dsn:flex dsn:flex-wrap dsn:gap-2">' +
				'<a class="faq-btn faq-btn-primary faq-btn-sm" href="' + escHtml( f.u ) + '">' + escHtml( t.readFull ) + '</a>' +
				'<a class="faq-btn faq-btn-outline faq-btn-sm" href="#faq-ask" data-faq-ask>' + escHtml( t.ask ) + '</a>' +
				'</span>';
		}

		function questions( ids, back ) {
			choices( ids.filter( function ( id ) { return faqs[ id ]; } ).slice( 0, 8 ).map( function ( id ) {
				return { label: faqs[ id ].q, run: function () { answer( id, back ); } };
			} ) );
		}

		// back: { label, run } to offer "more about this topic" after the answer.
		function answer( id, back ) {
			var f = faqs[ id ];
			user( f.q );
			say( card( f, t.answer ), function () {
				say( escHtml( t.next ), function () {
					var next = [];
					if ( back ) {
						next.push( back );
					}
					next.push( { label: t.restart, quiet: true, run: restart } );
					next.push( { label: t.seeAll, quiet: true, run: function () { go( '#products' ); } } );
					choices( next );
				} );
			} );
		}

		function topic( line, tp ) {
			user( tp.name );
			say( escHtml( fmt( t.pickQ, tp.name ) ), function () {
				questions( tp.faqs, { label: fmt( t.more, tp.name ), run: function () { topicAgain( line, tp ); } } );
			} );
		}

		function topicAgain( line, tp ) {
			user( fmt( t.more, tp.name ) );
			say( escHtml( fmt( t.pickQ, tp.name ) ), function () {
				questions( tp.faqs, { label: fmt( t.more, tp.name ), run: function () { topicAgain( line, tp ); } } );
			} );
		}

		function product( i ) {
			var line = tree.lines[ i ];
			if ( ! line ) {
				return;
			}
			user( line.name );
			say( escHtml( fmt( t.askTopic, line.name ) ), function () {
				var items = line.topics.map( function ( tp ) {
					return { label: tp.name, icon: tp.icon, run: function () { topic( line, tp ); } };
				} );
				var most = { name: t.mostAsked, faqs: line.top };
				items.unshift( { label: t.mostAsked, icon: line.icon, run: function () { topic( line, most ); } } );
				choices( items );
			} );
		}

		function company() {
			var co = tree.company;
			user( co.name );
			say( escHtml( t.pickCo ), function () {
				questions( co.faqs, null );
			} );
		}

		function typed( q ) {
			user( q );
			var hits = matchFaqs( all, q ).hits;
			if ( ! hits.length ) {
				say( escHtml( t.none ) + '<span class="dsn:mt-3 dsn:block"><a class="faq-btn faq-btn-accent faq-btn-sm" href="#faq-ask" data-faq-ask>' + escHtml( t.ask ) + '</a></span>', function () {
					choices( [ { label: t.restart, quiet: true, run: restart } ] );
				} );
				return;
			}
			say( card( hits[ 0 ], t.best ), function () {
				if ( hits.length > 1 ) {
					say( escHtml( t.related ), function () {
						questions( hits.slice( 1, 4 ).map( function ( f ) { return f.id; } ), null );
						choices( [ { label: t.restart, quiet: true, run: restart } ] );
					} );
				} else {
					choices( [ { label: t.restart, quiet: true, run: restart } ] );
				}
			} );
		}

		function restart() {
			log.innerHTML = start;
			restartBtn.hidden = true;
			busy = false;
			log.scrollTop = 0;
		}

		function go( hash ) {
			var el = document.querySelector( hash );
			if ( el ) {
				el.scrollIntoView( { behavior: reduce ? 'auto' : 'smooth', block: 'start' } );
			}
		}

		// The first choices are real links (they work without JavaScript).
		log.addEventListener( 'click', function ( e ) {
			var a = e.target.closest( '[data-cc-line], [data-cc-company]' );
			if ( ! a ) {
				return;
			}
			e.preventDefault();
			var row = a.closest( '.cc-choices' );
			if ( busy || row.classList.contains( 'is-done' ) ) {
				return;
			}
			freeze( row, a );
			if ( a.hasAttribute( 'data-cc-company' ) ) {
				company();
			} else {
				product( parseInt( a.getAttribute( 'data-cc-line' ), 10 ) );
			}
		} );

		restartBtn.addEventListener( 'click', restart );

		form.addEventListener( 'submit', function ( e ) {
			var q = input.value.trim();
			e.preventDefault();
			if ( q && ! busy ) {
				input.value = '';
				typed( q );
			}
		} );
	} );
}() );
