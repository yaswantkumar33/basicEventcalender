@extends('layouts.app')
@section('content')
    <section class="mt-5">
        <div class="px-4 py-5 px-md-5 text-center text-lg-start" style="background-color: hsl(0, 0%, 96%)">
            <div class="container">
                <div class="row gx-lg-5 align-items-center">
                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <h1 class="my-5 display-3 fw-bold ls-tight">
                            The ultimate solution
                            <br />
                            <span class="text-primary">for organizing events</span>
                        </h1>
                        <p style="color: hsl(217, 10%, 50.8%)">
                            Quickly add, edit, and view events with our intuitive calendar interface.
                            Start using our event management calendar today and make your plans organized in your life!
                        </p>
                    </div>
                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <div class="card">
                            <div class="card-body py-5 px-md-5">
                                <form method="post">
                                    <h4 class="display-4 fw-semibold mb-5" style="font-size: 35px">Event Managment calender
                                    </h4>
                                    <p id="err" class="text-center text-danger"></p>
                                    <div class="form-outline mb-4">
                                        <input type="email" id="email" class="form-control" name="email" />
                                        <label class="form-label" for="form3Example3">Email address</label>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <input type="password" id="password" class="form-control" name="email" />
                                        <label class="form-label" for="form3Example4">Password</label>
                                    </div>
                                    <button type="button" id="submitbtn"class="btn btn-primary btn-block mb-4">
                                        Sign In
                                    </button>
                                    <p>New User Sign up <a href="/register" class="link-underline-primary">here</a>
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @section('cujs')
        <script>
            $(document).ready(function() {
                let email, password, firstname, lastname;
                console.log("ready!");
                let err = $('#err')
                $('#password').on('input', (ev) => {
                    password = ev.target.value;
                });
                $('#email').on('input', (ev) => {
                    email = ev.target.value;
                });
                $('#submitbtn').on('click', () => {

                    if (email && email.length > 0) {
                        if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
                            err.html("")
                            if (password && password.length > 0) {

                                $.ajax({
                                    url: "/user/auth",
                                    type: "POST",
                                    data: {
                                        email: email,
                                        password: password,
                                        type: 'login',
                                        _token: "{{ csrf_token() }}"
                                    },
                                    success: function(data) {
                                        window.location.href = "/calender"
                                    },
                                    error: function(xhr, status, error) {
                                        err.html("Error Invalid creditials")
                                    }
                                })

                            } else {
                                err.html("Enter Password Field")
                            }

                        } else {
                            err.html(" Enter Valid Email ");
                        }
                    } else {
                        err.html("Enter email field")

                    }
                })
            });
        </script>
    </section>
@endsection
