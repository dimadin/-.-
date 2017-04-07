const CACHE_NAME = 'preslovar.srb-cache-v1';
const urlsToCache = [
	'/',
	'https://unpkg.com/bootstrap@4.0.0-alpha.6/dist/css/bootstrap.min.css',
	'/assets/css/main.min.css?v=1',
	'https://unpkg.com/jquery@3.2.1/dist/jquery.slim.min.js',
	'https://unpkg.com/clipboard@1.6.1/dist/clipboard.min.js',
	'https://unpkg.com/tether@1.4.0/dist/js/tether.min.js',
	'https://unpkg.com/bootstrap@4.0.0-alpha.6/dist/js/bootstrap.min.js',
	'https://unpkg.com/serbian-transliteration@1.0.0/dist/serbian-transliteration.min.js',
	'https://unpkg.com/autosize@3.0.20/dist/autosize.min.js',
	'https://unpkg.com/mousetrap@1.6.1/mousetrap.min.js',
	'/assets/js/main.min.js?v=3'
];

self.addEventListener( 'install', function( event ) {
	// Store cache at installation
	event.waitUntil(
		caches.open( CACHE_NAME )
			.then( function( cache ) {
				return cache.addAll( urlsToCache );
			} )
	);
} );

self.addEventListener( 'fetch', function( event ) {
	// Serve cached response if it exists
	event.respondWith(
		caches.match( event.request )
			.then( function( response ) {
				// Cache hit - return response
				if ( response ) {
					return response;
				}
				
				return fetch( event.request );
			} )
	);
} );
