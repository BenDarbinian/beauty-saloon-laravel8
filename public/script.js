
$(document).ready(function(){
    $('#phone-number').mask('+7 (000) 000-00-00');
  });

const trigger = document.querySelector(".logoNavButton");
const nav = document.querySelector(".fullScreenNav");
const backdrop = document.querySelector(".backdrop");
const navtri = document.querySelector(".navMenu");

trigger.addEventListener("click", () => nav.classList.add("open-nav"));
backdrop.addEventListener("click", () => nav.classList.remove("open-nav"));
navtri.addEventListener("click", () => nav.classList.remove("open-nav"));
// Работа с виджетом recaptcha
// 1. Получить ответ гугл капчи
var captcha = grecaptcha.getResponse();

// 2. Если ответ пустой, то выводим сообщение о том, что пользователь не прошёл тест.
// Такую форму не будем отправлять на сервер.
if (!captcha.length) {
  // Выводим сообщение об ошибке
  $('#recaptchaError').text('* Вы не прошли проверку "Я не робот"');
} else {
  // получаем элемент, содержащий капчу
  $('#recaptchaError').text('');
}

// 3. Если форма валидна и длина капчи не равно пустой строке, то отправляем форму на сервер (AJAX)
if ((formValid) && (captcha.length)) {

  // добавить в formData значение 'g-recaptcha-response'=значение_recaptcha
  formData.append('g-recaptcha-response', captcha);

}

// 4. Если сервер вернул ответ error, то делаем следующее...
// Сбрасываем виджет reCaptcha
grecaptcha.reset();
// Если существует свойство msg у объекта $data, то...
if ($data.msg) {
  // вывести её в элемент у которого id=recaptchaError
  $('#recaptchaError').text($data.msg);
}