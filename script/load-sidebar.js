$(document).ready(() => {
	let role = $("#role").val()
	console.log(role);
	
	if (role == "") return

	let loadSidebarUser = async () => {
		let response = await fetch("../../components/user/sidebar.html");
		let html = await response.text();
		$("body").prepend(html);
	}	
	
	let loadSidebarCollegeAdmin = async () => {
		let response = await fetch("../../components/user/sidebar.html");
		let html = await response.text();
		$("body").prepend(html);
	}
	
	let loadSidebarSystemAdmin = async () => {
		let response = await fetch("../../components/user/sidebar.html");
		let html = await response.text();
		$("body").prepend(html);
	}

	let loadSidebarContractor = async () => {
		let response = await fetch("../../components/user/sidebar.html");
		let html = await response.text();
		$("body").prepend(html);
	}

	if (role == "USER") loadSidebarUser()
	else if (role == "CAD") loadSidebarCollegeAdmin()
	else if (role == "SAD") loadSidebarSystemAdmin()
	else if (role == "CTR") loadSidebarContractor()
})