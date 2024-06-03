<?php require_once "partials/head.php" ?>
<?php require_once "partials/nav.php" ?>

<main class="py-8 z-10 font-serif w-full h-[90%] flex items-center justify-center">
    <article id="<?= $blog -> BlogID ?>" class="p-6 bg-white rounded-lg border border-gray-200 shadow-md w-[90%] h-full">
        <input type="hidden" <?= $followerORnot ? 'name="network"' : '' ?>>
        <div class="flex justify-between items-center mb-5 text-gray-500">
            <span id="category" class="bg-primary-100 text-primary-800 text-xs font-medium inline-flex items-center gap-2 px-2.5 py-0.5 rounded">
                <i class="fa-brands fa-readme"></i>
                <?= $blog -> Category ?>
            </span>
            <span class="text-sm">Last Edit : <?= $blog -> LastModifiedDate ?></span>
        </div>
        <div class="flex justify-between items-center mb-5">
            <div class="flex items-center gap-5">
                <a class="flex items-center space-x-4 hover:underline" href="#">
                    <img class="w-7 h-7 rounded-full" src="<?= $blog -> Profile ?>" alt="<?= $blog -> LastName ?>" />
                    <span class="font-medium">
                        <?= $blog -> LastName . ' ' . $blog -> FirstName ?>
                    </span>
                </a>
                <a href="#" onclick="follow(event)"><i class="fa-<?= $followerORnot ? 'solid' : 'regular' ?> fa-star hover:text-yellow-500"></i></a>
            </div>
            <div class="flex gap-5 items-center justfiy-center">
                <span class="flex justfiy-center items-center gap-2">
                    <a href="#" onclick="like(event)"><i class="fa-<?=$likeit == 0? 'regular' : 'solid' ?> fa-thumbs-up hover:text-green-500"></i></a> <!--regular -- solid-->
                    <span id="reactionNB" class="text-<?= $reactionNB >= 0 ? 'green' : 'red' ?>-700 font-bold"><?= $reactionNB ?></span>
                    <a href="#" onclick="dislike(event)"><i class="fa-<?=$dislikeit == 0? 'regular' : 'solid' ?> fa-thumbs-down hover:text-red-500"></i></a>
                </span>
                <span class="flex justfiy-center items-center gap-2">
                    <a href="/blog?BlogID=<?= $blog -> BlogID ?>"><i class="fa-regular fa-comment hover:text-green-500"></i></a>
                    <span class="font-bold"><?= $commentsNB ?></span>
                </span>
            </div>
        </div>
        <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 hover:underline"><a href="/blog?BlogID=<?= $blog -> BlogID ?>"><?= $blog -> Title ?></a></h2>
        <p class="mb-5 font-light text-gray-500 h-[40%] p-4 bg-blue-50 overflow-y-auto">
            <?= $blog->Content ?>
        </p>


        <div>
            <label for="comment" class="sr-only">Your Comment</label>
            <div class="flex items-center px-3 py-2 rounded-lg bg-gray-50">
                <button type="button" class="inline-flex justify-center p-2 text-gray-500 rounded-lg cursor-pointer hover:text-gray-900 hover:bg-gray-100">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
                        <path fill="currentColor" d="M13 5.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0ZM7.565 7.423 4.5 14h11.518l-2.516-3.71L11 13 7.565 7.423Z"/>
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 1H2a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1Z"/>
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0ZM7.565 7.423 4.5 14h11.518l-2.516-3.71L11 13 7.565 7.423Z"/>
                    </svg>
                    <span class="sr-only">Upload image</span>
                </button>
                <button type="button" class="p-2 text-gray-500 rounded-lg cursor-pointer hover:text-gray-900 hover:bg-gray-100">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.408 7.5h.01m-6.876 0h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0ZM4.6 11a5.5 5.5 0 0 0 10.81 0H4.6Z"/>
                    </svg>
                    <span class="sr-only">Add emoji</span>
                </button>
                <textarea id="comment" rows="2" class="block mx-4 p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 outline-none resize-none" placeholder="Your Comment..."></textarea>
                    <button type="submit" class="inline-flex justify-center p-2 text-blue-600 rounded-full cursor-pointer hover:bg-blue-100">
                    <svg class="w-5 h-5 rotate-90 rtl:-rotate-90" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                        <path d="m17.914 18.594-8-18a1 1 0 0 0-1.828 0l-8 18a1 1 0 0 0 1.157 1.376L8 18.281V9a1 1 0 0 1 2 0v9.281l6.758 1.689a1 1 0 0 0 1.156-1.376Z"/>
                    </svg>
                    <span class="sr-only">Send message</span>
                </button>
            </div>
        </div>

    </article>
</main>

<script src="/js/blog.js"></script>

<?php require_once "partials/footer.php" ?>