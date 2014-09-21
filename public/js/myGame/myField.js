function MyField(x, y) {
    this.x = x;
    this.y = y;
    this.terrain = new Array(); //x,y meshes

    this.getPos = function(){
    	return this.x+"_"+this.y;
    }

	this.createTerrain = function(data){
		alert(this.x+'_'+this.y);
		for ( var x = this.x-5; x < this.x+5; x++ ) {
			for ( var y = this.y-5; y < this.y+5; y++ ) {
				this.terrain[x] = new Array();
				var terrain = null;
				var type = data[x+'_'+y];
				if(type==1) terrain = new this.createTerrainGround(x, y);
				else if(type==2) {}//wall
				else terrain = new this.createTerrainUnexplored(x, y);
				this.terrain[x][y] = new Array();
				this.terrain[x][y]['mesh'] = terrain;
				this.terrain[x][y]['type'] = type;
				scene.add( terrain ); //global
			}
		}
	}

	this.createTerrainGround = function(x, y){
		x*=myBlockSize; //global
		y*=myBlockSize; //global
	   var squareMaterial = new THREE.MeshBasicMaterial({
	       map:THREE.ImageUtils.loadTexture(myBasePath+'/img/keepertexture.png'),//global
	       side:THREE.DoubleSide
	   });
		var groundMesh = new THREE.Mesh(new THREE.PlaneGeometry(myBlockSize, myBlockSize, 1, 1), squareMaterial);
		groundMesh.position.set(x, y, 0);
		return groundMesh;
	}

	this.createTerrainUnexplored = function(x, y){
		x*=myBlockSize; //global
		y*=myBlockSize; //global
		z=myBlockSize/2;
	   	var unexploredMesh = new THREE.Mesh( new THREE.BoxGeometry( myBlockSize, myBlockSize, myBlockSize ), new THREE.MeshBasicMaterial( {color: 0x333333} ));
		unexploredMesh.position.set(x, y, z);
		return unexploredMesh;
	}
}