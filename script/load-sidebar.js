$(document).ready(() => {
	let role = $("#role").val()
	let title = $("#title").val()
	console.log(title);
	
	if (role == "") return

	let render = (htmlSidebar, htmlheader) => {
		let header = $(htmlheader);
		console.log(header);
		
		header.find(".title").text(title);
		$("body").prepend(htmlSidebar);
		$(".workspace").prepend(header);
	}

	let loadSidebarUser = async () => {
		let responseSidebar = await fetch("../../components/user/sidebar.html");
		let htmlSidebar = await responseSidebar.text();
		
		let responseheader = await fetch("../../components/user/header.html");
		let htmlheader = await responseheader.text();

		render(htmlSidebar, htmlheader)
	}	
	
	let loadSidebarCollegeAdmin = async () => {
		let response = await fetch("../../components/college-admin/sidebar.html");
		let html = await response.text();

		let responseheader = await fetch("../../components/college-admin/header.html");
		let htmlheader = await responseheader.text();

		render(html, htmlheader)
	}
	
	let loadSidebarSystemAdmin = async () => {
		let response = await fetch("../../components/system-admin/sidebar.html");
		let htmlSidebar = await response.text();

		let responseheader = await fetch("../../components/system-admin/header.html");
		let htmlheader = await responseheader.text();

		render(htmlSidebar, htmlheader)
	}

	let loadSidebarContractor = async () => {
		let response = await fetch("../../components/contractor/sidebar.html");
		let htmlSidebar = await response.text();

		let responseheader = await fetch("../../components/contractor/header.html");
		let htmlheader = await responseheader.text();

		render(htmlSidebar, htmlheader)
	}

	if (role == "USER") loadSidebarUser()
	else if (role == "CAD") loadSidebarCollegeAdmin()
	else if (role == "SAD") loadSidebarSystemAdmin()
	else if (role == "CTR") loadSidebarContractor()
})