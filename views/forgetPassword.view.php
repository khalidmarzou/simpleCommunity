<?php require_once "partials/head.php" ?>
<?php require_once "partials/nav.php"  ?>

<section class="bg-gray-50 h-[90%] w-full">

  <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
      <div class="w-full p-6 bg-white rounded-lg shadow md:mt-0 sm:max-w-md sm:p-8">
          <h2 class="mb-1 text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl" id="title">
              We send code to this E-mail
          </h2>
          <form class="mt-4 space-y-4 lg:mt-5 md:space-y-5" method="POST" action="/forgetPassword">
              <div>
                  <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Your email</label>
                  <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="enter your email here">
                  <p id="message" class="text-sm font-light text-red-500 h-8 flex items-center"></p>
              </div>
              <div class="hidden">
                  <label for="code" class="block mb-2 text-sm font-medium text-gray-900">Code that we send</label>
                  <input type="number" name="code" id="code" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
              </div>
              <button type="button" id="confirm_code" class="w-full text-white bg-blue-200 hover:bg-blue-300 focus:ring-4 focus:outline-none focus:ring-primary-300 font-bold rounded-lg text-lg px-5 py-2.5 text-center">Confirm</button>
              <div class="hidden">
                  <label for="password" class="block mb-2 text-sm font-medium text-gray-900">New Password</label>
                  <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
              </div>
              <div class="hidden">
                  <label for="confirm-password" class="block mb-2 text-sm font-medium text-gray-900">Confirm password</label>
                  <input type="password" name="confirm-password" id="confirm-password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
              </div>
              <div class="hidden flex items-start">
                  <div class="flex items-center h-5">
                    <input id="newsletter" aria-describedby="newsletter" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300" required>
                  </div>
                  <div class="ml-3 text-sm">
                    <label for="newsletter" class="font-light text-gray-500">I accept the <a class="font-medium text-primary-600 hover:underline" href="/terms" target="_blank">Terms and Conditions</a></label>
                  </div>
              </div>
              <button type="submit" class="hidden w-full text-white bg-blue-200 hover:bg-blue-300 focus:ring-4 focus:outline-none focus:ring-primary-300 font-bold rounded-lg text-lg px-5 py-2.5 text-center">Reset passwod</button>
          </form>
      </div>
  </div>

</section>

<script src="/js/forgetPassword.js"></script>
<?php require_once "partials/footer.php" ?>