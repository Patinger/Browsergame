var myWidth = 1200, myHeight = 720
var scene, camera, renderer;
var geometry, material, mesh;
var myBasePath;


function init(basePath){
	myBasePath = basePath;
	$('#myGame').attr({width:myWidth,height:myHeight});
	scene = new THREE.Scene();
	
	camera = new THREE.PerspectiveCamera( 75, myWidth / myHeight, 1, 10000 );
	camera.position.z = 1000;

	geometry = new THREE.BoxGeometry( 200, 200, 200 );
	// material = new THREE.MeshBasicMaterial( { color: 0xff0000, wireframe: true } );

	

	var squareGeometry = new mySquare(128);


	// var squareMaterial = new THREE.MeshBasicMaterial({
	// 	color:0xFFFFFF,
	// 	side:THREE.DoubleSide
	// });

	// var squareMesh = new THREE.Mesh(squareGeometry, squareMaterial);
	// squareMesh.position.set(1.5, 0.0, 4.0);

	var texture = THREE.ImageUtils.loadTexture(myBasePath+'/img/keepertexture.png');
	// texture.wrapS = THREE.RepeatWrapping;
	// texture.wrapT = THREE.RepeatWrapping;
	// texture.repeat.set( 4, 4 );
	
   var squareMaterial = new THREE.MeshBasicMaterial({
       map:texture,
       side:THREE.DoubleSide
   });

	var squareMesh = new THREE.Mesh(squareGeometry, squareMaterial);
	mesh = new THREE.Mesh( geometry, squareMaterial );
	squareMesh.position.set(1.5, 0.0, 4.0);

	var groundModel = new THREE.Mesh(new THREE.PlaneGeometry(128, 128, 1, 1), squareMaterial);

	//scene.add(squareMesh);
	//scene.add( mesh );
	scene.add( groundModel );

	renderer = new THREE.WebGLRenderer({canvas: myGame});
	renderer.render( scene, camera );
	//renderer.setSize( myWidth, myHeight );

	//document.getElementById('myGame').appendChild( renderer.domElement );

	animate();
}

function animate(){
	requestAnimationFrame( animate );

	mesh.rotation.x += 0.01;
	mesh.rotation.y += 0.02;

	renderer.render( scene, camera );
}

function mySquare(size) { 

    var square = new THREE.Geometry(); 

    //set 4 points
    square.vertices.push(new THREE.Vector3(-size, size,0));
    square.vertices.push(new THREE.Vector3( size, size,0));
    square.vertices.push(new THREE.Vector3( size,-size,0));
    square.vertices.push(new THREE.Vector3(-size,-size,0));

    //push 1 triangle
    square.faces.push(new THREE.Face3( 0,1,2));

    //push another triangle
    square.faces.push(new THREE.Face3( 0,3,2));

    //return the square object with BOTH faces
    return square;
}