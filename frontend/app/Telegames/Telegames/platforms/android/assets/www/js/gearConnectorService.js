
function connectToGear() {
	GalaxyGear.onConnect(function(e){
		alert("Connection successfully established");
	});
}

function startReceiver() {
	GalaxyGear.onDataReceived(e.handle, function(e){
		alert("Data Received - handle: " + e.handle + " data: " + e.data);
	});
}

function sendToGear() {
	GalaxyGear.sendData(e.handle, "Hello From Cordova");
}
