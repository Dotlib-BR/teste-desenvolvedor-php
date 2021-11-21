@extends('layouts.app')

@section('content')

      <!-- hero area -->
      <section class="hero-area bg-primary" id="parallax">
        <div class="container">
          <div class="row">
            <div class="col-lg-11 mx-auto">
              <h1 class="text-white font-tertiary"><br> Encontre o profissional que você procura<br>,ou o trabalho dos seus sonhos</h1>
            </div>
          </div>
        </div>
        <div class="layer-bg w-100">
          <img class="img-fluid w-100" src="images/illustrations/leaf-bg.png" alt="bg-shape">
        </div>
        <div class="layer" id="l2">
          <img src="images/illustrations/dots-cyan.png" alt="bg-shape">
        </div>
        <div class="layer" id="l3">
          <img src="images/illustrations/leaf-orange.png" alt="bg-shape">
        </div>
        <div class="layer" id="l4">
          <img src="images/illustrations/dots-orange.png" alt="bg-shape">
        </div>
        <div class="layer" id="l5">
          <img src="images/illustrations/leaf-yellow.png" alt="bg-shape">
        </div>
        <div class="layer" id="l6">
          <img src="images/illustrations/leaf-cyan.png" alt="bg-shape">
        </div>
        <div class="layer" id="l7">
          <img src="images/illustrations/dots-group-orange.png" alt="bg-shape">
        </div>
        <div class="layer" id="l8">
          <img src="images/illustrations/leaf-pink-round.png" alt="bg-shape">
        </div>
        <div class="layer" id="l9">
          <img src="images/illustrations/leaf-cyan-2.png" alt="bg-shape">
        </div>
        <!-- social icon -->
        <ul class="list-unstyled ml-5 mt-3 position-relative zindex-1">
          <li class="mb-3"><a class="text-white" href="https://themefisher.com/"><i class="ti-facebook"></i></a></li>
          <li class="mb-3"><a class="text-white" href="https://themefisher.com/"><i class="ti-instagram"></i></a></li>
          <li class="mb-3"><a class="text-white" href="https://themefisher.com/"><i class="ti-dribbble"></i></a></li>
          <li class="mb-3"><a class="text-white" href="https://themefisher.com/"><i class="ti-twitter"></i></a></li>
        </ul>
        <!-- /social icon -->
      </section>
      <!-- /hero area -->
      <!-- Registro -->
      <section id="register">
        <div class="container">
          <div class="row">
              <div class="col-lg-10 mx-auto text-center">

            </div>
          </div>
        </div>
      </section>
      <!-- /about -->
    <!-- blog -->
      <section class="section">
        <div class="container">
          <div class="row">
            <div class="col-12 text-center">
              <h2 class="section-title">Blogs</h2>
            </div>
            <div class="col-lg-4 col-sm-6 mb-4 mb-lg-0">
              <article class="card shadow">
                <img class="rounded card-img-top" src="images/blog/post-3.jpg" alt="post-thumb">
                <div class="card-body">
                  <h4 class="card-title"><a class="text-dark" href="blog-single.html">Amazon increase income 1.5 Million</a>
                  </h4>
                  <p class="cars-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                    incididunt ut labore et
                    dolore magna aliqua.</p>
                  <a href="blog-single.html" class="btn btn-xs btn-primary">Read More</a>
                </div>
              </article>
            </div>
            <div class="col-lg-4 col-sm-6 mb-4 mb-lg-0">
              <article class="card shadow">
                <img class="rounded card-img-top" src="images/blog/post-4.jpg" alt="post-thumb">
                <div class="card-body">
                  <h4 class="card-title"><a class="text-dark" href="blog-single.html">Amazon increase income 1.5 Million</a>
                  </h4>
                  <p class="cars-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                    incididunt ut labore et
                    dolore magna aliqua.</p>
                  <a href="blog-single.html" class="btn btn-xs btn-primary">Read More</a>
                </div>
              </article>
            </div>
            <div class="col-lg-4 col-sm-6 mb-4 mb-lg-0">
              <article class="card shadow">
                <img class="rounded card-img-top" src="images/blog/post-2.jpg" alt="post-thumb">
                <div class="card-body">
                  <h4 class="card-title"><a class="text-dark" href="blog-single.html">Amazon increase income 1.5 Million</a>
                  </h4>
                  <p class="cars-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                    incididunt ut labore et
                    dolore magna aliqua.</p>
                  <a href="blog-single.html" class="btn btn-xs btn-primary">Read More</a>
                </div>
              </article>
            </div>
          </div>
        </div>
      </section>
      @endsection

