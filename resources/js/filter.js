import moment from 'moment'
import Vue from 'vue'
Vue.filter('timeformat',(argument)=>{
	return moment(argument).format("MMM Do YY"); 
})
Vue.filter('textshort',function(text, length, suffix){
	if(text.length > length){
		return text.substring(0, length)+suffix;
	}else{
		return text.substring(0, length);
	}
	
})