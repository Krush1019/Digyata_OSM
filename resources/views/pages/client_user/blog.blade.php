@extends('layouts/client_user/contentLayoutMaster')

@section('title', 'blog')

@section('specific-style')
  <link href="{{asset('client_user/css/blog.css')}}" rel="stylesheet">
@endsection

@section('custom-style')
  <link href="{{asset('client_user/css/custom.css')}}" rel="stylesheet">
@endsection

@section('header-class', 'header header_in shadow element_to_stick clearfix')

@section('content')
  <main class="bg_color">

    <div class="container margin_45_40">
      <div class="row">
        <div class="col-lg-9">
          <div class="row">
            <div class="col-md-6">
              <article class="blog">
                <figure>
                  <a href="blog-post.html"><img src="img/blog-1.jpg" alt="">
                    <div class="preview"><span>Read more</span></div>
                  </a>
                </figure>
                <div class="post_info">
                  <small>Category - 20 Nov. 2017</small>
                  <h2><a href="blog-post.html">Ea exerci option hendrerit</a></h2>
                  <p>Quodsi sanctus pro eu, ne audire scripserit quo. Vel an enim offendit salutandi, in eos quod omnes epicurei, ex veri qualisque scriptorem mei.</p>
                  <ul>
                    <li>
                      <div class="thumb"><img src="img/avatar.jpg" alt=""></div> Admin
                    </li>
                    <li><i class="icon_comment_alt"></i>20</li>
                  </ul>
                </div>
              </article>
              <!-- /article -->
            </div>
            <!-- /col -->
            <div class="col-md-6">
              <article class="blog">
                <figure>
                  <a href="blog-post.html"><img src="img/blog-2.jpg" alt="">
                    <div class="preview"><span>Read more</span></div>
                  </a>
                </figure>
                <div class="post_info">
                  <small>Category - 20 Nov. 2017</small>
                  <h2><a href="blog-post.html">At usu sale dolorum offendit</a></h2>
                  <p>Quodsi sanctus pro eu, ne audire scripserit quo. Vel an enim offendit salutandi, in eos quod omnes epicurei, ex veri qualisque scriptorem mei.</p>
                  <ul>
                    <li>
                      <div class="thumb"><img src="img/avatar.jpg" alt=""></div> Admin
                    </li>
                    <li><i class="icon_comment_alt"></i>20</li>
                  </ul>
                </div>
              </article>
              <!-- /article -->
            </div>
            <!-- /col -->
            <div class="col-md-6">
              <article class="blog">
                <figure>
                  <a href="blog-post.html"><img src="img/blog-3.jpg" alt="">
                    <div class="preview"><span>Read more</span></div>
                  </a>
                </figure>
                <div class="post_info">
                  <small>Category - 20 Nov. 2017</small>
                  <h2><a href="blog-post.html">Iusto nominavi petentium in</a></h2>
                  <p>Quodsi sanctus pro eu, ne audire scripserit quo. Vel an enim offendit salutandi, in eos quod omnes epicurei, ex veri qualisque scriptorem mei.</p>
                  <ul>
                    <li>
                      <div class="thumb"><img src="img/avatar.jpg" alt=""></div> Admin
                    </li>
                    <li><i class="icon_comment_alt"></i>20</li>
                  </ul>
                </div>
              </article>
              <!-- /article -->
            </div>
            <!-- /col -->
            <div class="col-md-6">
              <article class="blog">
                <figure>
                  <a href="blog-post.html"><img src="img/blog-4.jpg" alt="">
                    <div class="preview"><span>Read more</span></div>
                  </a>
                </figure>
                <div class="post_info">
                  <small>Category - 20 Nov. 2017</small>
                  <h2><a href="blog-post.html">Assueverit concludaturque quo</a></h2>
                  <p>Quodsi sanctus pro eu, ne audire scripserit quo. Vel an enim offendit salutandi, in eos quod omnes epicurei, ex veri qualisque scriptorem mei.</p>
                  <ul>
                    <li>
                      <div class="thumb"><img src="img/avatar.jpg" alt=""></div> Admin
                    </li>
                    <li><i class="icon_comment_alt"></i>20</li>
                  </ul>
                </div>
              </article>
              <!-- /article -->
            </div>
            <!-- /col -->
            <div class="col-md-6">
              <article class="blog">
                <figure>
                  <a href="blog-post.html"><img src="img/blog-5.jpg" alt="">
                    <div class="preview"><span>Read more</span></div>
                  </a>
                </figure>
                <div class="post_info">
                  <small>Category - 20 Nov. 2017</small>
                  <h2><a href="blog-post.html">Nec nihil menandri appellantur</a></h2>
                  <p>Quodsi sanctus pro eu, ne audire scripserit quo. Vel an enim offendit salutandi, in eos quod omnes epicurei, ex veri qualisque scriptorem mei.</p>
                  <ul>
                    <li>
                      <div class="thumb"><img src="img/avatar.jpg" alt=""></div> Admin
                    </li>
                    <li><i class="icon_comment_alt"></i>20</li>
                  </ul>
                </div>
              </article>
              <!-- /article -->
            </div>
            <!-- /col -->
            <div class="col-md-6">
              <article class="blog">
                <figure>
                  <a href="blog-post.html"><img src="img/blog-6.jpg" alt="">
                    <div class="preview"><span>Read more</span></div>
                  </a>
                </figure>
                <div class="post_info">
                  <small>Category - 20 Nov. 2017</small>
                  <h2><a href="blog-post.html">Te congue everti his salutandi</a></h2>
                  <p>Quodsi sanctus pro eu, ne audire scripserit quo. Vel an enim offendit salutandi, in eos quod omnes epicurei, ex veri qualisque scriptorem mei.</p>
                  <ul>
                    <li>
                      <div class="thumb"><img src="img/avatar.jpg" alt=""></div> Admin
                    </li>
                    <li><i class="icon_comment_alt"></i>20</li>
                  </ul>
                </div>
              </article>
              <!-- /article -->
            </div>
            <!-- /col -->
          </div>
          <!-- /row -->

          <div class="pagination_fg">
            <a href="#">&laquo;</a>
            <a href="#" class="active">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
            <a href="#">4</a>
            <a href="#">5</a>
            <a href="#">&raquo;</a>
          </div>

        </div>
        <!-- /col -->

        <aside class="col-lg-3">
          <div class="widget search_blog">
            <div class="form-group">
              <input type="text" name="search" id="search" class="form-control" placeholder="Terms...">
              <span><input type="submit" value="Search"></span>
            </div>
          </div>
          <!-- /widget -->
          <div class="widget">
            <div class="widget-title first">
              <h4>Latest Post</h4>
            </div>
            <ul class="comments-list">
              <li>
                <div class="alignleft">
                  <a href="#0"><img src="img/blog-5.jpg" alt=""></a>
                </div>
                <small>Category - 11.08.2016</small>
                <h3><a href="#" title="">Verear qualisque ex minimum...</a></h3>
              </li>
              <li>
                <div class="alignleft">
                  <a href="#0"><img src="img/blog-6.jpg" alt=""></a>
                </div>
                <small>Category - 11.08.2016</small>
                <h3><a href="#" title="">Verear qualisque ex minimum...</a></h3>
              </li>
              <li>
                <div class="alignleft">
                  <a href="#0"><img src="img/blog-4.jpg" alt=""></a>
                </div>
                <small>Category - 11.08.2016</small>
                <h3><a href="#" title="">Verear qualisque ex minimum...</a></h3>
              </li>
            </ul>
          </div>
          <!-- /widget -->
          <div class="widget">
            <div class="widget-title">
              <h4>Categories</h4>
            </div>
            <ul class="cats">
              <li><a href="#">Dermatology <span>(12)</span></a></li>
              <li><a href="#">Consulting <span>(21)</span></a></li>
              <li><a href="#">Treatments <span>(44)</span></a></li>
              <li><a href="#">Personal care <span>(31)</span></a></li>
            </ul>
          </div>
          <!-- /widget -->
          <div class="widget">
            <div class="widget-title">
              <h4>Popular Tags</h4>
            </div>
            <div class="tags">
              <a href="#">Lawyer</a>
              <a href="#">Accounting</a>
              <a href="#">Consulting</a>
              <a href="#">Doctors</a>
              <a href="#">Best Offers</a>
              <a href="#">Languages</a>
              <a href="#">Teach</a>
            </div>
          </div>
          <!-- /widget -->
        </aside>
        <!-- /aside -->
      </div>
      <!-- /row -->
    </div>
    <!-- /container -->

  </main>
  <!-- /main -->
@endsection


