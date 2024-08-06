@extends('layouts.app')
@section('content')
    <!-- Section: Design Block -->
    <section class="mt-5">
        <!-- Jumbotron -->
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
                                    @csrf <!-- Add CSRF token field -->
                                    <h4 class="display-4 fw-semibold mb-5" style="font-size: 35px">Event Management Calendar
                                    </h4>
                                    <p id="err" class="text-center text-danger"></p>
                                    <!-- 2 column grid layout with text inputs for the first and last names -->
                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <div class="form-outline">
                                                <input type="text" id="firstname" class="form-control"
                                                    name="firstname" />
                                                <label class="form-label" for="firstname">First name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <div class="form-outline">
                                                <input type="text" id="lastname" class="form-control" name="lastname" />
                                                <label class="form-label" for="lastname">Last name</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <input type="email" id="email" class="form-control" name="email" />
                                        <label class="form-label" for="email">Email address</label>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <input type="password" id="password" class="form-control" name="password" />
                                        <label class="form-label" for="password">Password</label>
                                    </div>
                                    <button type="button" id="submitbtn"
                                        class="btn btn-primary btn-block mb-4 Pointer-none">
                                        Sign up
                                    </button>
                                    <p>Already have an account? Sign in by <a href="/login"
                                            class="link-underline-primary">clicking here</a>
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
                $('#firstname').on('input', (ev) => {
                    firstname = ev.target.value;
                });
                $('#lastname').on('input', (ev) => {
                    lastname = ev.target.value;
                });
                $('#submitbtn').on('click', () => {
                    if (firstname && firstname.length > 4) {
                        if (lastname && lastname.length > 4) {
                            if (email && email.length > 0) {
                                if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
                                    err.html("")
                                    if (password && password.length > 6) {
                                        err.html(" ")
                                        if (password.match(/[a-z]/g)) {
                                            err.html(" ")
                                            if (password.match(/[A-Z]/g)) {
                                                err.html(" ")
                                                if (password.match(/[0-9]/g)) {
                                                    $.ajax({
                                                        url: "/user/auth",
                                                        type: "POST",
                                                        data: {
                                                            firstname: firstname,
                                                            lastname: lastname,
                                                            email: email,
                                                            password: password,
                                                            type: 'register',
                                                            _token: "{{ csrf_token() }}"
                                                        },
                                                        success: function(data) {
                                                            window.location.href = '/login'
                                                        },
                                                        error: function(xhr, status, error) {
                                                            console.error("API request failed:",
                                                                error);
                                                            alert(
                                                                "An error occurred while registering. Please try again."
                                                            );
                                                        }
                                                    })

                                                } else {
                                                    err.html('Password Must Contain')
                                                }
                                            } else {
                                                err.html("Password must contain Uppercase")
                                            }
                                        } else {
                                            err.html("Password must contain lowercase")
                                        }

                                    } else {
                                        err.html("Password Must Contain at least 6 characters")
                                    }
                                } else {
                                    err.html(" Enter Valid Email ");
                                }
                            } else {
                                err.html("Enter email field")

                            }
                        } else {
                            err.html("Lastname Should be at least 4 characters")
                        }
                    } else {
                        err.html("Firstname Should be at least 4 characters")
                    }
                })
            });
        </script>
        <!-- Jumbotron -->
    </section>
    <!-- Section: Design Block -->
@endsection
