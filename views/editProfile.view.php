<?php

    require_once dirname(__DIR__) . '/views/partials/head.php';
    require_once dirname(__DIR__) . '/views/partials/nav.php';

?>

<main class="py-8 z-10 font-serif w-full h-[90%] flex items-center justify-center">


    <div class="bg-white border border-4 rounded-lg shadow relative m-10 w-[70%] h-[70%]">

        <div class="flex items-start justify-between p-5 border-b rounded-t">
            <h3 class="text-xl font-semibold">
                Edit Profile
            </h3>
        </div>

        <div class="p-6 space-y-6">
            <form action="/editProfile" method="POST" enctype="multipart/form-data">
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-3">
                    <label for="firstName" class="text-sm font-medium text-gray-900 block mb-2">First Name</label>
                        <div class="flex items-center gap-3">
                            <input type="text" name="firstName" id="firstName" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5 outline-none" disabled>
                            <a href="#" onclick="removeDisabled(event)" class="bg-gray-100 py-1 px-2 rounded-lg hover:bg-gray-300"><i class="fa-solid fa-pen-to-square text-2xl hover:text-gray-700"></i></a>
                        </div>
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="lastName" class="text-sm font-medium text-gray-900 block mb-2">Last Name</label>
                        <div class="flex items-center gap-3">
                        <input type="text" name="lastName" id="lastName" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5 outline-none" disabled>
                        
                            <a href="#" onclick="removeDisabled(event)" class="bg-gray-100 py-1 px-2 rounded-lg hover:bg-gray-300"><i class="fa-solid fa-pen-to-square text-2xl hover:text-gray-700"></i></a>
                        </div>
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="email" class="text-sm font-medium text-gray-900 block mb-2">Email</label>
                        <div class="flex items-center gap-3">
                        <input type="email" name="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5 outline-none" disabled>
                        
                            <a href="#" onclick="removeDisabled(event)" class="bg-gray-100 py-1 px-2 rounded-lg hover:bg-gray-300"><i class="fa-solid fa-pen-to-square text-2xl hover:text-gray-700"></i></a>
                        </div>
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="password" class="text-sm font-medium text-gray-900 block mb-2">Password</label>
                        <div class="flex items-center gap-3">
                        <input type="password" name="password" id="password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5 outline-none" disabled>
                        
                            <a href="#" onclick="removeDisabled(event)" class="bg-gray-100 py-1 px-2 rounded-lg hover:bg-gray-300"><i class="fa-solid fa-pen-to-square text-2xl hover:text-gray-700"></i></a>
                        </div>
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label class="text-sm font-medium text-gray-900 block mb-2" for="picture">Edit Profile</label>
                        <div class="flex items-center gap-3">
                        <input class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-1.5 outline-none" id="picture" name="picture" type="file" accept="image/*" disabled>
                            <a href="#" onclick="removeDisabled(event)" class="bg-gray-100 py-1 px-2 rounded-lg hover:bg-gray-300"><i class="fa-solid fa-pen-to-square text-2xl hover:text-gray-700"></i></a>
                        </div>
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="c_password" class="text-sm font-medium text-gray-900 block mb-2">Confirm Password</label>
                        <input type="password" name="c_password" id="c_password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5 outline-none" disabled>
                    </div>
                </div>
            
        </div>

        <div class="p-6 border-t border-gray-200 rounded-b">
            <button class="text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="submit">Save all</button>
            <a href="/profile" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-sm px-7 py-3 text-center">Cancel</a>
        </div>
        </form>
    </div>
</main>
<script src="/js/editProfile.js"></script>


<?php
    require_once dirname(__DIR__) . '/views/partials/footer.php';