
// Get the DIV with overlay effect
//var overlayBg = document.getElementById("myOverlay");

function open_add_project() {
	var mvp = document.getElementById("add_mvp");
	if (mvp.style.display === 'block') {
	    mvp.style.display = 'none';
	    //overlayBg.style.display = "none";
	} else {
	    mvp.style.display = 'block';
	    //overlayBg.style.display = "block";
	}
}

function close_add_project() {
    mvp.style.display = "none";
    //overlayBg.style.display = "none";
} 