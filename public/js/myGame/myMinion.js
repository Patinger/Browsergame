function MyMinion () {
	this.id = 1;
	this.x = 0;
	this.y = 0;
    this.type = 0;
    this.mesh = 0;
    this.exploreRadius = 3;
    this.job = 0;

    this.init = function() {
    	var material = new THREE.MeshBasicMaterial({ color: 0x0000ff });
    	var sphereGeometry = new THREE.SphereGeometry( 25, 32, 32 );
    	var sphere = new THREE.Mesh( sphereGeometry, material );
		sphere.position.set(0, 0, 25);
    	this.mesh = sphere;
    	scene.add( sphere );
    };

    this.explore = function(){
    	if(true){//@TODO hier noch eine super bedingung einfügen
    		$.post( "test.php", { name: "John", time: "2pm" })
				.done(function( data ) {
					alert( "Data Loaded: " + data );
				}
			);
    	}
    }
}

