$(document).ready(() => {
	let role = $("#role").val()
	let title = $("#title").val()

	// let loading = `<div class="_loading-container"><h1>Loading...</h1></div>`
	// $("body").prepend(loading);

	if (role == "") return

	$(document).on("change", "#_dekstop-sideBar", function () {
		localStorage.setItem("sidebar-desktop", this.checked);

		if (this.checked) {
			$("._avatar-besar > i").removeClass("hidden");
			$("._avatar-besar > img").addClass("hidden");
		} else {
			$("._avatar-besar > i").addClass("hidden");
			$("._avatar-besar > img").removeClass("hidden");
		}
	});

	let savedState = localStorage.getItem("sidebar-desktop");
	$("#_dekstop-sideBar").prop("checked", savedState === "true");

	let delay = time => new Promise(resolve => setTimeout(resolve, time))

	let render = async (htmlSidebar = "", htmlheader = "") => {
		// let header = $(htmlheader)
		let side = $(htmlSidebar)

		// header.find(".title").text(title);

		$("body").prepend(side); // guna side
		// $("._workspace").prepend(header);

		let savedState = localStorage.getItem("sidebar-desktop");
		$("#_dekstop-sideBar").prop("checked", savedState === "true");

		if (savedState == "true") {
			side.find("._avatar-besar > i").removeClass("hidden")
			side.find("._avatar-besar > img").addClass("hidden")
		} else {
			side.find("._avatar-besar > img").removeClass("hidden")
			side.find("._avatar-besar > i").addClass("hidden")
		}

		let currentTitle = $("#title").val().trim();

		side.find("._links a").each(function () {
			if ($(this).data("page") === currentTitle) {
				$(this).addClass("active");
			}
		});

		// await delay(1000)
		// $("._loading-container").remove()
	}

	let loadComponentUser = async () => {
		let responseSidebar = await fetch("../../components/user/sidebar.php");
		let htmlSidebar = await responseSidebar.text();

		// let responseheader = await fetch("../../components/user/header.php");
		// let htmlheader = await responseheader.text();

		render(htmlSidebar , "")
	}

	let loadComponentCollegeAdmin = async () => {
		let response = await fetch("../../components/college-admin/sidebar.php");
		let htmlSidebar = await response.text();

		// let responseheader = await fetch("../../components/college-admin/header.php");
		// let htmlheader = await responseheader.text();

		render(htmlSidebar, "")
	}

	let loadComponentSystemAdmin = async () => {
		let response = await fetch("../../components/system-admin/sidebar.php");
		let htmlSidebar = await response.text();

		// let responseheader = await fetch("../../components/system-admin/header.php");
		// let htmlheader = await responseheader.text();

		render(htmlSidebar, "")
	}

	let loadComponentContractor = async () => {
		let response = await fetch("../../components/contractor/sidebar.php");
		let htmlSidebar = await response.text();

		// let responseheader = await fetch("../../components/contractor/header.php");
		// let htmlheader = await responseheader.text();

		render(htmlSidebar, "")
	}

	if (role == "USER") loadComponentUser()
	else if (role == "CAD") loadComponentCollegeAdmin()
	else if (role == "SAD") loadComponentSystemAdmin()
	else if (role == "CTR") loadComponentContractor()
})