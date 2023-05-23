// Webpack Imports
import * as bootstrap from 'bootstrap';


(function () {
	'use strict';

	// Focus input if Searchform is empty
	[].forEach.call(document.querySelectorAll('.search-form'), (el) => {
		el.addEventListener('submit', function (e) {
			var search = el.querySelector('input');
			if (search.value.length < 1) {
				e.preventDefault();
				search.focus();
			}
		});
	});

	// Initialize Popovers: https://getbootstrap.com/docs/5.0/components/popovers
	var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
	var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
		return new bootstrap.Popover(popoverTriggerEl, {
			trigger: 'focus',
		});
	});
})();

// main menu animation - moving dot

document.addEventListener('DOMContentLoaded', () => {
	const speed = 0.5;
	const dotWidth = 90;
	const dotHeight = 2;
	const container = document.querySelector("#menu-menu-glowne");
	const menuItems = document.querySelectorAll("#header .nav-link");
	const activeElement = document.querySelector("#menu-menu-glowne .active");

	container.style.position = "relative"

	const dot = document.createElement('div')
	dot.style.transition = "0s";
	dot.classList.add('dot');
	dot.classList.add('d-none');
	dot.classList.add('d-md-block');
	dot.style.position = "absolute"
	dot.style.left = "0px"
	dot.style.bottom = "0px"
	dot.style.width = dotWidth + 'px'
	dot.style.height = dotHeight + 'px'

	container.appendChild(dot);

	const moveDot = (target) => {
		if (target) {
			dot.style.left =
				target.getBoundingClientRect().x +
				target.getBoundingClientRect().width / 2 -
				container.getBoundingClientRect().x -
				dot.getBoundingClientRect().width / 2 +
				"px";
		}
	};

	activeElement ? moveDot(activeElement) : null;

	menuItems.forEach((item, index) => {

		item.addEventListener("mouseover", (e) => {

			!activeElement && index == 0 ? moveDot(item) : null;
			
			dot.style.transition = speed + "s";
			moveDot(e.currentTarget);
		});
		item.addEventListener("mouseout", () => {
			if (activeElement) {
				moveDot(activeElement);
			} else {
				!activeElement && index == 0 ? moveDot(item) : null;
				dot.style.transition = speed + "s";
				// dot.style.left = -1000 + "px";
			}
		});
	});
	window.addEventListener("resize", () => {
		moveDot(activeElement);
	});
})




//tab nav menu animation

document.querySelectorAll('#nav-tabs-dot').forEach((container,index)=>{

	const containerIndexedClass = 'nav-container-'+index

	container.classList.add(containerIndexedClass)

	document.addEventListener('DOMContentLoaded', () => {
		const speed = 0.5;
		const dotWidth = 90;
		const dotHeight = 2;
		// const container = document.querySelector("#nav-tabs-dot");
		const menuItems = container.querySelectorAll("."+containerIndexedClass+" .nav-link");
		let activeElement = container.querySelector("."+containerIndexedClass+" .nav-link.active");
	
		container.style.position = "relative"
	
		const dot = document.createElement('div')
		dot.style.transition = "0s";
		dot.classList.add('dot');
		dot.classList.add('d-none');
		dot.classList.add('d-md-block');
		dot.style.position = "absolute"
		dot.style.left = "0px"
		dot.style.bottom = "0px"
		dot.style.width = dotWidth + 'px'
		dot.style.height = dotHeight + 'px'
	
		container.appendChild(dot);
	
		const moveDot = (target) => {
			if (target) {
				dot.style.left =
					target.getBoundingClientRect().x +
					target.getBoundingClientRect().width / 2 -
					container.getBoundingClientRect().x -
					dot.getBoundingClientRect().width / 2 +
					"px";
			}
		};
	
		menuItems.forEach((item, index) => {
	
			if (index == 0) {
				moveDot(item)
			}
	
			item.addEventListener('click', (e) => {
				activeElement = document.querySelector("."+containerIndexedClass+" .nav-link.active");
				activeElement ? moveDot(activeElement) : null;
			})
	
			item.addEventListener("mouseover", (e) => {
				dot.style.transition = speed + "s";
				moveDot(e.currentTarget);
			});
			item.addEventListener("mouseout", () => {
				if (activeElement) {
					moveDot(activeElement);
				} else {
					dot.style.transition = speed + "s";
					dot.style.left = -100 + "px";
				}
			});
		});
		window.addEventListener("resize", () => {
			moveDot(activeElement);
		});
	})



})