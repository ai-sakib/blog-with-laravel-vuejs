<template>
	<div>
		<section id="inner-headline">
      <div class="container">
        <div class="row">
          <div class="span4">
            <div class="inner-heading">
              <h2>All Posts</h2>
            </div>
          </div>
          <div class="span8">
            <ul class="breadcrumb">
              <li><a href="#"><i class="icon-home"></i></a><i class="icon-angle-right"></i></li>
              <li><a href="#">Blog</a><i class="icon-angle-right"></i></li>
              <li class="active">Blog with left sidebar</li>
            </ul>
          </div>
        </div>
      </div>
    </section>
    <section id="content">
      <div class="container">
        <div class="row">
          <div class="span8">
            <article v-for="(post,index) in posts" :key="post.id">
              <div class="row">
                <div class="span8">
                  <div class="post-image">
                    <div class="post-heading">
                      <h3><router-link v-bind:to="'/post/' + post.id">{{ post.title }}</router-link></h3>
                    </div>
                    <img style="max-height:200px;" :src="showImage(post.image)" alt="" />
                  </div>
                  <p>
                    {{ post.description | textshort(400,'...') }}
                  </p>
                  <div class="bottom-article">
                    <ul class="meta-post">
                      <li><i class="icon-calendar"></i><a href="#"> <!-- {{ post.created_at | timeformat }} --></a></li>
                      <li><i class="icon-user"></i><a v-if="post.user" href="#"> {{ post.user.name }}</a></li>
                      <li><i class="icon-folder-open"></i><router-link v-bind:to="'/category/' + post.category.id" v-if="post.category" href="#"> {{ post.category.name }}</router-link></li>
                      <li><i class="icon-comments"></i><a href="#">4 Comments</a></li>
                    </ul>
                    <router-link v-bind:to="'/post/' + post.id" class="pull-right">Continue reading <i class="icon-angle-right"></i></router-link>
                  </div>
                </div>
              </div>
            </article>
            </article>
            <div id="pagination">
              <span class="all">Page 1 of 3</span>
              <span class="current">1</span>
              <a href="#" class="inactive">2</a>
              <a href="#" class="inactive">3</a>
            </div>
          </div>
          <rightside/>
          
        </div>
      </div>
    </section>
	</div>
</template>
<script>
	import rightside from "./rightside"
	export default {
		name: "",
		components:{
			rightside
		},
		mounted(){
			this.$store.dispatch("getAllBlogPosts")
		},
		computed:{
			posts(){
				return this.$store.getters.getBlogPosts
			}
		},
		methods:{
			showImage(image){
				return "public/images/"+image;
			},
      getPostsByCategory(){
        if(this.$route.params.category_id != null){
          this.$store.dispatch("getPostsByCategory", this.$route.params.category_id)
        }else{
          this.$store.dispatch("getAllBlogPosts")
        }
        
      }
		},
    watch:{
      $route(to,from){
        this.getPostsByCategory();
      }
    }

	}
</script>
<style lang="scss">
</style>