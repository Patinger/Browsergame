$( document ).ready(function() {
	$('#myGame').attr({width:1200,height:720});
	start();
});


var gl; // A global variable for the WebGL context

function start() {
	var pos;
	//Create moon
	var moon = new PhiloGL.O3D.Sphere({
		nlat: 30,
		nlong: 30,
		radius: 2,
		textures: 'img/keepertexture.png'
	});

	//Create application
	PhiloGL('myGame', {
		camera: {
			position: {
			x: 0, y: 0, z: -7
			}
		},
		textures: {
			src: ['img/keepertexture.png'],
			parameters: [{
				name: 'TEXTURE_MAG_FILTER',
				value: 'LINEAR'
			}, {
				name: 'TEXTURE_MIN_FILTER',
				value: 'LINEAR_MIPMAP_NEAREST',
				generateMipmap: true
			}]
		},
		events: {
			onDragStart: function(e) {
				pos = {
					x: e.x,
					y: e.y
				};
			},
			onDragMove: function(e) {
				var z = this.camera.position.z,
				sign = Math.abs(z) / z;

				moon.rotation.y += -(pos.x - e.x) / 100;
				moon.rotation.x += sign * (pos.y - e.y) / 100;
				moon.update();
				pos.x = e.x;
				pos.y = e.y;
			},
			onMouseWheel: function(e) {
				e.stop();
				var camera = this.camera;
				camera.position.z += e.wheel;
				camera.update();
			}
		},
		onError: function() {
			alert('There was an error creating the app');
		},
		onLoad: function(app) {
			// Unpack app properties
			var gl = app.gl,
			program = app.program,
			scene = app.scene,
			canvas = app.canvas,
			camera = app.camera;
			// Add object to the scene
			scene.add(moon);
			// Draw the scene
			draw();
			function draw() {
				// Clear the screen
				gl.clear(gl.COLOR_BUFFER_BIT | gl.DEPTH_BUFFER_BIT);
				// Setup lighting
				/*var lights = scene.config.lights;
				lights.enable = lighting.checked;
				lights.ambient = {
					r: +ambient.r.value,
					g: +ambient.g.value,
					b: +ambient.b.value
				};
				lights.directional = {
					color: {
						r: +direction.r.value,
						g: +direction.g.value,
						b: +direction.b.value
					},
					direction: {
						x: +direction.x.value,
						y: +direction.y.value,
						z: +direction.z.value
					}
				};*/
				// Render moon
				scene.render();
				// Animate
				PhiloGL.Fx.requestAnimationFrame(draw);
			}
		}
	});
}