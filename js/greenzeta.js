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

window.addEventListener('load', () => {
	console.log('%c\u03B6'+'%ca GreenZeta Production', 
			'font-family:serif; font-size:12px; color: white; font-weight: bold; background-color: #7bb951; padding: 4px 10px;', 
			'color: white; font-size:12px; background-color: #2a2a2a; padding: 4px 10px;', 
			'http://greenzeta.com');

	if(window.location.hash) filterPortfolio(window.location.hash.substring(1));

	var swiper = new Swiper('.swiper-container', {
		autoHeight: true,
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
	  });
});

window.addEventListener('hashchange',(event)=>{
	console.log("event", window.location.hash.substring(1))
	filterPortfolio(window.location.hash.substring(1));
});