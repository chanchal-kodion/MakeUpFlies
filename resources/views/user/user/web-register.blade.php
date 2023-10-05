
  @include("user.layout.header")
    <div class="container my-5">
       
   
    <section class="vh-100" style="background-color: #5ac5f0;">
      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col col-xl-10">
              <div class="card" style="border-radius: 1rem;">
                <div class="row g-0">
                  <div class="col-md-6 col-lg-5 d-none d-md-block">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/img1.webp"
                    alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                  </div>
                  <div class="col-md-6 col-lg-7 d-flex align-items-center">
                    <div class="card-body p-4 p-lg-5 text-black">
                      
                      <form name="registrationForm" id="registrationForm" method="post">
                        
                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Welcome to Make Up Flies Register Now</h5>
                        <div class="form-outline mb-4">
                          <input type="text" id="name" class="form-control form-control-lg" />
                          <label class="form-label" for="name">Name</label>
                        </div>

                        <div class="form-outline mb-4">
                            <input type="email" id="email" class="form-control form-control-lg" />
                            <label class="form-label" for="email">Email address</label>
                          </div>
                          
                          <div class="form-outline mb-4">
                            <input type="password" id="password" class="form-control form-control-lg" />
                            <label class="form-label" for="password">Password</label>
                          </div>
                          
                          <div class="pt-1 mb-4">
                            <button class="btn btn-dark btn-lg btn-block" type="button">Register Now</button>
                          </div>

                          <p class="mb-5 pb-lg-2" style="color: #12b0e0;">Already Have an account ? <a href="{{url('web-login')}}"
                            style="color: #17e7ee;">Login here</a></p>
                          </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      </div>
      @include("user.layout.footer")