<?php

    require_once dirname(__DIR__) . '/views/partials/head.php';
    require_once dirname(__DIR__) . '/views/partials/nav.php';

?>

    <main class="py-8 z-10 font-serif w-full h-[90%] flex items-center">
        <article class="w-[20%] border-r-2 h-full border-gray-200 p-5 flex flex-col justify-start items-center">
            <div class="relative flex flex-col overflow-hidden text-gray-700 bg-white rounded-md shadow-md w-80 bg-clip-border">
                <nav id="filterBtns" class="my-2 flex min-w-[240px] flex-col gap-1 p-0 font-sans text-base font-normal text-blue-gray-700">
                    <div role="button" tabindex="-1"
                        class="group flex w-full bg-purple-100 items-center rounded-none p-3 py-1.5 px-3 text-start text-sm font-normal text-blue-gray-700 outline-none transition-all hover:bg-blue-500 hover:bg-opacity-80 hover:text-white focus:bg-blue-500 focus:bg-opacity-80 focus:text-white active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900">
                        <div class="grid mr-4 place-items-center">
                            <i class="fa-solid fa-square-rss text-xl"></i>
                        </div>
                        All
                        <div class="grid ml-auto place-items-center justify-self-end">
                            <div
                            class="relative grid items-center px-2 py-1 font-sans text-xs font-bold text-gray-900 uppercase rounded-full select-none whitespace-nowrap bg-gray-900/10 group-hover:bg-white/20 group-hover:text-white">
                            <span class="">+<?= $allNB ?></span>
                            </div>
                        </div>
                    </div>

                    <div role="button" tabindex="-1"
                        class="group flex w-full items-center rounded-none p-3 py-1.5 px-3 text-start text-sm font-normal text-blue-gray-700 outline-none transition-all hover:bg-blue-500 hover:bg-opacity-80 hover:text-white focus:bg-blue-500 focus:bg-opacity-80 focus:text-white active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900">
                        <div class="grid mr-4 place-items-center">
                            <i class="fa-solid fa-microchip text-xl"></i>
                        </div>
                        Technology
                        <div class="grid ml-auto place-items-center justify-self-end">
                            <div
                            class="relative grid items-center px-2 py-1 font-sans text-xs font-bold text-gray-900 uppercase rounded-full select-none whitespace-nowrap bg-gray-900/10 group-hover:bg-white/20 group-hover:text-white">
                            <span class="">+<?= $techNB ?></span>
                            </div>
                        </div>
                    </div>

                    <div role="button" tabindex="-1"
                        class="group flex w-full items-center rounded-none p-3 py-1.5 px-3 text-start text-sm font-normal text-blue-gray-700 outline-none transition-all hover:bg-blue-500 hover:bg-opacity-80 hover:text-white focus:bg-blue-500 focus:bg-opacity-80 focus:text-white active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900">
                        <div class="grid mr-4 place-items-center">
                            <i class="fa-solid fa-volleyball text-xl"></i>
                        </div>
                        Sport
                        <div class="grid ml-auto place-items-center justify-self-end">
                            <div
                            class="relative grid items-center px-2 py-1 font-sans text-xs font-bold text-gray-900 uppercase rounded-full select-none whitespace-nowrap bg-gray-900/10 group-hover:bg-white/20 group-hover:text-white">
                            <span class="">+<?= $sportNB ?></span>
                            </div>
                        </div>
                    </div>

                    <div role="button" tabindex="-1"
                        class="group flex w-full items-center rounded-none p-3 py-1.5 px-3 text-start text-sm font-normal text-blue-gray-700 outline-none transition-all hover:bg-blue-500 hover:bg-opacity-80 hover:text-white focus:bg-blue-500 focus:bg-opacity-80 focus:text-white active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900">
                        <div class="grid mr-4 place-items-center">
                            <i class="fa-solid fa-flask text-xl"></i>
                        </div>
                        Science
                        <div class="grid ml-auto place-items-center justify-self-end">
                            <div
                            class="relative grid items-center px-2 py-1 font-sans text-xs font-bold text-gray-900 uppercase rounded-full select-none whitespace-nowrap bg-gray-900/10 group-hover:bg-white/20 group-hover:text-white">
                            <span class="">+<?= $scienceNB ?></span>
                            </div>
                        </div>
                    </div>

                    <div role="button" tabindex="-1"
                        class="group flex w-full items-center rounded-none p-3 py-1.5 px-3 text-start text-sm font-normal text-blue-gray-700 outline-none transition-all hover:bg-blue-500 hover:bg-opacity-80 hover:text-white focus:bg-blue-500 focus:bg-opacity-80 focus:text-white active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900">
                        <div class="grid mr-4 place-items-center">
                            <i class="fa-solid fa-network-wired text-xl"></i>
                        </div>
                        MyNetwork
                        <div class="grid ml-auto place-items-center justify-self-end">
                            <div
                            class="relative grid items-center px-2 py-1 font-sans text-xs font-bold text-gray-900 uppercase rounded-full select-none whitespace-nowrap bg-gray-900/10 group-hover:bg-white/20 group-hover:text-white">
                            <span id="networkBlogs" class="">+404</span>
                            </div>
                        </div>
                    </div>
                    
                </nav>
            </div>

        </article>
        <article id="blogs" class="w-[50%] border-r-2 h-full border-gray-200 p-2 flex flex-col gap-5 overflow-y-auto">
            <?php if(count($allBlogs) > 0) :?>
                <?php foreach($allBlogs as $blog) : ?>
                    <?php
                        $db -> query('SELECT * FROM Comments WHERE BlogID = :BlogID');
                        $db -> bind(':BlogID', $blog->BlogID);
                        $db -> execute();
                        $commentsNB = $db -> rowCount();

                        $db -> query('SELECT * FROM Likes WHERE BlogID = :BlogID');
                        $db -> bind(':BlogID', $blog->BlogID);
                        $db -> execute();
                        $likesBlogNB = $db -> rowCount();

                        $db -> query('SELECT * FROM Dislikes WHERE BlogID = :BlogID');
                        $db -> bind(':BlogID', $blog->BlogID);
                        $db -> execute();
                        $dislikesNB = $db -> rowCount();

                        $reactionNB = $likesBlogNB - $dislikesNB;

                        $db -> query('SELECT * FROM Likes WHERE UserID = :UserID AND BlogID = :BlogID');
                        $db -> bind(':BlogID', $blog -> BlogID);
                        $db -> bind(':UserID', $UserID);
                        $db -> execute();
                        $likeit =  $db -> rowCount();

                        $db -> query('SELECT * FROM Dislikes WHERE UserID = :UserID AND BlogID = :BlogID');
                        $db -> bind(':BlogID', $blog -> BlogID);
                        $db -> bind(':UserID', $UserID);
                        $db -> execute();
                        $dislikeit =  $db -> rowCount() > 0;

                        $db -> query('SELECT * FROM Followers WHERE FollowerID = :FollowerID AND UserID = :UserID;');
                        $db -> bind(':UserID', $blog -> UserID);
                        $db -> bind(':FollowerID', $UserID);
                        $db -> execute();
                        $followerORnot = $db -> rowCount() > 0;

                    ?>
                    <article id="<?= $blog -> BlogID ?>" class="p-6 bg-white rounded-lg border border-gray-200 shadow-md">
                        <input type="hidden" <?= $followerORnot ? 'network' : '' ?>>
                        <div class="flex justify-between items-center mb-5 text-gray-500">
                            <span id="category" class="bg-primary-100 text-primary-800 text-xs font-medium inline-flex items-center gap-2 px-2.5 py-0.5 rounded">
                                <i class="fa-brands fa-readme"></i>
                                <?= $blog -> Category ?>
                            </span>
                            <span class="text-sm">Last Edit : <?= $blog -> LastModifiedDate ?></span>
                        </div>
                        <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 hover:underline"><a href="/blog?BlogID=<?= $blog -> BlogID ?>"><?= $blog -> Title ?></a></h2>
                        <p class="mb-5 font-light text-gray-500">
                            <?= strlen($blog->Content) > 600 ? substr($blog->Content, 0, 600) . '...' : $blog->Content ?>
                        </p>
                        <div class="flex justify-between items-center">
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
                            <a href="/blog?BlogID=<?= $blog -> BlogID ?>" class="inline-flex items-center font-medium text-primary-600 hover:underline">
                                Read more
                                <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            </a>
                        </div>
                    </article> 
                <?php endforeach; ?>
            <?php else : ?>
                <h1 class="text-3xl font-extrabold text-center py-20">No blog is available in this category until now.</h1>
            <?php endif; ?>
        </article>
        <article class="w-[30%] h-full border-gray-200 flex items-start">
            <div class="max-w-2xl mx-4 sm:max-w-sm md:max-w-sm lg:max-w-sm xl:max-w-sm sm:mx-auto md:mx-auto lg:mx-auto xl:mx-auto mt-16 bg-white shadow-xl rounded-lg text-gray-900">
                <div class="rounded-t-lg h-32 overflow-hidden">
                    <img class="object-cover object-top w-full" src='https://images.unsplash.com/photo-1549880338-65ddcdfd017b?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=400&fit=max&ixid=eyJhcHBfaWQiOjE0NTg5fQ' alt='Mountain'>
                </div>
                <div class="mx-auto w-32 h-32 relative -mt-16 border-4 border-white rounded-full overflow-hidden">
                    <img class="object-cover object-center h-32" src='<?= $picture ?>' >
                </div>
                <div class="text-center mt-2">
                    <h2 class="font-semibold"><?= $name ?></h2>
                    <p class="text-gray-500"><?= $email ?></p>
                </div>
                <ul class="py-4 mt-2 text-gray-700 flex items-center justify-around">
                    <li class="flex flex-col items-center justify-around">
                        <i class="fa-solid fa-heart"></i>
                        <div id="likeNB"><?= $likesNB ?></div>
                    </li>
                    <li class="flex flex-col items-center justify-between">
                        <i class="fa-solid fa-user-plus"></i>
                        <div id="followersNB"><?= $followersNB ?></div>
                    </li>
                    <li class="flex flex-col items-center justify-around">
                        <i class="fa-solid fa-newspaper"></i>
                        <div><?= $blogsNB ?></div>
                    </li>
                </ul>
                <div class="p-4 border-t mx-8 mt-2">
                    <a href="/newBlog" class="w-1/2 block mx-auto rounded-full bg-gray-900 hover:shadow-lg font-semibold text-white px-6 py-2">New Blog</a>
                </div>
            </div>
        </article>
    </main>

<script src="/js/dashboard.js"></script>


<?php
    require_once dirname(__DIR__) . '/views/partials/footer.php';