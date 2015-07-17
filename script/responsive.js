function contains(a, it) { return a.indexOf(it) != -1; };

// $(document).ready(function() {
// 	if (matchMedia) {
		
// 		var mq = window.matchMedia("(max-width: 320pt)");

// 		mq.addListener(WidthChange);
// 		WidthChange(mq);
// 	}
// });

// function WidthChange(mq) {
// 	if (mq.matches) {
// 		$('.halfwidth').removeClass('halfwidth').addClass('fullwidth');
// 		$('.quarterwidth').removeClass('quarterwidth').addClass('fullwidth');
// 		$('.threewidth').removeClass('threewidth').addClass('fullwidth');

// 		/* Services */
// 		// $('')

// 		// var widgets = document.getElementsByClassName('widget');
// 		// var ordered = [];

// 		// for (var i =  0; i < widgets.length; i++) {
// 		// 	var width = 0;
// 		// 	if(contains(widgets[i].className, 'fullwidth')){
// 		// 		ordered.push(widgets[i]);
// 		// 	}
// 		// 	if(contains(widgets[i].className,'halfwidth') && !contains(widgets[i].className,'added')){
// 		// 		width += 2;
// 		// 		for (var j =  i + 1; j < widgets.length; j++) {
// 		// 			if (contains(widgets[j].className, 'halfwidth')){
// 		// 				ordered.push(widgets[j]);
// 		// 				width += 2;
// 		// 				$(widgets[j]).addClass('added');
// 		// 			}
// 		// 		};
// 		// 		if(width == 4){

// 		// 		}else{
// 		// 			ordered.push(widgets[i]);
// 		// 			widgets[i].className = 'widget fullwidth';
// 		// 		}
// 		// 	}
// 		// };
// 		// var parent = ordered[0].parentNode;
// 		// $('.widget').remove();

// 		// $(parent).append(ordered);
// 	}
// }