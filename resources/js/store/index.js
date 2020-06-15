import axios from 'axios'
axios.defaults.baseURL = '/superblog'

export default {
	state:{
		category:[],
		post:[],
		blogPosts:[],
		getIndividualPost:[],
		getAllCategoies:[],
		getLatestPosts:[],
		getPostsByCategory:[],
	},
	getters:{
		getCategory(state){
			return state.category
		},
		getPost(state){
			return state.post
		},
		getBlogPosts(state){
			return state.blogPosts
		},
		getIndividualPost(state){
			return state.getIndividualPost
		},
		getAllCategoies(state){
			return state.getAllCategoies
		},
		getLatestPosts(state){
			return state.getLatestPosts
		},
		getPostsByCategory(state){
			return state.getPostsByCategory
		},
		
	},
	actions:{
		allCategory(context){
			axios.get('/get-category')
				.then((response)=>{
					context.commit('allCategories', response.data.categories)
				})
		},
		allPosts(context){
			axios.get('/get-post')
				.then((response)=>{
					context.commit('allPosts', response.data.posts)
				})
		},
		getAllBlogPosts(context){
			axios.get('/blogpost')
				.then((response)=>{
					context.commit('getBlogPost', response.data.posts)
				})
		},
		getIndividualPost(context, payload){
			axios.get('/get-individual-post/'+payload)
				.then((response)=>{
					context.commit('getIndividualPost', response.data.post)
				})
		},
		getAllCategoies(context){
			axios.get('/all-categories')
				.then((response)=>{
					context.commit('getAllCategoies', response.data.categories)
				})
		},
		getLatestPosts(context){
			axios.get('/latest-posts')
				.then((response)=>{
					context.commit('getLatestPosts', response.data.posts)
				})
		},
		getPostsByCategory(context, payload){
			axios.get('/get-all-posts/'+payload)
				.then((response)=>{
					context.commit('getBlogPost', response.data.posts)
				})
		},
		searchPosts(context, payload){
			axios.get('/search?s='+payload)
				.then((response)=>{
					context.commit('searchPosts', response.data.posts)
				})
		},
	},
	mutations:{
		allCategories(state, data){
			return state.category = data
		},
		allPosts(state, data){
			return state.post = data
		},
		getBlogPost(state, payload){
			return state.blogPosts = payload
		},
		getIndividualPost(state, payload){
			return state.getIndividualPost = payload
		},
		getAllCategoies(state, payload){
			return state.getAllCategoies = payload
		},
		getLatestPosts(state, payload){
			return state.getLatestPosts = payload
		},
		searchPosts(state, payload){
			return state.blogPosts = payload
		},
	}
}