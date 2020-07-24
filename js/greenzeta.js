function filterPortfolio(className){
	const portfolioItems = document.querySelectorAll('article.portfolio');
	const filterButtons = document.querySelectorAll('.tag-list .button.tag.active');
	
	portfolioItems.forEach(function(portfolioItem) {
		if(!className || (className && portfolioItem.classList.contains(className))){
			portfolioItem.style.display = 'initial';
		}else{
			portfolioItem.style.display = 'none';
		}
	});
	
	filterButtons.forEach(function(filterButton) {
		filterButton.classList.remove('active');
	});

	const entrySuperTitle = document.querySelector('.page-header .entry-super-title');

	if(className){
		const activeFilterButton = document.querySelector('a[href="#'+className+'"]');
		const filterButtonLabel = activeFilterButton.querySelector('span');

		let filterText = className.split('-')[1];
		if(filterButtonLabel) filterText = filterButtonLabel.innerText;

		entrySuperTitle.innerHTML = filterText;

		activeFilterButton.classList.add('active');
	}else{
		entrySuperTitle.innerHTML = 'All';
	}
}

function playVideo(event){
	console.log('playbtn', event);
	event.preventDefault();
	let video = event.target.parentElement.querySelector('video');
	if(video) video.play();
			window.setTimeout(function(){
				event.target.style.display = 'none';
			}.bind(this),1000);
			event.target.style.opacity = 0;
			return false;
}

function positionMobileSidebar(timestamp) {
	if(window.innerWidth < 768){
		let sidebar = document.getElementById('secondary');
		sidebar.style.transform = 'translateY(' + window.scrollY + 'px)';
		window.requestAnimationFrame(positionMobileSidebar);
	}
}

window.addEventListener('load', () => {

	var swiper = new Swiper('.swiper-container', {
		autoHeight: false,
		slidesPerView: 1,
		spaceBetween: 30,
		loop: true,
		pagination: {
		  el: '.swiper-pagination',
		  clickable: true,
		},
		navigation: {
		  nextEl: '.swiper-button-next',
		  prevEl: '.swiper-button-prev',
		},
		on: {
			slideChange: function () {
				let videos = document.querySelectorAll('video');
				if(videos && videos.length){
					for( let vidIdx=0; vidIdx < videos.length; vidIdx++ ){
						videos[vidIdx].pause();
					}
				}
			},
		},
	});
	
	//let playBtn = document.querySelector('.video-play-button');
	//if(playBtn){
	//	playBtn.addEventListener('click', .bind(playBtn));
	//}
	
	// Mobile Sidebar
	////////////////////////////////////////////////////////////////////////////////////
	let sidebarToggle = document.getElementById('sidebar-toggle');
	sidebarToggle.addEventListener('click', (event)=>{
		let sidebar = document.getElementById('secondary');
		let toggleIcon = sidebar.querySelector('#sidebar-toggle .fas');
		//fas fa-angle-left
		if(sidebar.classList.contains('sidebar-out')){
			sidebar.classList.remove('sidebar-out');
			toggleIcon.classList.add('fa-angle-left');
			toggleIcon.classList.remove('fa-angle-right');
		}else{
			sidebar.classList.add('sidebar-out');
			toggleIcon.classList.add('fa-angle-right');
			toggleIcon.classList.remove('fa-angle-left');
		}
	});

	window.addEventListener('resize', (event)=>{
		positionMobileSidebar();
	})
	positionMobileSidebar();

	// Portfolio Filters
	////////////////////////////////////////////////////////////////////////////////////
	if(window.location.hash) filterPortfolio(window.location.hash.substring(1));
	
	window.addEventListener('hashchange',(event)=>{
		console.log("event", window.location.hash.substring(1))
		filterPortfolio(window.location.hash.substring(1));
	});

	// Look for portfolio filter buttons.
	const filterButtons = document.querySelectorAll('.tag-list .button.tag');
	if(filterButtons.length){
		// Add click event handler to remove location hash if already displayed
		filterButtons.forEach(function(filterButton) {
			filterButton.addEventListener('click', function(event){
				if(window.location.hash === this.getAttribute('href')){
					event.preventDefault();
					window.location.hash = '';
				}
			}.bind(filterButton));
		});
	}

	// GZ Console Branding
	////////////////////////////////////////////////////////////////////////////////////
	console.log('%c\u03B6'+'%ca GreenZeta Production', 
			'font-family:serif; font-size:12px; color: white; font-weight: bold; background-color: #7bb951; padding: 4px 10px;', 
			'color: white; font-size:12px; background-color: #2a2a2a; padding: 4px 10px;', 
			'http://greenzeta.com');

});
