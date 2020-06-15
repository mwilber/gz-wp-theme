function filterPortfolio(className){
	const itemsToShow = document.querySelectorAll('article.portfolio.'+className);
	const portfolioItems = document.querySelectorAll('article.portfolio');

	portfolioItems.forEach(function(portfolioItem) {
		if(itemsToShow.length > 0 && !portfolioItem.classList.contains(className)){
			portfolioItem.style.display = 'none';
		}else{
			portfolioItem.style.display = 'initial';
		}
	});
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

window.addEventListener('load', () => {
	console.log('%c\u03B6'+'%ca GreenZeta Production', 
			'font-family:serif; font-size:12px; color: white; font-weight: bold; background-color: #7bb951; padding: 4px 10px;', 
			'color: white; font-size:12px; background-color: #2a2a2a; padding: 4px 10px;', 
			'http://greenzeta.com');

	if(window.location.hash) filterPortfolio(window.location.hash.substring(1));

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
});

window.addEventListener('hashchange',(event)=>{
	console.log("event", window.location.hash.substring(1))
	filterPortfolio(window.location.hash.substring(1));
});