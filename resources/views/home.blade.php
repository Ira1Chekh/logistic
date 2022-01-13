<!DOCTYPE html>
<html lang="uk">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="{{ asset('images/truck.png')  }}" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body>
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container px-5">
                <a class="navbar-brand" href="#">Logistics</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="#services">Послуги</a></li>
                        <li class="nav-item"><a class="nav-link" href="#cargo_types">Типи вантажу</a></li>
                        <li class="nav-item"><a class="nav-link" href="#vehicle_types">Типи кузова</a></li>
                        <li class="nav-item"><a class="nav-link" href="#workflow">Робочий процес</a></li>
                        <li class="nav-item"><a class="nav-link" href="#about_us">Про нас</a></li>
                        <li class="nav-item"><a class="nav-link" href="#insurance">Страхування</a></li>
                        <li class="nav-item"><a class="nav-link" href="#contacts">Контакти</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <header class="masthead" style="background-image: url('/images/truck3.jpg');" >
            <div class="overlay"></div>
            <div class="container px-5">
                <div class="row gx-5 justify-content-center">
                    <div class="col-lg-6">
                        <div class="text-center my-5">
                            <h1 class="display-5 fw-bolder text-white mb-2">Доставка вантажів по Україні від 30 кг</h1>
                            <p class="lead fw-bold text-white mb-4">Створіть замовлення в один клік після реєстрації на сайті!</p>
                            <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
                                <a class="btn btn-primary btn-lg px-4 me-sm-3" href="{{ route('register') }}">Зареєструватися</a>
                                <a class="btn btn-outline-light btn-lg px-4 fw-bolder" href="{{ route('login') }}">Увійти</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <section class="py-5 border-bottom" id="services">
            <div class="container px-5 my-5">
                <div class="row gx-5">
                    <div class="text-center mb-5">
                        <h2 class="fw-bolder">Послуги</h2>
                    </div>
                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="31" height="32" fill="currentColor" class="bi bi-coin" viewBox="0 0 16 16">
                                <path d="M5.5 9.511c.076.954.83 1.697 2.182 1.785V12h.6v-.709c1.4-.098 2.218-.846 2.218-1.932 0-.987-.626-1.496-1.745-1.76l-.473-.112V5.57c.6.068.982.396 1.074.85h1.052c-.076-.919-.864-1.638-2.126-1.716V4h-.6v.719c-1.195.117-2.01.836-2.01 1.853 0 .9.606 1.472 1.613 1.707l.397.098v2.034c-.615-.093-1.022-.43-1.114-.9H5.5zm2.177-2.166c-.59-.137-.91-.416-.91-.836 0-.47.345-.822.915-.925v1.76h-.005zm.692 1.193c.717.166 1.048.435 1.048.91 0 .542-.412.914-1.135.982V8.518l.087.02z"/>
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M8 13.5a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11zm0 .5A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"/>
                            </svg></div>
                        <h2 class="h4 fw-bolder">Фінансова логістика</h2>
                        <p>Управляємо рухом фінансів при реалізації ЗЕД, що є важливою складовою логістичного процесу і може істотно впливати на підсумковий фінансовий результат</p>
                        <p>Беремо участь на всіх етапах фінансового маршруту, роблячи його оптимальним і коректним</p>
                        <p>Організовуємо оплати постачальнику</p>
                        <p>Управляємо витратами і прибутком за зовнішньоекономічними операціями</p>
                        <p>Фінансовий консалтинг</p>
                    </div>
                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-file-earmark-check"></i></div>
                        <h2 class="h4 fw-bolder">Контрактна логістика</h2>
                        <p>Реалізуємо аутсорсинг відділу ЗЕД</p>
                        <p>Візьмемо на себе перелік завдань по роботі з постачальниками</p>
                        <p>Складемо і перевіримо зовнішньоекономічний контракт</p>
                        <p>Узгодимо з постачальником спірні моменти по документам і процесам</p>
                        <p>Поставки "під ключ"</p>
                        <p>Послуга комісіонера</p>
                    </div>
                    <div class="col-lg-4">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-truck"></i></div>
                        <h2 class="h4 fw-bolder">Транспортна логістика</h2>
                        <p>Організуємо доставку вантажу «від дверей до дверей» будь-яким видом транспорту, а також використовуючи комбінацію різних видів транспорту в ланцюжку поставки, з урахуванням дотримання основних логістичних критеріїв</p>
                        <p>Розробимо оптимальний маршрут, запропонуємо оптимальні терміни і вартість при заданих умовах</p>
                        <p>Доставимо Ваш вантаж в окремому авто або в складі збірного авто</p>
                        <p>Контролюємо температурний режим при транспортуванні</p>
                        <p>Організовуємо страхування вантажу</p>
                        <p>Експедируємо вантажі в порту / аеропорту</p>
                        <p>Відстежуємо вантажі на всіх етапах доставки</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-light py-5 border-bottom" id="cargo_types">
            <div class="container px-5 my-5">
                <div class="text-center mb-5">
                    <h2 class="fw-bolder">Типи вантажів</h2>
                </div>
                <div class="row gx-5 justify-content-center">
                    @foreach($cargoTypes as $id => $name)
                    <div class="col-lg-6 col-xl-3 mb-3">
                        <div class="card mb-5 mb-xl-0">
                            <div class="card-body p-5">
                                <div class="mb-3">
                                    <span class="display-6 fw-bolder">{{$id}}</span>
                                </div>
                                <ul class="list-unstyled mb-4">
                                    <li class="mb-2">
                                        {{$name}}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="bg-light py-5 border-bottom" id="vehicle_types">
            <div class="container px-5 my-5">
                <div class="text-center mb-5">
                    <h2 class="fw-bolder">Типи кузова</h2>
                </div>
                <div class="row gx-5 justify-content-center">
                    @foreach($vehicleTypes as $id => $name)
                    <div class="col-lg-6 col-xl-3 mb-3">
                        <div class="card mb-5 mb-xl-0">
                            <div class="card-body p-5">
                                <div class="mb-3">
                                    <span class="display-6 fw-bolder">{{$id}}</span>
                                </div>
                                <ul class="list-unstyled mb-4">
                                    <li class="mb-2">
                                        {{$name}}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="py-5 border-bottom" id="workflow">
            <div class="container px-5 my-5 px-5">
                <div class="text-center mb-5">
                    <h2 class="fw-bolder">Робочій процес</h2>
                    <p class="lead mb-0">Як ми працюємо</p>
                </div>
                <div class="row gx-5 justify-content-center">
                    <div class="col-lg-9">
                        <!-- Testimonial 1-->
                        <div class="card mb-4">
                            <div class="card-body p-4">
                                <div class="d-flex">
                                    <div class="flex-shrink-0"><i class="bi bi-pen text-primary fs-1"></i></div>
                                    <div class="ms-4">
                                        <p class="mb-1">Оформлення замовлення</p>
                                        <div class="small text-muted">Заповнення форми з інформацією про тип вантажу, тип кузова, місце і дата відправлення і прибуття.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-body p-4">
                                <div class="d-flex">
                                    <div class="flex-shrink-0"><i class="bi bi-check-square text-primary fs-1"></i></div>
                                    <div class="ms-4">
                                        <p class="mb-1">Перевірка документів менеджером</p>
                                        <div class="small text-muted">Менеджер переревіряє документи на перевезення, схвалює замовлення до оплати.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-body p-4">
                                <div class="d-flex">
                                    <div class="flex-shrink-0"><i class="bi bi-credit-card text-primary fs-1"></i></div>
                                    <div class="ms-4">
                                        <p class="mb-1">Оплата</p>
                                        <div class="small text-muted">Клієнт оплачує перевезення банківскьим переводом.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-body p-4">
                                <div class="d-flex">
                                    <div class="flex-shrink-0"><i class="bi bi-truck text-primary fs-1"></i></div>
                                    <div class="ms-4">
                                        <p class="mb-1">Транспортування</p>
                                        <div class="small text-muted">Призначений до заказу водій завантажує вантаж у транспортний засіб.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-body p-4">
                                <div class="d-flex">
                                    <div class="flex-shrink-0"><i class="bi bi-box-seam text-primary fs-1"></i></div>
                                    <div class="ms-4">
                                        <p class="mb-1">Доставка до пункту призначення</p>
                                        <div class="small text-muted">Вантаж прибуває до місця призначення.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-5" id="about_us">
            <div class="container px-4 px-lg-5 my-5">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-6">
                        <img class="card-img-top mb-5 mb-md-0" src="{{asset('images/about.jpg')}}" alt="...">
                    </div>
                    <div class="col-md-6">
                        <h1 class="display-5 fw-bolder">Про нас</h1>
                        <div class="fs-5 mb-5">
                            <span>Чому варто вибрати Logistics?</span>
                        </div>
                        <p>«Logistics» – компанія, яка економить час своїх клієнтів. За 2 хвилини ми проконсультуємо, складемо заявку, розрахуємо вартість і підберемо автомобіль. Вантажна машина прибуває в вказане місце вже через 2 години, незалежно від ситуації на дорогах і дальності адреси.</p>
                        <p>Величезна партнерська мережа, де налічується понад 3000 автомобілів, дозволяє нам не наймати посередників, працюючи з замовником безпосередньо. Це вберігає клієнта від низької якості послуг і дозволяє встановлювати ціни на 7-9% нижчими від ринкових.</p>
                        <p>Оптимальні логістичні рішення, перевірені маршрути та чесні водії –  це те, що допомагає здійснювати перевезення завжди вчасно. Завдяки злагодженій роботі та комплексному підходу, наші автомобілі не затримуються, а ризик виникнення форс-мажорних ситуації зводиться до мінімуму.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-5 border-bottom" id="insurance">
            <div class="container px-5 my-5">
                <div class="row gx-5">
                    <div class="text-center mb-5">
                        <h2 class="fw-bolder">Страхування</h2>
                    </div>
                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-box-seam"></i></div>
                        <h2 class="h4 fw-bolder">Відповідальність за вантаж</h2>
                        <p>Ми за умовчанням страхуємо кожен вантаж для додаткової надійності</p>
                    </div>
                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-truck"></i></div>
                        <h2 class="h4 fw-bolder">Перевірені водії</h2>
                        <p>100% машин пройшли перевірку та готові для роботи за європейськими стандартами</p>
                    </div>
                    <div class="col-lg-4">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-credit-card"></i></div>
                        <h2 class="h4 fw-bolder">Будь-яка форма оплати</h2>
                        <p>У нас можна платити готівкою, карткою або на розрахунковий рахунок</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer-->
        <footer class="py-5 bg-dark" id="contacts">
            <div class="container px-5 my-5 text-white">
                <div class="row mb-5">
                    <div class="col-md">
                        <div class="ftco-footer-widget mb-4">
                            <h4 class="ftco-heading-2">Про Logistics</h4>
                            <p>Logistics - логістична компанія з 2016 року на ринку.</p>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="ftco-footer-widget mb-4">
                            <h4 class="ftco-heading-2">У вас залишились запитання?</h4>
                            <div class="block-23 mb-3">
                                <ul>
                                    <li><i class="bi bi-geo-alt" style="font-size: 1.5rem;"></i><span class="text"> вул. Сумська 27, Харків, Україна</span></li>
                                    <li><i class="bi bi-phone" style="font-size: 1.5rem;"></i><span class="text"> +38(050) 052 21 46</span></li>
                                    <li><i class="bi bi-envelope" style="font-size: 1.5rem;"></i><span class="text"> logisticts@gmail.com</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
