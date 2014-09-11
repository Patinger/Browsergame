var myWidth = 1200, myHeight = 720
var scene, camera, renderer, controls;
var geometry, material, mesh;
var myBasePath;


function init(basePath){
	myBasePath = basePath;
	$('#myGame').attr({width:myWidth,height:myHeight});
	scene = new THREE.Scene();
	
	camera = new THREE.PerspectiveCamera( 75, myWidth / myHeight, 1, 10000 );
	camera.position.z = 500;
	camera.rotation.x = 45 * Math.PI / 180;

	geometry = new THREE.BoxGeometry( 200, 200, 200 );
	// material = new THREE.MeshBasicMaterial( { color: 0xff0000, wireframe: true } );

	

	var groundModel = new myCreateGround(0,0);
	var groundModel1 = new myCreateGround(128,0);
	var groundModel2 = new myCreateGround(128,128);
	var groundModel3 = new myCreateGround(0,128);

	//scene.add(squareMesh);
	//scene.add( mesh );
	scene.add( groundModel );
	scene.add( groundModel1 );
	scene.add( groundModel2 );
	scene.add( groundModel3 );


	// Add axes
	axes = buildAxes( 1000 );
	scene.add( axes );

	renderer = new THREE.WebGLRenderer({canvas: myGame});
	renderer.render( scene, camera );

	controls = new THREE.TrackballControls( camera );

	controls.rotateSpeed = 1.0;
	controls.zoomSpeed = 1.2;
	controls.panSpeed = 0.8;

	controls.noZoom = false;
	controls.noPan = false;

	controls.staticMoving = true;
	controls.dynamicDampingFactor = 0.3;

	controls.keys = [ 65, 83, 68 ];
	//renderer.setSize( myWidth, myHeight );

	//document.getElementById('myGame').appendChild( renderer.domElement );

	render();
}

function render(){
	controls.update();	
	requestAnimationFrame( render );
	renderer.render( scene, camera );
}

function myCreateGround(x, y){
	
   var squareMaterial = new THREE.MeshBasicMaterial({
       map:THREE.ImageUtils.loadTexture(myBasePath+'/img/keepertexture.png'),
       side:THREE.DoubleSide
   });
	var groundMesh = new THREE.Mesh(new THREE.PlaneGeometry(128, 128, 1, 1), squareMaterial);
	groundMesh.position.set(x, y, 0);
	//groundMesh.rotation.x = 90 * Math.PI / 180;
	return groundMesh;
}

function buildAxes( length ) {
	var axes = new THREE.Object3D();
	axes.add( buildAxis( new THREE.Vector3( 0, 0, 0 ), new THREE.Vector3( length, 0, 0 ), 0xFF0000, false ) ); // +X
	axes.add( buildAxis( new THREE.Vector3( 0, 0, 0 ), new THREE.Vector3( -length, 0, 0 ), 0xFF0000, true) ); // -X
	axes.add( buildAxis( new THREE.Vector3( 0, 0, 0 ), new THREE.Vector3( 0, length, 0 ), 0x00FF00, false ) ); // +Y
	axes.add( buildAxis( new THREE.Vector3( 0, 0, 0 ), new THREE.Vector3( 0, -length, 0 ), 0x00FF00, true ) ); // -Y
	axes.add( buildAxis( new THREE.Vector3( 0, 0, 0 ), new THREE.Vector3( 0, 0, length ), 0x0000FF, false ) ); // +Z
	axes.add( buildAxis( new THREE.Vector3( 0, 0, 0 ), new THREE.Vector3( 0, 0, -length ), 0x0000FF, true ) ); // -Z
	return axes;
}

function buildAxis( src, dst, colorHex, dashed ) {
	var geom = new THREE.Geometry(), mat;
	if(dashed) {
		mat = new THREE.LineDashedMaterial({ linewidth: 3, color: colorHex, dashSize: 3, gapSize: 3 });
	} else {
		mat = new THREE.LineBasicMaterial({ linewidth: 3, color: colorHex });
	}
	geom.vertices.push( src.clone() );
	geom.vertices.push( dst.clone() );
	geom.computeLineDistances(); // This one is SUPER important, otherwise dashed lines will appear as simple plain lines
	var axis = new THREE.Line( geom, mat, THREE.LinePieces );
	return axis;
}
