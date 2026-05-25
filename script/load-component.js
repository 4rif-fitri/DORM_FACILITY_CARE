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

	let loadComponentUser = async () => {
		let responseSidebar = await fetch("../../components/user/sidebar.html");
		let htmlSidebar = await responseSidebar.text();
		
		let responseheader = await fetch("../../components/user/header.html");
		let htmlheader = await responseheader.text();

		render(htmlSidebar, htmlheader)
	}	
	
	let loadComponentCollegeAdmin = async () => {
		let response = await fetch("../../components/college-admin/sidebar.html");
		let html = await response.text();

		let responseheader = await fetch("../../components/college-admin/header.html");
		let htmlheader = await responseheader.text();

		render(html, htmlheader)
	}
	
	let loadComponentSystemAdmin = async () => {
		let response = await fetch("../../components/system-admin/sidebar.html");
		let htmlSidebar = await response.text();

		let responseheader = await fetch("../../components/system-admin/header.html");
		let htmlheader = await responseheader.text();

		render(htmlSidebar, htmlheader)
	}

	let loadComponentContractor = async () => {
		let response = await fetch("../../components/contractor/sidebar.html");
		let htmlSidebar = await response.text();

		let responseheader = await fetch("../../components/contractor/header.html");
		let htmlheader = await responseheader.text();

		render(htmlSidebar, htmlheader)
	}

	if (role == "USER") loadComponentUser()
	else if (role == "CAD") loadComponentCollegeAdmin()
	else if (role == "SAD") loadComponentSystemAdmin()
	else if (role == "CTR") loadComponentContractor()
})