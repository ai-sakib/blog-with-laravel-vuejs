<template>
	<div>
		<section id="inner-headline">
      <div class="container">
        <div class="row">
          <div class="span4">
            <div class="inner-heading">
              <h2>Individual Post</h2>
            </div>
          </div>
          <div class="span8">
            <ul class="breadcrumb">
              <li><a href="#"><i class="icon-home"></i></a><i class="icon-angle-right"></i></li>
              <li><a href="#">Blog</a><i class="icon-angle-right"></i></li>
              <li class="active">Blog post right sidebar</li>
            </ul>
          </div>
        </div>
      </div>
    </section>
    <section id="content">
      <div class="container">
        <div class="row">
          <div class="span8">
            <article>
              <div class="row">
                <div class="span8">
                  <div class="post-image">
                    <div class="post-heading">
                      <h3><router-link v-bind:to="'/post/' + post.id">{{ post.title }}</router-link></h3>
                    </div>
                    <img style="max-height:200px;" :src="showImage(post.image)" alt="" />
                  </div>
                  <p>
                    {{ post.description  }}
                  </p>
                  <div class="bottom-article">
                    <ul class="meta-post">
                      <li><i class="icon-user"></i><a  href="#"> Admin</a></li>
                      <li><i class="icon-folder-open"></i><router-link v-bind:to="'/category/' + post.category.id" v-if="post.category" href="#"> {{ post.category.name }}</router-link></li></li>
                      <li><i class="icon-tags"></i><a href="#">Web design</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </article>
            <!-- author info -->
            <div class="about-author">
              <a href="#" class="thumbnail align-left"><img src="public/flattern/img/avatar.png" alt="" /></a>
              <h5><strong><a v-if="post.user" href="#">{{ post.user.name }}</a></strong></h5>
              <p>
                Qui ut ceteros comprehensam. Cu eos sale sanctus eligendi, id ius elitr saperet, ocurreret pertinacia pri an. No mei nibh consectetuer, semper ad qui, est rebum nulla argumentum ei.
              </p>
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
			this.individualPost();
		},
		computed:{
			post(){
				return this.$store.getters.getIndividualPost
			},
		},
		methods:{
      individualPost(){
        this.$store.dispatch("getIndividualPost",this.$route.params.post_id)
      },
			showImage(image){
				return "public/images/"+image;
			}
		},
    watch:{
      $route(to,from){
        this.individualPost();
      }
    }

	}
</script>
<style lang="scss">
</style>