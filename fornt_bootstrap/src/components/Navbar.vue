<template>
      <!-- navbar  -->
    <header class="custom_bg">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <nav class="navbar navbar-expand-lg navbar-dark ">
                        <div class="container-fluid">
                          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                          </button>
                          <div class="collapse navbar-collapse" id="navbarNavDropdown">
                            <ul class="navbar-nav">
                              <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">Home</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" href="#">Movies</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" href="#">Categories</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" href="#">Contact Us</a>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </nav>
                </div>
                <div class="col-md-3 align-content-center align-self-center">
                    <a class="navbar-brand text-light" href="#">MovieShop</a>
                </div>
                <div class="col-md-4 align-content-end align-self-center">
                    <div class="d-flex justify-content-between">
                        <form class="d-flex">
                            <input class="form-control me-2 bg-transparent text-info" type="search" placeholder="Search" aria-label="Search">
                          </form>
                          <div class="auth_user d-flex justify-content-between">
                              <div class="img_box">
                                  <img src="https://dt2sdf0db8zob.cloudfront.net/wp-content/uploads/2019/12/9-Best-Online-Avatars-and-How-to-Make-Your-Own-for-Free-image1-5.png" alt="" class="user_img rounded" >
                              </div>
                              <h5 class="align-self-center text-light mt-2 mx-2">Shahin</h5>
                          </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
</template>

<script>
    export default {
        
    }
</script>

<style lang="scss" scoped>

</style>
