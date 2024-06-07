<?php

    require_once dirname(__DIR__) . '/views/partials/head.php';
    require_once dirname(__DIR__) . '/views/partials/nav.php';

?>

<main class="py-8 z-10 font-serif w-full h-[90%] flex items-center">
    <div class="bg-gray-100 w-full h-full">
        <div class="container mx-auto py-8 h-full">
            <div class="grid grid-cols-4 sm:grid-cols-12 gap-6 px-4 h-full">
                <div class="col-span-4 sm:col-span-3">
                    <div class="bg-white shadow rounded-lg p-6">
                        <div class="flex flex-col items-center">
                            <img src="<?= $User -> Profile ?>" class="w-32 h-32 bg-gray-300 rounded-full mb-4 shrink-0">
                            </img>
                            <h1 class="text-xl font-bold"><?= "{$User -> FirstName} {$User -> LastName}" ?></h1>
                            <p class="text-gray-700"><?= $User -> Email ?></p>
                            <div class="mt-6 flex flex-wrap gap-4 justify-center">
                                <?php if ($profileUserID == $UserID) :?>
                                    <a href="/editProfile" class="bg-gray-300 hover:bg-gray-400 text-gray-700 py-2 px-10 rounded">Edit</a>
                                <?php else : ?>
                                    <a href="#" onclick="follow(event ,<?= $User -> UserID ?>)" class="<?= $followerORnot ? 'bg-red-500 hover:bg-red-600' : 'bg-blue-500 hover:bg-blue-600' ?>  text-white py-2 px-4 rounded"><?= $followerORnot ? 'Following' : 'Follow'  ?></a>
                                    <a href="#" class="bg-gray-300 hover:bg-gray-400 text-gray-700 py-2 px-4 rounded">Message</a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <hr class="my-6 border-t border-gray-300">
                        <div class="flex flex-col">
                            <span class="text-gray-700 uppercase font-bold tracking-wider mb-2">Statistic</span>
                            <ul class="font-serif ps-3">
                                <?php

                                    $countLikes = 0;
                                    $countDislikes = 0;
                                    $countComments = 0;

                                    $db -> query('SELECT * FROM Followers WHERE UserID = :UserID;');
                                    $db -> bind(':UserID', $User -> UserID);
                                    $db -> execute();
                                    $countFollowers = $db -> rowCount();

                                    foreach($Blogs as $blog) {
                                        try {
                                            $db -> query('SELECT * FROM Likes WHERE BlogID = :BlogID;');
                                            $db -> bind(':BlogID', $blog -> BlogID);
                                            $db -> execute();
                                            $countLikes += $db -> rowCount();

                                            $db -> query('SELECT * FROM Dislikes WHERE BlogID = :BlogID;');
                                            $db -> bind(':BlogID', $blog -> BlogID);
                                            $db -> execute();
                                            $countDislikes += $db -> rowCount();

                                            $db -> query('SELECT * FROM Comments WHERE BlogID = :BlogID;');
                                            $db -> bind(':BlogID', $blog -> BlogID);
                                            $db -> execute();
                                            $countComments += $db -> rowCount();

                                        } catch (Exception $e) {
                                            echo $e -> getMessage() .'';
                                            die();
                                        }
                                    }
                                ?>
                                <li class="mb-2"><pre>Blogs     : <?= count($Blogs) ?></pre></li>
                                <li class="mb-2"><pre>Likes     : <span id="countLikes"><?= $countLikes ?></span></pre></li>
                                <li class="mb-2"><pre>Dislikes  : <span id="countDislikes"><?= $countDislikes ?></span></pre></li>
                                <li class="mb-2"><pre>Comments  : <?= $countComments ?></pre></li>
                                <a href="#" class="cursor-pointer hover:underline"><li class="mb-2"><pre>Followers : <span id="countFollowers"><?= $countFollowers ?></span></pre></li></a>
                            </ul>
                        </div>
                        <p class="font-light mt-10">Registration Date : <?= $User -> RegistrationDate ?></p>
                    </div>
                </div>
                <div class="col-span-4 sm:col-span-9 h-full overflow-y-auto">
                    <div class="bg-white shadow rounded-lg p-6 h-full overflow-y-auto flex flex-col gap-4">
                        <?php if(count($Blogs) > 0) :?>
                            <?php foreach($Blogs as $blog) : ?>
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
                                    $db -> bind(':UserID', $user -> UserID);
                                    $db -> execute();
                                    $likeit =  $db -> rowCount();

                                    $db -> query('SELECT * FROM Dislikes WHERE UserID = :UserID AND BlogID = :BlogID');
                                    $db -> bind(':BlogID', $blog -> BlogID);
                                    $db -> bind(':UserID', $user -> UserID);
                                    $db -> execute();
                                    $dislikeit =  $db -> rowCount() > 0;
                                ?>
                                <article id="<?= $blog -> BlogID ?>" class="p-6 bg-white rounded-lg border border-gray-200 shadow-md">
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
                                        <div class="flex gap-5 items-center justfiy-center">
                                            <span class="flex justfiy-center items-center gap-2">
                                                <a href="#" onclick="like(event)"><i class="fa-<?=$likeit == 0? 'regular' : 'solid' ?> fa-thumbs-up hover:text-green-500"></i></a> <!--regular -- solid-->
                                                <span id="reactionNB" class="text-<?= $reactionNB >= 0 ? 'green' : 'red' ?>-700 font-bold"><?= $reactionNB ?></span>
                                                <a href="#" onclick="dislike(event)"><i class="fa-<?=$dislikeit == 0? 'regular' : 'solid' ?> fa-thumbs-down hover:text-red-500"></i></a>
                                            </span>
                                            <span class="flex justfiy-center items-center gap-2">
                                                | <a href="/blog?BlogID=<?= $blog -> BlogID ?>"><i class="fa-regular fa-comment hover:text-green-500"></i></a>
                                                <span class="font-bold"><?= $commentsNB ?></span>
                                            </span>
                                            <?php if ($profileUserID == $UserID) :?>
                                                | <a href="#" onclick="deleteBlog(<?= $blog -> BlogID ?>)"><i class="fa-solid fa-trash hover:text-gray-700"></i></a>
                                            <?php endif ; ?>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="/js/profile.js" ></script>
<script src="/js/deleteBlog.js"></script>

<?php
    require_once dirname(__DIR__) . '/views/partials/footer.php';