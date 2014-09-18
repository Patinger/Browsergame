//Globals

var myWidth = 1200, myHeight = 720, myBlockSize = 128;
var scene, camera, renderer, controls;
var geometry, material, mesh;
var myBasePath;
var myField;


function init(basePath){
	myBasePath = basePath;
	$('#myGame').attr({width:myWidth,height:myHeight});

	scene = new THREE.Scene();
	scene.fog = new THREE.FogExp2( 0xffcccc, 0.0005 );
	
	camera = new THREE.PerspectiveCamera( 75, myWidth / myHeight, 1, 10000 );
	camera.position.z = 500;
	camera.rotation.x = 45 * Math.PI / 180;

	renderer = new THREE.WebGLRenderer({canvas: myGame});
	renderer.render( scene, camera );

	controls = new THREE.OrbitControls( camera );
	myField = new MyField(0,0);
	$.getJSON( myBasePath+"/terrain/terrainjson", function( data ) {
		myField.createTerrain(data);
	});

	// Add axes
	// axes = buildAxes( 1000 );
	// scene.add( axes );


	render();
}

function render(){
	controls.update();	
	requestAnimationFrame( render );
	renderer.render( scene, camera );
}


// function buildAxes( length ) {
// 	var axes = new THREE.Object3D();
// 	axes.add( buildAxis( new THREE.Vector3( 0, 0, 0 ), new THREE.Vector3( length, 0, 0 ), 0xFF0000, false ) ); // +X
// 	axes.add( buildAxis( new THREE.Vector3( 0, 0, 0 ), new THREE.Vector3( -length, 0, 0 ), 0xFF0000, true) ); // -X
// 	axes.add( buildAxis( new THREE.Vector3( 0, 0, 0 ), new THREE.Vector3( 0, length, 0 ), 0x00FF00, false ) ); // +Y
// 	axes.add( buildAxis( new THREE.Vector3( 0, 0, 0 ), new THREE.Vector3( 0, -length, 0 ), 0x00FF00, true ) ); // -Y
// 	axes.add( buildAxis( new THREE.Vector3( 0, 0, 0 ), new THREE.Vector3( 0, 0, length ), 0x0000FF, false ) ); // +Z
// 	axes.add( buildAxis( new THREE.Vector3( 0, 0, 0 ), new THREE.Vector3( 0, 0, -length ), 0x0000FF, true ) ); // -Z
// 	return axes;
// }

// function buildAxis( src, dst, colorHex, dashed ) {
// 	var geom = new THREE.Geometry(), mat;
// 	if(dashed) {
// 		mat = new THREE.LineDashedMaterial({ linewidth: 3, color: colorHex, dashSize: 3, gapSize: 3 });
// 	} else {
// 		mat = new THREE.LineBasicMaterial({ linewidth: 3, color: colorHex });
// 	}
// 	geom.vertices.push( src.clone() );
// 	geom.vertices.push( dst.clone() );
// 	geom.computeLineDistances(); // This one is SUPER important, otherwise dashed lines will appear as simple plain lines
// 	var axis = new THREE.Line( geom, mat, THREE.LinePieces );
// 	return axis;
// }
