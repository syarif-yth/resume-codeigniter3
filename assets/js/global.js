

function baseUrl(segment) {
	pathArray = window.location.pathname.split( '/' );
	indexOfSegment = pathArray.indexOf(segment);
	return window.location.origin + pathArray.slice(0,indexOfSegment).join('/') + '/';
}
