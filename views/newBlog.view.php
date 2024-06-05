<?php

    require_once dirname(__DIR__) . '/views/partials/head.php';
    require_once dirname(__DIR__) . '/views/partials/nav.php';

?>

<form class="py-8 z-10 font-serif w-full h-[90%] flex justify-center" method="POST" action="/newBlog">
    <div class="md:w-1/2 w-[90%] mb-4 border border-gray-200 rounded-lg bg-gray-50 flex flex-col items-center justify-center gap-10">
        <div class="relative z-0 w-[90%] group">
            <input type="text" name="title" id="title" value="<?= $blogSelected -> Title ?? '' ?>" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
            <label for="title" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Title</label>
        </div>

        <div class="mx-auto w-[90%] flex flex-col items-start">
            <label for="category" class="block mb-2 text-sm font-medium text-gray-900">Select an category</label>
            <select id="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 outline-none" name="category" required>
                <?php if($blogSelected -> Category) : ?>
                    <option value="<?= $blogSelected -> Category ?>" selected><?= $blogSelected -> Category ?></option>
                    <input type="hidden" name="BlogIDEdited" value="<?= $blogSelected -> BlogID ?>">
                <?php else : ?>
                    <option value="" selected>Choose a category</option>
                    <option value="Technology">Technology</option>
                    <option value="Sport">Sport</option>
                    <option value="Science">Science</option>
                <?php endif; ?>
            </select>
        </div>

        <div class="px-4 py-2 bg-white rounded-t-lg flex flex-col items-center w-[90%]">
            <label for="content" class="sr-only">Your Blog</label>
            <textarea id="content" rows="20" name="content"  class="w-[90%] px-2 text-sm text-gray-900 bg-white border rounded-lg py-1 border-gray-500 outline-none border-1 focus:ring-0 resize-none" placeholder="Write what in your mind..." required ><?= $blogSelected -> Content ?? '' ?></textarea>
        </div>
        <div class="flex items-center justify-center px-3 py-2">
            <button type="submit" class="inline-flex items-center py-2.5 px-7 text-xs font-bold text-xl text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 hover:bg-blue-800">
                Post Blog
            </button>
        </div>
    </div>
</form>

<?php
    require_once dirname(__DIR__) . '/views/partials/footer.php';