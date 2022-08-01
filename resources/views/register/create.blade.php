<x-layout>
    <section class="backgroundNav2 test9">
        <div class="mask d-flex align-items-center h-100 gradient-custom-3">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                        <div class="card" style="border-radius: 15px; background-color: #e4f9fe83;">
                            <div class="card-body p-5">
                                <h2 class="text-uppercase text-center mb-5">Регистрация</h2>
                                <form method="POST" action="/register">
                                    @csrf

                                    <div class="form-outline mb-3">
                                        <label class="form-label" for="name">Имя</label>
                                        <input type="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" name="name" required autocomplete="current-name" placeholder="Татьяна" />
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-outline mb-3">
                                        <label class="form-label" for="phone_number">Номер телефона</label>
                                        <input type="phone_number" id="phone-number" class="form-control @error('phone_number') is-invalid @enderror" value="{{ old('phone_number') }}" name="phone_number" required autocomplete="current-phone_number" placeholder="+7 (961) 610-48-38" />
                                        @error('phone_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-outline mb-3">
                                        <label class="form-label" for="email">Почта</label>
                                        <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" name="email" required autocomplete="current-email" placeholder="tatyanamib@example.com" />
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-outline mb-3">
                                        <label class="form-label" for="password">Пароль</label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="••••••••" />
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-outline mb-3">
                                        <label class="form-label" name="password_confirmation" for="password_confirmation">Повторите Пароль еще раз</label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" required autocomplete="current-password" placeholder="••••••••" />

                                    </div>
                                    <div id="captcha" name="captcha" class="g-recaptcha" data-sitekey="6LcW5mcgAAAAAGaW4JCvtxJ7I5WEHBiw81kW9bVN"  required autocomplete="current-captcha">я не робот</div>

                                    <!-- элемент для вывода ошибок -->
                                    <div class="text-danger" id="recaptchaError"></div>

                                    <!-- js-скрипт гугл капчи -->
                                    <script src='https://www.google.com/recaptcha/api.js'></script>

                                    <div class="d-flex justify-content-center mt-3">
                                        <button type="submit" class="btn btn-outline-info btn-block btn-lg gradient-custom-4">Зарегистрироваться</button>
                                    </div>

                                    <p class="text-center text-muted mt-5 mb-0">Уже зарегистрированы? <a href="login" class="fw-bold text-body"><u>Авторизоваться</u></a></p>


                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout>