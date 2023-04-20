@extends('layout.layout')

@section('title', 'Auto-école')

@section('content')
    <!-- Carousel -->
    <section class="container-fluid p-0">
        <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="{{ asset('images/carousel-1.jpg') }}" alt="Image" />
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-7">
                                    <h1 class="display-2 text-light mb-5 animated slideInDown">
                                        Apprenez à conduire en toute
                                        confiance
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="{{ asset('images/carousel-2.jpg') }}" alt="Image" />
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-7">
                                    <h1 class="display-2 text-light mb-5 animated slideInDown">
                                        La sécurité au volant est notre
                                        priorité absolue
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

    <!-- Summary section -->
    <section class="container-fluid facts py-5 pt-lg-0">
        <div class="container py-5 pt-lg-0">
            <div class="row gx-0">
                <div class="col-lg-4">
                    <div class="bg-white shadow d-flex align-items-center h-100 p-4" style="min-height: 150px">
                        <div class="d-flex">
                            <div class="flex-shrink-0 btn-lg-square bg-primary">
                                <i class="fa fa-car text-white"></i>
                            </div>
                            <div class="ps-4">
                                <h5>Apprentissage facile</h5>
                                <span>Vous pouvez apprendre à conduire tout
                                    en vous amusant</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="bg-white shadow d-flex align-items-center h-100 p-4" style="min-height: 150px">
                        <div class="d-flex">
                            <div class="flex-shrink-0 btn-lg-square bg-primary">
                                <i class="fa fa-users text-white"></i>
                            </div>
                            <div class="ps-4">
                                <h5>Professeurs qualifiés</h5>
                                <span>Notre équipe de professeurs est
                                    qualifiée et expérimentée</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="bg-white shadow d-flex align-items-center h-100 p-4" style="min-height: 150px">
                        <div class="d-flex">
                            <div class="flex-shrink-0 btn-lg-square bg-primary">
                                <i class="fa fa-file-alt text-white"></i>
                            </div>
                            <div class="ps-4">
                                <h5>Formation complète</h5>
                                <span>Notre formation est complète et vous
                                    permet d'obtenir votre permis de
                                    conduire</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About section -->
    <section class="container-xxl py-6" id="about-section">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6">
                    <div class="position-relative overflow-hidden ps-5 pt-5 h-100" style="min-height: 400px">
                        <img class="position-absolute w-100 h-100" src="{{ asset('images/about-1.jpg') }}" alt=""
                            style="object-fit: cover" />
                        <img class="position-absolute top-0 start-0 bg-white pe-3 pb-3"
                            src="{{ asset('images/about-2.jpg') }}" alt="" style="width: 200px; height: 200px" />
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="h-100">
                        <h6 class="text-primary text-uppercase mb-2">
                            A propos de nous
                        </h6>
                        <h1 class="display-6 mb-4">
                            Nous sommes une école de conduite, nous vous
                            apprenons à conduire en toute sécurité et en
                            toute confiance
                        </h1>
                        <div class="row g-4">
                            {{-- <div class="col-sm-6">
                                <a class="btn btn-primary py-3 px-5" href="">Read More</a>
                            </div> --}}
                            <div class="col-sm-6">
                                <a class="d-inline-flex align-items-center btn btn-outline-primary border-2 p-2"
                                    href="">
                                    <span class="flex-shrink-0 btn-square bg-primary">
                                        <i class="fa fa-phone-alt text-white"></i>
                                    </span>
                                    <span class="px-3">000-000-0000</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section class="container-xxl py-6">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6">
                    <h6 class="text-primary text-uppercase mb-2">
                        Pourquoi nous choisir ?
                    </h6>

                    <div>
                        <div class="col-sm-6 d-flex flex-row">
                            <div>
                                <i class="fa fa-check-circle text-primary fs-3"></i>
                            </div>
                            <div class="d-flex flex-column p-2">
                                <h6 class="mb-0">
                                    Des voitures récentes
                                </h6>
                                <p>
                                    Des voitures récentes et confortables pour vous permettre de vous concentrer sur la
                                    conduite.
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-6 d-flex flex-row">
                            <div>
                                <i class="fa fa-check-circle text-primary fs-3"></i>
                            </div>
                            <div class="d-flex flex-column p-2">
                                <h6 class="mb-0">
                                    Des moniteurs professionnels
                                </h6>
                                <p>
                                    Des moniteurs professionnels qui vous apprendront à conduire en toute sécurité.
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-6 d-flex flex-row">
                            <div>
                                <i class="fa fa-check-circle text-primary fs-3"></i>
                            </div>
                            <div class="d-flex flex-column p-2">
                                <h6 class="mb-0">
                                    Des prix compétitifs
                                </h6>
                                <p>
                                    Des prix compétitifs pour vous permettre de vous former à la conduite.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="position-relative overflow-hidden pe-5 pt-5 h-100" style="min-height: 400px">
                        <img class="position-absolute w-100 h-100" src="{{ asset('images/about-1.jpg') }}" alt=""
                            style="object-fit: cover" />
                        <img class="position-absolute top-0 end-0 bg-white ps-3 pb-3"
                            src="{{ asset('images/about-2.jpg') }}" alt="" style="width: 200px; height: 200px" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact section -->
    <section class="container-xxl py-6" id="contact-section">
        <div class="container">
            <div class="col-lg-6">
                <h6 class="text-primary text-uppercase mb-2">
                    Contactez nous
                </h6>
                <h1 class="display-6 mb-4">
                    Nous sommes à votre écoute, n'hésitez pas à nous
                    contacter
                </h1>

                <form action="" method="post">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control border-0 bg-light" id="name"
                                    placeholder="Your Name" name="name" />
                                <label for="name">Votre Nom</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email" class="form-control border-0 bg-light" id="email"
                                    placeholder="Your Email" name="email" />
                                <label for="email">Votre Email</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" class="form-control border-0 bg-light" id="subject"
                                    placeholder="Subject" name="subject" />
                                <label for="subject">Le sujet</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control border-0 bg-light" placeholder="Leave a message here" id="message"
                                    style="height: 150px" name="message"></textarea>
                                <label for="message">Votre message</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary py-3 px-5" type="submit">
                                Envoyer
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
