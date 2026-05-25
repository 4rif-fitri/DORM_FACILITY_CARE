$(document).ready(() => {
	let role = $("#role").val()
	let title = $("#title").val()

	let loading = `<div class="_loading-container"><h1>Loading...</h1></div>`
	$("body").prepend(loading);

	if (role == "") return
	
	$(document).on("change", "#_dekstop-sideBar", function () {
		localStorage.setItem("sidebar-desktop", this.checked);
	});

	let savedState = localStorage.getItem("sidebar-desktop");
	$("#_dekstop-sideBar").prop("checked", savedState === "true");

	let delay = time => new Promise(resolve => setTimeout(resolve,time))

	let render = async (htmlSidebar, htmlheader) => {
		let header = $(htmlheader);
		console.log(header);

		header.find(".title").text(title);
		$("body").prepend(htmlSidebar);
		$("._workspace").prepend(header);

		let savedState = localStorage.getItem("sidebar-desktop");
		$("#_dekstop-sideBar").prop("checked", savedState === "true");
		let currentPage = $("#title").val().trim();
		
		let currentTitle = $("#title").val().trim();
		let linkText 

		$("._links a").each(function () {
			if ($(this).data("page") === currentTitle) {
				$(this).addClass("active");
			}
		});
		

		await delay(1000)
		$("._loading-container").remove()
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