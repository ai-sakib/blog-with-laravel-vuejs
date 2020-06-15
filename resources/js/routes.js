import AdminHome from './components/admin/AdminHome.vue';

import CategoryList from './components/admin/category/index.vue';
import AddCategory from './components/admin/category/create.vue';
import EditCategory from './components/admin/category/edit.vue';

import AdminPost from './components/admin/post/index.vue';
import AddPost from './components/admin/post/create.vue';
import EditPost from './components/admin/post/edit.vue';

//Frontend Imorts
import PublicHome from './components/public/PublicHome.vue';
import blog from './components/public/blog/blog.vue';
import individualPost from './components/public/blog/individualPost.vue';
//import individualCategory from './components/public/blog/individualCategory.vue';

export const routes = [

  //Admin Routes
  { path: '/dashboard', component: AdminHome, },
  
  { path: '/category', component: CategoryList,},
  { path: '/add-category', component: AddCategory },
  { path: '/category/:categoryid/edit', component: EditCategory,},

  { path: '/post', component: AdminPost,},
  { path: '/add-post', component: AddPost,},
  { path: '/post/:id/edit', component: EditPost,},

  //Frontend Routes

  { path: '/', component: PublicHome, },
  { path: '/blog', component: blog, },
  { path: '/post/:post_id', component: individualPost, },
  { path: '/category/:category_id', component: blog, },
]