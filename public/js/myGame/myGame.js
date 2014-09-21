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
	$.getJSON( myBasePath+"/backend/terrain/terrainjson", function( data ) {
		alert('test');
		myField.createTerrain(data);
	});

	myMinion = new MyMinion();
	myMinion.init();

	render();
}

function render(){
	controls.update();	
	requestAnimationFrame( render );
	renderer.render( scene, camera );
}