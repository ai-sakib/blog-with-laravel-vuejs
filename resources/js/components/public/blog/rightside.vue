<template>
	<span>
		<div class="span4">
	        <aside class="right-sidebar">
	          <div class="widget">
	            <form class="form-search">
	              <input placeholder="Type something" @keyup="searchPosts()" v-model="keyword" type="text" class="input-medium search-query">
	              <button type="button" @click.prevent="searchPosts()" class="btn btn-square btn-theme">Search</button>
	            </form>
	          </div>
	          <div class="widget">
	            <h5 class="widgetheading">Categories</h5>
	            <ul v-for="category in categories" class="cat">
	              <li><i class="icon-angle-right"></i><router-link v-bind:to="'/category/' + category.id">{{ category.name }}</router-link><span> (20)</span></li>
	            </ul>
	          </div>
	          <div class="widget">
	            <h5 class="widgetheading">Latest posts</h5>
	            <ul v-for="post in latestPosts" class="recent">
	              <li>
	                <img style="max-width: 85px; max-height: 75px" :src="showImage(post.image)" class="pull-left" alt="" />
	                <h6><router-link v-bind:to="'/post/' + post.id">{{ post.title }}</router-link></h6>
	                <p>
	                  {{ post.description | textshort(100,'...') }}
	                </p>
	              </li>
	            </ul>
	          </div>
	          <!-- <div class="widget">
	            <h5 class="widgetheading">Popular tags</h5>
	            <ul class="tags">
	              <li><a href="#">Web design</a></li>
	              <li><a href="#">Trends</a></li>
	              <li><a href="#">Technology</a></li>
	              <li><a href="#">Internet</a></li>
	              <li><a href="#">Tutorial</a></li>
	              <li><a href="#">Development</a></li>
	            </ul>
	          </div> -->
	        </aside>
	     </div>
		
	</span>
</template>
<script>
	import _ from 'lodash'
	export default {
		name:"",
		data(){
			return {
				keyword:''
			}
		},
		mounted(){
			this.$store.dispatch('getAllCategoies');
			this.$store.dispatch('getLatestPosts');
		},
		computed:{
			categories(){
				return this.$store.getters.getAllCategoies
			},
			latestPosts(){
				return this.$store.getters.getLatestPosts
			}
		},
		methods:{
			showImage(image){
				return "public/images/"+image;
			},
			searchPosts:_.debounce(function(){
				this.$store.dispatch("searchPosts",this.keyword);
			}, 500)
		}
	}
</script>